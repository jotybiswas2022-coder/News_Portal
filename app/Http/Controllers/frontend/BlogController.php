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
    public function index(Request $request)
    {
        $query = $request->get('q');

        $posts = Post::recent();

        if ($query) {
            $posts = $posts->where(function ($q) use ($query) {
                $q->where('title', 'like', "%{$query}%")
                  ->orWhere('content', 'like', "%{$query}%")
                  ->orWhere('category', 'like', "%{$query}%")
                  ->orWhere('tags', 'like', "%{$query}%");
            });
        }

        $posts = $posts->paginate(9)->withQueryString();

        $categories = Post::where('is_published', true)
            ->whereNotNull('category')
            ->select('category')
            ->distinct()
            ->pluck('category');

        return view('frontend.blog.index', compact('posts', 'categories', 'query'));
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
