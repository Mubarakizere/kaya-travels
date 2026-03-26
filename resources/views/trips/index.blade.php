@extends('layouts.public')

@section('title', 'Travel Packages - Explore Amazing Trips | Kaya Travels')

@section('meta')
<meta name="description" content="Discover our premium travel packages and trips across Rwanda and Africa. From adventure tours to luxury experiences, find your perfect journey with Kaya Travels.">
<meta name="keywords" content="Travel Packages, Rwanda Trips, Africa Tours, Adventure Travel, Luxury Tours, Cultural Experiences, Kaya Travels Packages">
@endsection

@php
  use App\Models\Destination;
@endphp

@section('content')
<style>
  /* Trips Page Specific Styles */
  :root {
    --hero-height: 60vh;
    --card-hover-scale: 1.02;
  }

  /* Hero Section */
  .trips-hero {
    height: var(--hero-height);
    background-size: cover;
    background-position: center;
    background-attachment: fixed;
    position: relative;
    display: flex;
    align-items: center;
    overflow: hidden;
  }

  .trips-hero::before {
    content: '';
    position: absolute;
    inset: 0;
    background: linear-gradient(
      135deg,
      rgba(44, 62, 80, 0.8) 0%,
      rgba(52, 73, 94, 0.6) 50%,
      rgba(244, 208, 63, 0.2) 100%
    );
    z-index: 1;
  }

  .trips-hero .container {
    position: relative;
    z-index: 2;
  }

  .hero-content {
    max-width: 800px;
    margin: 0 auto;
    text-align: center;
    color: white;
  }

  .hero-badge {
    display: inline-flex;
    align-items: center;
    background: rgba(244, 208, 63, 0.2);
    backdrop-filter: blur(15px);
    border: 2px solid var(--primary-gold);
    padding: 12px 30px;
    border-radius: 50px;
    font-size: 0.9rem;
    font-weight: 600;
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

  .hero-subtitle {
    font-size: 1.3rem;
    line-height: 1.6;
    opacity: 0.9;
  }

  /* Filter & Search Section */
  .filter-search-section {
    background: white;
    padding: 2rem 0;
    box-shadow: var(--shadow-soft);
    position: sticky;
    top: 100px;
    z-index: 100;
  }

  .filter-container {
    display: flex;
    align-items: center;
    gap: 1rem;
    flex-wrap: wrap;
    margin-bottom: 1rem;
  }

  .filter-label {
    font-weight: 600;
    color: var(--charcoal);
    white-space: nowrap;
  }

  .filter-select {
    background: var(--light-bg);
    border: 2px solid #e9ecef;
    border-radius: 15px;
    padding: 10px 15px;
    font-size: 0.9rem;
    transition: var(--transition);
    min-width: 150px;
  }

  .filter-select:focus {
    outline: none;
    border-color: var(--primary-gold);
    box-shadow: 0 0 15px rgba(244, 208, 63, 0.2);
  }

  .search-container {
    position: relative;
    flex-grow: 1;
    max-width: 400px;
  }

  .search-input {
    width: 100%;
    padding: 12px 45px 12px 20px;
    border: 2px solid #e9ecef;
    border-radius: 25px;
    font-size: 1rem;
    transition: var(--transition);
    background: var(--light-bg);
  }

  .search-input:focus {
    outline: none;
    border-color: var(--primary-gold);
    box-shadow: 0 0 20px rgba(244, 208, 63, 0.2);
    background: white;
  }

  .search-icon {
    position: absolute;
    right: 15px;
    top: 50%;
    transform: translateY(-50%);
    color: var(--charcoal-lighter);
    font-size: 1.2rem;
  }

  .results-info {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-top: 1rem;
    padding-top: 1rem;
    border-top: 1px solid #e9ecef;
  }

  .results-count {
    color: var(--charcoal-lighter);
    font-size: 0.9rem;
  }

  .view-toggle {
    display: flex;
    gap: 0.5rem;
  }

  .view-btn {
    background: var(--light-bg);
    border: 2px solid #e9ecef;
    color: var(--charcoal-lighter);
    padding: 8px 12px;
    border-radius: 8px;
    transition: var(--transition);
    cursor: pointer;
  }

  .view-btn.active,
  .view-btn:hover {
    background: var(--primary-gold);
    border-color: var(--primary-gold);
    color: var(--charcoal);
  }

  /* Trips Section */
  .trips-section {
    padding: 3rem 0;
    background: var(--light-bg);
    min-height: 60vh;
  }

  /* Horizontal Card Layout */
  .trip-card-horizontal {
    background: white;
    border-radius: 20px;
    overflow: hidden;
    box-shadow: var(--shadow-soft);
    transition: var(--transition);
    margin-bottom: 2rem;
    position: relative;
  }

  .trip-card-horizontal:hover {
    transform: translateY(-5px);
    box-shadow: var(--shadow-hover);
  }

  .trip-image-container {
    position: relative;
    width: 300px;
    min-height: 250px;
    overflow: hidden;
  }

  .trip-image {
    width: 100%;
    height: 100%;
    background-size: cover;
    background-position: center;
    transition: var(--transition);
  }

  .trip-card-horizontal:hover .trip-image {
    transform: scale(1.05);
  }

  .trip-badges {
    position: absolute;
    top: 15px;
    left: 15px;
    display: flex;
    flex-direction: column;
    gap: 8px;
    z-index: 2;
  }

  .trip-badge {
    background: rgba(244, 208, 63, 0.95);
    color: var(--charcoal);
    padding: 6px 12px;
    border-radius: 15px;
    font-size: 0.75rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    backdrop-filter: blur(10px);
  }

  .badge-top {
    background: linear-gradient(135deg, #ff6b6b, #ff8e8e);
    color: white;
  }

  .trip-gallery-indicator {
    position: absolute;
    bottom: 15px;
    right: 15px;
    background: rgba(0, 0, 0, 0.7);
    color: white;
    padding: 6px 12px;
    border-radius: 15px;
    font-size: 0.8rem;
    backdrop-filter: blur(10px);
  }

  .trip-content {
    padding: 2rem;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    flex-grow: 1;
  }

  .trip-header {
    margin-bottom: 1rem;
  }

  .trip-title {
    font-size: 1.5rem;
    font-weight: 700;
    color: var(--charcoal);
    margin-bottom: 0.5rem;
    line-height: 1.3;
  }

  .trip-meta {
    display: flex;
    align-items: center;
    gap: 1rem;
    margin-bottom: 1rem;
    color: var(--charcoal-lighter);
    font-size: 0.9rem;
    flex-wrap: wrap;
  }

  .trip-meta-item {
    display: flex;
    align-items: center;
    gap: 5px;
    white-space: nowrap;
  }

  .trip-meta-item i {
    color: var(--primary-gold);
  }

  .trip-description {
    color: var(--charcoal-lighter);
    line-height: 1.6;
    margin-bottom: 1.5rem;
    font-size: 1rem;
  }

  .trip-details {
    display: flex;
    align-items: center;
    gap: 1rem;
    margin-bottom: 1.5rem;
    font-size: 0.85rem;
    color: var(--charcoal-lighter);
    flex-wrap: wrap;
  }

  .trip-id {
    background: var(--light-bg);
    color: var(--charcoal);
    padding: 4px 12px;
    border-radius: 12px;
    font-weight: 600;
    font-size: 0.8rem;
  }

  .trip-footer {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 1rem;
  }

  .trip-rating {
    display: flex;
    align-items: center;
    gap: 5px;
  }

  .trip-rating .stars {
    color: var(--primary-gold);
    margin-right: 8px;
  }

  .trip-price-section {
    text-align: right;
  }

  .trip-price {
    font-size: 2rem;
    font-weight: 800;
    color: var(--primary-gold);
    line-height: 1;
    margin-bottom: 0.5rem;
  }

  .price-label {
    font-size: 0.8rem;
    color: var(--charcoal-lighter);
    margin-bottom: 1rem;
  }

  .btn-explore {
    background: linear-gradient(135deg, var(--primary-gold), var(--gold-dark));
    color: var(--charcoal);
    border: none;
    padding: 12px 30px;
    border-radius: 25px;
    font-weight: 700;
    font-size: 1rem;
    text-decoration: none;
    transition: var(--transition);
    display: inline-flex;
    align-items: center;
    gap: 8px;
  }

  .btn-explore:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(244, 208, 63, 0.3);
    color: var(--charcoal);
  }

  /* Grid Layout */
  .trips-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(400px, 1fr));
    gap: 2rem;
  }

  .trip-card-grid {
    background: white;
    border-radius: 20px;
    overflow: hidden;
    box-shadow: var(--shadow-soft);
    transition: var(--transition);
    height: 100%;
    display: flex;
    flex-direction: column;
  }

  .trip-card-grid:hover {
    transform: translateY(-8px);
    box-shadow: var(--shadow-hover);
  }

  .grid-image-container {
    height: 250px;
    position: relative;
    overflow: hidden;
  }

  .grid-content {
    padding: 1.5rem;
    flex-grow: 1;
    display: flex;
    flex-direction: column;
  }

  .grid-title {
    font-size: 1.3rem;
    font-weight: 700;
    margin-bottom: 0.5rem;
  }

  .grid-description {
    flex-grow: 1;
    margin-bottom: 1rem;
  }

  /* Empty State */
  .empty-state {
    text-align: center;
    padding: 4rem 2rem;
    background: white;
    border-radius: 20px;
    box-shadow: var(--shadow-soft);
    max-width: 600px;
    margin: 2rem auto;
  }

  .empty-state-icon {
    font-size: 4rem;
    color: var(--charcoal-lighter);
    margin-bottom: 1.5rem;
  }

  .empty-state-title {
    font-size: 1.8rem;
    font-weight: 700;
    color: var(--charcoal);
    margin-bottom: 1rem;
  }

  .empty-state-text {
    color: var(--charcoal-lighter);
    line-height: 1.6;
    margin-bottom: 2rem;
    font-size: 1.1rem;
  }

  .btn-browse {
    background: var(--primary-gold);
    color: var(--charcoal);
    border: none;
    padding: 15px 35px;
    border-radius: 25px;
    font-weight: 600;
    font-size: 1.1rem;
    transition: var(--transition);
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 10px;
  }

  .btn-browse:hover {
    background: var(--gold-dark);
    transform: translateY(-2px);
    color: var(--charcoal);
  }

  /* Animation Classes */
  .trip-item {
    opacity: 1;
    transform: translateY(0);
    transition: all 0.4s ease;
  }

  .trip-item.hidden {
    opacity: 0;
    transform: translateY(20px);
    pointer-events: none;
    height: 0;
    margin: 0;
    overflow: hidden;
  }

  /* Pagination */
  .pagination-container {
    display: flex;
    justify-content: center;
    margin-top: 3rem;
  }

  /* Responsive Design */
  @media (max-width: 1024px) {
    .trip-image-container {
      width: 250px;
    }
    
    .trips-grid {
      grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
    }
  }

  @media (max-width: 768px) {
    .hero-title {
      font-size: 2.5rem;
    }
    
    .trip-card-horizontal {
      flex-direction: column;
    }
    
    .trip-image-container {
      width: 100%;
      height: 200px;
    }
    
    .filter-container {
      flex-direction: column;
      align-items: stretch;
      gap: 1rem;
    }
    
    .filter-select,
    .search-container {
      max-width: none;
    }
    
    .results-info {
      flex-direction: column;
      gap: 1rem;
      text-align: center;
    }
    
    .trip-footer {
      flex-direction: column;
      gap: 1rem;
      text-align: center;
    }
    
    .trip-price-section {
      text-align: center;
    }
    
    .trips-grid {
      grid-template-columns: 1fr;
    }
    
    .filter-search-section {
      top: 80px;
    }
  }

  @media (max-width: 576px) {
    .hero-title {
      font-size: 2rem;
    }
    
    .trip-content {
      padding: 1.5rem;
    }
    
    .trips-section {
      padding: 2rem 0;
    }
    
    .trip-meta {
      justify-content: center;
    }
  }
</style>

<!-- Hero Section -->
<section class="trips-hero" style="background-image: url('{{ asset('images/about.jpeg') }}');">
  <div class="container">
    <div class="hero-content">
      <div class="hero-badge" data-aos="fade-up">
        <i class="bi bi-compass me-2"></i>Travel Packages
      </div>
      <h1 class="hero-title" data-aos="fade-up" data-aos-delay="200">Premium Travel Packages</h1>
      <p class="hero-subtitle" data-aos="fade-up" data-aos-delay="400">Discover unforgettable journeys crafted with passion and expertise across Rwanda and beyond</p>
    </div>
  </div>
</section>

<!-- Filter & Search Section -->
<section class="filter-search-section">
  <div class="container">
    <div class="filter-container">
      <div class="filter-label">
        <i class="bi bi-funnel me-2 text-warning"></i>Filter by:
      </div>
      
      <select class="filter-select" id="categoryFilter">
        <option value="">All Categories</option>
        <option value="adventure">Adventure</option>
        <option value="cultural">Cultural</option>
        <option value="luxury">Luxury</option>
        <option value="weekend">Weekend</option>
      </select>
      
      <select class="filter-select" id="durationFilter">
        <option value="">Any Duration</option>
        <option value="1-3">1-3 Days</option>
        <option value="4-7">4-7 Days</option>
        <option value="8+">8+ Days</option>
      </select>
      
      <select class="filter-select" id="priceFilter">
        <option value="">Any Price</option>
        <option value="0-500">$0 - $500</option>
        <option value="500-1000">$500 - $1000</option>
        <option value="1000+">$1000+</option>
      </select>
      
      <div class="search-container">
        <input type="text" class="search-input" placeholder="Search trips..." id="searchInput">
        <i class="bi bi-search search-icon"></i>
      </div>
    </div>
    
    <div class="results-info">
      <div class="results-count" id="resultsCount">
        Showing {{ $trips->count() }} of {{ $trips->total() }} trips
      </div>
      <div class="view-toggle">
        <button class="view-btn active" data-view="horizontal">
          <i class="bi bi-list"></i>
        </button>
        <button class="view-btn" data-view="grid">
          <i class="bi bi-grid"></i>
        </button>
      </div>
    </div>
  </div>
</section>

<!-- Trips Section -->
<section class="trips-section">
  <div class="container">
    @if($trips->isEmpty())
      <div class="empty-state">
        <i class="bi bi-airplane empty-state-icon"></i>
        <h2 class="empty-state-title">No Trips Available</h2>
        <p class="empty-state-text">We're currently working on amazing travel packages for you. Check back soon for exciting destinations and unforgettable experiences!</p>
        <a href="{{ url('/destinations') }}" class="btn-browse">
          <i class="bi bi-map"></i>
          <span>Browse Destinations</span>
        </a>
      </div>
    @else
      <div id="tripsContainer" class="trips-horizontal">
        @foreach($trips as $trip)
          <div class="trip-item" 
               data-category="{{ $trip->category }}" 
               data-duration="{{ $trip->duration }}" 
               data-price="{{ $trip->price }}"
               data-title="{{ strtolower($trip->title) }}"
               data-location="{{ strtolower($trip->location) }}"
               data-aos="fade-up" 
               data-aos-delay="{{ $loop->index * 100 }}">
            
            <!-- Horizontal Layout -->
            <div class="trip-card-horizontal d-flex">
              <div class="trip-image-container">
                <div class="trip-image" style="background-image: url('{{ asset('storage/' . $trip->thumbnail) }}');"></div>
                
                <div class="trip-badges">
                  @if($trip->is_top)
                    <span class="trip-badge badge-top">
                      <i class="bi bi-star-fill me-1"></i>Top Trip
                    </span>
                  @endif
                  <span class="trip-badge">{{ ucfirst($trip->category) }}</span>
                </div>
                
                @if(!empty($trip->gallery))
                  <div class="trip-gallery-indicator">
                    <i class="bi bi-images me-1"></i>{{ count(json_decode($trip->gallery, true)) }} photos
                  </div>
                @endif
              </div>
              
              <div class="trip-content">
                <div class="trip-header">
                  <h3 class="trip-title">{{ ucfirst($trip->title) }}</h3>
                  
                  <div class="trip-meta">
                    <div class="trip-meta-item">
                      <i class="bi bi-geo-alt-fill"></i>
                      <span>{{ $trip->location }}</span>
                    </div>
                    <div class="trip-meta-item">
                      <i class="bi bi-clock"></i>
                      <span>{{ $trip->duration }} Days</span>
                    </div>
                    <div class="trip-meta-item">
                      <i class="bi bi-calendar-event"></i>
                      <span>Added {{ $trip->created_at->format('M d, Y') }}</span>
                    </div>
                  </div>
                  
                  <p class="trip-description">{{ Str::limit($trip->short_description, 150) }}</p>
                  
                  <div class="trip-details">
                    <span class="trip-id">#TRIP-{{ $trip->id }}</span>
                  </div>
                </div>
                
                <div class="trip-footer">
                  <div class="trip-rating">
                    <div class="stars">
                      @for($i = 1; $i <= 5; $i++)
                        <i class="bi bi-star-fill"></i>
                      @endfor
                    </div>
                    <span class="text-muted small">5.0 (50+ reviews)</span>
                  </div>
                  
                  <div class="trip-price-section">
                    <div class="trip-price">${{ number_format($trip->price) }}</div>
                    <div class="price-label">per person</div>
                    <a href="{{ route('trips.public.show', $trip->slug) }}" class="btn-explore">
                      <span>Explore Trip</span>
                      <i class="bi bi-arrow-right"></i>
                    </a>
                  </div>
                </div>
              </div>
            </div>
            
            <!-- Grid Layout (Hidden by default) -->
            <div class="trip-card-grid" style="display: none;">
              <div class="grid-image-container">
                <div class="trip-image" style="background-image: url('{{ asset('storage/' . $trip->thumbnail) }}');"></div>
                
                <div class="trip-badges">
                  @if($trip->is_top)
                    <span class="trip-badge badge-top">
                      <i class="bi bi-star-fill me-1"></i>Top
                    </span>
                  @endif
                  <span class="trip-badge">{{ ucfirst($trip->category) }}</span>
                </div>
              </div>
              
              <div class="grid-content">
                <h3 class="grid-title">{{ ucfirst($trip->title) }}</h3>
                
                <div class="trip-meta">
                  <div class="trip-meta-item">
                    <i class="bi bi-geo-alt-fill"></i>
                    <span>{{ $trip->location }}</span>
                  </div>
                  <div class="trip-meta-item">
                    <i class="bi bi-clock"></i>
                    <span>{{ $trip->duration }} Days</span>
                  </div>
                </div>
                
                <p class="grid-description trip-description">{{ Str::limit($trip->short_description, 100) }}</p>
                
                <div class="trip-footer">
                  <div class="trip-rating">
                    <div class="stars">
                      @for($i = 1; $i <= 5; $i++)
                        <i class="bi bi-star-fill"></i>
                      @endfor
                    </div>
                  </div>
                  
                  <div class="trip-price-section">
                    <div class="trip-price">${{ number_format($trip->price) }}</div>
                    <div class="price-label">per person</div>
                    <a href="{{ route('trips.public.show', $trip->slug) }}" class="btn-explore">
                      <span>Explore</span>
                      <i class="bi bi-arrow-right"></i>
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        @endforeach
      </div>
      
      <!-- No Results Found -->
      <div id="noResults" class="empty-state" style="display: none;">
        <i class="bi bi-search empty-state-icon"></i>
        <h2 class="empty-state-title">No Trips Found</h2>
        <p class="empty-state-text">Try adjusting your search or filter criteria to find more trips.</p>
        <button class="btn-browse" onclick="resetFilters()">
          <i class="bi bi-arrow-clockwise"></i>
          <span>Clear All Filters</span>
        </button>
      </div>
      
      <!-- Pagination -->
      <div class="pagination-container">
        {{ $trips->links('pagination::bootstrap-4') }}
      </div>
    @endif
  </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
  const categoryFilter = document.getElementById('categoryFilter');
  const durationFilter = document.getElementById('durationFilter');
  const priceFilter = document.getElementById('priceFilter');
  const searchInput = document.getElementById('searchInput');
  const tripItems = document.querySelectorAll('.trip-item');
  const noResults = document.getElementById('noResults');
  const resultsCount = document.getElementById('resultsCount');
  const tripsContainer = document.getElementById('tripsContainer');
  const viewBtns = document.querySelectorAll('.view-btn');
  
  let currentView = 'horizontal';
  
  // Filter functionality
  function applyFilters() {
    const category = categoryFilter.value;
    const duration = durationFilter.value;
    const price = priceFilter.value;
    const search = searchInput.value.toLowerCase().trim();
    
    let visibleCount = 0;
    
    tripItems.forEach(item => {
      const itemCategory = item.getAttribute('data-category');
      const itemDuration = parseInt(item.getAttribute('data-duration'));
      const itemPrice = parseInt(item.getAttribute('data-price'));
      const itemTitle = item.getAttribute('data-title');
      const itemLocation = item.getAttribute('data-location');
      
      let show = true;
      
      // Category filter
      if (category && itemCategory !== category) show = false;
      
      // Duration filter
      if (duration) {
        if (duration === '1-3' && (itemDuration < 1 || itemDuration > 3)) show = false;
        if (duration === '4-7' && (itemDuration < 4 || itemDuration > 7)) show = false;
        if (duration === '8+' && itemDuration < 8) show = false;
      }
      
      // Price filter
      if (price) {
        if (price === '0-500' && itemPrice > 500) show = false;
        if (price === '500-1000' && (itemPrice < 500 || itemPrice > 1000)) show = false;
        if (price === '1000+' && itemPrice < 1000) show = false;
      }
      
      // Search filter
      if (search && !itemTitle.includes(search) && !itemLocation.includes(search)) show = false;
      
      if (show) {
        item.classList.remove('hidden');
        visibleCount++;
      } else {
        item.classList.add('hidden');
      }
    });
    
    // Update results count
    resultsCount.textContent = `Showing ${visibleCount} trips`;
    
    // Show/hide no results
    if (visibleCount === 0 && tripItems.length > 0) {
      noResults.style.display = 'block';
      tripsContainer.style.display = 'none';
    } else {
      noResults.style.display = 'none';
      tripsContainer.style.display = 'block';
    }
  }
  
  // View toggle functionality
  viewBtns.forEach(btn => {
    btn.addEventListener('click', () => {
      const view = btn.getAttribute('data-view');
      currentView = view;
      
      viewBtns.forEach(b => b.classList.remove('active'));
      btn.classList.add('active');
      
      tripItems.forEach(item => {
        const horizontalCard = item.querySelector('.trip-card-horizontal');
        const gridCard = item.querySelector('.trip-card-grid');
        
        if (view === 'horizontal') {
          tripsContainer.className = 'trips-horizontal';
          horizontalCard.style.display = 'flex';
          gridCard.style.display = 'none';
        } else {
          tripsContainer.className = 'trips-grid';
          horizontalCard.style.display = 'none';
          gridCard.style.display = 'flex';
        }
      });
    });
  });
  
  // Event listeners
  categoryFilter.addEventListener('change', applyFilters);
  durationFilter.addEventListener('change', applyFilters);
  priceFilter.addEventListener('change', applyFilters);
  searchInput.addEventListener('input', applyFilters);
  
  // Reset filters function
  window.resetFilters = function() {
    categoryFilter.value = '';
    durationFilter.value = '';
    priceFilter.value = '';
    searchInput.value = '';
    applyFilters();
  };
  
  // Smooth scroll for filter section
  let lastScrollY = window.scrollY;
  window.addEventListener('scroll', () => {
    const filterSection = document.querySelector('.filter-search-section');
    if (window.scrollY > lastScrollY && window.scrollY > 200) {
      filterSection.style.transform = 'translateY(-100%)';
    } else {
      filterSection.style.transform = 'translateY(0)';
    }
    lastScrollY = window.scrollY;
  });
  
  // Add loading animation for images
  const images = document.querySelectorAll('.trip-image');
  images.forEach(img => {
    const bgImage = img.style.backgroundImage;
    if (bgImage) {
      const imageUrl = bgImage.slice(4, -1).replace(/"/g, "");
      const image = new Image();
      
      img.style.background = 'linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%)';
      img.style.backgroundSize = '200% 100%';
      img.style.animation = 'loading 1.5s infinite';
      
      image.onload = function() {
        img.style.backgroundImage = bgImage;
        img.style.animation = 'none';
      };
      
      image.src = imageUrl;
    }
  });
  
  // Add hover effects for better interactivity
  tripItems.forEach(item => {
    const cards = item.querySelectorAll('.trip-card-horizontal, .trip-card-grid');
    
    cards.forEach(card => {
      card.addEventListener('mouseenter', function() {
        this.style.transform = 'translateY(-5px) scale(1.01)';
      });
      
      card.addEventListener('mouseleave', function() {
        if (!item.classList.contains('hidden')) {
          this.style.transform = 'translateY(0) scale(1)';
        }
      });
    });
  });
  
  // Keyboard navigation
  document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
      resetFilters();
    }
  });
  
  // Auto-focus search on Ctrl+F
  document.addEventListener('keydown', function(e) {
    if ((e.ctrlKey || e.metaKey) && e.key === 'f') {
      e.preventDefault();
      searchInput.focus();
    }
  });
});

// Add CSS animations for loading state
const style = document.createElement('style');
style.textContent = `
  @keyframes loading {
    0% { background-position: 200% 0; }
    100% { background-position: -200% 0; }
  }
`;
document.head.appendChild(style);
</script>

@endsection