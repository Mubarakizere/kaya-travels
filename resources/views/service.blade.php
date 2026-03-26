@extends('layouts.public')

@section('title', 'Our Services - Professional Travel Solutions | Kaya Travels')

@section('meta')
<meta name="description" content="Discover Kaya Travels' comprehensive travel services including corporate travel, leisure tours, group trips, MICE events, VIP handling, and visa assistance across Rwanda and Africa.">
<meta name="keywords" content="Travel Services Rwanda, Corporate Travel, Leisure Tours, Group Trips, MICE Events, VIP Travel, Visa Assistance, Kaya Travels Services">
@endsection

@section('content')
<style>
  /* Services Page Specific Styles */
  :root {
    --hero-height: 70vh;
  }

  /* Hero Section */
  .services-hero {
    height: var(--hero-height);
    background-size: cover;
    background-position: center;
    background-attachment: fixed;
    position: relative;
    display: flex;
    align-items: center;
    overflow: hidden;
  }

  .services-hero::before {
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

  .services-hero .container {
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
    font-size: 4rem;
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

  /* Overview Section */
  .overview-section {
    padding: 6rem 0;
    background: white;
    position: relative;
  }

  .overview-content {
    max-width: 800px;
    margin: 0 auto;
    text-align: center;
    margin-bottom: 4rem;
  }

  .overview-title {
    font-size: 2.5rem;
    font-weight: 800;
    color: var(--charcoal);
    margin-bottom: 1.5rem;
  }

  .overview-text {
    font-size: 1.2rem;
    color: var(--charcoal-lighter);
    line-height: 1.7;
  }

  .stats-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 2rem;
    margin: 4rem 0;
  }

  .stat-item {
    text-align: center;
    padding: 2rem 1rem;
    background: var(--light-bg);
    border-radius: 20px;
    transition: var(--transition);
  }

  .stat-item:hover {
    background: white;
    box-shadow: var(--shadow-soft);
    transform: translateY(-5px);
  }

  .stat-number {
    font-size: 3rem;
    font-weight: 800;
    color: var(--primary-gold);
    margin-bottom: 0.5rem;
  }

  .stat-label {
    font-size: 1rem;
    font-weight: 600;
    color: var(--charcoal);
    text-transform: uppercase;
    letter-spacing: 1px;
  }

  /* Services Grid */
  .services-section {
    padding: 6rem 0;
    background: var(--light-bg);
  }

  .section-header {
    text-align: center;
    margin-bottom: 4rem;
  }

  .section-badge {
    display: inline-flex;
    align-items: center;
    background: linear-gradient(135deg, var(--primary-gold), var(--gold-dark));
    color: var(--charcoal);
    padding: 10px 25px;
    border-radius: 50px;
    font-size: 0.85rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 1px;
    margin-bottom: 1.5rem;
  }

  .section-title {
    font-size: 2.5rem;
    font-weight: 800;
    color: var(--charcoal);
    margin-bottom: 1rem;
  }

  .section-subtitle {
    font-size: 1.2rem;
    color: var(--charcoal-lighter);
    max-width: 600px;
    margin: 0 auto;
    line-height: 1.6;
  }

  .services-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
    gap: 2rem;
  }

  .service-card {
    background: white;
    border-radius: 20px;
    padding: 3rem 2rem;
    box-shadow: var(--shadow-soft);
    transition: var(--transition);
    height: 100%;
    display: flex;
    flex-direction: column;
    position: relative;
    overflow: hidden;
  }

  .service-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 4px;
    background: linear-gradient(90deg, var(--primary-gold), var(--gold-light));
    transform: scaleX(0);
    transition: var(--transition);
  }

  .service-card:hover::before {
    transform: scaleX(1);
  }

  .service-card:hover {
    transform: translateY(-10px);
    box-shadow: var(--shadow-hover);
  }

  .service-icon {
    width: 100px;
    height: 100px;
    background: linear-gradient(135deg, var(--primary-gold), var(--gold-dark));
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 2rem;
    transition: var(--transition);
    position: relative;
  }

  .service-icon::after {
    content: '';
    position: absolute;
    inset: -10px;
    border-radius: 50%;
    background: linear-gradient(135deg, var(--primary-gold), var(--gold-dark));
    opacity: 0.2;
    transform: scale(0);
    transition: var(--transition);
  }

  .service-card:hover .service-icon::after {
    transform: scale(1);
  }

  .service-icon i {
    font-size: 2.5rem;
    color: var(--charcoal);
    z-index: 2;
    position: relative;
  }

  .service-card:hover .service-icon {
    transform: scale(1.1) rotate(360deg);
  }

  .service-title {
    font-size: 1.5rem;
    font-weight: 700;
    color: var(--charcoal);
    margin-bottom: 1rem;
  }

  .service-description {
    color: var(--charcoal-lighter);
    line-height: 1.7;
    margin-bottom: 1.5rem;
    font-size: 1.05rem;
  }

  .service-features {
    list-style: none;
    padding: 0;
    margin-bottom: 2rem;
  }

  .service-features li {
    display: flex;
    align-items: center;
    margin-bottom: 0.8rem;
    color: var(--charcoal-lighter);
    font-size: 0.95rem;
  }

  .service-features i {
    color: var(--primary-gold);
    margin-right: 12px;
    font-size: 1.1rem;
  }

  .service-cta {
    background: linear-gradient(135deg, var(--primary-gold), var(--gold-dark));
    color: var(--charcoal);
    border: none;
    padding: 12px 30px;
    border-radius: 25px;
    font-weight: 600;
    text-decoration: none;
    transition: var(--transition);
    text-align: center;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    margin-top: auto;
  }

  .service-cta:hover {
    background: var(--gold-dark);
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(244, 208, 63, 0.3);
    color: var(--charcoal);
  }

  /* Process Section */
  .process-section {
    padding: 6rem 0;
    background: white;
  }

  .process-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 2rem;
    margin-top: 3rem;
  }

  .process-step {
    text-align: center;
    padding: 2rem 1rem;
    position: relative;
  }

  .process-number {
    width: 80px;
    height: 80px;
    background: linear-gradient(135deg, var(--primary-gold), var(--gold-dark));
    color: var(--charcoal);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 2rem;
    font-weight: 800;
    margin: 0 auto 1.5rem;
    position: relative;
    z-index: 2;
  }

  .process-step::before {
    content: '';
    position: absolute;
    top: 40px;
    left: 50%;
    width: 100%;
    height: 2px;
    background: linear-gradient(90deg, var(--primary-gold), var(--gold-light));
    transform: translateX(-50%);
    z-index: 1;
  }

  .process-step:last-child::before {
    display: none;
  }

  .process-title {
    font-size: 1.3rem;
    font-weight: 700;
    color: var(--charcoal);
    margin-bottom: 1rem;
  }

  .process-description {
    color: var(--charcoal-lighter);
    line-height: 1.6;
  }

  /* Testimonials Section */
  .testimonials-section {
    padding: 6rem 0;
    background: linear-gradient(135deg, var(--charcoal) 0%, var(--charcoal-light) 100%);
    color: white;
    position: relative;
    overflow: hidden;
  }

  .testimonials-section::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="testimonial-pattern" width="20" height="20" patternUnits="userSpaceOnUse"><circle cx="10" cy="10" r="1" fill="%23f4d03f" opacity="0.1"/></pattern></defs><rect width="100" height="100" fill="url(%23testimonial-pattern)"/></svg>');
    opacity: 0.3;
  }

  .testimonials-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
    gap: 2rem;
    margin-top: 3rem;
  }

  .testimonial-card {
    background: rgba(255, 255, 255, 0.1);
    backdrop-filter: blur(15px);
    border: 1px solid rgba(244, 208, 63, 0.2);
    border-radius: 20px;
    padding: 2.5rem;
    transition: var(--transition);
    position: relative;
    z-index: 2;
    height: 100%;
    display: flex;
    flex-direction: column;
  }

  .testimonial-card:hover {
    background: rgba(255, 255, 255, 0.15);
    transform: translateY(-5px);
  }

  .testimonial-quote {
    font-size: 2rem;
    color: var(--primary-gold);
    margin-bottom: 1.5rem;
  }

  .testimonial-text {
    font-size: 1.1rem;
    line-height: 1.7;
    margin-bottom: 2rem;
    font-style: italic;
  }

  .testimonial-author {
    display: flex;
    align-items: center;
    gap: 1rem;
    margin-top: auto;
  }

  .author-avatar {
    width: 60px;
    height: 60px;
    background: var(--primary-gold);
    color: var(--charcoal);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 700;
    font-size: 1.5rem;
  }

  .author-info h6 {
    margin-bottom: 0.25rem;
    font-weight: 700;
  }

  .author-info small {
    opacity: 0.8;
  }

  /* CTA Section */
  .cta-section {
    padding: 6rem 0;
    background: linear-gradient(135deg, var(--primary-gold), var(--gold-dark));
    color: var(--charcoal);
    text-align: center;
    position: relative;
    overflow: hidden;
  }

  .cta-section::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="cta-pattern" width="30" height="30" patternUnits="userSpaceOnUse"><path d="M15,5 Q25,15 15,25 Q5,15 15,5" fill="%232c3e50" opacity="0.1"/></pattern></defs><rect width="100" height="100" fill="url(%23cta-pattern)"/></svg>');
  }

  .cta-content {
    position: relative;
    z-index: 2;
    max-width: 600px;
    margin: 0 auto;
  }

  .cta-title {
    font-size: 3rem;
    font-weight: 800;
    margin-bottom: 1.5rem;
    line-height: 1.2;
  }

  .cta-subtitle {
    font-size: 1.3rem;
    margin-bottom: 3rem;
    opacity: 0.9;
    line-height: 1.6;
  }

  .cta-buttons {
    display: flex;
    justify-content: center;
    gap: 1.5rem;
    flex-wrap: wrap;
  }

  .btn-cta-primary {
    background: var(--charcoal);
    color: white;
    border: none;
    padding: 18px 40px;
    border-radius: 50px;
    font-weight: 700;
    font-size: 1.1rem;
    text-decoration: none;
    transition: var(--transition);
    display: inline-flex;
    align-items: center;
    gap: 10px;
  }

  .btn-cta-primary:hover {
    background: var(--charcoal-light);
    transform: translateY(-3px);
    box-shadow: 0 15px 40px rgba(44, 62, 80, 0.3);
    color: white;
  }

  .btn-cta-secondary {
    background: transparent;
    color: var(--charcoal);
    border: 2px solid var(--charcoal);
    padding: 16px 38px;
    border-radius: 50px;
    font-weight: 700;
    font-size: 1.1rem;
    text-decoration: none;
    transition: var(--transition);
    display: inline-flex;
    align-items: center;
    gap: 10px;
  }

  .btn-cta-secondary:hover {
    background: var(--charcoal);
    color: white;
    transform: translateY(-3px);
  }

  /* Responsive Design */
  @media (max-width: 1024px) {
    .services-grid {
      grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    }
    
    .process-step::before {
      display: none;
    }
  }

  @media (max-width: 768px) {
    .hero-title {
      font-size: 2.8rem;
    }
    
    .overview-title,
    .section-title {
      font-size: 2rem;
    }
    
    .cta-title {
      font-size: 2.2rem;
    }
    
    .services-grid,
    .testimonials-grid {
      grid-template-columns: 1fr;
    }
    
    .service-card {
      height: auto;
      padding: 2rem 1.5rem;
    }
    
    .stats-grid {
      grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
      gap: 1rem;
    }
    
    .stat-number {
      font-size: 2.5rem;
    }
    
    .cta-buttons {
      flex-direction: column;
      align-items: center;
    }
    
    .btn-cta-primary,
    .btn-cta-secondary {
      width: 100%;
      max-width: 300px;
      justify-content: center;
    }
    
    .services-hero {
      height: 60vh;
    }
  }

  @media (max-width: 576px) {
    .hero-title {
      font-size: 2.2rem;
    }
    
    .overview-section,
    .services-section,
    .process-section,
    .testimonials-section,
    .cta-section {
      padding: 4rem 0;
    }
    
    .service-card,
    .testimonial-card {
      padding: 2rem 1rem;
    }
    
    .process-step {
      padding: 1.5rem 0.5rem;
    }
  }
</style>

<!-- Hero Section -->
<section class="services-hero" style="background-image: url('{{ asset('images/services-hero.jpg') }}');">
  <div class="container">
    <div class="hero-content">
      <div class="hero-badge" data-aos="fade-up">
        <i class="bi bi-briefcase me-2"></i>Professional Services
      </div>
      <h1 class="hero-title" data-aos="fade-up" data-aos-delay="200">Our Travel Services</h1>
      <p class="hero-subtitle" data-aos="fade-up" data-aos-delay="400">Comprehensive travel solutions designed to exceed expectations and create unforgettable experiences for every type of traveler</p>
    </div>
  </div>
</section>

<!-- Overview Section -->
<section class="overview-section">
  <div class="container">
    <div class="overview-content" data-aos="fade-up">
      <h2 class="overview-title">Excellence in Every Journey</h2>
      <p class="overview-text">At Kaya Travels, we provide a comprehensive range of travel services designed to meet the diverse needs of individuals, groups, and corporate clients. Our commitment to precision, care, and elegance ensures that every journey becomes an extraordinary experience.</p>
    </div>
    
    <div class="stats-grid" data-aos="fade-up" data-aos-delay="200">
      <div class="stat-item">
        <div class="stat-number">500+</div>
        <div class="stat-label">Happy Clients</div>
      </div>
      <div class="stat-item">
        <div class="stat-number">50+</div>
        <div class="stat-label">Destinations</div>
      </div>
      <div class="stat-item">
        <div class="stat-number">24/7</div>
        <div class="stat-label">Support</div>
      </div>
      <div class="stat-item">
        <div class="stat-number">100%</div>
        <div class="stat-label">Satisfaction</div>
      </div>
    </div>
  </div>
</section>

<!-- Services Section -->
<section class="services-section">
  <div class="container">
    <div class="section-header" data-aos="fade-up">
      <div class="section-badge">
        <i class="bi bi-gear me-2"></i>Our Services
      </div>
      <h2 class="section-title">What We Offer</h2>
      <p class="section-subtitle">Discover our comprehensive range of travel services, each designed to deliver exceptional experiences and unmatched value</p>
    </div>

    <div class="services-grid">
      @php
        $services = [
          [
            'icon' => 'bi-briefcase-fill',
            'title' => 'Corporate Travel',
            'description' => 'Streamlined booking, comprehensive reporting, and professional management solutions for business clients seeking efficiency and reliability.',
            'features' => [
              'Executive travel coordination',
              'Group booking management',
              'Expense reporting & analytics',
              'Priority customer support',
              '24/7 emergency assistance'
            ]
          ],
          [
            'icon' => 'bi-globe-americas',
            'title' => 'Leisure Tours',
            'description' => 'From romantic honeymoons to adventurous weekend escapes, our expert team curates perfect vacation experiences tailored to your dreams.',
            'features' => [
              'Customized itinerary planning',
              'Luxury accommodation booking',
              'Adventure & cultural tours',
              'Photography services',
              'Local guide expertise'
            ]
          ],
          [
            'icon' => 'bi-people-fill',
            'title' => 'Group Travel',
            'description' => 'Specialized group travel packages designed for schools, families, organizations, and special interest groups with seamless coordination.',
            'features' => [
              'Educational tours & workshops',
              'Family reunion planning',
              'Corporate team building',
              'Special interest groups',
              'Group discount packages'
            ]
          ],
          [
            'icon' => 'bi-calendar2-event',
            'title' => 'MICE Events',
            'description' => 'Full-service solutions for meetings, incentives, conferences, and exhibitions with professional event management and logistics.',
            'features' => [
              'Venue selection & booking',
              'Event planning & coordination',
              'Audio-visual equipment',
              'Catering arrangements',
              'Delegate management'
            ]
          ],
          [
            'icon' => 'bi-person-check-fill',
            'title' => 'VIP Services',
            'description' => 'Exclusive meet-and-greet services, luxury transfers, and discreet travel arrangements for distinguished clients requiring premium treatment.',
            'features' => [
              'Airport VIP lounge access',
              'Luxury vehicle transfers',
              'Personal concierge service',
              'Fast-track immigration',
              'Executive accommodation'
            ]
          ],
          [
            'icon' => 'bi-shield-check',
            'title' => 'Travel Support',
            'description' => 'Comprehensive assistance with visa processing, travel insurance documentation, and all essential travel requirements.',
            'features' => [
              'Visa application support',
              'Travel insurance plans',
              'Health & vaccination advice',
              'Currency exchange services',
              'Travel document assistance'
            ]
          ]
        ];
      @endphp

      @foreach($services as $index => $service)
        <div class="service-card" data-aos="fade-up" data-aos-delay="{{ $index * 100 }}">
          <div class="service-icon">
            <i class="bi {{ $service['icon'] }}"></i>
          </div>
          <h3 class="service-title">{{ $service['title'] }}</h3>
          <p class="service-description">{{ $service['description'] }}</p>
          <ul class="service-features">
            @foreach($service['features'] as $feature)
              <li><i class="bi bi-check-circle-fill"></i> {{ $feature }}</li>
            @endforeach
          </ul>
          <a href="{{ url('/contact') }}" class="service-cta">
            <span>Get Started</span>
            <i class="bi bi-arrow-right"></i>
          </a>
        </div>
      @endforeach
    </div>
  </div>
</section>

<!-- Process Section -->
<section class="process-section">
  <div class="container">
    <div class="section-header" data-aos="fade-up">
      <div class="section-badge">
        <i class="bi bi-list-check me-2"></i>Our Process
      </div>
      <h2 class="section-title">How We Work</h2>
      <p class="section-subtitle">Our streamlined process ensures every detail is perfectly planned and executed</p>
    </div>

    <div class="process-grid">
      @php
        $processSteps = [
          [
            'number' => '1',
            'title' => 'Consultation',
            'description' => 'We listen to your needs, preferences, and budget to understand your perfect travel experience.'
          ],
          [
            'number' => '2',
            'title' => 'Planning',
            'description' => 'Our experts craft a detailed itinerary tailored specifically to your requirements and interests.'
          ],
          [
            'number' => '3',
            'title' => 'Booking',
            'description' => 'We handle all reservations, confirmations, and arrangements with our trusted partners worldwide.'
          ],
          [
            'number' => '4',
            'title' => 'Support',
            'description' => 'Enjoy 24/7 support throughout your journey with our dedicated customer service team.'
          ]
        ];
      @endphp

      @foreach($processSteps as $index => $step)
        <div class="process-step" data-aos="fade-up" data-aos-delay="{{ $index * 150 }}">
          <div class="process-number">{{ $step['number'] }}</div>
          <h4 class="process-title">{{ $step['title'] }}</h4>
          <p class="process-description">{{ $step['description'] }}</p>
        </div>
      @endforeach
    </div>
  </div>
</section>

<!-- Testimonials Section -->
<section class="testimonials-section">
  <div class="container position-relative">
    <div class="section-header" data-aos="fade-up">
      <div class="section-badge">
        <i class="bi bi-chat-heart me-2"></i>Client Stories
      </div>
      <h2 class="section-title text-white">What Our Clients Say</h2>
      <p class="section-subtitle text-white">Real experiences from satisfied travelers who have trusted us with their journeys</p>
    </div>

    <div class="testimonials-grid">
      @php
        $testimonials = [
          [
            'text' => 'Kaya Travels transformed our corporate retreat into an unforgettable experience. Their attention to detail and professional service exceeded all our expectations.',
            'author' => 'Sarah Johnson',
            'position' => 'CEO, Tech Innovations Ltd',
            'initial' => 'S'
          ],
          [
            'text' => 'From planning to execution, every aspect of our family vacation was perfectly organized. The local insights and personalized service made all the difference.',
            'author' => 'Michael Chen',
            'position' => 'Family Traveler',
            'initial' => 'M'
          ],
          [
            'text' => 'The VIP service was exceptional. From airport pickup to luxury accommodations, every detail was handled with professionalism and care.',
            'author' => 'Ambassador Williams',
            'position' => 'Diplomatic Services',
            'initial' => 'W'
          ]
        ];
      @endphp

      @foreach($testimonials as $index => $testimonial)
        <div class="testimonial-card" data-aos="fade-up" data-aos-delay="{{ $index * 100 }}">
          <div class="testimonial-quote">
            <i class="bi bi-quote"></i>
          </div>
          <p class="testimonial-text">"{{ $testimonial['text'] }}"</p>
          <div class="testimonial-author">
            <div class="author-avatar">{{ $testimonial['initial'] }}</div>
            <div class="author-info">
              <h6>{{ $testimonial['author'] }}</h6>
              <small>{{ $testimonial['position'] }}</small>
            </div>
          </div>
        </div>
      @endforeach
    </div>
  </div>
</section>

<!-- CTA Section -->
<section class="cta-section" data-aos="zoom-in">
  <div class="container">
    <div class="cta-content">
      <h2 class="cta-title">Ready to Plan Your Next Journey?</h2>
      <p class="cta-subtitle">Let our travel experts create an extraordinary experience tailored just for you. From corporate travel to luxury vacations, we're here to make your journey unforgettable.</p>
      <div class="cta-buttons">
        <a href="{{ url('/contact') }}" class="btn-cta-primary">
          <i class="bi bi-telephone"></i>
          <span>Contact Our Experts</span>
        </a>
        <a href="{{ route('trips.public.index') }}" class="btn-cta-secondary">
          <i class="bi bi-compass"></i>
          <span>Browse Packages</span>
        </a>
      </div>
    </div>
  </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
  // Counter animation for stats
  function animateCounter(element) {
    const target = element.textContent;
    const isPercentage = target.includes('%');
    const isPlus = target.includes('+');
    const targetNumber = parseInt(target.replace(/[^\d]/g, ''));
    const duration = 2000;
    const increment = targetNumber / (duration / 16);
    let current = 0;
    
    const timer = setInterval(() => {
      current += increment;
      if (current >= targetNumber) {
        const suffix = isPercentage ? '%' : (isPlus ? '+' : '');
        element.textContent = targetNumber + suffix;
        clearInterval(timer);
      } else {
        const suffix = isPercentage ? '%' : (isPlus ? '+' : '');
        element.textContent = Math.floor(current) + suffix;
      }
    }, 16);
  }
  
  // Intersection Observer for counters
  const counters = document.querySelectorAll('.stat-number');
  const counterObserver = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        animateCounter(entry.target);
        counterObserver.unobserve(entry.target);
      }
    });
  }, { threshold: 0.5 });
  
  counters.forEach(counter => {
    counterObserver.observe(counter);
  });

  // Service card hover effects
  const serviceCards = document.querySelectorAll('.service-card');
  serviceCards.forEach(card => {
    card.addEventListener('mouseenter', function() {
      this.style.transform = 'translateY(-15px) scale(1.02)';
    });
    
    card.addEventListener('mouseleave', function() {
      this.style.transform = 'translateY(0) scale(1)';
    });
  });

  // Smooth scrolling for CTA buttons
  document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function(e) {
      e.preventDefault();
      const target = document.querySelector(this.getAttribute('href'));
      if (target) {
        const offset = 100;
        const elementPosition = target.getBoundingClientRect().top;
        const offsetPosition = elementPosition + window.pageYOffset - offset;
        
        window.scrollTo({
          top: offsetPosition,
          behavior: 'smooth'
        });
      }
    });
  });

  // Add loading animation to service icons
  const serviceIcons = document.querySelectorAll('.service-icon');
  const iconObserver = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        entry.target.style.animation = 'pulse 2s ease-in-out infinite';
        iconObserver.unobserve(entry.target);
      }
    });
  }, { threshold: 0.5 });
  
  serviceIcons.forEach(icon => {
    iconObserver.observe(icon);
  });

  // Process steps animation
  const processSteps = document.querySelectorAll('.process-step');
  processSteps.forEach((step, index) => {
    step.addEventListener('mouseenter', function() {
      this.style.transform = 'translateY(-10px)';
      this.querySelector('.process-number').style.transform = 'scale(1.2)';
    });
    
    step.addEventListener('mouseleave', function() {
      this.style.transform = 'translateY(0)';
      this.querySelector('.process-number').style.transform = 'scale(1)';
    });
  });

  // Testimonial cards stagger animation
  const testimonialCards = document.querySelectorAll('.testimonial-card');
  testimonialCards.forEach((card, index) => {
    card.style.animationDelay = `${index * 0.2}s`;
  });

  // Add parallax effect to hero section
  window.addEventListener('scroll', () => {
    const scrolled = window.pageYOffset;
    const hero = document.querySelector('.services-hero');
    if (hero) {
      const rate = scrolled * -0.5;
      hero.style.transform = `translateY(${rate}px)`;
    }
  });

  // Enhanced hover effects for testimonial cards
  testimonialCards.forEach(card => {
    card.addEventListener('mouseenter', function() {
      this.style.transform = 'translateY(-10px) scale(1.02)';
      this.style.background = 'rgba(255, 255, 255, 0.2)';
    });
    
    card.addEventListener('mouseleave', function() {
      this.style.transform = 'translateY(0) scale(1)';
      this.style.background = 'rgba(255, 255, 255, 0.1)';
    });
  });

  // CTA section animation on scroll
  const ctaSection = document.querySelector('.cta-section');
  const ctaObserver = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        entry.target.style.animation = 'slideInUp 1s ease-out';
      }
    });
  }, { threshold: 0.3 });
  
  if (ctaSection) {
    ctaObserver.observe(ctaSection);
  }
});

// Add CSS animations
const style = document.createElement('style');
style.textContent = `
  @keyframes pulse {
    0%, 100% { transform: scale(1); }
    50% { transform: scale(1.05); }
  }
  
  @keyframes slideInUp {
    from {
      opacity: 0;
      transform: translateY(30px);
    }
    to {
      opacity: 1;
      transform: translateY(0);
    }
  }
`;
document.head.appendChild(style);
</script>

@endsection