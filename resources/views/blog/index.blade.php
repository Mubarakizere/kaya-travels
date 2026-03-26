@extends('layouts.public')

@section('title', 'Our Travel Blog | Kaya Travels')

@section('meta')
<meta name="description" content="Discover amazing travel stories, expert tips, and unforgettable experiences from around the world on the Kaya Travels Blog.">
<meta name="keywords" content="Travel Blog, Travel Tips, Safari Guides, Rwanda Tourism, Kigali Tours, Kaya Travels">
@endsection

@section('content')
<style>
  :root {
    --hero-height: 55vh;
  }

  /* Hero Section */
  .blog-hero {
    height: var(--hero-height);
    background-size: cover;
    background-position: center;
    background-attachment: fixed;
    position: relative;
    display: flex;
    align-items: center;
    overflow: hidden;
  }

  .blog-hero::before {
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

  .blog-hero .container {
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

  .hero-subtitle {
    font-size: 1.2rem;
    line-height: 1.6;
    opacity: 0.9;
  }

  /* Filter Section */
  .filter-section {
    background: white;
    padding: 2rem 0;
    border-bottom: 1px solid #eee;
  }

  .filter-form .form-select, .filter-form .form-control {
    border: 1px solid #e0e0e0;
    padding: 0.8rem 1.2rem;
    border-radius: 50px;
    font-size: 0.95rem;
    transition: var(--transition);
  }

  .filter-form .form-select:focus, .filter-form .form-control:focus {
    border-color: var(--primary-gold);
    box-shadow: 0 0 0 4px rgba(244, 208, 63, 0.1);
  }

  .filter-icon {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    color: #999;
  }

  /* Featured Post Carousel */
  .featured-section {
    padding: 5rem 0;
    background: var(--light-bg);
  }

  .section-title {
    font-size: 2.2rem;
    font-weight: 800;
    color: var(--charcoal);
    margin-bottom: 1rem;
  }

  .featured-card {
    border-radius: 24px;
    overflow: hidden;
    position: relative;
    box-shadow: 0 15px 35px rgba(0,0,0,0.06);
  }

  .featured-post-img {
    height: 480px;
    background-size: cover;
    background-position: center;
    position: relative;
    transition: transform 0.6s ease;
  }

  .featured-card:hover .featured-post-img {
    transform: scale(1.03);
  }

  .featured-overlay {
    position: absolute;
    inset: 0;
    background: linear-gradient(to top, rgba(0,0,0,0.85) 0%, rgba(0,0,0,0.2) 60%, rgba(0,0,0,0) 100%);
  }

  .featured-content {
    position: absolute;
    bottom: 0;
    left: 0;
    width: 100%;
    padding: 3rem;
    color: white;
  }

  .post-badge {
    background: var(--primary-gold);
    color: var(--charcoal);
    padding: 6px 16px;
    border-radius: 30px;
    font-size: 0.8rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 1px;
    display: inline-block;
    margin-bottom: 1rem;
  }

  /* Normal Blog Cards */
  .blog-grid-section {
    padding: 4rem 0 6rem;
    background: white;
  }

  .blog-card {
    background: white;
    border-radius: var(--card-border-radius);
    overflow: hidden;
    box-shadow: var(--shadow-soft);
    transition: var(--transition);
    height: 100%;
    display: flex;
    flex-direction: column;
    border: 1px solid #f5f5f5;
  }

  .blog-card:hover {
    transform: translateY(-8px);
    box-shadow: var(--shadow-hover);
  }

  .blog-img-wrap {
    height: 240px;
    overflow: hidden;
    position: relative;
  }

  .blog-img {
    width: 100%;
    height: 100%;
    background-size: cover;
    background-position: center;
    transition: transform 0.5s ease;
  }

  .blog-card:hover .blog-img {
    transform: scale(1.05);
  }

  .blog-body {
    padding: 2rem;
    flex-grow: 1;
    display: flex;
    flex-direction: column;
  }

  .blog-meta {
    display: flex;
    gap: 15px;
    font-size: 0.85rem;
    color: var(--charcoal-lighter);
    margin-bottom: 1rem;
    font-weight: 500;
  }

  .blog-title {
    font-size: 1.3rem;
    font-weight: 700;
    color: var(--charcoal);
    margin-bottom: 1rem;
    line-height: 1.4;
  }

  .blog-card:hover .blog-title {
    color: var(--primary-gold);
  }

  .blog-excerpt {
    color: var(--charcoal-lighter);
    font-size: 0.95rem;
    line-height: 1.6;
    margin-bottom: 1.5rem;
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
  }

  .blog-footer {
    margin-top: auto;
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding-top: 1.5rem;
    border-top: 1px solid #f0f0f0;
  }

  .read-more {
    color: var(--charcoal);
    font-weight: 700;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 6px;
    font-size: 0.9rem;
    transition: var(--transition);
  }

  .read-more:hover {
    color: var(--primary-gold);
    gap: 10px;
  }

  /* Newsletter Row */
  .newsletter-section {
    background: var(--charcoal);
    padding: 4rem 0;
    border-radius: 20px;
    margin: 4rem 0;
  }
</style>

<!-- Hero Section -->
<section class="blog-hero" style="background-image: url('{{ asset('images/about.jpeg') }}');">
  <div class="container">
    <div class="hero-content">
      <div class="hero-badge" data-aos="fade-up">
        <i class="bi bi-journal-text me-2"></i>Travel Stories
      </div>
      <h1 class="hero-title" data-aos="fade-up" data-aos-delay="200">Our Travel Blog</h1>
      <p class="hero-subtitle" data-aos="fade-up" data-aos-delay="400">Discover amazing travel stories, expert tips, and unforgettable experiences from around the world</p>
    </div>
  </div>
</section>

<!-- Filter Section -->
<section class="filter-section">
  <div class="container">
    <form method="GET" action="{{ route('blog.index') }}" class="filter-form">
      <div class="row g-3 justify-content-center">
        <div class="col-md-5">
          <div class="position-relative">
            <i class="bi bi-funnel filter-icon ms-3"></i>
            <select name="category" class="form-select ps-5" onchange="this.form.submit()">
              <option value="">All Categories</option>
              @foreach($categories as $cat)
                <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>
                  {{ $cat->name }}
                </option>
              @endforeach
            </select>
          </div>
        </div>
        <div class="col-md-5">
          <div class="position-relative">
            <i class="bi bi-search filter-icon ms-3"></i>
            <input type="text" class="form-control ps-5" placeholder="Search articles...">
          </div>
        </div>
      </div>
    </form>
  </div>
</section>

<!-- Featured Post Carousel -->
@if($featuredPosts->count())
<section class="featured-section">
  <div class="container">
    <div class="d-flex align-items-center mb-4 text-center justify-content-center">
      <h2 class="section-title"><i class="bi bi-star-fill text-warning me-2 fs-4"></i> Featured Stories</h2>
    </div>

    <div id="featuredCarousel" class="carousel slide" data-bs-ride="carousel" data-aos="fade-up">
      <div class="carousel-indicators" style="bottom: 20px;">
        @foreach($featuredPosts as $index => $post)
          <button type="button" data-bs-target="#featuredCarousel" data-bs-slide-to="{{ $index }}" 
                  class="{{ $index === 0 ? 'active' : '' }}" style="width: 10px; height: 10px; border-radius: 50%; opacity:0.8;"></button>
        @endforeach
      </div>
      
      <div class="carousel-inner featured-card">
        @foreach($featuredPosts as $index => $post)
          <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
            <div class="featured-post-img" style="background-image: url('{{ $post->thumbnail ? asset('storage/' . $post->thumbnail) : asset('images/about.jpeg') }}');">
              <div class="featured-overlay"></div>
              <div class="featured-content">
                <div class="row">
                  <div class="col-lg-8">
                    <span class="post-badge">Featured</span>
                    <h3 class="display-6 fw-bold mb-3">{{ $post->title }}</h3>
                    <p class="fs-5 text-white-50 mb-4 d-none d-md-block">{{ Str::limit($post->excerpt ?? strip_tags($post->content), 120) }}</p>
                    <div class="d-flex align-items-center gap-4">
                      <span class="text-white-50"><i class="bi bi-calendar3 me-2"></i>{{ optional($post->published_at)->format('M d, Y') }}</span>
                      <a href="{{ route('blog.show', $post->slug) }}" class="btn btn-light rounded-pill px-4 fw-bold">Read Article <i class="bi bi-arrow-right ms-2"></i></a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        @endforeach
      </div>
      
      <button class="carousel-control-prev" type="button" data-bs-target="#featuredCarousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true" style="filter: drop-shadow(0 2px 5px rgba(0,0,0,0.5));"></span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#featuredCarousel" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true" style="filter: drop-shadow(0 2px 5px rgba(0,0,0,0.5));"></span>
      </button>
    </div>
  </div>
</section>
@endif

<!-- Normal Blog Cards -->
<section class="blog-grid-section">
  <div class="container">
    @if(request('category'))
      <h3 class="mb-4">Showing results for category</h3>
    @endif

    <div class="row g-4">
      @forelse($posts as $post)
        <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
          <article class="blog-card">
            <div class="blog-img-wrap">
              <div class="blog-img" style="background-image: url('{{ $post->thumbnail ? asset('storage/' . $post->thumbnail) : asset('images/about.jpeg') }}');"></div>
              <div class="position-absolute top-0 end-0 p-3">
                <span class="badge bg-white text-dark px-3 py-2 rounded-pill shadow-sm fw-semibold">
                   {{ $post->category->name ?? 'Travel' }}
                </span>
              </div>
            </div>
            
            <div class="blog-body">
              <div class="blog-meta">
                <span><i class="bi bi-calendar3 me-1"></i> {{ optional($post->published_at)->format('M d, Y') }}</span>
                <span><i class="bi bi-clock me-1"></i> {{ rand(3, 8) }} min read</span>
              </div>
              
              <h4 class="blog-title">{{ Str::limit($post->title, 60) }}</h4>
              <p class="blog-excerpt">{{ Str::limit($post->excerpt ?? strip_tags($post->content), 120) }}</p>
              
              <div class="blog-footer">
                <div class="d-flex align-items-center">
                  <div class="rounded-circle bg-light d-flex align-items-center justify-content-center me-2" style="width:32px;height:32px;">
                    <i class="bi bi-person text-secondary"></i>
                  </div>
                  <span class="text-muted small fw-semibold">Kaya Travels</span>
                </div>
                <a href="{{ route('blog.show', $post->slug) }}" class="read-more">Read More <i class="bi bi-arrow-right"></i></a>
              </div>
            </div>
          </article>
        </div>
      @empty
        <div class="col-12 py-5 text-center">
          <div class="mb-4 text-muted"> <i class="bi bi-journal-x" style="font-size: 4rem;"></i> </div>
          <h4 class="fw-bold text-charcoal">No Stories Found</h4>
          <p class="text-muted mb-4">We couldn't find any articles matching your criteria. Try adjusting your search.</p>
          <a href="{{ route('blog.index') }}" class="btn btn-outline-dark rounded-pill px-4">View All Articles</a>
        </div>
      @endforelse
    </div>

    @if($posts->hasPages())
      <div class="mt-5 d-flex justify-content-center">
        {{ $posts->withQueryString()->links() }}
      </div>
    @endif
  </div>

  <!-- Newsletter Module -->
  <div class="container">
    <div class="newsletter-section shadow-lg" data-aos="fade-up">
      <div class="row justify-content-center">
        <div class="col-lg-8 text-center text-white p-4">
          <i class="bi bi-envelope-paper fs-1 text-warning mb-3 d-block"></i>
          <h3 class="fw-bold mb-3">Join Our Travel Community</h3>
          <p class="mb-4 text-white-50">Get the latest travel tips, destination guides, and exclusive deals delivered straight to your inbox.</p>
          
          <div class="d-flex gap-3 justify-content-center max-w-lg mx-auto">
            <input type="email" class="form-control form-control-lg rounded-pill border-0 px-4" style="max-width: 350px;" placeholder="Your email address">
            <button class="btn btn-warning btn-lg rounded-pill px-4 fw-bold">Subscribe</button>
          </div>
          <small class="text-white-50 d-block mt-3">We respect your privacy. No spam.</small>
        </div>
      </div>
    </div>
  </div>
</section>

@endsection