<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;
use App\Models\Setting;
use App\Models\Slider;

class SiteController extends Controller
{
    // Homepage
    public function index()
    {
        $settings = Setting::first();
        $slider = Slider::latest()->first();

        $posts = Post::where('status', '1')->latest()->get();
        $categories = Category::all();

        return view('frontend.index', compact('posts','categories','settings','slider'));
    }

    // Single Post Page
    public function Post($id)
    {
        $post = Post::where('id', $id)
                    ->where('status', '1')
                    ->firstOrFail();

        $otherPosts = Post::where('category_id', $post->category_id)
                          ->where('id', '!=', $post->id)
                          ->where('status', '1')
                          ->latest()
                          ->take(8)
                          ->get();

        return view('frontend.post.index', compact('post', 'otherPosts'));
    }

    // Category Wise Posts
    public function list($id)
    {
        $posts = Post::where('category_id', $id)
                    ->where('status', '1')
                    ->latest()
                    ->get();

        return view('frontend.post.list', compact('posts'));
    }
}