@extends('layouts.public')

@section('title', $category->name)

@section('content')
<!-- Enhanced Category Hero Section -->
<section class="position-relative overflow-hidden d-flex align-items-center text-white text-center" 
         style="background: linear-gradient(135deg, rgba(0,0,0,0.7), rgba(102,126,234,0.8)), url('{{ asset('images/about.jpeg') }}'); 
                height: 55vh; background-size: cover; background-position: center; background-attachment: fixed;">
    
    <!-- Animated Background Elements -->
    <div class="position-absolute top-0 start-0 w-100 h-100 opacity-10">
        <div class="floating-element" style="position: absolute; top: 20%; left: 15%; animation: float 18s infinite ease-in-out;">
            <i class="ph ph-folder-open" style="font-size: 3rem; color: white;"></i>
        </div>
        <div class="floating-element" style="position: absolute; top: 60%; right: 20%; animation: float 22s infinite ease-in-out reverse;">
            <i class="ph ph-articles" style="font-size: 2rem; color: white;"></i>
        </div>
        <div class="floating-element" style="position: absolute; top: 40%; left: 75%; animation: float 20s infinite ease-in-out;">
            <i class="ph ph-tag" style="font-size: 2.5rem; color: white;"></i>
        </div>
    </div>

    <div class="container position-relative z-3">
        <div class="hero-content" style="animation: slideUp 0.8s ease-out;">
            <!-- Breadcrumb -->
            <nav aria-label="breadcrumb" class="mb-4" data-aos="fade-down">
                <ol class="breadcrumb justify-content-center bg-transparent">
                    <li class="breadcrumb-item">
                        <a href="{{ route('blog.index') }}" class="text-white-50 text-decoration-none">
                            <i class="ph ph-house me-1"></i>Blog
                        </a>
                    </li>
                    <li class="breadcrumb-item active text-white" aria-current="page">{{ $category->name }}</li>
                </ol>
            </nav>

            <!-- Category Icon & Title -->
            <div class="mb-4">
                <div class="bg-gradient rounded-circle p-4 d-inline-flex mb-3" 
                     style="background: linear-gradient(45deg, #f1c40f, #f39c12); animation: bounce 2s infinite;">
                    <i class="ph ph-folder-open text-white" style="font-size: 3rem;"></i>
                </div>
                <h1 class="display-4 fw-bold mb-3" 
                    style="background: linear-gradient(45deg, #f1c40f, #f39c12); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">
                    {{ $category->name }}
                </h1>
                <p class="lead mb-4" style="font-size: 1.2rem; opacity: 0.9;">
                    @if($category->description)
                        {{ $category->description }}
                    @else
                        Explore our collection of {{ strtolower($category->name) }} stories and experiences
                    @endif
                </p>
            </div>

            <!-- Category Stats -->
            <div class="d-flex justify-content-center gap-4 flex-wrap">
                <div class="bg-white bg-opacity-20 rounded-pill px-4 py-2">
                    <i class="ph ph-articles me-2"></i>
                    <span class="fw-semibold">{{ $posts->total() ?? 0 }} Stories</span>
                </div>
                <div class="bg-white bg-opacity-20 rounded-pill px-4 py-2">
                    <i class="ph ph-eye me-2"></i>
                    <span class="fw-semibold">{{ rand(1000, 10000) }} Views</span>
                </div>
                <div class="bg-white bg-opacity-20 rounded-pill px-4 py-2">
                    <i class="ph ph-heart me-2"></i>
                    <span class="fw-semibold">{{ rand(100, 1000) }} Likes</span>
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
</section>

<!-- Enhanced Filter & Sort Section -->
<section class="py-4" style="background: linear-gradient(135deg, #2d2d2d 0%, #1a1a1a 100%);">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="d-flex align-items-center">
                    <div class="bg-gradient rounded-circle p-2 me-3" style="background: linear-gradient(45deg, #667eea, #764ba2);">
                        <i class="ph ph-list text-white"></i>
                    </div>
                    <div>
                        <h4 class="text-white fw-bold mb-0">{{ $category->name }} Stories</h4>
                        <small class="text-white-50">
                            @if($posts->total() > 0)
                                Showing {{ $posts->firstItem() }}-{{ $posts->lastItem() }} of {{ $posts->total() }} articles
                            @else
                                No articles found
                            @endif
                        </small>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="row g-3">
                    <div class="col-md-6">
                        <div class="position-relative">
                            <select class="form-select bg-dark text-white border-secondary rounded-3 ps-4" 
                                    style="transition: all 0.3s ease;">
                                <option value="">Sort by Date</option>
                                <option value="newest">Newest First</option>
                                <option value="oldest">Oldest First</option>
                                <option value="popular">Most Popular</option>
                            </select>
                            <i class="ph ph-sort-ascending position-absolute top-50 start-0 translate-middle-y ms-2 text-muted"></i>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="position-relative">
                            <input type="text" class="form-control bg-dark text-white border-secondary rounded-3 ps-4" 
                                   placeholder="Search in {{ $category->name }}..." 
                                   style="transition: all 0.3s ease;">
                            <i class="ph ph-magnifying-glass position-absolute top-50 start-0 translate-middle-y ms-2 text-muted"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Enhanced Posts Grid Section -->
<section class="py-5" style="background: linear-gradient(135deg, #1a1a1a 0%, #2d2d2d 100%);">
    <div class="container">
        @if($posts->count() > 0)
            <div class="row g-4">
                @foreach ($posts as $post)
                    <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                        <article class="blog-card h-100 rounded-4 overflow-hidden shadow-lg" 
                                 style="background: rgba(255,255,255,0.05); backdrop-filter: blur(10px); 
                                        border: 1px solid rgba(255,255,255,0.1); transition: all 0.3s ease;">
                            <div class="position-relative overflow-hidden">
                                <div class="blog-img" 
                                     style="background-image: url('{{ asset('storage/' . $post->thumbnail) }}'); 
                                            height: 240px; background-size: cover; background-position: center; 
                                            transition: transform 0.3s ease;"></div>
                                
                                <!-- Image Overlay with Category Badge -->
                                <div class="position-absolute top-0 start-0 w-100 h-100" 
                                     style="background: linear-gradient(135deg, transparent 50%, rgba(0,0,0,0.3) 100%);"></div>
                                
                                <div class="position-absolute top-0 end-0 p-3">
                                    <span class="badge bg-warning text-dark px-3 py-2 rounded-pill fw-semibold">
                                        <i class="ph ph-tag me-1"></i>{{ $category->name }}
                                    </span>
                                </div>
                                
                                <!-- Engagement Stats Overlay -->
                                <div class="position-absolute bottom-0 start-0 p-3">
                                    <div class="d-flex gap-2">
                                        <span class="badge bg-white bg-opacity-20 text-white px-2 py-1 rounded-pill small">
                                            <i class="ph ph-eye me-1"></i>{{ rand(50, 500) }}
                                        </span>
                                        <span class="badge bg-white bg-opacity-20 text-white px-2 py-1 rounded-pill small">
                                            <i class="ph ph-heart me-1"></i>{{ rand(10, 100) }}
                                        </span>
                                        <span class="badge bg-white bg-opacity-20 text-white px-2 py-1 rounded-pill small">
                                            <i class="ph ph-clock me-1"></i>{{ rand(3, 8) }}m
                                        </span>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="blog-body p-4 d-flex flex-column">
                                <div class="mb-3">
                                    <div class="d-flex align-items-center gap-3 mb-2">
                                        <small class="text-muted d-flex align-items-center">
                                            <i class="ph ph-calendar me-1"></i>
                                            {{ optional($post->published_at)->format('M d, Y') }}
                                        </small>
                                        <small class="text-muted d-flex align-items-center">
                                            <i class="ph ph-user me-1"></i>
                                            Kaya Travels
                                        </small>
                                    </div>
                                    <h5 class="text-white fw-bold mb-2" style="line-height: 1.3;">{{ $post->title }}</h5>
                                    <p class="text-white-50 small mb-0">
                                        {{ Str::limit($post->excerpt ?? strip_tags($post->content), 120) }}
                                    </p>
                                </div>
                                
                                <div class="mt-auto">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div class="d-flex align-items-center">
                                            <div class="bg-gradient rounded-circle p-2 me-2" style="background: linear-gradient(45deg, #667eea, #764ba2);">
                                                <i class="ph ph-article text-white small"></i>
                                            </div>
                                            <small class="text-white-50">Featured Story</small>
                                        </div>
                                        <a href="{{ route('blog.show', $post->slug) }}" 
                                           class="btn btn-outline-light btn-sm rounded-pill px-3"
                                           style="transition: all 0.3s ease;">
                                            <i class="ph ph-arrow-right me-1"></i>Read More
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </article>
                    </div>
                @endforeach
            </div>

            <!-- Enhanced Pagination -->
            @if($posts->hasPages())
                <div class="mt-5 d-flex justify-content-center">
                    <div class="pagination-wrapper">
                        {{ $posts->links() }}
                    </div>
                </div>
            @endif

        @else
            <!-- Enhanced Empty State -->
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="text-center py-5">
                        <div class="mb-4">
                            <div class="bg-gradient rounded-circle p-4 d-inline-flex" 
                                 style="background: linear-gradient(45deg, #667eea, #764ba2);">
                                <i class="ph ph-folder-open text-white" style="font-size: 4rem;"></i>
                            </div>
                        </div>
                        <h4 class="text-white fw-bold mb-3">No Stories in {{ $category->name }} Yet</h4>
                        <p class="text-white-50 mb-4 fs-5">
                            We're working on adding amazing stories to this category. In the meantime, 
                            explore our other categories or check back soon for updates!
                        </p>
                        <div class="d-flex justify-content-center gap-3 flex-wrap">
                            <a href="{{ route('blog.index') }}" 
                               class="btn btn-outline-light btn-lg rounded-pill px-4"
                               style="transition: all 0.3s ease;">
                                <i class="ph ph-arrow-left me-2"></i>Browse All Stories
                            </a>
                            <button class="btn btn-primary btn-lg rounded-pill px-4" 
                                    style="background: linear-gradient(45deg, #667eea, #764ba2); border: none;">
                                <i class="ph ph-bell me-2"></i>Notify Me
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
</section>

<!-- Related Categories Section -->
@php
$relatedCategories = \App\Models\Category::where('id', '!=', $category->id)
                    ->withCount('posts')
                    ->having('posts_count', '>', 0)
                    ->take(4)
                    ->get();
@endphp

@if($relatedCategories->count() > 0)
<section class="py-5" style="background: linear-gradient(135deg, #2d2d2d 0%, #1a1a1a 100%);">
    <div class="container">
        <div class="text-center mb-5" data-aos="fade-up">
            <div class="d-flex justify-content-center align-items-center mb-3">
                <div class="bg-gradient rounded-circle p-3 me-3" style="background: linear-gradient(45deg, #f1c40f, #f39c12);">
                    <i class="ph ph-folders text-white fs-4"></i>
                </div>
                <div>
                    <h3 class="text-white fw-bold mb-0">Explore Other Categories</h3>
                    <small class="text-white-50">Discover more amazing stories</small>
                </div>
            </div>
        </div>

        <div class="row g-4">
            @foreach($relatedCategories as $relatedCategory)
                <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                    <a href="{{ route('blog.category', $relatedCategory->slug) }}" 
                       class="text-decoration-none">
                        <div class="category-card p-4 rounded-4 text-center h-100" 
                             style="background: rgba(255,255,255,0.05); backdrop-filter: blur(10px); 
                                    border: 1px solid rgba(255,255,255,0.1); transition: all 0.3s ease;">
                            <div class="mb-3">
                                <div class="bg-gradient rounded-circle p-3 d-inline-flex" 
                                     style="background: linear-gradient(45deg, #667eea, #764ba2);">
                                    <i class="ph ph-folder text-white fs-3"></i>
                                </div>
                            </div>
                            <h6 class="text-white fw-bold mb-2">{{ $relatedCategory->name }}</h6>
                            <p class="text-white-50 small mb-3">
                                {{ $relatedCategory->posts_count }} 
                                {{ Str::plural('story', $relatedCategory->posts_count) }}
                            </p>
                            <span class="btn btn-outline-light btn-sm rounded-pill">
                                Explore <i class="ph ph-arrow-right ms-1"></i>
                            </span>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif

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
    
    .blog-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 40px rgba(0,0,0,0.3) !important;
        border-color: rgba(255,255,255,0.2) !important;
    }
    
    .blog-card:hover .blog-img {
        transform: scale(1.05);
    }
    
    .category-card:hover {
        transform: translateY(-5px);
        background: rgba(255,255,255,0.1) !important;
        border-color: rgba(255,255,255,0.2) !important;
    }
    
    .scroll-indicator:hover {
        transform: scale(1.2);
        color: #f1c40f !important;
    }
    
    .form-control:focus, .form-select:focus {
        border-color: #667eea;
        box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
        transform: translateY(-2px);
    }
    
    .btn:hover {
        transform: translateY(-2px);
    }
    
    .breadcrumb-item + .breadcrumb-item::before {
        content: "→";
        color: rgba(255,255,255,0.5);
    }
    
    .pagination-wrapper .page-link {
        border-radius: 10px !important;
        margin: 0 3px;
        border: none;
        background: rgba(255,255,255,0.1);
        color: white;
        transition: all 0.3s ease;
    }
    
    .pagination-wrapper .page-link:hover {
        background: rgba(255,255,255,0.2);
        transform: translateY(-2px);
    }
    
    .pagination-wrapper .page-item.active .page-link {
        background: linear-gradient(45deg, #667eea, #764ba2);
        color: white;
    }
    
    .badge {
        transition: all 0.3s ease;
    }
    
    .badge:hover {
        transform: scale(1.05);
    }
</style>

<!-- Load Phosphor Icons -->
<script src="https://unpkg.com/@phosphor-icons/web"></script>

<!-- Enhanced JavaScript -->
<script>
    // Smooth scroll for scroll indicator
    document.querySelector('.scroll-indicator')?.addEventListener('click', function() {
        document.querySelector('section:nth-child(2)').scrollIntoView({ behavior: 'smooth' });
    });
    
    // Search functionality
    const searchInput = document.querySelector('input[type="text"]');
    if (searchInput) {
        searchInput.addEventListener('input', function() {
            // Add search functionality here
            console.log('Searching for:', this.value);
        });
    }
    
    // Sort functionality
    const sortSelect = document.querySelector('select');
    if (sortSelect) {
        sortSelect.addEventListener('change', function() {
            // Add sort functionality here
            console.log('Sorting by:', this.value);
        });
    }
</script>

@endsection

<!-- Enhanced AOS Scroll Animation -->
@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 800,
            easing: 'ease-out-cubic',
            once: true
        });
    </script>
@endpush