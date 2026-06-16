<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{

    public function index()
    {
        $posts = Post::latest()->get();
        $categories = Category::all();

        return view('backend.posts.index', compact('posts','categories'));
    }


    public function create()
    {
        $categories = Category::all();
        return view('backend.posts.create', compact('categories'));
    }


    public function store(Request $request)
{
    $request->validate([
        'title'       => 'required|string|max:255',
        'category_id' => 'required|exists:categories,id',
        'details'     => 'nullable|string',
        'status'      => 'required|in:0,1',
        'file'        => 'required|file|mimetypes:image/jpeg,image/png,image/gif,image/webp,video/mp4|max:512000',
    ]);

    $filePath = null;
    if ($request->hasFile('file')) {
        $file = $request->file('file');
        $mime = $file->getMimeType();

        // safety check
        if(!in_array($mime, ['video/mp4','image/jpeg','image/png','image/gif','image/webp'])){
            return back()->with('error','Only Image and MP4 video allowed!');
        }

        $filePath = $file->store('posts','public');
    }

    Post::create([
        'title'       => $request->title,
        'category_id' => $request->category_id,
        'details'     => $request->details ?? '',
        'status'      => (int)$request->status,
        'file'        => $filePath,
    ]);

    return redirect('/admin/posts')->with('success','Post added successfully!');
}



    public function update(Request $request, $id)
    {
        $post = Post::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'details' => 'nullable|string',
            'status' => 'required|in:0,1',
            'file' => 'nullable|mimes:jpg,jpeg,png,gif,webp,mp4|max:512000',
        ]);

        if($request->hasFile('file')){

            $file = $request->file('file');
            $ext  = strtolower($file->getClientOriginalExtension());

            if($file->getMimeType() && str_contains($file->getMimeType(),'video') && $ext !== 'mp4'){
                return redirect()->back()->with('error','Only MP4 video allowed!');
            }

            if($post->file && Storage::disk('public')->exists($post->file)){
                Storage::disk('public')->delete($post->file);
            }

            $post->file = $file->store('posts','public');
        }

        $post->title = $request->title;
        $post->category_id = $request->category_id;
        $post->details = $request->details ?? '';
        $post->status = $request->status;
        $post->save();

        return redirect('/admin/posts')->with('success','Post updated successfully!');
    }



    public function delete($id)
    {
        $post = Post::findOrFail($id);

        if ($post->file && Storage::disk('public')->exists($post->file)) {
            Storage::disk('public')->delete($post->file);
        }

        $post->delete();

        return redirect('/admin/posts')->with('success','Post deleted successfully!');
    }



    public function viewFile($id)
    {
        $post = Post::findOrFail($id);

        if (!$post->file) {
            abort(404);
        }

        $filePath = storage_path('app/public/' . $post->file);

        if (!file_exists($filePath)) {
            abort(404);
        }

        return response()->file($filePath);
    }

}