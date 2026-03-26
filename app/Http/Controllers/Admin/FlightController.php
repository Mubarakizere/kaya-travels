<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Flight;

class FlightController extends Controller
{
    public function index()
    {
        $flights = Flight::latest()->paginate(10);
        return view('admin.flights.index', compact('flights'));
    }

    public function create()
    {
        return view('admin.flights.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'airline' => 'required|string|max:255',
            'flight_number' => 'required|string|max:50|unique:flights',
            'from_location' => 'required|string',
            'to_location' => 'required|string',
            'departure_date' => 'required|date',
            'departure_time' => 'required',
            'arrival_date' => 'required|date',
            'arrival_time' => 'required',
            'seat_capacity' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string',
        ]);

        Flight::create($validated);

        return redirect()->route('admin.flights.index')->with('success', 'Flight added successfully.');
    }

    public function edit(Flight $flight)
    {
        return view('admin.flights.edit', compact('flight'));
    }

    public function update(Request $request, Flight $flight)
    {
        $validated = $request->validate([
            'airline' => 'required|string|max:255',
            'flight_number' => 'required|string|max:50|unique:flights,flight_number,' . $flight->id,
            'from_location' => 'required|string',
            'to_location' => 'required|string',
            'departure_date' => 'required|date',
            'departure_time' => 'required',
            'arrival_date' => 'required|date',
            'arrival_time' => 'required',
            'seat_capacity' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string',
        ]);

        $flight->update($validated);

        return redirect()->route('admin.flights.index')->with('success', 'Flight updated successfully.');
    }

    public function destroy(Flight $flight)
    {
        $flight->delete();
        return back()->with('success', 'Flight deleted.');
    }
}
