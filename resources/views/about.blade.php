@extends('layouts.public')

@section('title', 'About Kaya Travels - Our Story & Mission')

@section('meta')
<meta name="description" content="Learn about Kaya Travels & Tours - Rwanda's premier travel agency. Discover our mission, vision, and commitment to creating unforgettable travel experiences.">
@endsection

@section('content')
<style>
  :root {
    --hero-height: 55vh;
  }

  /* Hero Section */
  .about-hero {
    height: var(--hero-height);
    background-size: cover;
    background-position: center;
    background-attachment: fixed;
    position: relative;
    display: flex;
    align-items: center;
    justify-content: center;
  }

  .about-hero::before {
    content: '';
    position: absolute;
    inset: 0;
    background: linear-gradient(135deg, rgba(44, 62, 80, 0.85) 0%, rgba(52, 73, 94, 0.7) 50%, rgba(244, 208, 63, 0.3) 100%);
    z-index: 1;
  }

  .about-hero-content {
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

  /* Floating Stats Widget */
  .stats-widget {
    background: white;
    border-radius: 24px;
    padding: 2.5rem 2rem;
    box-shadow: var(--shadow-medium);
    margin-top: -60px;
    position: relative;
    z-index: 10;
  }

  .stat-block {
    text-align: center;
    position: relative;
  }

  .stat-number {
    font-size: 3rem;
    font-weight: 800;
    color: var(--charcoal);
    line-height: 1;
    margin-bottom: 0.5rem;
  }

  .stat-label {
    font-size: 0.95rem;
    font-weight: 700;
    color: var(--primary-gold);
    text-transform: uppercase;
    letter-spacing: 1px;
  }

  /* Premium Section Headings */
  .heading-wrapper {
    text-align: center;
    margin-bottom: 4rem;
  }

  .heading-subtitle {
    color: var(--primary-gold);
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 2px;
    font-size: 0.9rem;
    margin-bottom: 1rem;
    display: block;
  }

  .heading-title {
    font-size: 2.8rem;
    font-weight: 800;
    color: var(--charcoal);
    margin-bottom: 1rem;
  }

  .heading-desc {
    color: var(--charcoal-lighter);
    font-size: 1.1rem;
    max-width: 600px;
    margin: 0 auto;
  }

  /* Generic Clean Cards */
  .clean-card {
    background: white;
    border-radius: 20px;
    border: 1px solid #f1f5f9;
    padding: 3rem 2.5rem;
    height: 100%;
    transition: var(--transition);
    box-shadow: var(--shadow-soft);
    position: relative;
    overflow: hidden;
  }

  .clean-card:hover {
    transform: translateY(-8px);
    box-shadow: var(--shadow-medium);
    border-color: rgba(244, 208, 63, 0.4);
  }

  /* Icon Wrappers */
  .icon-wrapper-gold {
    width: 70px;
    height: 70px;
    border-radius: 20px;
    background: linear-gradient(135deg, rgba(244, 208, 63, 0.2), rgba(244, 208, 63, 0.1));
    color: var(--primary-gold);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 2rem;
    margin-bottom: 1.5rem;
    transition: var(--transition);
  }

  .clean-card:hover .icon-wrapper-gold {
    background: linear-gradient(135deg, var(--primary-gold), var(--gold-dark));
    color: white;
    transform: scale(1.1) rotate(5deg);
  }

  /* Text Formatting inside cards */
  .card-title-pro {
    font-size: 1.5rem;
    font-weight: 800;
    color: var(--charcoal);
    margin-bottom: 1rem;
  }

  .card-desc-pro {
    color: var(--charcoal-lighter);
    font-size: 1.05rem;
    line-height: 1.7;
  }

  /* Founder Section Custom */
  .founder-wrapper {
    background: white;
    border-radius: 30px;
    overflow: hidden;
    box-shadow: var(--shadow-medium);
    display: flex;
    flex-direction: column;
    border: 1px solid #f1f5f9;
  }

  @media (min-width: 992px) {
    .founder-wrapper {
      flex-direction: row;
    }
  }

  .founder-img-box {
    flex: 1;
    background: linear-gradient(135deg, var(--charcoal-light), var(--charcoal));
    min-height: 400px;
    position: relative;
    display: flex;
    align-items: flex-end;
    padding: 2rem;
  }

  .founder-tag {
    background: rgba(255, 255, 255, 0.95);
    padding: 15px 25px;
    border-radius: 20px;
    box-shadow: var(--shadow-soft);
    z-index: 2;
  }

  .founder-info {
    flex: 1.2;
    padding: 4rem;
    display: flex;
    flex-direction: column;
    justify-content: center;
  }

  .quote-box {
    border-left: 4px solid var(--primary-gold);
    padding-left: 1.5rem;
    margin-top: 2rem;
    font-style: italic;
    color: var(--charcoal);
    font-size: 1.1rem;
    position: relative;
  }

  .quote-box::before {
    content: '\201C';
    font-size: 4rem;
    position: absolute;
    left: -15px;
    top: -20px;
    opacity: 0.1;
    color: var(--charcoal);
  }

  /* Dark MVV Section */
  .dark-section {
    background: var(--charcoal);
    color: white;
    position: relative;
    overflow: hidden;
    padding: 6rem 0;
    margin: 6rem 0;
  }

  .dark-section::before {
    content: '';
    position: absolute;
    top: 0; left: 0; right: 0; bottom: 0;
    background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="dots" width="20" height="20" patternUnits="userSpaceOnUse"><circle cx="10" cy="10" r="1" fill="%23f4d03f" opacity="0.1"/></pattern></defs><rect width="100" height="100" fill="url(%23dots)"/></svg>');
  }

  .dark-card {
    background: rgba(255, 255, 255, 0.03);
    border: 1px solid rgba(255, 255, 255, 0.1);
    border-radius: 24px;
    padding: 3rem 2.5rem;
    height: 100%;
    transition: var(--transition);
    backdrop-filter: blur(10px);
  }

  .dark-card:hover {
    background: rgba(255, 255, 255, 0.05);
    transform: translateY(-8px);
    border-color: rgba(244, 208, 63, 0.3);
  }

  .dark-icon {
    color: var(--primary-gold);
    font-size: 2.5rem;
    margin-bottom: 1.5rem;
  }

  .val-list {
    list-style: none;
    padding: 0;
    margin: 0;
  }

  .val-list li {
    margin-bottom: 15px;
    display: flex;
    align-items: center;
    font-size: 1.05rem;
    color: rgba(255, 255, 255, 0.8);
  }

  .val-list i {
    color: var(--primary-gold);
    margin-right: 12px;
  }

  /* Team Highlights */
  .team-icon-circle {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    background: rgba(244, 208, 63, 0.15);
    color: var(--primary-gold);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
    margin-bottom: 1.5rem;
  }

</style>

<!-- Hero Section -->
<section class="about-hero" style="background-image: url('{{ asset('images/about.jpeg') }}');">
  <div class="container">
    <div class="about-hero-content mx-auto" data-aos="fade-up">
      <span class="badge bg-gold text-charcoal rounded-pill px-3 py-2 mb-3 fw-bold shadow" style="background-color: var(--primary-gold);"><i class="bi bi-info-circle me-1"></i> About Us</span>
      <h1 class="hero-title">Our Story & Mission</h1>
      <p class="fs-5 opacity-75">Creating extraordinary journeys across Rwanda and beyond, one unforgettable experience at a time.</p>
    </div>
  </div>
</section>

<!-- Floating Stats Widget -->
<div class="container">
  <div class="stats-widget" data-aos="fade-up" data-aos-delay="100">
    <div class="row g-4">
      <div class="col-6 col-md-3">
        <div class="stat-block">
          <div class="stat-number" data-counter="500">0</div>
          <div class="stat-label">Happy Travelers</div>
        </div>
      </div>
      <div class="col-6 col-md-3">
        <div class="stat-block">
          <div class="stat-number" data-counter="50">0</div>
          <div class="stat-label">Destinations</div>
        </div>
      </div>
      <div class="col-6 col-md-3">
        <div class="stat-block">
          <div class="stat-number" data-counter="5">0</div>
          <div class="stat-label">Years Experience</div>
        </div>
      </div>
      <div class="col-6 col-md-3">
        <div class="stat-block">
          <div class="stat-number" data-counter="100">0</div>
          <div class="stat-label">Success Rate</div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Who We Are -->
<section class="py-5 mt-5">
  <div class="container">
    <div class="heading-wrapper" data-aos="fade-up">
      <span class="heading-subtitle">Who We Are</span>
      <h2 class="heading-title">Rwanda's Trusted Travel Partner</h2>
      <p class="heading-desc">Discover the passion and vision behind our premier travel experience company, committed to delivering excellence.</p>
    </div>

    <div class="row g-4">
      <div class="col-md-6" data-aos="fade-up" data-aos-delay="100">
        <div class="clean-card">
          <div class="icon-wrapper-gold">
            <i class="bi bi-heart-fill"></i>
          </div>
          <h3 class="card-title-pro">Our Passion</h3>
          <p class="card-desc-pro">Kaya Travel and Tours is a dynamic Rwandan travel agency born from a deep passion for showcasing the beauty and culture of Rwanda and Africa. We believe every journey should be transformative, connecting travelers with authentic experiences that create lasting memories.</p>
        </div>
      </div>
      <div class="col-md-6" data-aos="fade-up" data-aos-delay="200">
        <div class="clean-card">
          <div class="icon-wrapper-gold">
            <i class="bi bi-shield-check"></i>
          </div>
          <h3 class="card-title-pro">Our Commitment</h3>
          <p class="card-desc-pro">We serve both corporate and individual clients with innovative and personalized travel solutions. Our team of local experts ensures every journey is unforgettable through our unwavering commitment to professionalism, authenticity, and exceptional service.</p>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Founder Section -->
<section class="py-5" style="background: var(--light-bg);">
  <div class="container">
    <div class="heading-wrapper" data-aos="fade-up">
      <span class="heading-subtitle">Leadership</span>
      <h2 class="heading-title">Meet Our Founder</h2>
    </div>

    <div class="founder-wrapper" data-aos="fade-up">
      <div class="founder-img-box">
        <!-- Optional: set an actual image here instead of gradient <img src="julia.jpg" alt="Julia" class="position-absolute inset-0 w-100 h-100 object-fit-cover" style="z-index: 0; opacity: 0.5;"> -->
        <div class="founder-tag">
          <h4 class="fw-bold mb-0 text-charcoal">Julia Tumukunde Gakwaya</h4>
          <span class="text-muted small fw-semibold">Founder & CEO</span>
        </div>
      </div>
      <div class="founder-info">
        <h3 class="card-title-pro mb-3 text-charcoal">Visionary Leadership</h3>
        <p class="card-desc-pro mb-4">
          Julia Tumukunde Gakwaya is a passionate entrepreneur and visionary leader whose mission is to transform Africa into the world's premier destination for unique and unforgettable travel experiences. With her extensive knowledge of African culture, landscapes, and hospitality, Julia has built Kaya Travels into a trusted name in the industry.
        </p>
        <div class="quote-box">
          "My dream is to showcase the incredible beauty, rich culture, and warm hospitality that Africa has to offer, creating connections that go beyond tourism and fostering understanding between people from all walks of life."
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Dark MVV Section -->
<section class="dark-section">
  <div class="container position-relative z-2">
    <div class="heading-wrapper mb-5" data-aos="fade-up">
      <span class="heading-subtitle">Our Foundation</span>
      <h2 class="heading-title text-white">Mission, Vision & Values</h2>
    </div>

    <div class="row g-4">
      <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
        <div class="dark-card">
          <i class="bi bi-bullseye dark-icon"></i>
          <h3 class="text-white fw-bold mb-3">Our Mission</h3>
          <p class="text-white opacity-75 lh-lg">To simplify travel through personalized service, cutting-edge solutions, and unmatched attention to detail, making every journey seamless and extraordinary.</p>
        </div>
      </div>
      
      <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
        <div class="dark-card">
          <i class="bi bi-eye-fill dark-icon"></i>
          <h3 class="text-white fw-bold mb-3">Our Vision</h3>
          <p class="text-white opacity-75 lh-lg">To be the leading provider of reliable and innovative travel services in Africa and beyond, setting new standards for excellence in the travel industry.</p>
        </div>
      </div>

      <div class="col-lg-4" data-aos="fade-up" data-aos-delay="300">
        <div class="dark-card">
          <i class="bi bi-star-fill dark-icon"></i>
          <h3 class="text-white fw-bold mb-3">Our Values</h3>
          <ul class="val-list">
            <li><i class="bi bi-check-circle-fill"></i> Integrity in every interaction</li>
            <li><i class="bi bi-check-circle-fill"></i> Excellence in service delivery</li>
            <li><i class="bi bi-check-circle-fill"></i> Customer-focused approach</li>
            <li><i class="bi bi-check-circle-fill"></i> Innovation in travel solutions</li>
            <li><i class="bi bi-check-circle-fill"></i> Reliability you can trust</li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Why Us Section -->
<section class="py-5 mb-5">
  <div class="container">
    <div class="heading-wrapper" data-aos="fade-up">
      <span class="heading-subtitle">Our Team</span>
      <h2 class="heading-title">Why Choose Kaya Travels</h2>
    </div>

    <div class="row g-4">
      <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
        <div class="clean-card">
          <div class="team-icon-circle">
            <i class="bi bi-geo-alt-fill"></i>
          </div>
          <h4 class="fw-bold text-charcoal mb-3">Local Expertise</h4>
          <p class="card-desc-pro">Our team of local guides and travel experts have deep knowledge of Rwanda and East Africa, ensuring authentic and immersive experiences.</p>
        </div>
      </div>
      <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
        <div class="clean-card">
          <div class="team-icon-circle">
            <i class="bi bi-headset"></i>
          </div>
          <h4 class="fw-bold text-charcoal mb-3">24/7 Support</h4>
          <p class="card-desc-pro">Round-the-clock customer support ensures you're never alone during your journey. We're here to assist whenever you need us.</p>
        </div>
      </div>
      <div class="col-md-4" data-aos="fade-up" data-aos-delay="300">
        <div class="clean-card">
          <div class="team-icon-circle">
            <i class="bi bi-award-fill"></i>
          </div>
          <h4 class="fw-bold text-charcoal mb-3">Quality Assurance</h4>
          <p class="card-desc-pro">Every aspect of your journey is carefully planned and quality-checked to ensure it meets our incredibly high standards of excellence.</p>
        </div>
      </div>
    </div>
  </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
  // Counter animation
  function animateCounter(element) {
    const target = parseInt(element.getAttribute('data-counter'));
    const duration = 2000;
    const increment = target / (duration / 16);
    let current = 0;
    
    const timer = setInterval(() => {
      current += increment;
      if (current >= target) {
        element.textContent = target + (target === 100 ? '%' : '+');
        clearInterval(timer);
      } else {
        element.textContent = Math.floor(current) + (target === 100 ? '%' : '+');
      }
    }, 16);
  }
  
  const counters = document.querySelectorAll('[data-counter]');
  const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        animateCounter(entry.target);
        observer.unobserve(entry.target);
      }
    });
  }, { threshold: 0.5 });
  
  counters.forEach(counter => observer.observe(counter));
});
</script>
@endsection