<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Setting;
use Illuminate\Support\Facades\Storage;

class OrderManageController extends Controller
{
    public function store(Request $request)
    {
        $user_id = auth()->id();

        $request->validate([
            'firstname'       => 'required|string|max:255',
            'lastname'        => 'required|string|max:255',
            'email'           => 'required|email',
            'phone'           => 'required|string|max:20',
            'address'         => 'required|string|max:500',
            'payment_method'  => 'required|in:cod,bkash,nagad',
            'delivery_region' => 'sometimes|in:inside,outside',
        ]);

        $setting = Setting::first();
        $region = $request->input('delivery_region', 'inside');

        // Delivery charge depends on the chosen delivery region
        $delivery_charge = ($region === 'outside')
            ? ($setting?->delivery_outside ?? 0)
            : ($setting?->delivery_charge ?? 0);
        $tax_percentage  = $setting?->tax_percentage ?? 0;

        $carts = Cart::with('product')->where('user_id', $user_id)->get();

        if ($carts->isEmpty()) {
            return redirect('/cart')->with('error', 'Your cart is empty!');
        }

        $subtotal_after_discount = 0;

        foreach ($carts as $cart) {
            $product = $cart->product;

            if (!$product) continue;

            if ($cart->quantity > $product->stock) {
                return redirect()->back()->with('error', "Product '{$product->name}' is out of stock!");
            }

            $discount = $product->discount ?? 0;
            $price_after_discount = $product->price * (100 - $discount) / 100;
            $subtotal_after_discount += $price_after_discount * $cart->quantity;
        }

        $tax_amount = ($subtotal_after_discount * $tax_percentage) / 100;
        $total_price = $subtotal_after_discount + $tax_amount + $delivery_charge;

        $order = Order::create([
            'user_id'                      => $user_id,
            'firstname'                    => $request->firstname,
            'lastname'                     => $request->lastname,
            'email'                        => $request->email,
            'phone'                        => $request->phone,
            'address'                      => $request->address,
            'product_price_after_discount' => $subtotal_after_discount,
            'delivery_charge'              => $delivery_charge,
            'tax'                          => $tax_amount,
            'total_price'                  => $total_price,
            'payment_method'               => $request->payment_method,
        ]);

        foreach ($carts as $cart) {
            if (!$cart->product) continue;

            OrderDetail::create([
                'order_id'         => $order->id,
                'product_id'       => $cart->product_id,
                'product_name'     => $cart->product->name,
                'product_quantity' => $cart->quantity,
                'product_price'    => $cart->product->price,
                'status'           => 'processing',
            ]);
        }

        Cart::where('user_id', $user_id)->delete();

        return redirect('/user/order/payment/' . $order->id);
    }

    // ================== PAYMENT PAGE ==================
    public function payment(int $id)
    {
        $order = Order::with('orderdetails')->findOrFail($id);

        if ($order->user_id !== auth()->id()) {
            abort(403, 'You do not have access to this order.');
        }

        $settings  = Setting::first();
        $currency  = $settings?->currency ?? '৳';
        $bkashNo   = $settings?->bkash_number;
        $nagadNo   = $settings?->nagad_number;
        $method    = strtolower(trim($order->payment_method ?? ''));

        // Amount the customer must send now:
        //  - bKash/Nagad order -> full total
        //  - Cash on Delivery  -> delivery charge in advance
        $amountDue = ($method === 'cod') ? (float) $order->delivery_charge : (float) $order->total_price;

        return view('frontend.user.payment', compact('order', 'settings', 'currency', 'bkashNo', 'nagadNo', 'method', 'amountDue'));
    }

    // ================== SUBMIT PAYMENT PROOF ==================
    public function paymentSubmit(Request $request, int $id)
    {
        $order = Order::findOrFail($id);

        if ($order->user_id !== auth()->id()) {
            abort(403, 'You do not have access to this order.');
        }

        $method = strtolower(trim($order->payment_method ?? ''));

        $rules = [
            'sender_number' => 'required|string|max:20',
            'transaction_id' => 'required|string|max:100',
            'screenshot'     => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:4096',
        ];

        if ($method === 'cod') {
            $rules['advance_method'] = 'required|in:bkash,nagad';
        }

        $request->validate($rules);

        $data = [
            'sender_number'    => $request->sender_number,
            'transaction_id'   => $request->transaction_id,
            'advance_method'   => ($method === 'cod') ? $request->advance_method : $method,
            'payment_status'   => 'submitted',
        ];

        if ($request->hasFile('screenshot')) {
            if ($order->payment_screenshot && Storage::disk('public')->exists($order->payment_screenshot)) {
                Storage::disk('public')->delete($order->payment_screenshot);
            }
            $data['payment_screenshot'] = $request->file('screenshot')->store('payment-proofs', 'public');
        }

        $order->update($data);

        return redirect('/orders')->with('success', 'Payment details submitted successfully! We will verify shortly.');
    }
}