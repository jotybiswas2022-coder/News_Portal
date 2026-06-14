<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\SourceCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SourceCodeController extends Controller
{
    /**
     * Display a listing of source codes.
     */
    public function index()
    {
        $sourceCodes = SourceCode::latest()->paginate(20);
        return view('backend.source-code.index', compact('sourceCodes'));
    }

    /**
     * Show the form for creating a new source code.
     */
    public function create()
    {
        return view('backend.source-code.create');
    }

    /**
     * Store a newly created source code.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:source_codes,slug|alpha_dash',
            'tagline' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'old_price' => 'nullable|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'download_link' => 'nullable|string|max:2048',
            'language' => 'nullable|string|max:255',
            'category' => 'nullable|string|max:255',
            'platform' => 'nullable|string|max:255',
            'version' => 'nullable|string|max:255',
            'features' => 'nullable|string',
            'code' => 'nullable|string',
            'available' => 'nullable|boolean',
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('source-codes', 'public');
            $validated['image'] = $imagePath;
        }

        // Convert features string to array
        $validated['features'] = $this->parseCommaList($validated['features'] ?? null);

        $validated['available'] = $request->has('available');

        SourceCode::create($validated);

        return redirect()->route('admin.source-codes.index')
            ->with('success', 'Source code "' . $validated['name'] . '" created successfully.');
    }

    /**
     * Show the form for editing the specified source code.
     */
    public function edit($id)
    {
        $sourceCode = SourceCode::findOrFail($id);
        return view('backend.source-code.create', compact('sourceCode'));
    }

    /**
     * Update the specified source code.
     */
    public function update(Request $request, $id)
    {
        $sourceCode = SourceCode::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|alpha_dash|unique:source_codes,slug,' . $id,
            'tagline' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'old_price' => 'nullable|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'download_link' => 'nullable|string|max:2048',
            'language' => 'nullable|string|max:255',
            'category' => 'nullable|string|max:255',
            'platform' => 'nullable|string|max:255',
            'version' => 'nullable|string|max:255',
            'features' => 'nullable|string',
            'code' => 'nullable|string',
            'available' => 'nullable|boolean',
        ]);

        // Handle remove image checkbox (run before upload so upload wins)
        if ($request->has('remove_image') && $request->remove_image == '1') {
            if ($sourceCode->image) {
                Storage::disk('public')->delete($sourceCode->image);
            }
            $validated['image'] = null;
        }

        // Handle image upload
        if ($request->hasFile('image')) {
            if ($sourceCode->image) {
                Storage::disk('public')->delete($sourceCode->image);
            }
            $imagePath = $request->file('image')->store('source-codes', 'public');
            $validated['image'] = $imagePath;
        }

        // Convert features string to array
        $validated['features'] = $this->parseCommaList($validated['features'] ?? null);

        $validated['available'] = $request->has('available');

        $sourceCode->update($validated);

        return redirect()->route('admin.source-codes.index')
            ->with('success', 'Source code "' . $validated['name'] . '" updated successfully.');
    }

    /**
     * Remove the specified source code.
     */
    public function destroy($id)
    {
        $sourceCode = SourceCode::findOrFail($id);

        if ($sourceCode->image) {
            Storage::disk('public')->delete($sourceCode->image);
        }

        $sourceCode->delete();

        return redirect()->route('admin.source-codes.index')
            ->with('success', 'Source code deleted successfully.');
    }

    /**
     * Parse comma-separated string into an array.
     */

    private function parseCommaList(?string $value): ?array
    {
        if (empty($value)) {
            return null;
        }

        $items = array_map('trim', explode(',', $value));
        $items = array_filter($items, fn($v) => $v !== '');

        return empty($items) ? null : array_values($items);
    }
}
