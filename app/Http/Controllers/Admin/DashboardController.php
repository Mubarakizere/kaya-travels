<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Booking;
use App\Models\Trip;
use App\Models\Post;
use App\Models\Destination;
use App\Models\Flight;

class DashboardController extends Controller
{
    public function index()
    {
        $totalUsers = User::count();
        $totalBookings = Booking::count();
        $totalTrips = Trip::count();
        $totalPosts = Post::count();
        $totalDestinations = Destination::count();
        $totalFlights = Flight::count();

        $recentBookings = Booking::with(['trip', 'user'])
            ->latest()
            ->take(5)
            ->get();

        $recentTrips = Trip::latest()->take(5)->get();

        $recentUsers = User::where('role', 'customer')
            ->latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'totalUsers',
            'totalBookings',
            'totalTrips',
            'totalPosts',
            'totalDestinations',
            'totalFlights',
            'recentBookings',
            'recentTrips',
            'recentUsers'
        ));
    }
}
