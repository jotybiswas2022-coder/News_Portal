<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class ProfileController extends Controller
{
    /**
     * Show the profile edit form.
     */
    public function show()
    {
        $user = auth()->user();
        return view('frontend.forex.profile', compact('user'));
    }

    /**
     * Update the user's name and/or password.
     */
    public function update(Request $request)
    {
        $user = auth()->user();

        $rules = [
            'name' => 'required|string|max:255',
        ];

        // Only require password fields if current_password is provided
        if ($request->filled('current_password') || $request->filled('password') || $request->filled('password_confirmation')) {
            $rules['current_password'] = ['required', function ($attribute, $value, $fail) use ($user) {
                if (!Hash::check($value, $user->password)) {
                    $fail('Current password is incorrect.');
                }
            }];
            $rules['password'] = ['required', 'confirmed', Password::defaults()];
        }

        $validated = $request->validate($rules);

        // Update name
        $user->name = $validated['name'];

        // Update password if provided
        if ($request->filled('password')) {
            $user->password = Hash::make($validated['password']);
        }

        $user->save();

        return response()->json([
            'success' => true,
            'message' => 'Profile updated successfully!',
        ]);
    }
}
