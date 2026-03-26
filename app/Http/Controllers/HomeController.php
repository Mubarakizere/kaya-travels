<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Destination;
use App\Models\Trip;

class HomeController extends Controller
{
    public function index()
{
    $featuredDestinations = Destination::where('is_featured', true)
        ->latest()
        ->take(3)
        ->get();

    $nonFeaturedDestinations = Destination::where('is_featured', false)
        ->latest()
        ->take(6)
        ->get();

    $destinations = Destination::whereHas('trips')->get();

    $latestPosts = Post::where('status', 'published')
        ->orderBy('published_at', 'desc')
        ->take(3)
        ->get();

    return view('home', [
        'featuredDestinations' => $featuredDestinations,
        'nonFeaturedDestinations' => $nonFeaturedDestinations,
        'destinations' => $destinations,
        'latestPosts' => $latestPosts,
    ]);
}

}
