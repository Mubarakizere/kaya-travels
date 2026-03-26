@extends('layouts.public')
@section('title', 'My Dashboard - Kaya Travels')

@section('content')
<section class="py-5 text-white bg-black">
    <div class="container">
        <h2 class="text-gold fw-bold mb-4" data-aos="fade-down">
            Welcome Back, {{ Auth::user()->name }}
        </h2>
        <p class="text-white-50 mb-4" data-aos="fade-up" data-aos-delay="100">
            Here you can view your recent trip bookings and explore more adventures.
        </p>

        <div class="row g-4">
            <div class="col-md-8" data-aos="zoom-in">
                <div class="bg-dark p-4 rounded shadow-sm h-100">
                    <h5 class="text-gold mb-3">My Bookings</h5>

                    @if ($bookings->isEmpty())
                        <p class="text-white-50">You have no bookings yet.</p>
                        <a href="{{ route('trips.public.index') }}" class="btn btn-gold btn-sm mt-2">Book Your First Trip</a>
                    @else
                        <div class="table-responsive">
                            <table class="table table-dark table-sm table-bordered">
                                <thead class="text-gold">
                                    <tr>
                                        <th>#</th>
                                        <th>Trip</th>
                                        <th>Date</th>
                                        <th>Guests</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($bookings as $booking)
                                        <tr>
                                            <td>#{{ $booking->id }}</td>
                                            <td>{{ $booking->trip->title ?? 'N/A' }}</td>
                                            <td>{{ \Carbon\Carbon::parse($booking->travel_date)->format('M d, Y') }}</td>
                                            <td>{{ $booking->guests }}</td>
                                            <td>
                                                @if ($booking->status == 'pending')
                                                    <span class="badge bg-warning text-dark">Pending</span>
                                                @elseif ($booking->status == 'accepted')
                                                    <span class="badge bg-success">Accepted</span>
                                                @elseif ($booking->status == 'declined')
                                                    <span class="badge bg-danger">Declined</span>
                                                @else
                                                    <span class="badge bg-secondary">Unknown</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>

            <div class="col-md-4" data-aos="zoom-in" data-aos-delay="100">
                <div class="bg-dark p-4 rounded shadow-sm h-100">
                    <h5 class="text-gold">Recommended Trips</h5>
                    <p class="text-white-50">Discover new travel opportunities.</p>
                    <a href="{{ url('/destination') }}" class="btn btn-gold btn-sm">Browse Trips</a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
