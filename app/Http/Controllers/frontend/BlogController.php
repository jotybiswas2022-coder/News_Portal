<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;

class BlogController extends Controller
{
    /**
     * Display a listing of published blog posts.
     */
    public function index()
    {
        $posts = Post::recent()->paginate(9);
        $categories = Post::where('is_published', true)
            ->whereNotNull('category')
            ->select('category')
            ->distinct()
            ->pluck('category');

        return view('frontend.blog.index', compact('posts', 'categories'));
    }

    /**
     * Display the specified blog post.
     */
    public function show($slug)
    {
        $post = Post::where('slug', $slug)
            ->where('is_published', true)
            ->firstOrFail();

        // Related posts (same category, excluding current)
        $relatedPosts = Post::recent()
            ->where('id', '!=', $post->id)
            ->where(function ($q) use ($post) {
                if ($post->category) {
                    $q->where('category', $post->category);
                }
            })
            ->take(3)
            ->get();

        return view('frontend.blog.show', compact('post', 'relatedPosts'));
    }
}
