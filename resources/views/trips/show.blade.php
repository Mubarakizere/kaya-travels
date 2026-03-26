@extends('layouts.public')

@section('title', $trip->title)
@section('meta')
  <meta name="description" content="{{ $trip->meta_description ?? Str::limit(strip_tags($trip->full_description), 160) }}">
  <meta property="og:title" content="{{ $trip->title }} - Kaya Travels & Tours">
  <meta property="og:description" content="{{ $trip->meta_description ?? Str::limit(strip_tags($trip->full_description), 160) }}">
  <meta property="og:image" content="{{ asset('storage/' . $trip->thumbnail) }}">
  <meta property="og:url" content="{{ url()->current() }}">
  <meta name="twitter:card" content="summary_large_image">
@endsection

@section('content')
@php
  $itinerary = is_array($trip->itinerary) ? $trip->itinerary : json_decode($trip->itinerary, true) ?? [];
  $inclusions = is_array($trip->inclusions) ? $trip->inclusions : json_decode($trip->inclusions, true) ?? [];
  $exclusions = is_array($trip->exclusions) ? $trip->exclusions : json_decode($trip->exclusions, true) ?? [];
  $gallery = is_array($trip->gallery) ? $trip->gallery : json_decode($trip->gallery, true) ?? [];
@endphp

<!-- Enhanced Hero Banner -->
<div class="hero-section position-relative overflow-hidden" 
     style="background: linear-gradient(135deg, rgba(0,0,0,0.6), rgba(102,126,234,0.7)), url('{{ asset('storage/' . $trip->thumbnail) }}'); 
            background-size: cover; background-position: center; background-attachment: fixed; min-height: 70vh;">
    
    <!-- Animated Background Elements -->
    <div class="position-absolute top-0 start-0 w-100 h-100 opacity-10">
        <div class="floating-element" style="position: absolute; top: 20%; left: 15%; animation: float 18s infinite ease-in-out;">
            <i class="ph ph-airplane" style="font-size: 3rem; color: white;"></i>
        </div>
        <div class="floating-element" style="position: absolute; top: 60%; right: 20%; animation: float 22s infinite ease-in-out reverse;">
            <i class="ph ph-compass" style="font-size: 2rem; color: white;"></i>
        </div>
        <div class="floating-element" style="position: absolute; top: 40%; left: 75%; animation: float 20s infinite ease-in-out;">
            <i class="ph ph-mountains" style="font-size: 2.5rem; color: white;"></i>
        </div>
    </div>

    <div class="hero-overlay d-flex align-items-center position-relative z-3" style="min-height: 70vh;">
        <div class="container text-white">
            <div class="row justify-content-center">
                <div class="col-lg-10 text-center">
                    <div class="hero-content" style="animation: slideUp 0.8s ease-out;">
                        <!-- Trip Badges -->
                        <div class="mb-4">
                            <div class="d-flex justify-content-center gap-3 flex-wrap">
                                @if($trip->is_top)
                                    <span class="badge bg-warning text-dark px-4 py-2 rounded-pill fs-6">
                                        <i class="ph ph-star me-1"></i>Top Pick
                                    </span>
                                @endif
                                <span class="badge bg-success px-4 py-2 rounded-pill fs-6">
                                    <i class="ph ph-check-circle me-1"></i>{{ $trip->status ? 'Available' : 'Unavailable' }}
                                </span>
                                <span class="badge bg-info px-4 py-2 rounded-pill fs-6">
                                    <i class="ph ph-tag me-1"></i>{{ ucfirst($trip->category) }}
                                </span>
                            </div>
                        </div>

                        <!-- Title -->
                        <h1 class="display-3 fw-bold mb-4" 
                            style="background: linear-gradient(45deg, #f1c40f, #f39c12); -webkit-background-clip: text; -webkit-text-fill-color: transparent; line-height: 1.2;">
                            {{ $trip->title }}
                        </h1>

                        <!-- Trip Info -->
                        <div class="d-flex justify-content-center align-items-center gap-4 flex-wrap mb-4">
                            <div class="d-flex align-items-center">
                                <i class="ph ph-map-pin me-2 text-warning fs-4"></i>
                                <span class="fs-5">{{ $trip->location }}</span>
                            </div>
                            <div class="text-white-50">|</div>
                            <div class="d-flex align-items-center">
                                <i class="ph ph-clock me-2 text-info fs-4"></i>
                                <span class="fs-5">{{ $trip->duration }}</span>
                            </div>
                            <div class="text-white-50">|</div>
                            <div class="d-flex align-items-center">
                                <i class="ph ph-currency-dollar me-2 text-success fs-4"></i>
                                <span class="fs-4 fw-bold">${{ number_format($trip->price) }}</span>
                            </div>
                        </div>

                        <!-- CTA Buttons -->
                        <div class="d-flex justify-content-center gap-3 flex-wrap">
                            <a href="#tripTabs" class="btn btn-lg px-5 py-3 fw-bold rounded-pill" 
                               style="background: linear-gradient(45deg, #f1c40f, #f39c12); border: none; color: #000; transition: all 0.3s ease;">
                                <i class="ph ph-calendar-check me-2"></i>Book This Adventure
                            </a>
                            <a href="#gallery" class="btn btn-outline-light btn-lg px-5 py-3 fw-bold rounded-pill"
                               style="transition: all 0.3s ease;">
                                <i class="ph ph-images me-2"></i>View Gallery
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Scroll Indicator -->
    <div class="position-absolute bottom-0 start-50 translate-middle-x mb-3">
        <div class="scroll-indicator" style="animation: bounce 2s infinite;">
            <i class="ph ph-caret-down text-white fs-4"></i>
        </div>
    </div>
</div>

<!-- Enhanced Trip Info Section -->
<section class="py-5" style="background: linear-gradient(135deg, #1a1a1a 0%, #2d2d2d 100%);">
    <div class="container">
        <div class="row g-5 align-items-start">
            <!-- Enhanced Image -->
            <div class="col-lg-6" data-aos="fade-right">
                <div class="position-relative">
                    <img src="{{ asset('storage/' . $trip->thumbnail) }}" 
                         class="img-fluid rounded-4 shadow-lg w-100 trip-image" 
                         alt="{{ $trip->title }}" loading="lazy"
                         style="transition: transform 0.3s ease;">
                    <div class="position-absolute top-0 start-0 w-100 h-100 rounded-4"
                         style="background: linear-gradient(135deg, transparent 60%, rgba(241,196,15,0.1) 100%);"></div>
                    
                    <!-- Image Overlay Info -->
                    <div class="position-absolute bottom-0 start-0 p-4">
                        <div class="bg-dark bg-opacity-75 rounded-3 p-3 backdrop-blur">
                            <div class="d-flex align-items-center gap-2 text-white">
                                <i class="ph ph-camera text-warning"></i>
                                <small>Click to view gallery</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Enhanced Info Card -->
            <div class="col-lg-6" data-aos="fade-left">
                <div class="trip-info-card p-4 rounded-4 h-100" 
                     style="background: rgba(255,255,255,0.05); backdrop-filter: blur(10px); 
                            border: 1px solid rgba(255,255,255,0.1);">
                    
                    <div class="mb-4">
                        <h2 class="text-white fw-bold mb-3">Trip Details</h2>
                        <p class="text-white-50 fs-5">Everything you need to know about this amazing adventure</p>
                    </div>

                    <div class="trip-info-grid">
                        <div class="row g-3">
                            <div class="col-6">
                                <div class="info-item p-3 rounded-3" 
                                     style="background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1);">
                                    <div class="d-flex align-items-center mb-2">
                                        <i class="ph ph-map-pin text-warning me-2"></i>
                                        <span class="text-white-50 small">Location</span>
                                    </div>
                                    <div class="text-white fw-semibold">{{ $trip->location }}</div>
                                </div>
                            </div>
                            
                            <div class="col-6">
                                <div class="info-item p-3 rounded-3" 
                                     style="background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1);">
                                    <div class="d-flex align-items-center mb-2">
                                        <i class="ph ph-currency-dollar text-success me-2"></i>
                                        <span class="text-white-50 small">Price</span>
                                    </div>
                                    <div class="text-white fw-semibold">${{ number_format($trip->price) }}</div>
                                </div>
                            </div>
                            
                            <div class="col-6">
                                <div class="info-item p-3 rounded-3" 
                                     style="background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1);">
                                    <div class="d-flex align-items-center mb-2">
                                        <i class="ph ph-clock text-info me-2"></i>
                                        <span class="text-white-50 small">Duration</span>
                                    </div>
                                    <div class="text-white fw-semibold">{{ $trip->duration }}</div>
                                </div>
                            </div>
                            
                            <div class="col-6">
                                <div class="info-item p-3 rounded-3" 
                                     style="background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1);">
                                    <div class="d-flex align-items-center mb-2">
                                        <i class="ph ph-tag text-purple me-2"></i>
                                        <span class="text-white-50 small">Category</span>
                                    </div>
                                    <div class="text-white fw-semibold">{{ ucfirst($trip->category) }}</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-4">
                        <a href="#booking-section" class="btn btn-lg w-100 fw-bold rounded-pill" 
                           style="background: linear-gradient(45deg, #f1c40f, #f39c12); border: none; color: #000; transition: all 0.3s ease;">
                            <i class="ph ph-calendar-check me-2"></i>Book Now - ${{ number_format($trip->price) }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Enhanced Tab Navigation -->
<section class="py-4" style="background: linear-gradient(135deg, #2d2d2d 0%, #1a1a1a 100%);">
    <div class="container">
        <ul class="nav nav-pills justify-content-center gap-2" id="tripTabs" role="tablist">
            <li class="nav-item">
                <button class="nav-link active px-4 py-3 rounded-pill fw-semibold" data-bs-toggle="pill" data-bs-target="#overview">
                    <i class="ph ph-article me-2"></i>Overview
                </button>
            </li>
            @if(count($itinerary))
                <li class="nav-item">
                    <button class="nav-link px-4 py-3 rounded-pill fw-semibold" data-bs-toggle="pill" data-bs-target="#itinerary">
                        <i class="ph ph-map-trifold me-2"></i>Itinerary
                    </button>
                </li>
            @endif
            @if(count($inclusions))
                <li class="nav-item">
                    <button class="nav-link px-4 py-3 rounded-pill fw-semibold" data-bs-toggle="pill" data-bs-target="#inclusions">
                        <i class="ph ph-check-circle me-2"></i>Inclusions
                    </button>
                </li>
            @endif
            @if(count($exclusions))
                <li class="nav-item">
                    <button class="nav-link px-4 py-3 rounded-pill fw-semibold" data-bs-toggle="pill" data-bs-target="#exclusions">
                        <i class="ph ph-x-circle me-2"></i>Exclusions
                    </button>
                </li>
            @endif
            @if(count($gallery))
                <li class="nav-item">
                    <button class="nav-link px-4 py-3 rounded-pill fw-semibold" data-bs-toggle="pill" data-bs-target="#gallery">
                        <i class="ph ph-images me-2"></i>Gallery
                    </button>
                </li>
            @endif
        </ul>
    </div>
</section>

<!-- Enhanced Tab Content -->
<section class="py-5" style="background: linear-gradient(135deg, #1a1a1a 0%, #2d2d2d 100%);">
    <div class="container">
        <div class="tab-content" id="tripTabsContent">
            <!-- Overview Tab -->
            <div class="tab-pane fade show active" id="overview">
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <div class="content-wrapper p-4 rounded-4" 
                             style="background: rgba(255,255,255,0.05); backdrop-filter: blur(10px); border: 1px solid rgba(255,255,255,0.1);">
                            <div class="d-flex align-items-center mb-4">
                                <div class="bg-gradient rounded-circle p-3 me-3" style="background: linear-gradient(45deg, #f1c40f, #f39c12);">
                                    <i class="ph ph-article text-white fs-4"></i>
                                </div>
                                <div>
                                    <h3 class="text-white fw-bold mb-0">Trip Overview</h3>
                                    <small class="text-white-50">Discover what makes this trip special</small>
                                </div>
                            </div>
                            <div class="text-white fs-5" style="line-height: 1.8;">
                                {!! nl2br(e($trip->full_description)) !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Itinerary Tab -->
            @if(count($itinerary))
            <div class="tab-pane fade" id="itinerary">
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <div class="content-wrapper p-4 rounded-4" 
                             style="background: rgba(255,255,255,0.05); backdrop-filter: blur(10px); border: 1px solid rgba(255,255,255,0.1);">
                            <div class="d-flex align-items-center mb-4">
                                <div class="bg-gradient rounded-circle p-3 me-3" style="background: linear-gradient(45deg, #667eea, #764ba2);">
                                    <i class="ph ph-map-trifold text-white fs-4"></i>
                                </div>
                                <div>
                                    <h3 class="text-white fw-bold mb-0">Trip Itinerary</h3>
                                    <small class="text-white-50">Day-by-day breakdown of your adventure</small>
                                </div>
                            </div>
                            
                            <div class="timeline-container position-relative">
                                @foreach($itinerary as $i => $day)
                                    <div class="timeline-item d-flex mb-4" data-aos="fade-up" data-aos-delay="{{ $i * 100 }}">
                                        <div class="timeline-marker me-4">
                                            <div class="bg-gradient rounded-circle p-3 d-flex align-items-center justify-content-center" 
                                                 style="background: linear-gradient(45deg, #f1c40f, #f39c12); width: 50px; height: 50px;">
                                                <span class="text-dark fw-bold">{{ $i + 1 }}</span>
                                            </div>
                                        </div>
                                        <div class="timeline-content flex-grow-1">
                                            <div class="p-4 rounded-3" 
                                                 style="background: rgba(255,255,255,0.05); border: 1px solid rgba(255,255,255,0.1);">
                                                <h6 class="text-warning fw-bold mb-2">Day {{ $i + 1 }}</h6>
                                                <p class="text-white mb-0">{{ $day }}</p>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif

            <!-- Inclusions Tab -->
            @if(count($inclusions))
            <div class="tab-pane fade" id="inclusions">
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <div class="content-wrapper p-4 rounded-4" 
                             style="background: rgba(255,255,255,0.05); backdrop-filter: blur(10px); border: 1px solid rgba(255,255,255,0.1);">
                            <div class="d-flex align-items-center mb-4">
                                <div class="bg-gradient rounded-circle p-3 me-3" style="background: linear-gradient(45deg, #10b981, #059669);">
                                    <i class="ph ph-check-circle text-white fs-4"></i>
                                </div>
                                <div>
                                    <h3 class="text-white fw-bold mb-0">What's Included</h3>
                                    <small class="text-white-50">Everything covered in your package</small>
                                </div>
                            </div>
                            
                            <div class="row g-3">
                                @foreach($inclusions as $index => $item)
                                    <div class="col-md-6" data-aos="fade-up" data-aos-delay="{{ $index * 50 }}">
                                        <div class="inclusion-item p-3 rounded-3 d-flex align-items-center" 
                                             style="background: rgba(16, 185, 129, 0.1); border: 1px solid rgba(16, 185, 129, 0.2);">
                                            <i class="ph ph-check text-success me-3 fs-5"></i>
                                            <span class="text-white">{{ $item }}</span>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif

            <!-- Exclusions Tab -->
            @if(count($exclusions))
            <div class="tab-pane fade" id="exclusions">
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <div class="content-wrapper p-4 rounded-4" 
                             style="background: rgba(255,255,255,0.05); backdrop-filter: blur(10px); border: 1px solid rgba(255,255,255,0.1);">
                            <div class="d-flex align-items-center mb-4">
                                <div class="bg-gradient rounded-circle p-3 me-3" style="background: linear-gradient(45deg, #ef4444, #dc2626);">
                                    <i class="ph ph-x-circle text-white fs-4"></i>
                                </div>
                                <div>
                                    <h3 class="text-white fw-bold mb-0">What's Not Included</h3>
                                    <small class="text-white-50">Additional costs to consider</small>
                                </div>
                            </div>
                            
                            <div class="row g-3">
                                @foreach($exclusions as $index => $item)
                                    <div class="col-md-6" data-aos="fade-up" data-aos-delay="{{ $index * 50 }}">
                                        <div class="exclusion-item p-3 rounded-3 d-flex align-items-center" 
                                             style="background: rgba(239, 68, 68, 0.1); border: 1px solid rgba(239, 68, 68, 0.2);">
                                            <i class="ph ph-x text-danger me-3 fs-5"></i>
                                            <span class="text-white">{{ $item }}</span>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif

            <!-- Gallery Tab -->
            @if(count($gallery))
            <div class="tab-pane fade" id="gallery">
                <div class="row justify-content-center">
                    <div class="col-lg-10">
                        <div class="content-wrapper p-4 rounded-4" 
                             style="background: rgba(255,255,255,0.05); backdrop-filter: blur(10px); border: 1px solid rgba(255,255,255,0.1);">
                            <div class="d-flex align-items-center mb-4">
                                <div class="bg-gradient rounded-circle p-3 me-3" style="background: linear-gradient(45deg, #8b5cf6, #7c3aed);">
                                    <i class="ph ph-images text-white fs-4"></i>
                                </div>
                                <div>
                                    <h3 class="text-white fw-bold mb-0">Photo Gallery</h3>
                                    <small class="text-white-50">Get a glimpse of what awaits you</small>
                                </div>
                            </div>
                            
                            <div class="row g-4">
                                @foreach($gallery as $index => $image)
                                    <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="{{ $index * 100 }}">
                                        <div class="gallery-item position-relative overflow-hidden rounded-3">
                                            <img src="{{ asset('storage/' . $image) }}" 
                                                 class="img-fluid w-100 gallery-image" 
                                                 alt="Gallery Image {{ $index + 1 }}" 
                                                 loading="lazy"
                                                 style="height: 250px; object-fit: cover; transition: transform 0.3s ease;"
                                                 data-bs-toggle="modal" 
                                                 data-bs-target="#galleryCarouselModal" 
                                                 onclick="setCarouselIndex({{ $index }})">
                                            <div class="gallery-overlay position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center justify-content-center"
                                                 style="background: rgba(0,0,0,0.7); opacity: 0; transition: opacity 0.3s ease;">
                                                <i class="ph ph-magnifying-glass-plus text-white fs-3"></i>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</section>

<!-- Enhanced Booking Section -->
<section class="py-5" id="booking-section" style="background: linear-gradient(135deg, #2d2d2d 0%, #1a1a1a 100%);">
    <div class="container">
        <div class="text-center mb-5" data-aos="fade-up">
            <div class="d-flex justify-content-center align-items-center mb-3">
                <div class="bg-gradient rounded-circle p-3 me-3" style="background: linear-gradient(45deg, #f1c40f, #f39c12);">
                    <i class="ph ph-calendar-check text-white fs-4"></i>
                </div>
                <div>
                    <h2 class="text-white fw-bold mb-0">Book Your Adventure</h2>
                    <small class="text-white-50">Secure your spot on this amazing journey</small>
                </div>
            </div>
        </div>

        @if(session('success'))
            <div class="alert alert-success rounded-4 mb-4" data-aos="fade-up">
                <i class="ph ph-check-circle me-2"></i>{{ session('success') }}
            </div>
        @endif

        <div class="row justify-content-center">
            <div class="col-lg-8">
                <form action="{{ route('bookings.store') }}" method="POST" class="booking-form" data-aos="fade-up">
                    @csrf
                    <input type="hidden" name="trip_id" value="{{ $trip->id }}">

                    <div class="form-wrapper p-4 rounded-4" 
                         style="background: rgba(255,255,255,0.05); backdrop-filter: blur(10px); border: 1px solid rgba(255,255,255,0.1);">
                        
                        <div class="row g-4">
                            <div class="col-md-6">
                                <label for="full_name" class="form-label text-white fw-semibold">
                                    <i class="ph ph-user me-2 text-warning"></i>Full Name *
                                </label>
                                <input type="text" name="full_name" id="full_name" 
                                       class="form-control form-control-lg bg-dark text-white border-secondary rounded-3" 
                                       placeholder="Enter your full name" required
                                       style="transition: all 0.3s ease;">
                            </div>

                            <div class="col-md-6">
                                <label for="phone" class="form-label text-white fw-semibold">
                                    <i class="ph ph-phone me-2 text-success"></i>Phone Number *
                                </label>
                                <input type="text" name="phone" id="phone" 
                                       class="form-control form-control-lg bg-dark text-white border-secondary rounded-3" 
                                       placeholder="Enter your phone number" required
                                       style="transition: all 0.3s ease;">
                            </div>

                            <div class="col-md-6">
                                <label for="email" class="form-label text-white fw-semibold">
                                    <i class="ph ph-envelope me-2 text-info"></i>Email Address 
                                    <span class="text-white-50">(optional)</span>
                                </label>
                                <input type="email" name="email" id="email" 
                                       class="form-control form-control-lg bg-dark text-white border-secondary rounded-3" 
                                       placeholder="Enter your email address"
                                       style="transition: all 0.3s ease;">
                            </div>

                            <div class="col-md-3">
                                <label for="travel_date" class="form-label text-white fw-semibold">
                                    <i class="ph ph-calendar me-2 text-purple"></i>Travel Date
                                </label>
                                <input type="date" name="travel_date" id="travel_date" 
                                       class="form-control form-control-lg bg-dark text-white border-secondary rounded-3"
                                       style="transition: all 0.3s ease;">
                            </div>

                            <div class="col-md-3">
                                <label for="guests" class="form-label text-white fw-semibold">
                                    <i class="ph ph-users me-2 text-orange"></i>Guests
                                </label>
                                <input type="number" name="guests" id="guests" 
                                       class="form-control form-control-lg bg-dark text-white border-secondary rounded-3" 
                                       value="1" min="1"
                                       style="transition: all 0.3s ease;">
                            </div>

                            <div class="col-12">
                                <div class="price-summary p-4 rounded-3 mb-4" 
                                     style="background: rgba(241, 196, 15, 0.1); border: 1px solid rgba(241, 196, 15, 0.3);">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <h6 class="text-warning fw-bold mb-1">Total Price</h6>
                                            <small class="text-white-50">Price per person × Number of guests</small>
                                        </div>
                                        <div class="text-end">
                                            <div class="fs-3 fw-bold text-warning" id="price-summary">${{ number_format($trip->price) }}</div>
                                            <small class="text-white-50">USD</small>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12">
                                <label for="notes" class="form-label text-white fw-semibold">
                                    <i class="ph ph-note me-2 text-cyan"></i>Special Requests 
                                    <span class="text-white-50">(optional)</span>
                                </label>
                                <textarea name="notes" id="notes" rows="4" 
                                          class="form-control form-control-lg bg-dark text-white border-secondary rounded-3" 
                                          placeholder="Any special requests, dietary requirements, or additional information..."
                                          style="transition: all 0.3s ease; resize: vertical;"></textarea>
                            </div>

                            <div class="col-12">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="terms" required>
                                        <label class="form-check-label text-white-50" for="terms">
                                            I agree to the <a href="#" class="text-warning">Terms & Conditions</a>
                                        </label>
                                    </div>
                                    <button type="submit" class="btn btn-lg px-5 py-3 fw-bold rounded-pill" 
                                            style="background: linear-gradient(45deg, #f1c40f, #f39c12); border: none; color: #000; transition: all 0.3s ease;">
                                        <i class="ph ph-paper-plane-tilt me-2"></i>Submit Booking
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<!-- Enhanced Gallery Modal -->
<div class="modal fade" id="galleryCarouselModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content bg-black border-0 rounded-4">
            <div class="modal-body p-0 position-relative">
                <button type="button" class="btn-close btn-close-white position-absolute top-0 end-0 m-3 z-3" 
                        data-bs-dismiss="modal" aria-label="Close"
                        style="background: rgba(0,0,0,0.5); border-radius: 50%; padding: 1rem;"></button>
                
                <div id="galleryCarousel" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-indicators">
                        @foreach($gallery as $index => $image)
                            <button type="button" data-bs-target="#galleryCarousel" data-bs-slide-to="{{ $index }}" 
                                    class="{{ $index === 0 ? 'active' : '' }}" 
                                    style="width: 12px; height: 12px; border-radius: 50%;"></button>
                        @endforeach
                    </div>
                    
                    <div class="carousel-inner rounded-4">
                        @foreach($gallery as $index => $image)
                            <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                                <img src="{{ asset('storage/' . $image) }}" 
                                     class="d-block w-100 img-fluid" 
                                     style="max-height: 80vh; object-fit: contain;"
                                     loading="lazy" alt="Gallery Image {{ $index + 1 }}">
                            </div>
                        @endforeach
                    </div>
                    
                    <button class="carousel-control-prev" type="button" data-bs-target="#galleryCarousel" data-bs-slide="prev">
                        <div class="bg-white bg-opacity-20 rounded-circle p-2" style="backdrop-filter: blur(10px);">
                            <i class="ph ph-caret-left text-white fs-4"></i>
                        </div>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#galleryCarousel" data-bs-slide="next">
                        <div class="bg-white bg-opacity-20 rounded-circle p-2" style="backdrop-filter: blur(10px);">
                            <i class="ph ph-caret-right text-white fs-4"></i>
                        </div>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Enhanced Sticky CTA -->
<div class="sticky-cta-container position-fixed bottom-0 start-0 w-100 p-3 d-block d-lg-none" 
     style="background: linear-gradient(to top, rgba(0,0,0,0.9), transparent); z-index: 1000;">
    <div class="container">
        <div class="d-flex align-items-center gap-3">
            <div class="flex-grow-1">
                <div class="text-white fw-bold">${{ number_format($trip->price) }}</div>
                <small class="text-white-50">per person</small>
            </div>
            <a href="#booking-section" class="btn btn-lg px-4 py-2 fw-bold rounded-pill" 
               style="background: linear-gradient(45deg, #f1c40f, #f39c12); border: none; color: #000;">
                Book Now
            </a>
        </div>
    </div>
</div>

<a href="#booking-section" class="position-fixed d-none d-lg-inline-flex align-items-center justify-content-center fw-bold rounded-pill text-decoration-none"
   style="right: 2rem; bottom: 2rem; width: 60px; height: 60px; background: linear-gradient(45deg, #f1c40f, #f39c12); 
          color: #000; box-shadow: 0 10px 30px rgba(241, 196, 15, 0.3); z-index: 1000; transition: all 0.3s ease;">
    <i class="ph ph-calendar-check fs-5"></i>
</a>

<!-- Enhanced Custom Styles -->
<style>
    @keyframes float {
        0%, 100% { transform: translateY(0px) rotate(0deg); }
        50% { transform: translateY(-20px) rotate(5deg); }
    }
    
    @keyframes bounce {
        0%, 20%, 50%, 80%, 100% { transform: translateY(0); }
        40% { transform: translateY(-10px); }
        60% { transform: translateY(-5px); }
    }
    
    @keyframes slideUp {
        from { opacity: 0; transform: translateY(30px); }
        to { opacity: 1; transform: translateY(0); }
    }
    
    .trip-image:hover {
        transform: scale(1.05);
    }
    
    .info-item:hover {
        transform: translateY(-3px);
        background: rgba(255,255,255,0.1) !important;
    }
    
    .nav-pills .nav-link {
        background: rgba(255,255,255,0.05);
        border: 1px solid rgba(255,255,255,0.1);
        color: #fff;
        transition: all 0.3s ease;
    }
    
    .nav-pills .nav-link:hover {
        background: rgba(255,255,255,0.1);
        transform: translateY(-2px);
    }
    
    .nav-pills .nav-link.active {
        background: linear-gradient(45deg, #f1c40f, #f39c12);
        color: #000;
        border-color: #f1c40f;
    }
    
    .gallery-item:hover .gallery-image {
        transform: scale(1.1);
    }
    
    .gallery-item:hover .gallery-overlay {
        opacity: 1 !important;
    }
    
    .form-control:focus, .form-select:focus {
        border-color: #f1c40f;
        box-shadow: 0 0 0 0.2rem rgba(241, 196, 15, 0.25);
        transform: translateY(-2px);
    }
    
    .btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 30px rgba(0,0,0,0.2);
    }
    
    .scroll-indicator:hover {
        transform: scale(1.2);
        color: #f1c40f !important;
    }
    
    .timeline-item:hover .timeline-marker {
        transform: scale(1.1);
    }
    
    .inclusion-item:hover, .exclusion-item:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.2);
    }
    
    .carousel-control-prev:hover div,
    .carousel-control-next:hover div {
        background: rgba(255,255,255,0.4) !important;
        transform: scale(1.1);
    }
    
    .sticky-cta-container {
        backdrop-filter: blur(10px);
    }
    
    /* Responsive adjustments */
    @media (max-width: 768px) {
        .hero-section {
            min-height: 60vh !important;
        }
        
        .hero-overlay {
            min-height: 60vh !important;
        }
        
        .display-3 {
            font-size: 2.5rem !important;
        }
        
        .nav-pills {
            flex-wrap: wrap;
        }
        
        .nav-pills .nav-link {
            font-size: 0.9rem;
            padding: 0.75rem 1.5rem !important;
        }
    }
    
    /* Loading states */
    .booking-form.loading button[type="submit"] {
        pointer-events: none;
        opacity: 0.7;
    }
    
    .booking-form.loading button[type="submit"]::after {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 20px;
        height: 20px;
        border: 2px solid transparent;
        border-top: 2px solid #000;
        border-radius: 50%;
        animation: spin 1s linear infinite;
    }
    
    @keyframes spin {
        from { transform: translate(-50%, -50%) rotate(0deg); }
        to { transform: translate(-50%, -50%) rotate(360deg); }
    }
</style>

<!-- Enhanced JavaScript -->
<script>
    // Gallery modal functionality
    function setCarouselIndex(index) {
        const carousel = document.querySelector('#galleryCarousel');
        const instance = bootstrap.Carousel.getInstance(carousel) || new bootstrap.Carousel(carousel);
        instance.to(index);
    }

    // Smooth scrolling
    document.querySelectorAll('a[href^="#"]').forEach(link => {
        link.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({ behavior: 'smooth', block: 'start' });
            }
        });
    });

    // Price calculation
    document.addEventListener('DOMContentLoaded', function () {
        const guestsInput = document.getElementById('guests');
        const priceDisplay = document.getElementById('price-summary');
        const basePrice = {{ $trip->price }};

        function updatePrice() {
            const guests = parseInt(guestsInput.value) || 1;
            const totalPrice = guests * basePrice;
            priceDisplay.textContent = `${totalPrice.toLocaleString()}`;
        }

        guestsInput.addEventListener('input', updatePrice);
        updatePrice();
    });

    // Form submission enhancement
    document.querySelector('.booking-form').addEventListener('submit', function(e) {
        this.classList.add('loading');
        const submitBtn = this.querySelector('button[type="submit"]');
        submitBtn.innerHTML = '<i class="ph ph-spinner me-2"></i>Processing...';
    });

    // Scroll indicator functionality
    document.querySelector('.scroll-indicator')?.addEventListener('click', function() {
        document.querySelector('#tripTabs').scrollIntoView({ behavior: 'smooth' });
    });

    // Tab switching with URL hash
    const triggerTabList = [].slice.call(document.querySelectorAll('#tripTabs button'));
    triggerTabList.forEach(function (triggerEl) {
        const tabTrigger = new bootstrap.Tab(triggerEl);
        
        triggerEl.addEventListener('click', function (event) {
            event.preventDefault();
            tabTrigger.show();
            
            // Update URL hash
            const target = this.getAttribute('data-bs-target');
            history.pushState(null, null, target);
        });
    });

    // Handle page load with hash
    window.addEventListener('load', function() {
        if (window.location.hash) {
            const hashTab = document.querySelector(`button[data-bs-target="${window.location.hash}"]`);
            if (hashTab) {
                const tabTrigger = new bootstrap.Tab(hashTab);
                tabTrigger.show();
            }
        }
    });

    // Parallax effect for hero
    window.addEventListener('scroll', function() {
        const scrolled = window.pageYOffset;
        const hero = document.querySelector('.hero-section');
        if (hero) {
            hero.style.transform = `translateY(${scrolled * 0.5}px)`;
        }
    });

    // Intersection Observer for animations
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver(function(entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
            }
        });
    }, observerOptions);

    // Observe elements for animation
    document.querySelectorAll('.timeline-item, .info-item, .gallery-item').forEach(el => {
        el.style.opacity = '0';
        el.style.transform = 'translateY(20px)';
        el.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
        observer.observe(el);
    });
</script>

<!-- Load Phosphor Icons -->
<script src="https://unpkg.com/@phosphor-icons/web"></script>

@endsection