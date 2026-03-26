<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;

class UserController extends Controller
{
    public function dashboard()
    {
        $bookings = Booking::with('trip')
            ->where('user_id', auth()->id())
            ->latest()
            ->get();

        return view('customer.dashboard', compact('bookings'));
    }
}
