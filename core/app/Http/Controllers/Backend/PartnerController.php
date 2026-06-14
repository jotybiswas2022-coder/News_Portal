<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Partner;
use Illuminate\Http\Request;

class PartnerController extends Controller
{
    /**
     * Allowed application statuses.
     */
    const STATUSES = ['pending', 'approved', 'rejected'];

    /**
     * Display a listing of partnership applications.
     */
    public function index()
    {
        $partners = Partner::latest()->paginate(20);
        return view('backend.partner.index', compact('partners'));
    }

    /**
     * Update the status of a partnership application.
     */
    public function updateStatus(Request $request, $id)
    {
        $partner = Partner::findOrFail($id);

        $validated = $request->validate([
            'status' => 'required|string|in:' . implode(',', self::STATUSES),
        ]);

        $partner->update([
            'status' => $validated['status'],
        ]);

        return redirect()->route('admin.partners.index')
            ->with('success', 'Application status updated to "' . ucfirst($validated['status']) . '".');
    }

    /**
     * Remove the specified application.
     */
    public function destroy($id)
    {
        $partner = Partner::findOrFail($id);
        $partner->delete();

        return redirect()->route('admin.partners.index')
            ->with('success', 'Application deleted successfully.');
    }
}
