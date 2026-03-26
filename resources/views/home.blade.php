@extends('layouts.public')

@section('title', 'Welcome to Kaya Travels - Discover Your Next Adventure')

@section('meta')
<meta name="description" content="Kaya Travels & Tours – Explore Rwanda and beyond with premium travel experiences. Luxury tours, safaris, and holiday packages.">
@endsection

@section('content')
<style>
  :root {
    --hero-height: 85vh;
  }
  .glass-card { background: rgba(255, 255, 255, 0.95); backdrop-filter: blur(20px); border: 1px solid rgba(244, 208, 63, 0.2); border-radius: var(--card-border-radius, 20px); box-shadow: var(--shadow-medium, 0 10px 30px rgba(0,0,0,0.1)); padding: 2.5rem; transition: transform 0.3s ease, box-shadow 0.3s ease; }
  .search-widget { margin-top: 3rem; margin-bottom: 2rem; position: relative; z-index: 10; }
  .modern-input { background: #f8fafc; border: 2px solid #e9ecef; border-radius: 10px; padding: 10px 15px; width: 100%; transition: all 0.3s ease; font-size: 0.95rem; }
  .modern-input:focus { border-color: var(--primary-gold); outline: none; box-shadow: 0 0 15px rgba(244,208,63,0.2); background: white; }
  .feature-card { background: white; border-radius: 20px; border: 1px solid #f1f5f9; padding: 2.5rem 2rem; text-align: center; height: 100%; transition: all 0.3s ease; box-shadow: 0 5px 15px rgba(0,0,0,0.05); }
  .feature-card:hover { transform: translateY(-10px); box-shadow: 0 15px 35px rgba(0,0,0,0.1); border-color: rgba(244,208,63,0.3); }
  .icon-circle-gold { width: 80px; height: 80px; border-radius: 50%; background: linear-gradient(135deg, rgba(244,208,63,0.2), rgba(244,208,63,0.1)); color: var(--primary-gold); display: flex; align-items: center; justify-content: center; font-size: 2rem; margin: 0 auto 1.5rem; transition: all 0.3s ease; }
  .feature-card:hover .icon-circle-gold { background: linear-gradient(135deg, var(--primary-gold), var(--gold-dark)); color: white; transform: scale(1.1); }
  .img-card { background: white; border-radius: 20px; overflow: hidden; box-shadow: 0 5px 15px rgba(0,0,0,0.05); transition: all 0.3s ease; }
  .img-card:hover { transform: translateY(-8px); box-shadow: 0 15px 35px rgba(0,0,0,0.1); }
  .img-card-top { height: 250px; background-size: cover; background-position: center; position: relative; overflow: hidden; }
  .img-card-top::after { content: ''; position: absolute; inset: 0; background: linear-gradient(to top, rgba(0,0,0,0.7), transparent); opacity: 0; transition: opacity 0.3s; }
  .img-card:hover .img-card-top::after { opacity: 1; }
  .section-dark { background: var(--charcoal); color: white; padding: 6rem 0; position: relative; overflow: hidden; }
  .section-dark::before { content: ''; position: absolute; inset: 0; background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><circle cx="10" cy="10" r="1" fill="%23f4d03f" opacity="0.1"/></svg>'); }
  .newsletter-box { background: linear-gradient(135deg, var(--primary-gold), var(--gold-dark)); border-radius: 24px; padding: 4rem; color: var(--charcoal); }
</style>

<!-- Hero Carousel (Pinterest Inspired) -->
@include('components.home-hero')

<!-- Search Widget -->
<div class="container search-widget">
  <div class="glass-card shadow-sm bg-white rounded-4 p-3 p-md-4">
    <form action="{{ route('trips.public.index') }}" method="GET">
      <div class="row g-2 g-lg-3 align-items-end">
        <div class="col-lg-3 col-md-6">
          <label class="fw-bold mb-2 text-charcoal small text-uppercase" style="font-size: 0.8rem;"><i class="bi bi-geo-alt text-gold me-2"></i>Destination</label>
          <select name="destination" class="modern-input form-select bg-light border-0 shadow-none">
            <option value="">Any Destination</option>
            @foreach ($destinations as $dest)
              <option value="{{ $dest->slug }}">{{ $dest->name }}</option>
            @endforeach
          </select>
        </div>
        <div class="col-lg-3 col-md-6">
          <label class="fw-bold mb-2 text-charcoal small text-uppercase" style="font-size: 0.8rem;"><i class="bi bi-tags text-gold me-2"></i>Tour Type</label>
          <select name="category" class="modern-input form-select bg-light border-0 shadow-none">
            <option value="">All Types</option>
            <option value="adventure">Adventure</option>
            <option value="luxury">Luxury</option>
            <option value="cultural">Cultural</option>
          </select>
        </div>
        <div class="col-lg-3 col-md-6">
          <label class="fw-bold mb-2 text-charcoal small text-uppercase" style="font-size: 0.8rem;"><i class="bi bi-clock text-gold me-2"></i>Duration</label>
          <select name="duration" class="modern-input form-select bg-light border-0 shadow-none">
            <option value="">Any Duration</option>
            <option value="1-3">1–3 Days</option>
            <option value="4-7">4–7 Days</option>
             <option value="8+">8+ Days</option>
          </select>
        </div>
        <div class="col-lg-3 col-md-6 mt-3 mt-lg-0">
          <button type="submit" class="btn btn-dark w-100 rounded-pill py-2 fw-bold d-flex align-items-center justify-content-center gap-2 shadow-sm hover-lift">
            <i class="bi bi-search text-gold"></i> Search
          </button>
        </div>
      </div>
    </form>
  </div>
</div>

<!-- Featured Packages -->
<section class="py-5 py-md-6 mt-4">
  <div class="container py-4">
    <div class="text-center mb-5 pb-3">
      <span class="badge bg-gold text-charcoal rounded-pill px-3 py-2 fw-bold text-uppercase tracking-wide shadow-sm mb-3">International</span>
      <h2 class="display-5 fw-bold text-charcoal">Signature Packages</h2>
      <p class="text-muted lead mx-auto" style="max-width: 600px;">Curated experiences designed to showcase the very best of our destinations.</p>
    </div>
    <div class="row g-4">
      @forelse ($featuredDestinations as $dest)
        <div class="col-lg-4 col-md-6">
          <div class="img-card h-100 d-flex flex-column bg-white rounded-4 shadow-sm hover-shadow">
            <div class="img-card-top rounded-top-4" style="background-image: url('{{ asset('storage/' . $dest->image) }}'); height: 260px;">
              <span class="position-absolute top-0 start-0 m-3 badge bg-gold text-charcoal rounded-pill px-3 py-2 z-3 shadow-sm">Featured</span>
            </div>
            <div class="p-4 d-flex flex-column flex-grow-1">
              <h4 class="fw-bold text-charcoal mb-1">{{ $dest->name }}</h4>
              <p class="text-gold fw-bold small text-uppercase mb-3">{{ ucfirst($dest->type) }} Experience</p>
              <div class="mt-auto pt-3 border-top d-flex justify-content-between align-items-center">
                <div class="text-warning fw-bold"><i class="bi bi-star-fill"></i> 5.0</div>
                <a href="{{ route('trips.public.index', ['destination' => $dest->slug]) }}" class="text-charcoal fw-bold text-decoration-none hover-gold">Explore <i class="bi bi-arrow-right ms-1 text-gold"></i></a>
              </div>
            </div>
          </div>
        </div>
      @empty
        <div class="col-12 text-center text-muted py-5 my-5 bg-light rounded-4">
          <i class="bi bi-globe display-1 opacity-25 mb-4 d-block"></i>
          <h4 class="fw-bold text-charcoal">Amazing Packages Coming Soon</h4>
          <p>We are actively crafting incredible new experiences.</p>
        </div>
      @endforelse
    </div>
  </div>
</section>

<!-- Why Choose Us -->
<section class="section-dark py-5 py-md-6">
  <div class="container position-relative z-2 py-5">
    <div class="text-center mb-5 pb-4">
      <span class="text-gold fw-bold text-uppercase tracking-wide d-block mb-3">Our Promise</span>
      <h2 class="display-5 fw-bold text-white">Why Choose Kaya Travels</h2>
    </div>
    <div class="row g-4">
      <div class="col-lg-3 col-md-6 text-center">
        <div class="icon-circle-gold"><i class="bi bi-globe-americas"></i></div>
        <h5 class="fw-bold text-white mb-3">Global Expertise</h5>
        <p class="text-white opacity-75">Deep local insights seamlessly combined with international standards.</p>
      </div>
      <div class="col-lg-3 col-md-6 text-center">
        <div class="icon-circle-gold"><i class="bi bi-heart-fill"></i></div>
        <h5 class="fw-bold text-white mb-3">Tailored Experiences</h5>
        <p class="text-white opacity-75">Carefully customized journeys to fit your unique dreams and pace.</p>
      </div>
      <div class="col-lg-3 col-md-6 text-center">
        <div class="icon-circle-gold"><i class="bi bi-shield-check"></i></div>
        <h5 class="fw-bold text-white mb-3">Reliable Service</h5>
        <p class="text-white opacity-75">Punctual expert guides and perfectly coordinated daily schedules.</p>
      </div>
      <div class="col-lg-3 col-md-6 text-center">
        <div class="icon-circle-gold"><i class="bi bi-people-fill"></i></div>
        <h5 class="fw-bold text-white mb-3">Trusted by Thousands</h5>
        <p class="text-white opacity-75">Join our prestigious community of satisfied, lifelong travelers.</p>
      </div>
    </div>
  </div>
</section>

<!-- Blog & Newsletter -->
<section class="py-5 py-md-6 my-4">
  <div class="container py-4">
    <div class="row g-5 align-items-center">
      <div class="col-lg-7">
        <div class="mb-5">
          <span class="badge bg-light text-gold rounded-pill px-3 py-2 fw-bold text-uppercase tracking-wide mb-3">Stories</span>
          <h2 class="display-6 fw-bold text-charcoal">From Our Travel Blog</h2>
        </div>
        <div class="row g-4">
          @foreach ($latestPosts as $post)
            <div class="col-md-6">
              <div class="img-card h-100 bg-white rounded-4 shadow-sm hover-shadow d-flex flex-column">
                <div class="img-card-top rounded-top-4" style="background-image: url('{{ asset('storage/' . $post->thumbnail) }}'); height: 220px;"></div>
                <div class="p-4 d-flex flex-column flex-grow-1">
                  <h5 class="fw-bold text-charcoal mb-3">{{ $post->title }}</h5>
                  <a href="{{ route('blog.show', $post->slug) }}" class="mt-auto text-gold fw-bold text-decoration-none hover-charcoal d-inline-flex align-items-center">
                    Read Article <i class="bi bi-arrow-right ms-2"></i>
                  </a>
                </div>
              </div>
            </div>
          @endforeach
        </div>
      </div>
      <div class="col-lg-5">
        <div class="newsletter-box h-100 d-flex flex-column justify-content-center shadow-lg">
          <i class="bi bi-envelope-heart display-4 mb-4 text-charcoal opacity-75"></i>
          <h2 class="fw-bold text-charcoal mb-3">Stay Connected</h2>
          <p class="mb-4 fw-medium text-charcoal opacity-75 lead">Subscribe for exclusive travel deals, tips, and inspiration delivered straight to your inbox.</p>
          <form class="d-flex flex-column gap-3 mt-2">
            <input type="email" class="form-control form-control-lg border-0 shadow-sm" style="background: rgba(255,255,255,0.95); padding-top: 15px; padding-bottom: 15px;" placeholder="Your Email Address" required>
            <button class="btn btn-dark w-100 rounded-pill py-3 fw-bold d-inline-flex align-items-center justify-content-center gap-2 shadow-sm hover-lift">
              <i class="bi bi-send-fill text-gold"></i> Subscribe Now
            </button>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>

@endsection