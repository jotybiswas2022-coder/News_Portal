<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    // List all categories
    public function index()
    {
        $categories = Category::all();
        return view('backend.category.index', compact('categories'));
    }

    // Show create form
    public function create()
    {
        return view('backend.category.create');
    }

    // Store new category
    public function store(Request $request)
    {
        $request->validate([
            'name'  => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        Category::create([
            'name'  => $request->name,
            'image' => $request->hasFile('image')
                ? $request->file('image')->store('category', 'public')
                : null,
        ]);

        return redirect('admin/category')->with('success', 'Category added successfully!');
    }

    // Delete category
    public function delete($id)
    {
        $category = Category::findOrFail($id);

        if ($category->image && Storage::disk('public')->exists($category->image)) {
            Storage::disk('public')->delete($category->image);
        }

        $category->delete();

        return redirect('/admin/category')->with('success', 'Category deleted successfully!');
    }

    // Update category
    public function update(Request $request, $id)
    {
        $request->validate([
            'name'  => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        $category = Category::findOrFail($id);
        $category->name = $request->name;

        if ($request->hasFile('image')) {
            // Replacing the preview: drop the file it replaces.
            if ($category->image && Storage::disk('public')->exists($category->image)) {
                Storage::disk('public')->delete($category->image);
            }
            $category->image = $request->file('image')->store('category', 'public');
        } elseif ($request->boolean('remove_image')) {
            // Explicitly cleared, fall back to the newest product photo.
            if ($category->image && Storage::disk('public')->exists($category->image)) {
                Storage::disk('public')->delete($category->image);
            }
            $category->image = null;
        }

        $category->save();

        return redirect('/admin/category')->with('success', 'Category updated successfully!');
    }
}
