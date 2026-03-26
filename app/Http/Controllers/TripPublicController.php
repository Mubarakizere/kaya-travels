<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Trip;
use App\Models\Destination; // ✅ ONLY this line for Destination

class TripPublicController extends Controller
{
    public function index(Request $request)
    {
        $trips = Trip::query()->where('status', true);

        if ($request->filled('destination')) {
            $trips->whereHas('destination', function ($q) use ($request) {
                $q->where('slug', $request->destination);
            });
        }

        if ($request->filled('category')) {
            $trips->where('category', $request->category);
        }

        if ($request->filled('duration')) {
            $trips->where(function ($q) use ($request) {
                if ($request->duration === '1-3') {
                    $q->where('duration', 'LIKE', '%1%')->orWhere('duration', 'LIKE', '%2%')->orWhere('duration', 'LIKE', '%3%');
                } elseif ($request->duration === '4-7') {
                    $q->where('duration', 'LIKE', '%4%')->orWhere('duration', 'LIKE', '%5%')->orWhere('duration', 'LIKE', '%6%')->orWhere('duration', 'LIKE', '%7%');
                } elseif ($request->duration === '8+') {
                    $q->where('duration', 'LIKE', '%8%')->orWhere('duration', 'LIKE', '%9%')->orWhere('duration', 'LIKE', '%10%');
                }
            });
        }

        $trips = $trips->latest()->paginate(9);
        $destinations = Destination::all();

        return view('trips.index', compact('trips', 'destinations'));
    }

    public function show($slug)
    {
        $trip = Trip::where('slug', $slug)->where('status', true)->firstOrFail();

        $relatedTrips = Trip::where('id', '!=', $trip->id)
            ->where('category', $trip->category)
            ->where('status', true)
            ->inRandomOrder()
            ->take(4)
            ->get();

        return view('trips.show', compact('trip', 'relatedTrips'));
    }
}
