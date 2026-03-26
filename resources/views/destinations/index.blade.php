@extends('layouts.public')

@section('title', 'Destinations | Kaya Travels')

@section('meta')
<meta name="description" content="Explore our handpicked destinations across Rwanda and Africa. From adventure tours to luxury experiences.">
@endsection

@section('content')
<style>
  :root {
    --hero-height: 55vh;
  }

  /* Hero Section */
  .dest-hero {
    height: var(--hero-height);
    background-size: cover;
    background-position: center;
    background-attachment: fixed;
    position: relative;
    display: flex;
    align-items: center;
    justify-content: center;
  }

  .dest-hero::before {
    content: '';
    position: absolute;
    inset: 0;
    background: linear-gradient(135deg, rgba(44, 62, 80, 0.85) 0%, rgba(52, 73, 94, 0.7) 50%, rgba(244, 208, 63, 0.3) 100%);
    z-index: 1;
  }

  .dest-hero-content {
    position: relative;
    z-index: 2;
    text-align: center;
    color: white;
    max-width: 800px;
  }

  .hero-title {
    font-size: 3.5rem;
    font-weight: 800;
    margin-bottom: 1rem;
    background: linear-gradient(135deg, #ffffff 0%, var(--primary-gold) 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
  }

  /* Filter Widget */
  .filter-widget {
    background: white;
    border-radius: 24px;
    padding: 2rem;
    box-shadow: var(--shadow-medium);
    margin-top: -60px;
    position: relative;
    z-index: 10;
  }

  .filter-btn {
    background: #f8fafc;
    border: 1px solid #e2e8f0;
    color: var(--charcoal-lighter);
    padding: 10px 20px;
    border-radius: 50px;
    font-weight: 600;
    font-size: 0.9rem;
    transition: var(--transition);
  }

  .filter-btn:hover {
    border-color: var(--primary-gold);
    color: var(--charcoal);
  }

  .filter-btn.active {
    background: linear-gradient(135deg, var(--primary-gold), var(--gold-dark));
    color: var(--charcoal);
    border-color: var(--primary-gold);
    box-shadow: var(--shadow-gold);
  }

  .search-input {
    border: 1px solid #e2e8f0;
    background: #f8fafc;
    border-radius: 50px;
    padding: 12px 20px 12px 45px;
    width: 100%;
    transition: var(--transition);
  }

  .search-input:focus {
    outline: none;
    border-color: var(--primary-gold);
    background: white;
    box-shadow: 0 0 0 4px rgba(244, 208, 63, 0.1);
  }

  .search-icon {
    position: absolute;
    left: 18px;
    top: 50%;
    transform: translateY(-50%);
    color: var(--charcoal-lighter);
  }

  /* Card */
  .dest-card {
    background: white;
    border-radius: 20px;
    border: 1px solid #f1f5f9;
    overflow: hidden;
    transition: var(--transition);
    height: 100%;
    display: flex;
    flex-direction: column;
  }

  .dest-card:hover {
    transform: translateY(-8px);
    box-shadow: var(--shadow-medium);
    border-color: rgba(244, 208, 63, 0.4);
  }

  .dest-img-wrap {
    height: 240px;
    position: relative;
    overflow: hidden;
  }

  .dest-img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.6s ease;
  }

  .dest-card:hover .dest-img {
    transform: scale(1.05);
  }

  .dest-badge {
    position: absolute;
    top: 15px;
    left: 15px;
    background: rgba(255, 255, 255, 0.95);
    color: var(--charcoal);
    padding: 6px 14px;
    border-radius: 20px;
    font-size: 0.8rem;
    font-weight: 700;
    text-transform: uppercase;
    box-shadow: 0 4px 10px rgba(0,0,0,0.1);
  }

  .dest-content {
    padding: 1.8rem;
    flex-grow: 1;
    display: flex;
    flex-direction: column;
  }

  .dest-title {
    font-size: 1.4rem;
    font-weight: 800;
    color: var(--charcoal);
    margin-bottom: 0.5rem;
  }

  .dest-desc {
    color: var(--charcoal-lighter);
    font-size: 0.95rem;
    flex-grow: 1;
    margin-bottom: 1.5rem;
    line-height: 1.6;
  }

  .dest-footer {
    display: flex;
    justify-content: space-between;
    align-items: center;
    border-top: 1px solid #f1f5f9;
    padding-top: 1rem;
    margin-top: auto;
  }

  .trip-count {
    font-size: 0.9rem;
    font-weight: 600;
    color: var(--primary-gold);
    display: flex;
    align-items: center;
    gap: 6px;
  }

  .btn-view {
    background: transparent;
    color: var(--charcoal);
    font-weight: 700;
    font-size: 0.9rem;
    text-decoration: none;
    display: flex;
    align-items: center;
    gap: 5px;
    transition: var(--transition);
  }

  .dest-card:hover .btn-view {
    color: var(--primary-gold);
    gap: 10px;
  }
</style>

<!-- Hero Section -->
<section class="dest-hero" style="background-image: url('{{ asset('images/destination-hero.jpeg') }}');">
  <div class="container">
    <div class="dest-hero-content mx-auto" data-aos="fade-up">
      <span class="badge bg-gold text-charcoal rounded-pill px-3 py-2 mb-3 fw-bold shadow" style="background-color: var(--primary-gold);"><i class="bi bi-map me-1"></i> Destinations</span>
      <h1 class="hero-title">Discover Your Next Journey</h1>
      <p class="fs-5 opacity-75">Curated places across Rwanda and Africa. Find the perfect landscape for your travel story.</p>
    </div>
  </div>
</section>

<section class="pb-5 mb-5" style="background: var(--light-bg);">
  <div class="container">
    <!-- Filter Widget -->
    <div class="filter-widget" data-aos="fade-up" data-aos-delay="100">
      <div class="row g-3 align-items-center">
        <div class="col-lg-8">
          <div class="d-flex flex-wrap gap-2">
            <button class="filter-btn active" data-filter="all"><i class="bi bi-grid-fill me-1"></i> All</button>
            <button class="filter-btn" data-filter="adventure"><i class="bi bi-compass me-1"></i> Adventure</button>
            <button class="filter-btn" data-filter="cultural"><i class="bi bi-bank me-1"></i> Cultural</button>
            <button class="filter-btn" data-filter="luxury"><i class="bi bi-gem me-1"></i> Luxury</button>
            <button class="filter-btn" data-filter="weekend"><i class="bi bi-sun me-1"></i> Weekend</button>
          </div>
        </div>
        <div class="col-lg-4">
          <div class="position-relative">
            <i class="bi bi-search search-icon"></i>
            <input type="text" id="searchInput" class="search-input" placeholder="Search destinations...">
          </div>
        </div>
      </div>
    </div>

    <!-- Grid -->
    <div class="row g-4 mt-4" id="destGrid">
      @forelse($destinations as $dest)
        <div class="col-lg-4 col-md-6 dest-item" style="transition: opacity 0.3s;" data-category="{{ $dest->type }}" data-name="{{ strtolower($dest->name) }}" data-aos="fade-up" data-aos-delay="{{ $loop->index * 50 }}">
          <a href="{{ $dest->trips_count > 0 ? route('trips.public.index', ['destination' => $dest->slug]) : '#' }}" class="text-decoration-none d-block h-100">
            <div class="dest-card">
              <div class="dest-img-wrap">
                <img src="{{ asset('storage/' . $dest->image) }}" class="dest-img" alt="{{ $dest->name }}">
                <span class="dest-badge">{{ ucfirst($dest->type) }}</span>
              </div>
              <div class="dest-content">
                <h3 class="dest-title">{{ $dest->name }}</h3>
                <p class="dest-desc">{{ Str::limit($dest->description, 100) }}</p>
                
                <div class="dest-footer">
                  <div class="trip-count">
                    @if($dest->trips_count > 0)
                      <i class="bi bi-geo-alt-fill text-gold" style="color: var(--primary-gold);"></i> <span class="text-dark">{{ $dest->trips_count }} Package{{ $dest->trips_count > 1 ? 's' : '' }}</span>
                    @else
                      <i class="bi bi-clock text-secondary"></i> <span class="text-secondary">Coming Soon</span>
                    @endif
                  </div>
                  @if($dest->trips_count > 0)
                    <div class="btn-view">Explore <i class="bi bi-arrow-right"></i></div>
                  @endif
                </div>
              </div>
            </div>
          </a>
        </div>
      @empty
        <div class="col-12 text-center py-5">
          <i class="bi bi-map display-3 text-muted opacity-50 mb-3"></i>
          <h3>No destinations yet</h3>
        </div>
      @endforelse
    </div>
    
    <div id="noResults" class="text-center py-5 mt-4" style="display: none;">
      <i class="bi bi-search display-3 text-muted mb-3 opacity-50 d-block"></i>
      <h3 class="fw-bold text-charcoal">No destinations found</h3>
      <p class="text-muted">Try adjusting your filters or search.</p>
      <button class="btn rounded-pill px-4 mt-2" style="background: var(--primary-gold); font-weight: bold;" onclick="resetFilters()">Reset All</button>
    </div>
  </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', () => {
  const filterBtns = document.querySelectorAll('.filter-btn');
  const items = document.querySelectorAll('.dest-item');
  const search = document.getElementById('searchInput');
  const noResults = document.getElementById('noResults');
  
  let currentFilter = 'all';

  function apply() {
    let count = 0;
    const term = search.value.toLowerCase().trim();
    
    items.forEach(el => {
      const cat = el.dataset.category;
      const name = el.dataset.name;
      const mFilter = (currentFilter === 'all' || cat === currentFilter);
      const mSearch = (name.includes(term));
      
      if(mFilter && mSearch) {
        el.style.display = 'block';
        setTimeout(() => el.style.opacity = '1', 10);
        count++;
      } else {
        el.style.opacity = '0';
        setTimeout(() => el.style.display = 'none', 300);
      }
    });
    
    setTimeout(() => {
      noResults.style.display = count === 0 ? 'block' : 'none';
    }, 300);
  }

  filterBtns.forEach(btn => {
    btn.addEventListener('click', () => {
      filterBtns.forEach(b => b.classList.remove('active'));
      btn.classList.add('active');
      currentFilter = btn.dataset.filter;
      apply();
    });
  });

  search.addEventListener('input', apply);
  
  window.resetFilters = () => {
    search.value = '';
    filterBtns.forEach(b => b.classList.remove('active'));
    filterBtns[0].classList.add('active');
    currentFilter = 'all';
    apply();
  };
});
</script>
@endsection