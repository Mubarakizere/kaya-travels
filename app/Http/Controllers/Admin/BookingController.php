<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Trip;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\BookingStatusUpdateMail;

class BookingController extends Controller
{
    public function index(Request $request)
    {
        $query = Booking::with('trip');

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('trip_id')) {
            $query->where('trip_id', $request->trip_id);
        }

        $bookings = $query->latest()->paginate(10);
        $trips = Trip::select('id', 'title')->get();

        return view('admin.bookings.index', compact('bookings', 'trips'));
    }

    public function updateStatus(Request $request, Booking $booking)
    {
        $request->validate([
            'status' => 'required|in:pending,accepted,declined,completed',
        ]);

        $booking->status = $request->status;
        $booking->save();

        if ($booking->email) {
            Mail::to($booking->email)->send(new BookingStatusUpdateMail($booking));
        }

        return redirect()->back()->with('success', 'Booking status updated and email sent.');
    }
}
