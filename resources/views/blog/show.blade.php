@extends('layouts.public')

@section('title', $post->title . ' | Kaya Travels')

@section('meta')
<meta name="description" content="{{ Str::limit($post->excerpt ?? strip_tags($post->content), 160) }}">
<meta property="og:title" content="{{ $post->title }}" />
<meta property="og:description" content="{{ Str::limit($post->excerpt ?? strip_tags($post->content), 160) }}" />
<meta property="og:image" content="{{ asset('storage/' . $post->thumbnail) }}" />
@endsection

@section('content')
<style>
  :root {
    --hero-height: 60vh;
  }

  /* Post Hero Section */
  .post-hero {
    height: var(--hero-height);
    background-size: cover;
    background-position: center;
    background-attachment: fixed;
    position: relative;
    display: flex;
    align-items: center;
    overflow: hidden;
  }

  .post-hero::before {
    content: '';
    position: absolute;
    inset: 0;
    background: linear-gradient(
      to bottom,
      rgba(44, 62, 80, 0.4) 0%,
      rgba(44, 62, 80, 0.7) 60%,
      rgba(26, 37, 47, 0.95) 100%
    );
    z-index: 1;
  }

  .post-hero .container {
    position: relative;
    z-index: 2;
    padding-top: 5rem;
  }

  .post-badge {
    display: inline-flex;
    align-items: center;
    background: rgba(244, 208, 63, 0.85);
    backdrop-filter: blur(10px);
    padding: 8px 20px;
    border-radius: 50px;
    font-size: 0.85rem;
    font-weight: 700;
    color: var(--charcoal);
    text-transform: uppercase;
    letter-spacing: 1px;
    margin-bottom: 1.5rem;
  }

  .post-title {
    font-size: 3.5rem;
    font-weight: 800;
    line-height: 1.2;
    margin-bottom: 1.5rem;
    color: #fff;
    text-shadow: 0 4px 12px rgba(0,0,0,0.3);
  }

  .post-meta {
    display: flex;
    align-items: center;
    gap: 20px;
    color: rgba(255,255,255,0.9);
    font-size: 1rem;
    font-weight: 500;
    flex-wrap: wrap;
  }

  .meta-item {
    display: flex;
    align-items: center;
    gap: 8px;
  }

  .meta-item i {
    color: var(--primary-gold);
  }

  .author-avatar {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background: var(--primary-gold);
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--charcoal);
    font-weight: bold;
    font-size: 1.2rem;
  }

  /* Article Content */
  .article-section {
    padding: 5rem 0;
    background: white;
  }

  .content-wrapper {
    font-size: 1.15rem;
    line-height: 1.8;
    color: var(--charcoal);
  }

  .content-wrapper h2, .content-wrapper h3, .content-wrapper h4 {
    color: var(--charcoal);
    font-weight: 800;
    margin: 2.5rem 0 1rem;
  }

  .content-wrapper p {
    margin-bottom: 1.5rem;
  }

  .content-wrapper img {
    max-width: 100%;
    height: auto;
    border-radius: 16px;
    margin: 2rem 0;
    box-shadow: 0 10px 30px rgba(0,0,0,0.1);
  }

  .content-wrapper blockquote {
    font-size: 1.3rem;
    font-style: italic;
    font-weight: 600;
    color: var(--charcoal);
    border-left: 4px solid var(--primary-gold);
    padding: 1.5rem 2rem;
    background: #fafafa;
    border-radius: 0 12px 12px 0;
    margin: 2.5rem 0;
  }

  /* Share & Tags Row */
  .share-row {
    padding: 2rem 0;
    border-top: 1px solid #eee;
    border-bottom: 1px solid #eee;
    margin: 4rem 0 2rem;
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 15px;
  }

  .social-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 42px;
    height: 42px;
    border-radius: 50%;
    background: #f8f9fa;
    color: var(--charcoal);
    text-decoration: none;
    transition: all 0.2s ease;
    border: 1px solid #eaeaea;
  }

  .social-btn:hover {
    background: var(--primary-gold);
    color: var(--charcoal);
    border-color: var(--primary-gold);
    transform: translateY(-3px);
  }

  /* Sidebar */
  .sidebar-widget {
    background: #fff;
    border: 1px solid #eee;
    border-radius: 20px;
    padding: 2rem;
    margin-bottom: 2rem;
    box-shadow: 0 10px 30px rgba(0,0,0,0.03);
  }

  .widget-title {
    font-size: 1.2rem;
    font-weight: 800;
    margin-bottom: 1.5rem;
    display: flex;
    align-items: center;
    gap: 10px;
  }

  .widget-title i {
    color: var(--primary-gold);
  }

  .sidebar-link {
    color: var(--charcoal-lighter);
    text-decoration: none;
    display: block;
    padding: 0.8rem 0;
    border-bottom: 1px solid #f5f5f5;
    transition: var(--transition);
  }

  .sidebar-link:last-child {
    border-bottom: none;
    padding-bottom: 0;
  }

  .sidebar-link:hover {
    color: var(--primary-gold);
    padding-left: 8px;
  }

  /* Related Posts */
  .related-section {
    background: var(--light-bg);
    padding: 5rem 0;
  }

  .related-card {
    background: white;
    border-radius: 16px;
    overflow: hidden;
    box-shadow: 0 5px 20px rgba(0,0,0,0.05);
    height: 100%;
    display: flex;
    flex-direction: column;
    text-decoration: none;
    color: var(--charcoal);
    transition: var(--transition);
  }

  .related-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 35px rgba(0,0,0,0.1);
    color: var(--charcoal);
  }

  .related-img {
    height: 200px;
    background-size: cover;
    background-position: center;
  }

  .related-body {
    padding: 1.5rem;
    flex-grow: 1;
  }

  .related-title {
    font-weight: 700;
    font-size: 1.1rem;
    margin-bottom: 0.5rem;
    line-height: 1.4;
  }

  .related-meta {
    font-size: 0.85rem;
    color: #999;
  }

  /* Responsive Adjustments */
  @media (max-width: 768px) {
    .post-title { font-size: 2.2rem; }
    .content-wrapper { font-size: 1.05rem; }
    .post-hero { height: 50vh; }
    .share-row { justify-content: center; text-align: center; }
  }
</style>

<!-- Hero Section -->
<section class="post-hero" style="background-image: url('{{ $post->thumbnail ? asset('storage/' . $post->thumbnail) : asset('images/about.jpeg') }}');">
  <div class="container text-center text-md-start">
    <div class="row">
      <div class="col-lg-9">
        <div data-aos="fade-up">
          <div class="post-badge">
            <i class="bi bi-tag-fill me-2"></i> {{ $post->category->name ?? 'Travel Article' }}
          </div>
          <h1 class="post-title">{{ $post->title }}</h1>
          
          <div class="post-meta justify-content-center justify-content-md-start">
            <div class="meta-item">
              <div class="author-avatar"><i class="bi bi-person-fill text-dark"></i></div>
              <span class="ms-1">Kaya Travels</span>
            </div>
            <div class="meta-item">
              <i class="bi bi-calendar3"></i>
              <span>{{ optional($post->published_at)->format('M d, Y') }}</span>
            </div>
            <div class="meta-item">
              <i class="bi bi-clock-history"></i>
              <span>{{ rand(4, 10) }} min read</span>
            </div>
            <div class="meta-item">
              <i class="bi bi-eye"></i>
              <span>{{ rand(300, 1500) }} views</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Content Outline -->
<section class="article-section">
  <div class="container">
    <div class="row gx-lg-5">
      <!-- Main Content -->
      <div class="col-lg-8 mb-5 mb-lg-0">
        
        <!-- Optional Video Section -->
        @php
        function extractYoutubeId($url) {
            preg_match('/(?:youtu\.be\/|v=|\/embed\/|watch\?v=)([^\?&]+)/', $url, $matches);
            return $matches[1] ?? null;
        }
        $youtubeId = extractYoutubeId($post->video_url);
        @endphp
        
        @if($youtubeId)
          <div class="mb-5 ratio ratio-16x9 rounded-4 overflow-hidden shadow-sm" data-aos="fade-up">
            <iframe src="https://www.youtube.com/embed/{{ $youtubeId }}" frameborder="0" allowfullscreen></iframe>
          </div>
        @endif

        <!-- Article Text -->
        <article class="content-wrapper" data-aos="fade-up" data-aos-delay="100">
          {!! $post->content !!}
        </article>

        <!-- Dynamic Share Row -->
        <div class="share-row" data-aos="fade-up">
          <div class="d-flex align-items-center gap-2">
            <strong>Share this article:</strong>
            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}" target="_blank" class="social-btn" title="Facebook"><i class="bi bi-facebook"></i></a>
            <a href="https://twitter.com/intent/tweet?text={{ urlencode($post->title) }}&url={{ urlencode(url()->current()) }}" target="_blank" class="social-btn" title="Twitter"><i class="bi bi-twitter"></i></a>
            <a href="https://www.linkedin.com/shareArticle?mini=true&url={{ urlencode(url()->current()) }}&title={{ urlencode($post->title) }}" target="_blank" class="social-btn" title="LinkedIn"><i class="bi bi-linkedin"></i></a>
            <a href="https://api.whatsapp.com/send?text={{ urlencode($post->title . ' ' . url()->current()) }}" target="_blank" class="social-btn" title="WhatsApp"><i class="bi bi-whatsapp"></i></a>
            <button onclick="navigator.clipboard.writeText(window.location.href); alert('Link copied!');" class="social-btn border-0" title="Copy Link"><i class="bi bi-link-45deg fs-4"></i></button>
          </div>

          <div class="d-flex align-items-center gap-3">
            <button class="btn btn-outline-dark rounded-pill px-4 d-flex align-items-center gap-2" onclick="this.classList.toggle('bg-dark'); this.classList.toggle('text-white');">
              <i class="bi bi-heart"></i> Like
            </button>
          </div>
        </div>

        <!-- Back Nav -->
        <div class="d-flex justify-content-between">
          <a href="{{ route('blog.index') }}" class="btn btn-light border rounded-pill px-4 fw-bold">
            <i class="bi bi-arrow-left me-2"></i> Back to Blog
          </a>
          <button onclick="window.scrollTo({top:0, behavior:'smooth'})" class="btn btn-light border rounded-pill px-4 fw-bold">
            Top <i class="bi bi-arrow-up ms-2"></i>
          </button>
        </div>
      </div>

      <!-- Right Sidebar -->
      <div class="col-lg-4">
        <div class="sticky-top" style="top: 2rem;">
          
          <!-- Newsletter Widget -->
          <div class="sidebar-widget" data-aos="fade-left">
            <div class="text-center mb-4">
              <div class="d-inline-flex bg-light rounded-circle p-3 mb-3">
                <i class="bi bi-envelope-paper fs-2 text-warning"></i>
              </div>
              <h4 class="fw-bold fs-5">Never Miss a Story</h4>
              <p class="text-muted small">Get our latest travel guides delivered right to your inbox.</p>
            </div>
            <form>
              <input type="email" class="form-control rounded-pill px-4 mb-3 text-center" placeholder="Your Email Address">
              <button class="btn btn-warning w-100 rounded-pill fw-bold">Subscribe</button>
            </form>
          </div>

          <!-- Categories Widget -->
          <div class="sidebar-widget" data-aos="fade-left" data-aos-delay="100">
            <h4 class="widget-title"><i class="bi bi-bookmarks"></i> Categories</h4>
            <div class="mt-3">
              @foreach(\App\Models\Category::withCount('posts')->get() as $cat)
                <a href="{{ route('blog.index', ['category' => $cat->id]) }}" class="sidebar-link d-flex justify-content-between align-items-center">
                  {{ $cat->name }} 
                  <span class="badge bg-light text-dark rounded-pill border">{{ $cat->posts_count }}</span>
                </a>
              @endforeach
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>
</section>

<!-- Related Posts Section -->
@php
$related = \App\Models\Post::where('status', 'published')
            ->where('id', '!=', $post->id)
            ->where('category_id', $post->category_id)
            ->latest('published_at')
            ->take(3)
            ->get();

if ($related->isEmpty()) {
   $related = \App\Models\Post::where('status', 'published')
               ->where('id', '!=', $post->id)
               ->latest('published_at')
               ->take(3)
               ->get();
}
@endphp

@if ($related->count())
<section class="related-section">
  <div class="container">
    <div class="d-flex align-items-center mb-4 text-center justify-content-center" data-aos="fade-up">
      <h2 class="fs-2 fw-bold text-charcoal"><i class="bi bi-journals text-warning me-2"></i> Related Stories</h2>
    </div>

    <div class="row g-4 justify-content-center">
      @foreach($related as $item)
        <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
          <a href="{{ route('blog.show', $item->slug) }}" class="related-card">
            <div class="related-img" style="background-image: url('{{ $item->thumbnail ? asset('storage/' . $item->thumbnail) : asset('images/about.jpeg') }}');"></div>
            <div class="related-body">
              <div class="related-meta mb-2">
                <i class="bi bi-calendar3 me-1"></i> {{ optional($item->published_at)->format('M d, Y') }}
                &nbsp;•&nbsp; {{ $item->category->name ?? 'Discover' }}
              </div>
              <h4 class="related-title">{{ Str::limit($item->title, 60) }}</h4>
            </div>
          </a>
        </div>
      @endforeach
    </div>
  </div>
</section>
@endif

@endsection