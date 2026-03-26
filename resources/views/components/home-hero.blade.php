<style>
  .pin-hero-container {
    position: absolute; inset: 0; z-index: 2; height: 100%; display: flex; flex-direction: column;
    pointer-events: none; 
  }
  .hero-slide-bg {
    position: absolute; inset: 0; background-size: cover; background-position: center;
    background-attachment: fixed; transition: transform 10s linear;
  }
  .carousel-item.active .hero-slide-bg { transform: scale(1.05); }
  .hero-overlay {
    position: absolute; inset: 0; z-index: 1;
    background: linear-gradient(to right, rgba(10,20,30,0.85) 0%, rgba(10,20,30,0.3) 50%, rgba(10,20,30,0.4) 100%);
  }
  .pin-hero-content {
    flex-grow: 1; display: flex; align-items: center; padding-top: 80px;
  }
  .pin-hero-title {
    font-size: clamp(2.5rem, 5vw, 4.5rem); font-weight: 900; color: white; margin-bottom: 0.5rem;
    line-height: 1; letter-spacing: -2px; text-shadow: 0 10px 30px rgba(0,0,0,0.3);
  }
  .pin-hero-text {
    font-size: 1rem; color: rgba(255,255,255,0.9); max-width: 400px; margin-bottom: 1.5rem;
    line-height: 1.5; text-shadow: 0 5px 15px rgba(0,0,0,0.3);
  }
  .pin-hero-link {
    color: white; font-weight: 700; text-decoration: none; display: inline-flex; align-items: center;
    border-bottom: 2px solid var(--primary-gold); padding-bottom: 5px; font-size: 1rem; transition: color 0.3s;
  }
  .pin-hero-link:hover { color: var(--primary-gold); }
  .pin-glass-card {
    background: rgba(10, 20, 30, 0.35); backdrop-filter: blur(12px); border: 1px solid rgba(255, 255, 255, 0.15);
    padding: 1.8rem 1.5rem; height: 100%; display: flex; flex-direction: column;
    transition: all 0.4s ease; border-radius: 4px; border-top: 3px solid transparent;
  }
  .pin-glass-card:hover {
    background: rgba(10, 20, 30, 0.55); transform: translateY(-5px);
    border-top: 3px solid var(--primary-gold); box-shadow: 0 15px 35px rgba(0,0,0,0.2);
  }
  .pin-glass-title { color: white; font-size: 1.25rem; font-weight: 800; margin-bottom: 0.8rem; }
  .pin-glass-text { color: rgba(255,255,255,0.7); font-size: 0.85rem; margin-bottom: 1.5rem; flex-grow: 1; line-height: 1.5; }
  .pin-glass-btn { color: white; text-decoration: none; font-size: 0.85rem; font-weight: 700; display: inline-flex; align-items: center; gap: 10px; transition: color 0.3s; }
  .pin-glass-btn:hover { color: var(--primary-gold); }
  .pin-glass-icon { width: 30px; height: 30px; border-radius: 50%; border: 1px solid rgba(255,255,255,0.4); display: flex; align-items: center; justify-content: center; font-size: 0.8rem; transition: all 0.3s; }
  .pin-glass-btn:hover .pin-glass-icon { border-color: var(--primary-gold); background: var(--primary-gold); color: var(--charcoal); }
  .pin-number-overlay { position: absolute; right: 10px; top: 5px; font-size: 3.5rem; font-weight: 900; color: transparent; -webkit-text-stroke: 1px rgba(255,255,255,0.15); z-index: 0; pointer-events: none; }
  .pin-glass-card > * { position: relative; z-index: 1; pointer-events: auto; }
  .pin-controls-bar { padding-bottom: 2rem; z-index: 10; pointer-events: auto; }
  .pin-nav-btn { width: 35px; height: 35px; border-radius: 50%; border: 1px solid var(--primary-gold); color: var(--primary-gold); display: inline-flex; align-items: center; justify-content: center; cursor: pointer; text-decoration: none; transition: all 0.3s; }
  .pin-nav-btn:hover { background: var(--primary-gold); color: var(--charcoal); }
  .pin-indicators { display: flex; gap: 10px; align-items: center; margin: 0; }
  .pin-ind-line { width: 30px; height: 3px; background: rgba(255,255,255,0.3); border: none; padding: 0; margin: 0; transition: all 0.3s; }
  .pin-ind-line.active { width: 50px; background: var(--primary-gold); }
  
  .pin-mobile-scroll {
    scrollbar-width: none; -ms-overflow-style: none; scroll-snap-type: x mandatory;
  }
  .pin-mobile-scroll::-webkit-scrollbar { display: none; }
  .pin-mobile-scroll > div { scroll-snap-align: center; }
  
  @media (max-width: 992px) {
    .pin-hero-content { padding-top: 100px; }
    .pin-controls-bar { padding-bottom: 1rem; }
  }
</style>

<div id="heroCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel" style="height: var(--hero-height, 100vh);">
  <div class="carousel-inner h-100">
    <div class="carousel-item active h-100" data-bs-interval="6000">
      <div class="hero-slide-bg" style="background-image: url('{{ asset('images/slide1.jpg') }}');"></div>
      <div class="hero-overlay"></div>
    </div>
    <div class="carousel-item h-100" data-bs-interval="6000">
      <div class="hero-slide-bg" style="background-image: url('{{ asset('images/slide2.jpg') }}');"></div>
      <div class="hero-overlay"></div>
    </div>
  </div>

  <div class="pin-hero-container">
    <div class="pin-hero-content">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-lg-5 col-md-12 mb-4 mb-lg-0 pe-lg-5" data-aos="fade-right">
             <h1 class="pin-hero-title">Overview</h1>
             <p class="pin-hero-text">Kaya Travels coordinates unforgettable vacations in harmony with nature and culture in Rwanda and across Africa's most astonishing locations.</p>
             <a href="#destinations" class="pin-hero-link">More</a>
          </div>
          <div class="col-lg-7 col-md-12">
             <div class="row g-3 flex-nowrap flex-lg-wrap overflow-auto pb-2 pin-mobile-scroll">
               <div class="col-9 col-md-5 col-lg-4" data-aos="fade-up" data-aos-delay="100">
                 <div class="pin-glass-card">
                   <div class="pin-number-overlay">01</div>
                   <h4 class="pin-glass-title">Signature<br>Tours</h4>
                   <p class="pin-glass-text">Discover breathtaking nature, historic insights, and vibrant wildlife from curated packages.</p>
                   <a href="{{ route('trips.public.index') }}" class="pin-glass-btn">
                     <div class="pin-glass-icon"><i class="bi bi-plus"></i></div> Start now
                   </a>
                 </div>
               </div>
               <div class="col-9 col-md-5 col-lg-4" data-aos="fade-up" data-aos-delay="200">
                 <div class="pin-glass-card">
                   <div class="pin-number-overlay">02</div>
                   <h4 class="pin-glass-title">Exclusive<br>Locations</h4>
                   <p class="pin-glass-text">We coordinate vacations in harmony with nature in secluded and astonishing locations.</p>
                   <a href="{{ route('destination') }}" class="pin-glass-btn">
                     <div class="pin-glass-icon"><i class="bi bi-plus"></i></div> Read More
                   </a>
                 </div>
               </div>
               <div class="col-9 col-md-5 col-lg-4" data-aos="fade-up" data-aos-delay="300">
                 <div class="pin-glass-card">
                   <div class="pin-number-overlay">03</div>
                   <h4 class="pin-glass-title">Map &<br>Amenities</h4>
                   <p class="pin-glass-text">View the map of our destinations and exclusive services included in every itinerary.</p>
                   <a href="{{ route('service') }}" class="pin-glass-btn">
                     <div class="pin-glass-icon"><i class="bi bi-plus"></i></div> Read More
                   </a>
                 </div>
               </div>
             </div>
          </div>
        </div>
      </div>
    </div>

    <div class="pin-controls-bar">
      <div class="container d-flex justify-content-between align-items-end">
        <!-- Indicators on the left -->
        <div class="pin-indicators carousel-indicators position-static">
          <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="0" class="active pin-ind-line" aria-current="true"></button>
          <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="1" class="pin-ind-line"></button>
        </div>

        <!-- Controls on the right -->
        <div class="d-flex align-items-center gap-3">
          <div class="d-flex align-items-center gap-2">
            <span class="opacity-50 text-white small fw-bold d-none d-sm-inline">Prev</span>
            <a class="pin-nav-btn" href="#heroCarousel" role="button" data-bs-slide="prev">
              <i class="bi bi-chevron-left"></i>
            </a>
          </div>
          <div class="d-flex align-items-center gap-2">
            <a class="pin-nav-btn" href="#heroCarousel" role="button" data-bs-slide="next">
              <i class="bi bi-chevron-right"></i>
            </a>
            <span class="text-white small fw-bold d-none d-sm-inline">Next</span>
          </div>
        </div>

      </div>
    </div>
  </div>
</div>
