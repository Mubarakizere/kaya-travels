<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Flight;

class FlightPublicController extends Controller
{
    public function index(Request $request)
    {
        $flights = Flight::query();

        if ($request->filled('from')) {
            $flights->where('from_location', 'like', '%' . $request->from . '%');
        }

        if ($request->filled('to')) {
            $flights->where('to_location', 'like', '%' . $request->to . '%');
        }

        if ($request->filled('date')) {
            $flights->where('departure_date', $request->date);
        }

        $results = $flights->orderBy('departure_date')->paginate(10);

        return view('flights.index', [
            'results' => $results,
            'filters' => $request->only('from', 'to', 'date')
        ]);
    }
}
