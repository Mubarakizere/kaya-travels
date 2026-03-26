@extends('layouts.public')

@section('title', 'Find Flights | Kaya Travels')

@section('meta')
<meta name="description" content="Discover amazing deals on flights to your favorite destinations worldwide with Kaya Travels.">
@endsection

@section('content')
<style>
  :root {
    --hero-height: 50vh;
  }

  /* Flights Hero Section */
  .flights-hero {
    height: var(--hero-height);
    background-size: cover;
    background-position: center;
    background-attachment: fixed;
    position: relative;
    display: flex;
    align-items: center;
    overflow: hidden;
  }

  .flights-hero::before {
    content: '';
    position: absolute;
    inset: 0;
    background: linear-gradient(
      135deg,
      rgba(44, 62, 80, 0.8) 0%,
      rgba(52, 73, 94, 0.6) 50%,
      rgba(244, 208, 63, 0.3) 100%
    );
    z-index: 1;
  }

  .flights-hero .container {
    position: relative;
    z-index: 2;
  }

  .hero-badge {
    display: inline-flex;
    align-items: center;
    background: rgba(244, 208, 63, 0.2);
    backdrop-filter: blur(15px);
    border: 2px solid var(--primary-gold);
    padding: 10px 25px;
    border-radius: 50px;
    font-size: 0.85rem;
    font-weight: 700;
    color: var(--primary-gold);
    text-transform: uppercase;
    letter-spacing: 1px;
    margin-bottom: 2rem;
  }

  .hero-title {
    font-size: 3.5rem;
    font-weight: 800;
    line-height: 1.1;
    margin-bottom: 1.5rem;
    background: linear-gradient(135deg, #ffffff 0%, var(--primary-gold) 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
  }

  /* Search Card Widget */
  .search-widget {
    background: white;
    border-radius: 24px;
    padding: 2.5rem;
    box-shadow: var(--shadow-medium);
    margin-top: -80px;
    position: relative;
    z-index: 10;
  }

  .form-group-custom label {
    font-weight: 600;
    color: var(--charcoal);
    margin-bottom: 8px;
    display: flex;
    align-items: center;
    gap: 8px;
    font-size: 0.95rem;
  }

  .form-group-custom label i {
    color: var(--primary-gold);
    font-size: 1.1rem;
  }

  .form-control-custom, .form-select-custom {
    border: 1px solid #e2e8f0;
    background: #f8fafc;
    border-radius: 12px;
    padding: 14px 20px;
    font-size: 1rem;
    width: 100%;
    transition: var(--transition);
    color: var(--charcoal);
  }

  .form-control-custom:focus, .form-select-custom:focus {
    outline: none;
    border-color: var(--primary-gold);
    background: white;
    box-shadow: 0 0 0 4px rgba(244, 208, 63, 0.1);
  }

  /* Results Section */
  .results-section {
    padding: 4rem 0 6rem;
    background: var(--light-bg);
  }

  .flight-card {
    background: white;
    border-radius: 20px;
    border: 1px solid #f1f5f9;
    padding: 2rem;
    margin-bottom: 1.5rem;
    transition: var(--transition);
    box-shadow: var(--shadow-soft);
  }

  .flight-card:hover {
    transform: translateY(-5px);
    box-shadow: var(--shadow-medium);
    border-color: rgba(244, 208, 63, 0.3);
  }

  .airline-logo-box {
    width: 60px;
    height: 60px;
    border-radius: 12px;
    background: rgba(244, 208, 63, 0.1);
    color: var(--primary-gold);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.8rem;
    margin-right: 1.5rem;
  }

  .airline-name {
    font-weight: 700;
    font-size: 1.2rem;
    color: var(--charcoal);
    margin-bottom: 4px;
  }

  .flight-number {
    color: var(--charcoal-lighter);
    font-size: 0.85rem;
    font-weight: 500;
  }

  .time-display {
    text-align: center;
  }

  .time-text {
    font-size: 1.5rem;
    font-weight: 800;
    color: var(--charcoal);
  }

  .city-text {
    font-size: 0.95rem;
    font-weight: 600;
    color: var(--charcoal-lighter);
    margin-top: 4px;
  }

  .flight-path {
    flex: 1;
    position: relative;
    padding: 0 2rem;
    text-align: center;
  }

  .flight-line {
    height: 2px;
    background: #e2e8f0;
    width: 100%;
    position: relative;
    margin: 15px 0 8px;
  }

  .flight-icon-center {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    color: var(--primary-gold);
    background: white;
    padding: 0 10px;
    font-size: 1.2rem;
  }

  .duration-text {
    font-size: 0.85rem;
    color: var(--charcoal-lighter);
    font-weight: 600;
  }

  .price-box {
    text-align: right;
    border-left: 1px dashed #e2e8f0;
    padding-left: 2rem;
    height: 100%;
    display: flex;
    flex-direction: column;
    justify-content: center;
  }

  .price-text {
    font-size: 2rem;
    font-weight: 800;
    color: var(--charcoal);
    line-height: 1;
    margin-bottom: 8px;
  }

  .price-label {
    font-size: 0.85rem;
    color: var(--charcoal-lighter);
    margin-bottom: 1rem;
  }

  .badge-soft-success {
    background: rgba(16, 185, 129, 0.1);
    color: #10b981;
    padding: 6px 14px;
    border-radius: 20px;
    font-size: 0.8rem;
    font-weight: 600;
  }

  .badge-soft-warning {
    background: rgba(245, 158, 11, 0.1);
    color: #f59e0b;
    padding: 6px 14px;
    border-radius: 20px;
    font-size: 0.8rem;
    font-weight: 600;
  }

  @media (max-width: 991px) {
    .flight-path {
      padding: 0 1rem;
    }
    .price-box {
      border-left: none;
      border-top: 1px dashed #e2e8f0;
      padding-left: 0;
      padding-top: 1.5rem;
      margin-top: 1.5rem;
      text-align: center;
      align-items: center;
    }
  }
</style>

<!-- Hero Section -->
<section class="flights-hero" style="background-image: url('{{ asset('images/about.jpeg') }}');">
  <div class="container text-center">
    <div data-aos="fade-up">
      <div class="hero-badge">
        <i class="bi bi-airplane me-2"></i>Flight Search
      </div>
      <h1 class="hero-title">Find Your Perfect Flight</h1>
      <p class="text-white opacity-75 fs-5">World-class travel at your fingertips.</p>
    </div>
  </div>
</section>

<!-- Search Widget -->
<section class="position-relative">
  <div class="container">
    <div class="search-widget" data-aos="fade-up" data-aos-delay="100">
      <form method="GET" action="{{ route('flights.index') }}">
        <div class="row g-4 align-items-end">
          <div class="col-lg-4 col-md-6">
            <div class="form-group-custom">
              <label for="from"><i class="bi bi-geo-alt"></i> Departure (From)</label>
              <input type="text" id="from" name="from" value="{{ $filters['from'] ?? '' }}" class="form-control-custom" placeholder="City or Airport">
            </div>
          </div>
          
          <div class="col-lg-4 col-md-6">
            <div class="form-group-custom">
              <label for="to"><i class="bi bi-pin-map"></i> Destination (To)</label>
              <input type="text" id="to" name="to" value="{{ $filters['to'] ?? '' }}" class="form-control-custom" placeholder="City or Airport">
            </div>
          </div>
          
          <div class="col-lg-2 col-md-6">
            <div class="form-group-custom">
              <label for="date"><i class="bi bi-calendar3"></i> Date</label>
              <input type="date" id="date" name="date" value="{{ $filters['date'] ?? '' }}" class="form-control-custom">
            </div>
          </div>
          
          <div class="col-lg-2 col-md-6">
            <button type="submit" class="btn-gold w-100 justify-content-center" style="padding: 14px 20px;">
              <i class="bi bi-search me-2"></i> Search
            </button>
          </div>
        </div>
      </form>
    </div>
  </div>
</section>

<!-- Results Section -->
<section class="results-section">
  <div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
      <div>
        <h3 class="fw-bold mb-1">Available Flights</h3>
        <p class="text-muted mb-0">{{ $results->count() }} flights found based on your search</p>
      </div>
    </div>

    @if ($results->count())
      @foreach ($results as $flight)
        @php
          $departureTime = \Carbon\Carbon::parse($flight->departure_date . ' ' . $flight->departure_time);
          $arrivalTime = \Carbon\Carbon::parse($flight->arrival_date . ' ' . $flight->arrival_time);
          $duration = $departureTime->diff($arrivalTime);
          $durationText = $duration->format('%h:%I');
          
          $whatsAppMessage = urlencode("Hello, I'd like to book the following flight:\n\n✈️ *{$flight->airline} – {$flight->flight_number}*\nFrom: {$flight->from_location}\nTo: {$flight->to_location}\nDeparture: {$flight->departure_date} at {$flight->departure_time}\nPrice: $" . number_format($flight->price) . "\n\nPlease assist me.");
        @endphp

        <div class="flight-card" data-aos="fade-up">
          <div class="row align-items-center">
            
            <!-- Airline Info -->
            <div class="col-lg-3 col-md-4 d-flex align-items-center mb-3 mb-md-0">
              <div class="airline-logo-box">
                <i class="bi bi-airplane-engines"></i>
              </div>
              <div>
                <div class="airline-name">{{ $flight->airline }}</div>
                <div class="flight-number d-flex align-items-center gap-2">
                  <span>{{ $flight->flight_number }}</span>
                  @if($flight->seat_capacity <= 10)
                    <span class="badge-soft-warning"><i class="bi bi-fire me-1"></i> Few seats</span>
                  @endif
                </div>
              </div>
            </div>

            <!-- Route Info -->
            <div class="col-lg-5 col-md-8 d-flex align-items-center justify-content-between mb-3 mb-lg-0">
              <div class="time-display">
                <div class="time-text">{{ $departureTime->format('H:i') }}</div>
                <div class="city-text">{{ $flight->from_location }}</div>
              </div>
              
              <div class="flight-path">
                <div class="duration-text">{{ $duration->h }}h {{ $duration->i }}m</div>
                <div class="flight-line">
                  <div class="flight-icon-center"><i class="bi bi-airplane"></i></div>
                </div>
                <div class="badge-soft-success d-inline-block">Direct</div>
              </div>

              <div class="time-display">
                <div class="time-text">{{ $arrivalTime->format('H:i') }}</div>
                <div class="city-text">{{ $flight->to_location }}</div>
              </div>
            </div>

            <!-- Price and Action -->
            <div class="col-lg-4">
              <div class="price-box">
                <div>
                  <div class="price-text">${{ number_format($flight->price) }}</div>
                  <div class="price-label">Per passenger / One Way</div>
                  <a href="https://wa.me/+250789007076?text={{ $whatsAppMessage }}" 
                     target="_blank" 
                     class="btn btn-dark rounded-pill px-4 w-100 fw-bold d-flex align-items-center justify-content-center gap-2">
                    <i class="bi bi-whatsapp text-success"></i> Book Now
                  </a>
                </div>
              </div>
            </div>

          </div>
          
          @if($flight->description)
          <div class="mt-4 pt-3 border-top border-light">
             <div class="text-muted small"><i class="bi bi-info-circle me-1"></i> {{ $flight->description }}</div>
          </div>
          @endif
        </div>
      @endforeach

      <!-- Pagination -->
      <div class="mt-5 d-flex justify-content-center">
        {{ $results->withQueryString()->links() }}
      </div>

    @else
      <!-- Empty State -->
      <div class="text-center py-5 bg-white rounded-4 shadow-sm border border-light">
        <i class="bi bi-airplane d-block mb-3" style="font-size: 4rem; color: #cbd5e1;"></i>
        <h4 class="fw-bold text-charcoal mb-2">No Flights Found</h4>
        <p class="text-muted">We couldn't find any flights matching your current search criteria. Please try different dates or destinations.</p>
        <a href="{{ route('flights.index') }}" class="btn-gold mt-3">Reset Search</a>
      </div>
    @endif
  </div>
</section>

@endsection