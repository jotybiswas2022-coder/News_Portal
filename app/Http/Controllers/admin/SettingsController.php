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
            'currency'          => 'required|string',
            'language'          => 'required|string',
            'delivery_charge'   => 'nullable|numeric|min:0',
            'delivery_outside'  => 'nullable|numeric|min:0',
            'bkash_number'      => 'nullable|string|max:20',
            'nagad_number'      => 'nullable|string|max:20',
            'contact_instagram' => 'nullable|string|max:100',
            'contact_facebook'  => 'nullable|string|max:150',
            'contact_phone'     => 'nullable|string|max:30',
            'contact_email'     => 'nullable|email|max:100',
            'tax_percentage'    => 'nullable|numeric|min:0',
        ]);

        $settings = Setting::first() ?? new Setting();

        $settings->currency        = $request->currency;
        $settings->language        = $request->language;
        $settings->delivery_charge = $request->delivery_charge ?? 0;
        $settings->delivery_outside = $request->delivery_outside ?? 0;
        $settings->bkash_number    = $request->bkash_number;
        $settings->nagad_number    = $request->nagad_number;
        $settings->contact_instagram = $request->contact_instagram;
        $settings->contact_facebook  = $request->contact_facebook;
        $settings->contact_phone     = $request->contact_phone;
        $settings->contact_email     = $request->contact_email;
        $settings->tax_percentage  = $request->tax_percentage ?? 0;

        $settings->save();

        return redirect()->back()->with('success', 'Settings updated successfully.');
    }
}
