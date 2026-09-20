<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;

class ProfitController extends Controller
{
    public function index(Request $request)
    {
        $orders = Order::where('status', 'delivered')->with('orderdetails')->get();

        $startDate = $request->get('start_date');
        $endDate = $request->get('end_date');

        $totalProfit = 0;
        $totalRevenue = 0;
        $totalCost = 0;
        $totalOrders = 0;

        foreach ($orders as $order) {
            foreach ($order->orderdetails as $item) {
                $sellDate = $item->created_at->toDateString();

                if (($startDate && $sellDate < $startDate) || ($endDate && $sellDate > $endDate)) {
                    continue;
                }

                $product = Product::find($item->product_id);
                $discount = $product->discount ?? 0;
                $buyPrice = buyprice($item->product_id);
                $sellprice = $item->product_price * (100 - $discount) / 100;
                $profit = $sellprice - $buyPrice;

                $totalProfit += $profit;
                $totalRevenue += $sellprice;
                $totalCost += $buyPrice;
                $totalOrders++;
            }
        }

        $currency = optional(\App\Models\Setting::first())->currency ?? '৳';

        return view('backend.profit_loss', compact(
            'orders',
            'totalProfit',
            'totalRevenue',
            'totalCost',
            'totalOrders',
            'currency',
            'startDate',
            'endDate'
        ));
    }
}