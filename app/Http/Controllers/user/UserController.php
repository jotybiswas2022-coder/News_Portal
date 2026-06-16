<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contact;

class UserController extends Controller
{
    // Contact us form
    public function contactus(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email'=> 'required|email',
            'message'=> 'required|string',
        ]);

        Contact::create($request->all());

        return back()->with('success', 'Message sent successfully!');
    }
}