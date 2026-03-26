<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\BookingConfirmationMail;

class BookingController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'trip_id'     => 'required|exists:trips,id',
            'full_name'   => 'required|string|max:255',
            'phone'       => 'required|string|max:30',
            'email'       => 'nullable|email',
            'travel_date' => 'nullable|date',
            'guests'      => 'required|integer|min:1',
            'notes'       => 'nullable|string',
        ]);

        $booking = new Booking();
        $booking->trip_id     = $request->trip_id;
        $booking->user_id     = Auth::id(); // Only logged-in user can book
        $booking->full_name   = $request->full_name;
        $booking->phone       = $request->phone;
        $booking->email       = $request->email;
        $booking->travel_date = $request->travel_date;
        $booking->guests      = $request->guests;
        $booking->notes       = $request->notes;
        $booking->status      = 'pending';
        $booking->save();

        // Send PDF confirmation email to customer
        if ($booking->email) {
            Mail::to($booking->email)->send(new BookingConfirmationMail($booking));
        }

        // Also notify the admin
        Mail::to('admin@kaya.com')->send(new BookingConfirmationMail($booking));

        return back()->with('success', 'Your booking has been received! A confirmation email has been sent.');
    }
}
