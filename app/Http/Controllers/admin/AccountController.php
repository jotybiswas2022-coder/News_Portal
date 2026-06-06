<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Account;

class AccountController extends Controller
{
    public function index()
    {
        $account = Account::first();
        return view('backend.account.index', compact('account'));
    }

    public function edit()
    {
        $account = Account::first();
        return view('backend.account.edit', compact('account'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'name'  => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'image' => 'nullable|image|max:2048',
            'cv'    => 'nullable|mimes:pdf,doc,docx|max:5120',
        ]);

        $account = Account::first();
        if (!$account) {
            $account = new Account();
            $account->image = ''; 
        }
        $account->name = $request->name;
        $account->phone = $request->phone;
        $account->email = $request->email;

        // Image upload
        if ($request->hasFile('image')) {
            if ($account->image && Storage::disk('public')->exists($account->image)) {
                Storage::disk('public')->delete($account->image);
            }
            $account->image = $request->file('image')->store('profile', 'public');
        }

        // CV upload
        if ($request->hasFile('cv')) {
            // Delete old CV if exists
            if ($account->cv && Storage::disk('public')->exists($account->cv)) {
                Storage::disk('public')->delete($account->cv);
            }
            $account->cv = $request->file('cv')->store('cv', 'public');
        }

        // Remove CV
        if ($request->has('remove_cv') && $request->remove_cv == '1') {
            if ($account->cv && Storage::disk('public')->exists($account->cv)) {
                Storage::disk('public')->delete($account->cv);
            }
            $account->cv = null;
        }

        $account->save();

        return redirect()->back()->with('success', 'Account updated successfully!');
    }
}