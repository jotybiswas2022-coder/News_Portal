<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Account;
use App\Models\Contact;

class DashboardController extends Controller
{
    public function index()
    {
        // Fetch counts and data
        $accountsCount = Account::count();
        $contacts = Contact::latest()->take(5)->get(); 
        $contactsCount = Contact::count();

        return view('backend.index', compact(
            'accountsCount',
            'contacts',
            'contactsCount',
        ));
    }
}