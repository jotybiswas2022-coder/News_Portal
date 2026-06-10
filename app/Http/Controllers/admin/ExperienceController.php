<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Experience;

class ExperienceController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('q');

        $experiences = Experience::query()
            ->when($query, function ($q) use ($query) {
                $q->where('company', 'like', "%{$query}%")
                  ->orWhere('position', 'like', "%{$query}%")
                  ->orWhere('location', 'like', "%{$query}%");
            })
            ->orderBy('sort_order')
            ->get();

        if ($request->ajax()) {
            $html = view('backend.experience._table_rows', compact('experiences'))->render();
            return response()->json([
                'html'  => $html,
                'count' => $experiences->count(),
                'query' => $query,
            ]);
        }

        return view('backend.experience.index', compact('experiences', 'query'));
    }

    public function create()
    {
        return view('backend.experience.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'company'     => 'required|string|max:255',
            'position'    => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_date'  => 'required|date',
            'end_date'    => 'nullable|date|after_or_equal:start_date',
            'location'    => 'nullable|string|max:255',
            'sort_order'  => 'nullable|integer|min:0',
        ]);

        $data = $request->only([
            'company', 'position', 'description', 'start_date',
            'end_date', 'location', 'sort_order'
        ]);

        $data['is_current'] = $request->has('is_current') ? true : false;
        $data['is_active']  = $request->has('is_active') ? true : false;

        // If current, clear end_date
        if ($data['is_current']) {
            $data['end_date'] = null;
        }

        Experience::create($data);

        return redirect()->route('admin.experiences.index')
            ->with('success', 'Experience created successfully!');
    }

    public function edit($id)
    {
        $experience = Experience::findOrFail($id);
        return view('backend.experience.edit', compact('experience'));
    }

    public function update(Request $request, $id)
    {
        $experience = Experience::findOrFail($id);

        $request->validate([
            'company'     => 'required|string|max:255',
            'position'    => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_date'  => 'required|date',
            'end_date'    => 'nullable|date|after_or_equal:start_date',
            'location'    => 'nullable|string|max:255',
            'sort_order'  => 'nullable|integer|min:0',
        ]);

        $data = $request->only([
            'company', 'position', 'description', 'start_date',
            'end_date', 'location', 'sort_order'
        ]);

        $data['is_current'] = $request->has('is_current') ? true : false;
        $data['is_active']  = $request->has('is_active') ? true : false;

        // If current, clear end_date
        if ($data['is_current']) {
            $data['end_date'] = null;
        }

        $experience->update($data);

        return redirect()->route('admin.experiences.index')
            ->with('success', 'Experience updated successfully!');
    }

    public function destroy($id)
    {
        $experience = Experience::findOrFail($id);
        $experience->delete();

        return redirect()->route('admin.experiences.index')
            ->with('success', 'Experience deleted successfully!');
    }

    public function toggleStatus($id)
    {
        $experience = Experience::findOrFail($id);
        $experience->update(['is_active' => !$experience->is_active]);

        return redirect()->route('admin.experiences.index')
            ->with('success', 'Experience status updated!');
    }
}
