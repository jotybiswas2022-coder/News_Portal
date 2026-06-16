<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;

class SettingsController extends Controller
{
    public function index()
    {
        $settings = Setting::first();
        return view('backend.settings', compact('settings'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'email'          => 'required|string',
            'phone'          => 'required|string',
            'location'       => 'required|string',
        ]);

        $settings = Setting::first() ?? new Setting();

        $settings->email = $request->email;
        $settings->phone = $request->phone;
        $settings->location = $request->location;

        $settings->save();

        return redirect()->back()->with('success', 'Settings updated successfully.');
    }
}
