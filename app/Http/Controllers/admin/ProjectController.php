<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\Project;

class ProjectController extends Controller
{
    /**
     * Display a listing of the projects.
     */
    public function index(Request $request)
    {
        $query = $request->input('q');

        $projects = Project::query()
            ->when($query, function ($q) use ($query) {
                $q->where('title', 'like', "%{$query}%")
                  ->orWhere('category', 'like', "%{$query}%")
                  ->orWhere('tech_stack', 'like', "%{$query}%");
            })
            ->orderBy('sort_order')
            ->get();

        return view('backend.project.index', compact('projects', 'query'));
    }

    /**
     * Show the form for creating a new project.
     */
    public function create()
    {
        return view('backend.project.create');
    }

    /**
     * Store a newly created project in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'tech_stack'  => 'nullable|string|max:500',
            'live_link'   => 'nullable|url|max:500',
            'github_link' => 'nullable|url|max:500',
            'category'    => 'nullable|string|max:100',
            'image'       => 'nullable|image|max:2048',
            'sort_order'  => 'nullable|integer|min:0',
        ]);

        $data = $request->only([
            'title', 'description', 'tech_stack',
            'live_link', 'github_link', 'category', 'sort_order'
        ]);

        $data['slug'] = Str::slug($request->title);
        $data['is_active'] = $request->has('is_active') ? true : false;

        // Image upload
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('projects', 'public');
        }

        Project::create($data);

        return redirect()->route('admin.projects.index')
            ->with('success', 'Project created successfully!');
    }

    /**
     * Show the form for editing the specified project.
     */
    public function edit($id)
    {
        $project = Project::findOrFail($id);
        return view('backend.project.edit', compact('project'));
    }

    /**
     * Update the specified project in storage.
     */
    public function update(Request $request, $id)
    {
        $project = Project::findOrFail($id);

        $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'tech_stack'  => 'nullable|string|max:500',
            'live_link'   => 'nullable|url|max:500',
            'github_link' => 'nullable|url|max:500',
            'category'    => 'nullable|string|max:100',
            'image'       => 'nullable|image|max:2048',
            'sort_order'  => 'nullable|integer|min:0',
        ]);

        $data = $request->only([
            'title', 'description', 'tech_stack',
            'live_link', 'github_link', 'category', 'sort_order'
        ]);

        $data['slug'] = Str::slug($request->title);
        $data['is_active'] = $request->has('is_active') ? true : false;

        // Image upload
        if ($request->hasFile('image')) {
            // Delete old image
            if ($project->image && Storage::disk('public')->exists($project->image)) {
                Storage::disk('public')->delete($project->image);
            }
            $data['image'] = $request->file('image')->store('projects', 'public');
        }

        $project->update($data);

        return redirect()->route('admin.projects.index')
            ->with('success', 'Project updated successfully!');
    }

    /**
     * Remove the specified project from storage.
     */
    public function destroy($id)
    {
        $project = Project::findOrFail($id);

        // Delete image
        if ($project->image && Storage::disk('public')->exists($project->image)) {
            Storage::disk('public')->delete($project->image);
        }

        $project->delete();

        return redirect()->route('admin.projects.index')
            ->with('success', 'Project deleted successfully!');
    }

    /**
     * Toggle project active status.
     */
    public function toggleStatus($id)
    {
        $project = Project::findOrFail($id);
        $project->update(['is_active' => !$project->is_active]);

        return redirect()->route('admin.projects.index')
            ->with('success', 'Project status updated!');
    }
}
