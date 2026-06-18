<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Category;
use App\Models\Contact;
use App\Models\Slider;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    function index()
    {
        // Total counts
        $totalPosts = Post::count();
        $totalCategories = Category::count();
        $totalContacts = Contact::count();
        $totalSliders = Slider::count();

        // Published vs Draft
        $publishedPosts = Post::where('status', '1')->count();
        $draftPosts = Post::where('status', '!=', '1')->orWhereNull('status')->count();

        // Recent posts (latest 6)
        $recentPosts = Post::with('PostCategory')->latest()->take(6)->get();

        // Recent contacts (latest 6)
        $recentContacts = Contact::latest()->take(6)->get();

        // Posts per category (for distribution)
        $categoryPostCounts = Category::withCount('posts')->orderBy('posts_count', 'desc')->get();

        // Latest categories (just in case)
        $latestCategories = Category::latest()->take(5)->get();

        return view('backend.index', compact(
            'totalPosts',
            'totalCategories',
            'totalContacts',
            'totalSliders',
            'publishedPosts',
            'draftPosts',
            'recentPosts',
            'recentContacts',
            'categoryPostCounts',
            'latestCategories'
        ));
    }

    function settings()
    {
        return view('backend.settings');
    }
}
