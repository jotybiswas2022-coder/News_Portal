<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Profile;
use Barryvdh\DomPDF\Facade\Pdf;

class DonorController extends Controller
{
    // ==============================
    // Donor List
    // ==============================
    public function index(Request $request){
        $query = Profile::query();

        if ($request->filled('search_name')) {
            $query->where('name', 'like', '%' . $request->search_name . '%');
        }

        if ($request->filled('search_division')) {
            $query->where('division', $request->search_division);
        }

        // Pagination (10 per page)
        $donors = $query->orderBy('id','desc')->paginate(10);
        $donorsCount = Profile::count(); 
        
        return view('backend.donor_list.index', compact('donors', 'donorsCount'));
    }
    // ==============================
    // Show Create Donor Page
    // ==============================
    public function create()
    {
        $groups = ['A+','A-','B+','B-','O+','O-','AB+','AB-'];

        $divisions = [
            'Dhaka',
            'Chattogram',
            'Khulna',
            'Rajshahi',
            'Barishal',
            'Sylhet',
            'Rangpur',
            'Mymensingh'
        ];

        return view('backend.donor_list.create', compact('groups','divisions'));
    }

    // ==============================
    // Store New Donor
    // ==============================
    public function store(Request $request)
    {
        $request->validate([
            'name'          => 'required|string|max:255',
            'number'        => 'required|string|max:20',
            'blood'         => 'required|in:A+,A-,B+,B-,O+,O-,AB+,AB-',
            'division'      => 'required|in:Dhaka,Chattogram,Khulna,Rajshahi,Barishal,Sylhet,Rangpur,Mymensingh',
            'last_donated'  => 'nullable|date',
        ]);

        Profile::create([
            'name'         => $request->name,
            'number'       => $request->number,
            'blood'        => $request->blood,
            'division'     => $request->division,   
            'last_donated' => $request->last_donated,
            'user_id'      => null,
        ]);

        return redirect()->route('donor.index')
            ->with('success', 'Donor added successfully.');
    }

    // ==============================
    // Get Single Donor
    // ==============================
    public function edit($id)
    {
        $donor = Profile::findOrFail($id);
        return response()->json($donor);
    }

    // ==============================
    // Update Donor
    // ==============================
    public function update(Request $request, $id)
    {
        $donor = Profile::findOrFail($id);

        $request->validate([
            'name'          => 'required|string|max:255',
            'number'        => 'required|string|max:20',
            'blood'         => 'required|in:A+,A-,B+,B-,O+,O-,AB+,AB-',
            'division'      => 'required|in:Dhaka,Chattogram,Khulna,Rajshahi,Barishal,Sylhet,Rangpur,Mymensingh',
            'last_donated'  => 'nullable|date',
        ]);

        $donor->update($request->only([
            'name',
            'number',
            'blood',
            'division',   
            'last_donated'
        ]));

        return back()->with('success', 'Donor updated successfully.');
    }

    // ==============================
    // Delete Donor
    // ==============================
    public function delete($id)
    {
        $donor = Profile::findOrFail($id);
        $donor->delete();

        return back()->with('success', 'Donor deleted successfully.');
    }

    // ==============================
    // Export All Donors as PDF
    // ==============================
    public function exportPDF()
    {
        $donors = Profile::orderBy('id','desc')->get();
        $pdf = Pdf::loadView('backend.donor_list.pdf', compact('donors'));
        return $pdf->download('donor-list-' . date('Y-m-d') . '.pdf');
    }

    // ==============================
    // Export All Donors as CSV (opens in Excel)
    // ==============================
    public function exportCSV()
    {
        $donors = Profile::orderBy('id','desc')->get();

        $filename = 'donor-list-' . date('Y-m-d') . '.csv';
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];

        ob_start();
        $handle = fopen('php://output', 'w');
        fwrite($handle, "\xEF\xBB\xBF"); // UTF-8 BOM for Bengali/Excel compatibility

        // CSV header row
        fputcsv($handle, ['#', 'Name', 'Phone', 'Blood Group', 'Division', 'Last Donation', 'Status']);

        foreach ($donors as $i => $donor) {
            $status = $donor->canDonateNow() ? 'Eligible' : 'Not Eligible';
            fputcsv($handle, [
                $i + 1,
                $donor->name ?? 'N/A',
                $donor->number ?? 'N/A',
                $donor->blood ?? 'N/A',
                $donor->division ?? 'N/A',
                $donor->last_donated ? $donor->last_donated->format('d M Y') : 'N/A',
                $status,
            ]);
        }

        fclose($handle);
        $content = ob_get_clean();

        return response($content, 200, $headers);
    }
}