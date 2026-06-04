<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\Post;

class BlogController extends Controller
{
    /**
     * Display a listing of the blog posts.
     */
    public function index()
    {
        $posts = Post::latest()->get();
        return view('backend.blog.index', compact('posts'));
    }

    /**
     * Show the form for creating a new post.
     */
    public function create()
    {
        return view('backend.blog.create');
    }

    /**
     * Store a newly created post in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'          => 'required|string|max:255',
            'content'        => 'required|string',
            'excerpt'        => 'nullable|string|max:500',
            'category'       => 'nullable|string|max:100',
            'tags'           => 'nullable|string|max:500',
            'featured_image' => 'nullable|image|max:2048',
        ]);

        $data = $request->only([
            'title', 'content', 'excerpt', 'category', 'tags'
        ]);

        $data['slug'] = Str::slug($request->title);
        $data['user_id'] = auth()->id();
        $data['is_published'] = $request->has('is_published') ? true : false;

        // Featured image upload
        if ($request->hasFile('featured_image')) {
            $data['featured_image'] = $request->file('featured_image')->store('blog', 'public');
        }

        Post::create($data);

        return redirect()->route('admin.blog.index')
            ->with('success', 'Post created successfully!');
    }

    /**
     * Show the form for editing the specified post.
     */
    public function edit($id)
    {
        $post = Post::findOrFail($id);
        return view('backend.blog.edit', compact('post'));
    }

    /**
     * Update the specified post in storage.
     */
    public function update(Request $request, $id)
    {
        $post = Post::findOrFail($id);

        $request->validate([
            'title'          => 'required|string|max:255',
            'content'        => 'required|string',
            'excerpt'        => 'nullable|string|max:500',
            'category'       => 'nullable|string|max:100',
            'tags'           => 'nullable|string|max:500',
            'featured_image' => 'nullable|image|max:2048',
        ]);

        $data = $request->only([
            'title', 'content', 'excerpt', 'category', 'tags'
        ]);

        $data['slug'] = Str::slug($request->title);
        $data['is_published'] = $request->has('is_published') ? true : false;

        // Featured image upload
        if ($request->hasFile('featured_image')) {
            if ($post->featured_image && Storage::disk('public')->exists($post->featured_image)) {
                Storage::disk('public')->delete($post->featured_image);
            }
            $data['featured_image'] = $request->file('featured_image')->store('blog', 'public');
        }

        $post->update($data);

        return redirect()->route('admin.blog.index')
            ->with('success', 'Post updated successfully!');
    }

    /**
     * Remove the specified post from storage.
     */
    public function destroy($id)
    {
        $post = Post::findOrFail($id);

        if ($post->featured_image && Storage::disk('public')->exists($post->featured_image)) {
            Storage::disk('public')->delete($post->featured_image);
        }

        $post->delete();

        return redirect()->route('admin.blog.index')
            ->with('success', 'Post deleted successfully!');
    }

    /**
     * Toggle published status.
     */
    public function toggleStatus($id)
    {
        $post = Post::findOrFail($id);
        $post->update(['is_published' => !$post->is_published]);

        return redirect()->route('admin.blog.index')
            ->with('success', 'Post status updated!');
    }
}
