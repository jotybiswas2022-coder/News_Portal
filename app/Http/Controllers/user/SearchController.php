<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $query      = trim((string) $request->q);
        $categoryId = $request->category;

        $products = Product::query()
            ->with('ProductCategory')
            ->when($query !== '', function ($builder) use ($query) {
                // Grouped so the keyword search cannot escape the category filter.
                $builder->where(function ($sub) use ($query) {
                    $sub->where('name', 'LIKE', "%{$query}%")
                        ->orWhereHas('ProductCategory', function ($category) use ($query) {
                            $category->where('name', 'LIKE', "%{$query}%");
                        });
                });
            })
            ->when($categoryId, function ($builder, $id) {
                $builder->where('category_id', $id);
            })
            ->latest()
            ->paginate(12)
            ->withQueryString();

        // Only categories that actually hold products are offered as filters.
        $categories     = Category::withCount('products')->whereHas('products')->orderBy('name')->get();
        // Looked up directly so an empty/unknown category still highlights and names correctly.
        $activeCategory = $categoryId ? Category::find($categoryId) : null;
        $totalProducts  = $categories->sum('products_count');

        $heading = $query !== ''
            ? 'Results for “' . $query . '”'
            : ($activeCategory->name ?? 'The Collection');

        return view('frontend.search', [
            'products'       => $products,
            'query'          => $query,
            'categories'     => $categories,
            'activeCategory' => $activeCategory,
            'heading'        => $heading,
            'totalProducts'  => $totalProducts,
        ]);
    }
}
