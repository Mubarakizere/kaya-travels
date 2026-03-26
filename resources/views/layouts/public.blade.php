<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  {{-- Dynamic Meta Tags --}}
  @yield('meta')

<title>@yield('title', 'Kaya Travels')</title>

<!-- Favicon and App Icons -->
<link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon-16x16.png') }}">
<link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32x32.png') }}">
<link rel="apple-touch-icon" sizes="180x180" href="{{ asset('apple-touch-icon.png') }}">
<link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
<link rel="manifest" href="{{ asset('site.webmanifest') }}">

<!-- SEO Meta Tags -->
<meta name="description" content="Kaya Travels & Tours – Explore Rwanda and beyond with premium travel experiences. Book your next adventure today.">
<meta name="keywords" content="Kaya Travels, Rwanda Travel, Tours, Safari, Holiday Packages, Africa Travel">
<meta name="author" content="Kaya Travels & Tours">

<!-- Open Graph / Facebook -->
<meta property="og:title" content="Kaya Travels – Discover Your Next Adventure">
<meta property="og:description" content="Explore Rwanda and the world with Kaya Travels. Luxury trips and unforgettable tours.">
<meta property="og:image" content="{{ asset('cover.png') }}">
<meta property="og:url" content="{{ url()->current() }}">
<meta property="og:type" content="website">

<!-- Twitter Card -->
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="Kaya Travels – Discover Your Next Adventure">
<meta name="twitter:description" content="Explore Rwanda and the world with Kaya Travels. Luxury trips and unforgettable tours.">
<meta name="twitter:image" content="{{ asset('cover.png') }}">

<!-- Fonts -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

<!-- Styles -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" media="print" onload="this.media='all'">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css" media="print" onload="this.media='all'">
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet" media="print" onload="this.media='all'">

@stack('styles')

<style>
  /* Modern CSS Variables */
  :root {
    --primary-gold: #f4d03f;
    --gold-dark: #d4af37;
    --gold-light: #f7dc6f;
    --gold-glow: rgba(244, 208, 63, 0.3);
    
    --charcoal: #2c3e50;
    --charcoal-light: #34495e;
    --charcoal-lighter: #566573;
    --charcoal-soft: #7f8c8d;
    
    --light-bg: #f8f9fa;
    --white: #ffffff;
    --white-soft: rgba(255, 255, 255, 0.95);
    --white-muted: rgba(255, 255, 255, 0.8);
    
    --shadow-soft: 0 5px 25px rgba(0,0,0,0.08);
    --shadow-medium: 0 8px 30px rgba(0,0,0,0.12);
    --shadow-hover: 0 15px 40px rgba(0,0,0,0.15);
    --shadow-gold: 0 4px 20px var(--gold-glow);
    
    --border-radius: 16px;
    --border-radius-small: 8px;
    --border-radius-large: 24px;
    
    --transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
    --transition-fast: all 0.2s ease-out;
  }

  /* Reset and Base Styles */
  * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
  }

  body {
    font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
    color: var(--charcoal);
    line-height: 1.6;
    scroll-behavior: smooth;
    min-height: 100vh;
  }

  /* Enhanced Navbar */
  .navbar {
    background: rgba(255, 255, 255, 0.95) !important;
    backdrop-filter: blur(20px);
    -webkit-backdrop-filter: blur(20px);
    box-shadow: var(--shadow-soft);
    padding: 1rem 0;
    transition: var(--transition);
    border-bottom: 1px solid rgba(244, 208, 63, 0.1);
  }

  .navbar.scrolled {
    background: rgba(255, 255, 255, 0.98) !important;
    box-shadow: var(--shadow-medium);
  }

  .navbar-brand {
    font-weight: 700;
    transition: var(--transition);
  }

  .navbar-brand img {
    height: 60px;
    max-height: 100%;
    object-fit: contain;
    transition: var(--transition);
    filter: drop-shadow(0 2px 8px rgba(0, 0, 0, 0.1));
  }

  .navbar-brand img:hover {
    transform: scale(1.05);
    filter: drop-shadow(0 4px 12px var(--gold-glow));
  }

  .navbar-nav {
    display: flex;
    flex-wrap: nowrap;
    white-space: nowrap;
  }

  .navbar-nav .nav-link {
    color: var(--charcoal) !important;
    font-weight: 500;
    margin: 0 15px;
    padding: 12px 0 !important;
    position: relative;
    transition: var(--transition);
    text-transform: capitalize;
    font-size: 0.95rem;
    letter-spacing: 0.3px;
  }

  .navbar-nav .nav-link::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 50%;
    width: 0;
    height: 3px;
    background: linear-gradient(90deg, var(--primary-gold), var(--gold-dark));
    transition: var(--transition);
    border-radius: 2px;
    transform: translateX(-50%);
  }

  .navbar-nav .nav-link:hover::after,
  .navbar-nav .nav-link.active::after {
    width: 100%;
  }

  .navbar-nav .nav-link:hover,
  .navbar-nav .nav-link.active {
    color: var(--primary-gold) !important;
  }

  /* Modern Button Styles */
  .btn-gold {
    background: linear-gradient(135deg, var(--primary-gold), var(--gold-dark));
    color: var(--charcoal);
    border: none;
    padding: 12px 30px;
    border-radius: 50px;
    font-weight: 600;
    font-size: 0.95rem;
    letter-spacing: 0.3px;
    text-decoration: none;
    transition: var(--transition);
    box-shadow: var(--shadow-gold);
    position: relative;
    overflow: hidden;
    display: inline-flex;
    align-items: center;
    gap: 8px;
  }

  .btn-gold::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
    transition: var(--transition);
  }

  .btn-gold:hover::before {
    left: 100%;
  }

  .btn-gold:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 30px rgba(244, 208, 63, 0.4);
    color: var(--charcoal);
  }

  .text-gold {
    color: var(--primary-gold) !important;
  }

  /* Dropdown Styles */
  .dropdown-menu {
    background: rgba(44, 62, 80, 0.95) !important;
    backdrop-filter: blur(15px);
    border: 1px solid rgba(244, 208, 63, 0.2) !important;
    border-radius: var(--border-radius) !important;
    box-shadow: var(--shadow-hover) !important;
    padding: 0.5rem 0;
  }

  .dropdown-item {
    color: rgba(255, 255, 255, 0.9) !important;
    padding: 10px 20px;
    transition: var(--transition);
    border-radius: 0;
  }

  .dropdown-item:hover {
    background: rgba(244, 208, 63, 0.1) !important;
    color: var(--primary-gold) !important;
  }

  /* Enhanced Footer */
  .footer-section {
    background: linear-gradient(135deg, var(--charcoal) 0%, var(--charcoal-light) 100%);
    color: white;
    position: relative;
    overflow: hidden;
  }

  .footer-section::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="dots" width="20" height="20" patternUnits="userSpaceOnUse"><circle cx="10" cy="10" r="1" fill="%23f4d03f" opacity="0.1"/></pattern></defs><rect width="100" height="100" fill="url(%23dots)"/></svg>');
    opacity: 0.3;
  }

  .footer-section .container {
    position: relative;
    z-index: 2;
  }

  .footer-section h4 {
    font-weight: 700;
    background: linear-gradient(135deg, var(--primary-gold), var(--gold-light));
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    margin-bottom: 1rem;
  }

  .footer-section h6 {
    font-weight: 600;
    color: var(--primary-gold);
    margin-bottom: 1.5rem;
    position: relative;
  }

  .footer-section h6::after {
    content: '';
    position: absolute;
    bottom: -5px;
    left: 0;
    width: 30px;
    height: 2px;
    background: var(--primary-gold);
    border-radius: 1px;
  }

  .footer-section a {
    color: rgba(255, 255, 255, 0.8);
    text-decoration: none;
    display: block;
    margin-bottom: 0.8rem;
    transition: var(--transition);
    position: relative;
    padding-left: 0;
  }

  .footer-section a:hover {
    color: var(--primary-gold);
    transform: translateX(5px);
    padding-left: 10px;
  }

  .footer-section a:hover::before {
    content: '→';
    position: absolute;
    left: 0;
    color: var(--primary-gold);
  }

  /* Social Icons */
  .social-icons {
    display: flex;
    gap: 15px;
    margin-top: 1.5rem;
  }

  .social-icons a {
    width: 45px;
    height: 45px;
    background: rgba(244, 208, 63, 0.1);
    border: 2px solid rgba(244, 208, 63, 0.3);
    border-radius: 50%;
    display: flex !important;
    align-items: center;
    justify-content: center;
    color: var(--primary-gold) !important;
    font-size: 1.2rem;
    transition: var(--transition);
    margin-bottom: 0 !important;
    transform: none !important;
    padding: 0 !important;
  }

  .social-icons a::before {
    display: none !important;
  }

  .social-icons a:hover {
    background: var(--primary-gold);
    border-color: var(--primary-gold);
    color: var(--charcoal) !important;
    transform: translateY(-3px) !important;
    padding-left: 0 !important;
    box-shadow: 0 5px 20px var(--gold-glow);
  }

  /* Instagram Grid */
  .footer-section img {
    width: 100%;
    height: 60px;
    object-fit: cover;
    border-radius: var(--border-radius-small);
    transition: var(--transition);
    border: 2px solid transparent;
  }

  .footer-section img:hover {
    transform: scale(1.05);
    border-color: var(--primary-gold);
    box-shadow: 0 4px 15px var(--gold-glow);
  }

  /* Responsive Design */
  @media (max-width: 1200px) {
    .navbar-nav .nav-link {
      margin: 0 10px;
      font-size: 0.9rem;
    }
    
    .navbar-brand img {
      height: 50px;
    }
    
    .btn-gold {
      padding: 10px 25px;
      font-size: 0.9rem;
    }
  }

  @media (max-width: 991.98px) {
    .navbar-collapse {
      justify-content: start !important;
      margin-top: 1rem;
    }

    .navbar-nav {
      flex-direction: column;
      gap: 0.5rem;
    }

    .navbar-nav .nav-link {
      margin: 0;
      padding: 10px 0 !important;
      border-bottom: 1px solid rgba(0,0,0,0.1);
    }

    .navbar-nav .nav-link::after {
      bottom: 0;
      height: 1px;
    }

    .btn-gold {
      margin: 1rem auto;
      display: block;
      width: fit-content;
    }
  }

  @media (max-width: 768px) {
    .footer-section {
      text-align: center;
    }
    
    .footer-section .row > div {
      margin-bottom: 2rem;
    }
    
    .social-icons {
      justify-content: center;
    }
  }

  /* Utility Classes */
  .text-white-50 {
    color: rgba(255, 255, 255, 0.7) !important;
  }

  .border-dark {
    border-color: rgba(255, 255, 255, 0.2) !important;
  }

  /* Scroll Animations */
  [data-aos] {
    pointer-events: none;
  }

  [data-aos].aos-animate {
    pointer-events: auto;
  }

  /* Loading States */
  .loading {
    opacity: 0;
    transform: translateY(20px);
    transition: var(--transition);
  }

  .loading.loaded {
    opacity: 1;
    transform: translateY(0);
  }

  /* Custom Scrollbar */
  ::-webkit-scrollbar {
    width: 8px;
  }

  ::-webkit-scrollbar-track {
    background: var(--light-bg);
  }

  ::-webkit-scrollbar-thumb {
    background: linear-gradient(180deg, var(--primary-gold), var(--gold-dark));
    border-radius: 4px;
  }

  ::-webkit-scrollbar-thumb:hover {
    background: var(--gold-dark);
  }

  /* Print Styles */
  @media print {
    .navbar,
    .footer-section {
      display: none !important;
    }
  }
</style>

</head>
<body>

<!-- Enhanced Modern Navbar -->
<nav class="navbar navbar-expand-lg fixed-top">
  <div class="container">
    <a class="navbar-brand" href="{{ url('/') }}">
      <img src="{{ asset('images/logo.png') }}" alt="Kaya Travel & Tours Logo">
    </a>

    <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link {{ Request::is('/') ? 'active' : '' }}" href="{{ url('/') }}">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ Request::is('about') ? 'active' : '' }}" href="{{ url('/about') }}">About Us</a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ Request::is('destination') ? 'active' : '' }}" href="{{ url('/destination') }}">Destinations</a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ Request::is('trips') ? 'active' : '' }}" href="{{ route('trips.public.index') }}">Trips</a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ Request::is('service') ? 'active' : '' }}" href="{{ url('/service') }}">Services</a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ Request::is('flights*') ? 'active' : '' }}" href="{{ route('flights.index') }}">Flights</a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ Request::is('blog') ? 'active' : '' }}" href="{{ url('/blog') }}">Blog</a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ Request::is('contact') ? 'active' : '' }}" href="{{ url('/contact') }}">Contact</a>
        </li>

        {{-- Authentication Links --}}
        @guest
          <li class="nav-item">
            <a class="nav-link {{ Request::is('login') ? 'active' : '' }}" href="{{ route('login') }}">
              <i class="bi bi-person-circle me-1"></i> Login
            </a>
          </li>
        @endguest

        @auth
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              <i class="bi bi-person-check-fill me-1"></i> {{ Auth::user()->name }}
            </a>
            <ul class="dropdown-menu dropdown-menu-end">
              <li>
                <a class="dropdown-item" href="{{ route('dashboard') }}">
                  <i class="bi bi-speedometer2 me-2 text-gold"></i> Dashboard
                </a>
              </li>
              <li><hr class="dropdown-divider" style="border-color: rgba(244, 208, 63, 0.2);"></li>
              <li>
                <form method="POST" action="{{ route('logout') }}">
                  @csrf
                  <button class="dropdown-item" type="submit">
                    <i class="bi bi-box-arrow-right me-2 text-danger"></i> Logout
                  </button>
                </form>
              </li>
            </ul>
          </li>
        @endauth
      </ul>
    </div>

    <div class="d-none d-lg-block">
      <a href="{{ route('trips.public.index') }}" class="btn-gold">
        <i class="bi bi-calendar-check"></i>
        <span>Book Now</span>
        <i class="bi bi-arrow-right"></i>
      </a>
    </div>
  </div>
</nav>

<!-- Main Content -->
<main style="padding-top: 100px;">
  @yield('content')
</main>

<!-- Enhanced Footer -->
<footer class="footer-section py-5">
  <div class="container">
    <div class="row gy-5">

      <!-- Company Info -->
      <div class="col-lg-4 col-md-6">
        <h4>Kaya Travel And Tours</h4>
        <p class="text-white-50 mb-4">Journeys Worth Taking - Creating unforgettable memories through authentic travel experiences across Rwanda and beyond.</p>
        <div class="social-icons">
          <a href="https://x.com/kaya_travels" title="Twitter" aria-label="Follow us on Twitter">
            <i class="bi bi-twitter"></i>
          </a>
          <a href="https://www.linkedin.com/company/kaya-ltd/" title="LinkedIn" aria-label="Connect on LinkedIn">
            <i class="bi bi-linkedin"></i>
          </a>
          <a href="https://wa.me/+250789007076" title="WhatsApp" aria-label="Chat on WhatsApp">
            <i class="bi bi-whatsapp"></i>
          </a>
          <a href="https://www.instagram.com/kayatravelsltd" title="Instagram" aria-label="Follow on Instagram">
            <i class="bi bi-instagram"></i>
          </a>
        </div>
      </div>

      <!-- Quick Links -->
      <div class="col-lg-2 col-md-6">
        <h6>Quick Links</h6>
        <ul class="list-unstyled">
          <li><a href="{{ url('/') }}">Home</a></li>
          <li><a href="{{ url('/about') }}">About Us</a></li>
          <li><a href="{{ url('/service') }}">Our Services</a></li>
          <li><a href="{{ route('trips.public.index') }}">Tour Packages</a></li>
          <li><a href="{{ url('/contact') }}">Contact Us</a></li>
        </ul>
      </div>

      <!-- Contact Information -->
      <div class="col-lg-3 col-md-6">
        <h6>Get In Touch</h6>
        <div class="contact-info">
          <div class="d-flex align-items-center mb-3">
            <i class="bi bi-telephone-fill me-3 text-gold"></i>
            <div>
              <small class="text-white-50 d-block">Call Us</small>
              <a href="tel:+250796514917" class="text-white">+250 796 514 917</a>
            </div>
          </div>
          <div class="d-flex align-items-center mb-3">
            <i class="bi bi-envelope-fill me-3 text-gold"></i>
            <div>
              <small class="text-white-50 d-block">Email Us</small>
              <a href="mailto:info@kayatravels.net" class="text-white">info@kayatravels.net</a>
            </div>
          </div>
          <div class="d-flex align-items-center">
            <i class="bi bi-geo-alt-fill me-3 text-gold"></i>
            <div>
              <small class="text-white-50 d-block">Visit Us</small>
              <span class="text-white">Kigali, Rwanda</span>
            </div>
          </div>
        </div>
      </div>

      <!-- Instagram Feed -->
      <div class="col-lg-3 col-md-6">
        <h6>Follow Our Journey</h6>
        <p class="text-white-50 small mb-3">See the latest adventures and destinations</p>
        <div class="row g-2">
          @foreach (range(1,6) as $i)
            <div class="col-4">
              <img src="{{ asset('images/ig' . $i . '.jpg') }}" alt="Instagram post {{ $i }}" class="img-fluid" loading="lazy">
            </div>
          @endforeach
        </div>
      </div>

    </div>

    <hr class="border-dark mt-5 mb-4">
    
    <div class="row align-items-center">
      <div class="col-md-6">
        <p class="text-white-50 small mb-0">
          &copy; {{ date('Y') }} Kaya Travels & Tours. All Rights Reserved.
        </p>
      </div>
      <div class="col-md-6 text-md-end">
        <p class="text-white-50 small mb-0">
          Made By <a href="https://stockcenterapp.com/">Izere Moubarak</a>
        </p>
      </div>
    </div>
  </div>
</footer>

<!-- Scripts -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" defer></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js" defer></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr" defer></script>

<script>
document.addEventListener("DOMContentLoaded", function () {
  // Initialize AOS (Animate On Scroll)
  if (typeof AOS !== 'undefined') {
    AOS.init({
      duration: 800,
      easing: 'ease-out-cubic',
      once: true,
      offset: 100
    });
  }

  // Scroll to top functionality
  const scrollTopBtn = document.getElementById("scrollTopBtn");
  if (scrollTopBtn) {
    window.addEventListener("scroll", () => {
      scrollTopBtn.style.display = window.scrollY > 200 ? "block" : "none";
    });

    scrollTopBtn.addEventListener("click", (e) => {
      e.preventDefault();
      window.scrollTo({ top: 0, behavior: "smooth" });
    });
  }

  // Filter functionality
  const filterBtns = document.querySelectorAll('.filter-btn');
  const destinations = document.querySelectorAll('.destination-item');

  filterBtns.forEach(btn => {
    btn.addEventListener('click', () => {
      const filter = btn.getAttribute('data-filter');

      filterBtns.forEach(b => b.classList.remove('active'));
      btn.classList.add('active');

      destinations.forEach(item => {
        const match = filter === 'all' || item.dataset.category === filter;
        item.classList.toggle('hide', !match);
      });
    });
  });

  // Navbar scroll effect
  const navbar = document.querySelector(".navbar");
  window.addEventListener("scroll", () => {
    navbar.classList.toggle("scrolled", window.scrollY > 10);
  });

  // Flatpickr initialization (only if element exists and flatpickr is loaded)
  if (document.getElementById("travel_date") && typeof flatpickr !== 'undefined') {
    flatpickr("#travel_date", {
      altInput: true,
      altFormat: "F j, Y",
      dateFormat: "Y-m-d",
      minDate: "today"
    });
  }

  // Loading animation
  const loadingElements = document.querySelectorAll('.loading');
  loadingElements.forEach(el => {
    setTimeout(() => {
      el.classList.add('loaded');
    }, 100);
  });

  // Smooth scrolling for anchor links
  document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
      e.preventDefault();
      const target = document.querySelector(this.getAttribute('href'));
      if (target) {
        target.scrollIntoView({
          behavior: 'smooth',
          block: 'start'
        });
      }
    });
  });
});
</script>

@stack('scripts')

</body>
</html>