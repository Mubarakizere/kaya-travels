<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Models\Category;

class BlogController extends Controller
{
    // Public blog index page
    public function index(Request $request)
{
    $query = Post::where('status', 'published')->latest();

    if ($request->filled('category')) {
        $query->where('category_id', $request->category);
    }

    $posts = $query->paginate(9);
    $categories = Category::all();
    $featuredPosts = Post::where('status', 'published')->latest()->take(3)->get();

    return view('blog.index', compact('posts', 'categories', 'featuredPosts'));
}


    // Single blog post page
    public function show($slug)
    {
        $post = Post::where('slug', $slug)->where('status', 'published')->firstOrFail();

        return view('blog.show', compact('post'));
    }
    public function category($slug)
{
    $category = Category::where('slug', $slug)->firstOrFail();
    $posts = $category->posts()->latest()->paginate(6);

    return view('blog.category', compact('category', 'posts'));
}
}
