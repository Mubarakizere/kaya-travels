@extends('layouts.public')

@section('title', 'Booking Successful')

@section('content')

<section class="page-center">
  <div class="container" data-aos="zoom-in">
    <i class="bi bi-check-circle-fill"></i>
    <h1 class="text-gold">Thank You!</h1>
    <p>Your booking has been received. We'll contact you shortly via email or phone.</p>
    <a href="{{ url('/') }}" class="btn btn-gold">Return to Homepage</a>
  </div>
</section>

@endsection
@push('scripts')
<script>
  setTimeout(() => {
    confetti({
      particleCount: 100,
      spread: 70,
      origin: { y: 0.6 }
    });
  }, 500);
</script>
@endpush
