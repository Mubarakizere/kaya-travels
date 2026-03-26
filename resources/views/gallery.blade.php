@extends('layouts.public')

@section('title', 'Gallery - Kaya Travels')

@section('content')

<!-- ✅ Hero Banner -->
<section class="about-hero d-flex align-items-center text-center text-white" style="background-image: url('{{ asset('images/gallery-hero.jpeg') }}');">
  <div class="container">
    <h1 class="display-5 text-gold fw-bold" data-aos="fade-down">Our Gallery</h1>
    <p class="lead text-white-50" data-aos="fade-up" data-aos-delay="200">Memories from Journeys Worth Taking</p>
  </div>
</section>

<!-- ✅ Gallery Grid -->
<section class="py-5 bg-black text-white">
  <div class="container">
    <h2 class="text-center text-gold fw-bold mb-5" data-aos="fade-down">Captured Moments</h2>

    <div class="row g-4 gallery-grid">
      @foreach (range(1, 12) as $i)
        <div class="col-lg-4 col-md-6 col-sm-6 gallery-item" data-aos="zoom-in">
          <div class="gallery-img rounded overflow-hidden position-relative">
            <img src="{{ asset('images/gallery' . $i . '.jpg') }}" class="img-fluid w-100" alt="Gallery {{ $i }}">
            <div class="gallery-overlay d-flex align-items-center justify-content-center">
              <span class="text-gold fw-semibold">Tour #{{ $i }}</span>
            </div>
          </div>
        </div>
      @endforeach
    </div>
  </div>
</section>

@endsection
