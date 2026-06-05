<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\SourceCode;
use App\Models\UserNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class OrderController extends Controller
{
    /**
     * Display a list of orders for the authenticated user.
     */
    public function myOrders(Request $request)
    {
        $sort = $request->query('sort', 'newest');

        $orders = Order::where('user_id', Auth::id())
            ->orderBy('created_at', $sort === 'oldest' ? 'asc' : 'desc')
            ->paginate(10);

        return view('frontend.forex.my-orders', compact('orders', 'sort'));
    }
    /**
     * Place an order — save to database and redirect to success page.
     */
    public function placeOrder(Request $request)
    {
        $validated = $request->validate([
            'items'           => 'required|json',
            'total'           => 'required|numeric|min:0',
            'name'            => 'nullable|string|max:100',
            'email'           => 'nullable|email|max:100',
            'notes'           => 'nullable|string|max:1000',
            'payment_method'  => 'nullable|string|max:50',
            'trading_account' => 'nullable|string|max:50',
            'phone'           => 'nullable|string|max:30',
        ]);

        $items = json_decode($validated['items'], true);
        $user  = Auth::user();

        // Calculate subtotal from items to prevent manipulation
        $subtotal = 0;
        foreach ($items as $item) {
            $subtotal += ($item['price'] ?? 0) * ($item['qty'] ?? 1);
        }

        $order = Order::create([
            'user_id'         => $user?->id,
            'order_number'    => Order::generateOrderNumber(),
            'items'           => $items,
            'subtotal'        => $subtotal,
            'total'           => $validated['total'],
            'payment_method'  => $validated['payment_method'] ?? null,
            'status'          => 'pending_payment',
            'customer_name'   => $validated['name'] ?? ($user?->name),
            'customer_email'  => $validated['email'] ?? ($user?->email),
            'phone'           => $validated['phone'] ?? null,
            'trading_account' => $validated['trading_account'] ?? null,
            'notes'           => $validated['notes'] ?? null,
        ]);

        // Return JSON with order number so the frontend can proceed
        return response()->json([
            'success' => true,
            'order_number' => $order->order_number,
            'message' => 'Order created. Please submit your payment details.'
        ]);
    }

    /**
     * Confirm order with payment proof — handles file upload.
     */
    public function confirmPayment(Request $request)
    {
        $validated = $request->validate([
            'order_number'     => 'required|string|max:50|exists:orders,order_number',
            'transaction_id'     => 'required|string|max:255',
            'payment_screenshot' => 'required|image|mimes:jpeg,png,jpg,webp|max:5120',
        ]);

        $order = Order::where('order_number', $validated['order_number'])->firstOrFail();

        $path = $request->file('payment_screenshot')->store('payments', 'public');

        $updateData = [
            'transaction_id'     => $validated['transaction_id'],
            'payment_screenshot' => $path,
            'status'             => 'payment_submitted',
        ];

        $order->update($updateData);

        return redirect()->route('forex.my-orders')
            ->with('success', 'Your payment details have been submitted successfully! Order #' . $order->order_number);
    }

    /**
     * Order success page — show order details with prev/next navigation.
     */
    public function success(Request $request, $orderNumber = null)
    {
        $orderNumber = $orderNumber ?? $request->query('order');
        $order = null;
        $prevOrder = null;
        $nextOrder = null;
        $downloadLinks = [];

        if ($orderNumber) {
            $order = Order::where('order_number', $orderNumber)->first();

            if ($order && Auth::check()) {
                // Fetch download links for each item based on status
                if (in_array($order->status, ['completed', 'processing'])) {
                    foreach ($order->items ?? [] as $item) {
                        $itemId = $item['id'] ?? '';
                        $link = null;

                        // Source code items: id format is "src-{slug}"
                        if (str_starts_with($itemId, 'src-')) {
                            $slug = substr($itemId, 4);
                            $sourceCode = SourceCode::where('slug', $slug)->first();
                            if ($sourceCode && $sourceCode->download_link) {
                                $link = $sourceCode->download_link;
                            }
                        }
                        // Product items: id format is "{slug}-{planIndex}"
                        else {
                            // Extract slug by removing the last -{number}
                            $lastDash = strrpos($itemId, '-');
                            if ($lastDash !== false) {
                                $slug = substr($itemId, 0, $lastDash);
                                $product = Product::where('slug', $slug)->first();
                                if ($product && $product->download_link) {
                                    $link = $product->download_link;
                                }
                            }
                        }

                        if ($link) {
                            $downloadLinks[] = [
                                'name' => $item['name'] ?? 'Item',
                                'link' => $link,
                            ];
                        }
                    }
                }

                // Get all user's ordered IDs for prev/next navigation
                $userOrderIds = Order::where('user_id', Auth::id())
                    ->orderBy('created_at', 'desc')
                    ->pluck('order_number');

                $currentIndex = $userOrderIds->search($order->order_number);

                if ($currentIndex !== false) {
                    if ($currentIndex > 0) {
                        $prevOrder = $userOrderIds[$currentIndex - 1];
                    }
                    if ($currentIndex < $userOrderIds->count() - 1) {
                        $nextOrder = $userOrderIds[$currentIndex + 1];
                    }
                }
            }
        }

        return view('frontend.forex.order-success', compact('order', 'prevOrder', 'nextOrder', 'downloadLinks'));
    }

    /**
     * Mark a notification as read and redirect to the target page.
     */
    public function markNotificationRead($id)
    {
        $notification = UserNotification::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $notification->update(['is_read' => true]);

        // Redirect to the order page
        return redirect()->route('order.success', ['order' => $notification->order_number]);
    }

    /**
     * Mark all unread notifications as read for the authenticated user.
     */
    public function markAllNotificationsRead()
    {
        UserNotification::forUser(Auth::id())->unread()->update(['is_read' => true]);

        return redirect()->back()->with('success', 'All notifications marked as read.');
    }
}
