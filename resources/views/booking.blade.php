@extends('layouts.public')

@section('title', 'Book a Trip - Kaya Travels')

@section('content')

<!-- ✅ Hero Banner -->
<section class="about-hero d-flex align-items-center text-center text-white" style="background-image: url('{{ asset('images/booking-hero.jpg') }}');">
  <div class="container">
    <h1 class="display-5 text-gold fw-bold" data-aos="fade-down">Book a Trip</h1>
    <p class="lead text-white-50" data-aos="fade-up" data-aos-delay="200">Start planning your unforgettable journey with us</p>
  </div>
</section>

<!-- ✅ Booking Form -->
<section class="py-5 bg-black text-white">
  <div class="container" style="max-width: 860px">
    <h2 class="text-center text-gold mb-4" data-aos="fade-up">Booking Request</h2>

    <form action="#" method="POST" class="row g-4" data-aos="fade-up" data-aos-delay="100">
      @csrf

      <div class="col-md-6">
        <label class="form-label">Full Name</label>
        <input type="text" name="name" class="form-control booking-input" required>
      </div>

      <div class="col-md-6">
        <label class="form-label">Email Address</label>
        <input type="email" name="email" class="form-control booking-input" required>
      </div>

      <div class="col-md-6">
        <label class="form-label">Destination</label>
        <input type="text" name="destination" class="form-control booking-input" required>
      </div>

      <div class="col-md-3">
        <label class="form-label">Travel Date</label>
        <input type="date" name="date" class="form-control booking-input" required>
      </div>

      <div class="col-md-3">
        <label class="form-label">People</label>
        <input type="number" name="people" class="form-control booking-input" required min="1">
      </div>

      <div class="col-12">
        <label class="form-label">Message</label>
        <textarea name="message" rows="4" class="form-control booking-input" placeholder="Any special requirements or questions?"></textarea>
      </div>

      <div class="col-12 text-center mt-3">
        <button type="submit" class="btn btn-gold px-5 py-2">Submit Booking</button>
      </div>
    </form>

    <!-- ✅ Optional confirmation message area -->
    <div class="text-center mt-4 text-white-50 small" id="booking-note">
      We’ll get in touch with you via email after submission. Full payment will be handled directly.
    </div>
  </div>
</section>

@endsection
