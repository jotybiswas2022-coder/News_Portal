<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;

class SiteController extends Controller
{
    // Homepage
    function index()
    {
        // "Featured Collection" — the newest products added from the admin panel.
        $products = Product::latest()->take(8)->get();

        // "Shop by Category" tiles — only categories that actually hold stock,
        // ordered by how much they hold so the fullest ones lead. The newest
        // product of each category doubles as the tile image.
        $categories = Category::withCount('products')
            ->whereHas('products')
            ->with(['products' => fn ($query) => $query->latest()->take(1)])
            ->orderByDesc('products_count')
            ->take(4)
            ->get();

        return view('frontend.index', compact('products', 'categories'));
    }

    // Product detail page
    function product($id)
    {

        $product = Product::findOrFail($id);

        $otherProducts = Product::where('category_id', $product->category_id)
                                ->where('id', '!=', $id)
                                ->inRandomOrder()
                                ->limit(8)
                                ->get();

        return view('frontend.product', compact('product', 'otherProducts'));
    }
}