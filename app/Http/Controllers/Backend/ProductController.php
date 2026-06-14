<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of products.
     */
    public function index()
    {
        $products = Product::latest()->paginate(20);
        return view('backend.product.index', compact('products'));
    }

    /**
     * Show the form for creating a new product.
     */
    public function create()
    {
        return view('backend.product.create');
    }

    /**
     * Store a newly created product.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:products,slug|alpha_dash',
            'tagline' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'download_link' => 'nullable|string|max:2048',
            'indicator' => 'nullable|string|max:255',
            'pairs' => 'nullable|string',
            'reviews' => 'nullable|integer|min:0',
            'live_signal_years' => 'nullable|numeric|min:0|max:99.9',
            'hero_tagline' => 'nullable|string|max:255',
            'hero_description' => 'nullable|string',
            'feature_image_1' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'feature_image_2' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'feature_image_3' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'features' => 'nullable|array',
            'features.*.tagline' => 'nullable|string|max:255',
            'features.*.title' => 'nullable|string|max:255',
            'features.*.text' => 'nullable|string',
            'plans' => 'nullable|array',
            'plans.*.name' => 'nullable|string|max:255',
            'plans.*.price' => 'nullable|numeric|min:0',
            'plans.*.old_price' => 'nullable|numeric|min:0',
            'plans.*.base_price' => 'nullable|numeric|min:0',
            'plans.*.licenses' => 'nullable|integer|min:0',
            'plans.*.vps' => 'nullable|string|max:255',
            'plans.*.popular' => 'nullable|boolean',
            'plans.*.features' => 'nullable|string',
            'available' => 'nullable|boolean',
        ]);

        // Handle image uploads
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
            $validated['image'] = $imagePath;
        }

        // Handle feature image uploads
        foreach (['feature_image_1', 'feature_image_2', 'feature_image_3'] as $fi) {
            if ($request->hasFile($fi)) {
                $validated[$fi] = $request->file($fi)->store('products/features', 'public');
            }
        }

        // Convert pairs string to array
        $validated['pairs'] = $this->parseCommaList($validated['pairs'] ?? null);

        // Process plans: convert features string to array
        if (isset($validated['plans'])) {
            foreach ($validated['plans'] as $i => $plan) {
                $validated['plans'][$i]['features'] = $this->parseCommaList($plan['features'] ?? null);
            }
        }

        $validated['available'] = $request->has('available');
        $validated['reviews'] = $validated['reviews'] ?? 0;
        $validated['live_signal_years'] = $validated['live_signal_years'] ?? 0;

        Product::create($validated);

        return redirect()->route('admin.products.index')
            ->with('success', 'Product "' . $validated['name'] . '" created successfully.');
    }

    /**
     * Show the form for editing the specified product.
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('backend.product.create', compact('product'));
    }

    /**
     * Update the specified product.
     */
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|alpha_dash|unique:products,slug,' . $id,
            'tagline' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'download_link' => 'nullable|string|max:2048',
            'indicator' => 'nullable|string|max:255',
            'pairs' => 'nullable|string',
            'reviews' => 'nullable|integer|min:0',
            'live_signal_years' => 'nullable|numeric|min:0|max:99.9',
            'hero_tagline' => 'nullable|string|max:255',
            'hero_description' => 'nullable|string',
            'feature_image_1' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'feature_image_2' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'feature_image_3' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'features' => 'nullable|array',
            'features.*.tagline' => 'nullable|string|max:255',
            'features.*.title' => 'nullable|string|max:255',
            'features.*.text' => 'nullable|string',
            'plans' => 'nullable|array',
            'plans.*.name' => 'nullable|string|max:255',
            'plans.*.price' => 'nullable|numeric|min:0',
            'plans.*.old_price' => 'nullable|numeric|min:0',
            'plans.*.base_price' => 'nullable|numeric|min:0',
            'plans.*.licenses' => 'nullable|integer|min:0',
            'plans.*.vps' => 'nullable|string|max:255',
            'plans.*.popular' => 'nullable|boolean',
            'plans.*.features' => 'nullable|string',
            'available' => 'nullable|boolean',
        ]);

        // Handle remove image checkbox (run before upload so upload wins)
        if ($request->has('remove_image') && $request->remove_image == '1') {
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            $validated['image'] = null;
        }

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            $imagePath = $request->file('image')->store('products', 'public');
            $validated['image'] = $imagePath;
        }

        // Handle remove feature image checkboxes (run before upload so upload wins)
        foreach (['feature_image_1', 'feature_image_2', 'feature_image_3'] as $fi) {
            $removeKey = 'remove_' . $fi;
            if ($request->has($removeKey) && $request->$removeKey == '1') {
                if ($product->$fi) {
                    Storage::disk('public')->delete($product->$fi);
                }
                $validated[$fi] = null;
            }
        }

        // Handle feature image uploads
        foreach (['feature_image_1', 'feature_image_2', 'feature_image_3'] as $fi) {
            if ($request->hasFile($fi)) {
                // Delete old feature image if exists
                if ($product->$fi) {
                    Storage::disk('public')->delete($product->$fi);
                }
                $validated[$fi] = $request->file($fi)->store('products/features', 'public');
            }
        }

        // Convert pairs string to array
        $validated['pairs'] = $this->parseCommaList($validated['pairs'] ?? null);

        // Process plans: convert features string to array
        if (isset($validated['plans'])) {
            foreach ($validated['plans'] as $i => $plan) {
                $validated['plans'][$i]['features'] = $this->parseCommaList($plan['features'] ?? null);
            }
        }

        $validated['available'] = $request->has('available');
        $validated['reviews'] = $validated['reviews'] ?? 0;
        $validated['live_signal_years'] = $validated['live_signal_years'] ?? 0;

        $product->update($validated);

        return redirect()->route('admin.products.index')
            ->with('success', 'Product "' . $validated['name'] . '" updated successfully.');
    }

    /**
     * Remove the specified product.
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        // Delete image if exists
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }

        $product->delete();

        return redirect()->route('admin.products.index')
            ->with('success', 'Product deleted successfully.');
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
