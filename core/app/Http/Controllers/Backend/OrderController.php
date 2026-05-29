<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\UserNotification;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Allowed order statuses.
     */
    const STATUSES = ['pending', 'processing', 'completed', 'cancelled'];

    /**
     * Display a listing of orders.
     */
    public function index()
    {
        $orders = Order::latest()->paginate(20);
        return view('backend.order.index', compact('orders'));
    }

    /**
     * Display the specified order.
     */
    public function show($id)
    {
        $order = Order::findOrFail($id);
        $statuses = self::STATUSES;
        return view('backend.order.show', compact('order', 'statuses'));
    }

    /**
     * Update the status of an order.
     */
    public function updateStatus(Request $request, $id)
    {
        $order = Order::findOrFail($id);

        $validated = $request->validate([
            'status' => 'required|string|in:' . implode(',', self::STATUSES),
        ]);

        $order->update([
            'status' => $validated['status'],
        ]);

        // Create notification for the order owner when approved or cancelled
        if (in_array($validated['status'], ['completed', 'cancelled']) && $order->user_id) {
            $isApproved = $validated['status'] === 'completed';
            UserNotification::create([
                'user_id'      => $order->user_id,
                'type'         => $isApproved ? 'order_approved' : 'order_cancelled',
                'title'        => $isApproved ? 'Order Approved' : 'Order Cancelled',
                'message'      => $isApproved
                    ? 'Your order #' . $order->order_number . ' has been approved. You can now download your files.'
                    : 'Your order #' . $order->order_number . ' has been cancelled.',
                'order_number' => $order->order_number,
            ]);
        }

        return redirect()->route('admin.orders.show', $order->id)
            ->with('success', 'Order status updated to "' . ucfirst($validated['status']) . '".');
    }
}
