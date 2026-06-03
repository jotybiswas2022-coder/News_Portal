<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BloodRequest;
use App\Mail\BloodRequestNotification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class FrontendEmergencyRequestController extends Controller
{
    public function showForm()
    {
        return view('frontend.emergency.request');
    }

    public function submitRequest(Request $request)
    {
        $validated = $request->validate([
            'patient_name' => 'required|string|max:255',
            'blood_group' => 'required|in:A+,A-,B+,B-,O+,O-,AB+,AB-',
            'hospital' => 'nullable|string|max:255',
            'location' => 'required|string|max:255',
            'contact_phone' => 'required|string|max:20',
            'message' => 'nullable|string|max:1000',
            'urgency' => 'required|in:critical,urgent,normal',
        ]);

        $bloodRequest = BloodRequest::create([
            'user_id' => Auth::id(),
            'patient_name' => $validated['patient_name'],
            'blood_group' => $validated['blood_group'],
            'hospital' => $validated['hospital'] ?? null,
            'location' => $validated['location'],
            'contact_phone' => $validated['contact_phone'],
            'message' => $validated['message'] ?? null,
            'urgency' => $validated['urgency'],
            'status' => 'pending',
        ]);

        // Find matching donors
        $matchingDonors = $bloodRequest->findMatchingDonors();
        $matchedCount = $matchingDonors->count();

        $bloodRequest->update([
            'matched_donors_count' => $matchedCount,
            'status' => $matchedCount > 0 ? 'matched' : 'pending',
        ]);

        // Send email notifications to matching donors (up to 10 to avoid spam)
        $notifiedCount = 0;
        foreach ($matchingDonors->take(10) as $donor) {
            try {
                if ($donor->user && $donor->user->email) {
                    Mail::to($donor->user->email)->queue(new BloodRequestNotification($bloodRequest, $donor));
                    $notifiedCount++;
                }
            } catch (\Exception $e) {
                \Log::error('Failed to send blood request notification: ' . $e->getMessage());
            }
        }

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => ' আপনার জরুরি রক্তের অনুরোধ পাঠানো হয়েছে! ' . $matchedCount . ' জন সম্ভাব্য ডোনার খুঁজে পাওয়া গেছে।',
                'matched_count' => $matchedCount,
                'notified_count' => $notifiedCount,
                'request_id' => $bloodRequest->id,
            ]);
        }

        return redirect('/emergency-request/my-requests')
            ->with('success', 'আপনার জরুরি রক্তের অনুরোধ পাঠানো হয়েছে! ' . $matchedCount . ' জন সম্ভাব্য ডোনার খুঁজে পাওয়া গেছে।');
    }

    public function myRequests()
    {
        $requests = BloodRequest::where('user_id', Auth::id())
            ->latest()
            ->paginate(10);
        return view('frontend.emergency.my_requests', compact('requests'));
    }

    public function cancelRequest($id)
    {
        $bloodRequest = BloodRequest::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $bloodRequest->update(['status' => 'cancelled']);

        return back()->with('success', 'আপনার অনুরোধটি বাতিল করা হয়েছে।');
    }

    // ── Admin Functions ──

    public function adminIndex()
    {
        $requests = BloodRequest::with('user')
            ->latest()
            ->paginate(20);
        $pendingCount = BloodRequest::where('status', 'pending')->count();
        $matchedCount = BloodRequest::where('status', 'matched')->count();
        $fulfilledCount = BloodRequest::where('status', 'fulfilled')->count();
        $totalCount = BloodRequest::count();

        return view('backend.blood_requests.index', compact(
            'requests', 'pendingCount', 'matchedCount', 'fulfilledCount', 'totalCount'
        ));
    }

    public function adminShow($id)
    {
        $bloodRequest = BloodRequest::with('user')->findOrFail($id);
        $matchingDonors = $bloodRequest->findMatchingDonors();
        return view('backend.blood_requests.show', compact('bloodRequest', 'matchingDonors'));
    }

    public function markFulfilled($id)
    {
        $bloodRequest = BloodRequest::findOrFail($id);
        $bloodRequest->update([
            'status' => 'fulfilled',
            'fulfilled_at' => now(),
        ]);
        return back()->with('success', 'Request marked as fulfilled.');
    }

    public function adminDelete($id)
    {
        BloodRequest::findOrFail($id)->delete();
        return back()->with('success', 'Request deleted successfully.');
    }
}
