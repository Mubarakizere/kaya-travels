<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Post;
use App\Models\Category;
use App\Helpers\ImageHelper;

class PostController extends Controller
{
    // List posts
    public function index()
    {
        $posts = Post::latest()->paginate(10);
        return view('admin.posts.index', compact('posts'));
    }

    // Show create form
    public function create()
    {
        $categories = Category::all();
        return view('admin.posts.create', compact('categories'));
    }

    // Store new post
    public function store(Request $request)
    {
        $request->validate([
            'title'        => 'required|string|max:255',
            'excerpt'      => 'nullable|string|max:500',
            'video_url'    => 'nullable|url',
            'thumbnail'    => 'nullable|image|max:30720', // 30MB
            'content'      => 'required|string',
            'status'       => 'required|in:draft,published',
            'category_id'  => 'nullable|exists:categories,id',
        ]);

        $data = $request->only([
            'title', 'excerpt', 'video_url', 'content', 'status', 'category_id'
        ]);

        $data['author_id']    = Auth::id();
        $data['slug']         = Str::slug($request->title) . '-' . Str::random(4);
        $data['published_at'] = $request->status === 'published' ? now() : null;

        // Upload thumbnail
        if ($request->hasFile('thumbnail')) {
            $data['thumbnail'] = ImageHelper::compressAndStore($request->file('thumbnail'), 'posts');
        }

        Post::create($data);

        return redirect()->route('admin.posts.index')->with('success', 'Post created successfully.');
    }

    // Trix editor image upload
    public function uploadTrixImage(Request $request)
    {
        $request->validate([
            'attachment' => 'required|image|max:30720', // 30MB
        ]);

        $path = ImageHelper::compressAndStore($request->file('attachment'), 'posts/trix-images');
        $url  = Storage::url($path);

        return response()->json(['success' => true, 'url' => $url]);
    }

    // Show edit form
    public function edit(Post $post)
    {
        $categories = Category::all();
        return view('admin.posts.edit', compact('post', 'categories'));
    }

    // Update existing post
    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title'        => 'required|string|max:255',
            'excerpt'      => 'nullable|string|max:500',
            'video_url'    => 'nullable|url',
            'thumbnail'    => 'nullable|image|max:30720', // 30MB
            'content'      => 'required|string',
            'status'       => 'required|in:draft,published',
            'category_id'  => 'nullable|exists:categories,id',
        ]);

        $data = $request->only([
            'title', 'excerpt', 'video_url', 'content', 'status', 'category_id'
        ]);

        $data['published_at'] = $request->status === 'published' && !$post->published_at
            ? now()
            : $post->published_at;

        // Handle thumbnail update
        if ($request->hasFile('thumbnail')) {
            if ($post->thumbnail) {
                Storage::disk('public')->delete($post->thumbnail);
            }
            $data['thumbnail'] = ImageHelper::compressAndStore($request->file('thumbnail'), 'posts');
        }

        $post->update($data);

        return redirect()->route('admin.posts.index')->with('success', 'Post updated successfully.');
    }

    // Delete post
    public function destroy(Post $post)
    {
        if ($post->thumbnail) {
            Storage::disk('public')->delete($post->thumbnail);
        }
        $post->delete();
        return back()->with('success', 'Post deleted successfully.');
    }
}
