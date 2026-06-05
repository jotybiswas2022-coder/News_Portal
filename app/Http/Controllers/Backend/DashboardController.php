<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\Order;
use App\Models\Partner;
use App\Models\Product;
use App\Models\SourceCode;

class DashboardController extends Controller
{
    /**
     * Show the admin dashboard.
     */
    public function dashboard()
    {
        // Counts
        $totalContacts = Contact::count();
        $totalOrders  = Order::count();
        $totalProducts = Product::count();
        $totalSourceCodes = SourceCode::count();
        $totalPartners = Partner::count();

        // Recent items
        $contacts = Contact::latest()->take(10)->get();
        $recentOrders = Order::latest()->take(5)->get();

        // Pending orders count (includes all non-finalized statuses)
        $pendingOrders = Order::whereIn('status', ['pending', 'pending_payment', 'payment_submitted'])->count();

        return view('backend.index', compact(
            'totalContacts',
            'totalOrders',
            'totalProducts',
            'totalSourceCodes',
            'totalPartners',
            'contacts',
            'recentOrders',
            'pendingOrders'
        ));
    }

    /**
     * Show all contact messages.
     */
    public function contact()
    {
        $contacts = Contact::latest()->paginate(20);
        return view('backend.contact.index', compact('contacts'));
    }
}
