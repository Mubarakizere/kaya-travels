@extends('layouts.public')

@section('title', 'Contact Us | Kaya Travels')

@section('meta')
<meta name="description" content="Get in touch with Kaya Travels. We are here to help you plan your next unforgettable journey.">
@endsection

@section('content')
<style>
  :root {
    --hero-height: 50vh;
  }

  /* Contact Hero Section */
  .contact-hero {
    height: var(--hero-height);
    background-size: cover;
    background-position: center;
    background-attachment: fixed;
    position: relative;
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: hidden;
  }

  .contact-hero::before {
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

  .contact-hero .container {
    position: relative;
    z-index: 2;
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
    font-size: 4rem;
    font-weight: 800;
    line-height: 1.1;
    margin-bottom: 1.5rem;
    background: linear-gradient(135deg, #ffffff 0%, var(--primary-gold) 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
  }

  /* Contact Cards Section */
  .contact-info-section {
    padding: 5rem 0;
    background: var(--light-bg);
    position: relative;
    z-index: 10;
    margin-top: -80px;
  }

  .info-card {
    background: white;
    border-radius: 20px;
    padding: 2.5rem 2rem;
    text-align: center;
    box-shadow: var(--shadow-soft);
    border: 1px solid rgba(0, 0, 0, 0.03);
    height: 100%;
    transition: var(--transition);
    position: relative;
    overflow: hidden;
  }

  .info-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 4px;
    background: var(--primary-gold);
    transform: scaleX(0);
    transition: var(--transition);
    transform-origin: left;
  }

  .info-card:hover {
    transform: translateY(-10px);
    box-shadow: var(--shadow-medium);
  }

  .info-card:hover::before {
    transform: scaleX(1);
  }

  .icon-wrapper {
    width: 80px;
    height: 80px;
    background: rgba(244, 208, 63, 0.1);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 1.5rem;
    color: var(--primary-gold);
    font-size: 2rem;
    transition: var(--transition);
  }

  .info-card:hover .icon-wrapper {
    background: var(--primary-gold);
    color: white;
    transform: scale(1.1);
  }

  .info-title {
    font-size: 1.25rem;
    font-weight: 800;
    color: var(--charcoal);
    margin-bottom: 1rem;
  }

  .info-content {
    color: var(--charcoal-lighter);
    margin-bottom: 0;
    line-height: 1.6;
    font-size: 1rem;
  }

  .info-content a {
    color: var(--charcoal-lighter);
    text-decoration: none;
    transition: var(--transition);
  }

  .info-content a:hover {
    color: var(--primary-gold);
  }

  /* Form Section */
  .contact-form-section {
    padding: 5rem 0;
    background: white;
  }

  .section-tag {
    color: var(--primary-gold);
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 2px;
    font-size: 0.9rem;
    margin-bottom: 1rem;
    display: block;
  }

  .section-title {
    font-size: 2.5rem;
    font-weight: 800;
    color: var(--charcoal);
    margin-bottom: 1.5rem;
  }

  .form-group-custom label {
    font-weight: 600;
    color: var(--charcoal);
    margin-bottom: 8px;
    display: flex;
    align-items: center;
    gap: 8px;
    font-size: 0.95rem;
  }

  .form-group-custom label i {
    color: var(--primary-gold);
  }

  .form-control-custom, .form-select-custom {
    border: 1px solid #e2e8f0;
    background: #f8fafc;
    border-radius: 12px;
    padding: 14px 20px;
    font-size: 1rem;
    width: 100%;
    transition: var(--transition);
    color: var(--charcoal);
  }

  .form-control-custom:focus, .form-select-custom:focus {
    outline: none;
    border-color: var(--primary-gold);
    background: white;
    box-shadow: 0 0 0 4px rgba(244, 208, 63, 0.1);
  }

  textarea.form-control-custom {
    resize: vertical;
    min-height: 150px;
  }

  /* FAQ Accordion */
  .accordion-item {
    border: 1px solid #e2e8f0;
    border-radius: 16px !important;
    margin-bottom: 1rem;
    overflow: hidden;
    background: white;
    box-shadow: var(--shadow-soft);
  }

  .accordion-button {
    font-weight: 700;
    color: var(--charcoal);
    padding: 1.25rem 1.5rem;
    background: white;
    box-shadow: none !important;
  }

  .accordion-button:not(.collapsed) {
    background: #f8fafc;
    color: var(--primary-gold);
  }

  .accordion-button::after {
    filter: grayscale(1);
    transition: var(--transition);
  }

  .accordion-button:not(.collapsed)::after {
    filter: invert(79%) sepia(35%) saturate(1006%) hue-rotate(344deg) brightness(101%) contrast(93%); /* approx gold hue */
  }

  .accordion-body {
    padding: 1.5rem;
    color: var(--charcoal-lighter);
    line-height: 1.7;
    background: white;
    border-top: 1px solid #e2e8f0;
  }

  /* Social Icons */
  .social-icon-box {
    width: 45px;
    height: 45px;
    background: #f8fafc;
    border: 1px solid #e2e8f0;
    border-radius: 50%;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    color: var(--charcoal);
    font-size: 1.2rem;
    transition: var(--transition);
    text-decoration: none;
  }

  .social-icon-box:hover {
    background: var(--primary-gold);
    color: white;
    border-color: var(--primary-gold);
    transform: translateY(-3px);
  }

  /* Map Section */
  .map-container {
    border-radius: 20px;
    overflow: hidden;
    box-shadow: var(--shadow-medium);
    height: 500px;
    position: relative;
  }

  .map-container iframe {
    width: 100%;
    height: 100%;
    border: 0;
    filter: grayscale(20%);
    transition: var(--transition);
  }

  .map-container:hover iframe {
    filter: grayscale(0%);
  }
</style>

<!-- Hero Section -->
<section class="contact-hero" style="background-image: url('{{ asset('images/contact-hero.jpg') }}');">
  <div class="container text-center">
    <div data-aos="fade-up">
      <div class="hero-badge">
        <i class="bi bi-chat-dots me-2"></i>Get In Touch
      </div>
      <h1 class="hero-title">Let's Connect</h1>
      <p class="text-white opacity-75 fs-5 max-w-2xl mx-auto">Ready to plan your next adventure? We're here to make your travel dreams come true.</p>
    </div>
  </div>
</section>

<!-- Contact Info Cards -->
<section class="contact-info-section">
  <div class="container">
    <div class="row g-4 justify-content-center">
      <!-- Phone -->
      <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
        <div class="info-card">
          <div class="icon-wrapper">
            <i class="bi bi-telephone"></i>
          </div>
          <h3 class="info-title">Phone Support</h3>
          <p class="info-content">
            <a href="tel:+250789007076" class="d-block text-dark fw-bold fs-5 mb-1">+250 789 007 076</a>
            <span class="text-muted d-block small">Available 24/7 for emergencies</span>
          </p>
          <a href="tel:+250789007076" class="btn btn-outline-dark rounded-pill mt-4 px-4 btn-sm fw-bold">Call Now</a>
        </div>
      </div>

      <!-- Email -->
      <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
        <div class="info-card">
          <div class="icon-wrapper">
            <i class="bi bi-envelope"></i>
          </div>
          <h3 class="info-title">Email Us</h3>
          <p class="info-content">
            <a href="mailto:info@kayatravels.rw" class="d-block text-dark fw-bold fs-5 mb-1">info@kayatravels.rw</a>
            <span class="text-muted d-block small">We reply within 2 hours</span>
          </p>
          <a href="mailto:info@kayatravels.rw" class="btn btn-outline-dark rounded-pill mt-4 px-4 btn-sm fw-bold">Send Email</a>
        </div>
      </div>

      <!-- Location -->
      <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
        <div class="info-card">
          <div class="icon-wrapper">
            <i class="bi bi-geo-alt"></i>
          </div>
          <h3 class="info-title">Visit Office</h3>
          <p class="info-content">
            <span class="d-block text-dark fw-bold fs-5 mb-1">Kigali, Rwanda</span>
            <span class="text-muted d-block small">Heart of East Africa</span>
          </p>
          <a href="#map-section" class="btn btn-outline-dark rounded-pill mt-4 px-4 btn-sm fw-bold">View Map</a>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Message & FAQ Section -->
<section class="contact-form-section">
  <div class="container">
    <div class="row g-5">
      
      <!-- Contact Form -->
      <div class="col-lg-7" data-aos="fade-right">
        <span class="section-tag">Send a Message</span>
        <h2 class="section-title">How can we help you?</h2>
        <p class="text-muted mb-4 fs-5">Fill out the form below and our travel experts will get back to you shortly.</p>
        
        <form action="{{ route('contact.submit') }}" method="POST" class="contact-form">
          @csrf
          <div class="row g-4">
            <div class="col-md-6">
              <div class="form-group-custom">
                <label for="name"><i class="bi bi-person"></i> Full Name *</label>
                <input type="text" name="name" id="name" class="form-control-custom" placeholder="John Doe" required>
              </div>
            </div>
            
            <div class="col-md-6">
              <div class="form-group-custom">
                <label for="email"><i class="bi bi-envelope"></i> Email Address *</label>
                <input type="email" name="email" id="email" class="form-control-custom" placeholder="john@example.com" required>
              </div>
            </div>
            
            <div class="col-md-6">
              <div class="form-group-custom">
                <label for="phone"><i class="bi bi-telephone"></i> Phone Number</label>
                <input type="tel" name="phone" id="phone" class="form-control-custom" placeholder="+250 123 456 789">
              </div>
            </div>
            
            <div class="col-md-6">
              <div class="form-group-custom">
                <label for="subject"><i class="bi bi-tag"></i> Subject</label>
                <select name="subject" id="subject" class="form-select-custom">
                  <option value="">Select a topic</option>
                  <option value="booking">Flight Booking</option>
                  <option value="package">Travel Package</option>
                  <option value="corporate">Corporate Travel</option>
                  <option value="support">Customer Support</option>
                  <option value="general">General Inquiry</option>
                </select>
              </div>
            </div>
            
            <div class="col-12">
              <div class="form-group-custom">
                <label for="message"><i class="bi bi-chat-dots"></i> Message *</label>
                <textarea name="message" id="message" class="form-control-custom" placeholder="Tell us about your travel plans..." required></textarea>
              </div>
            </div>

            <div class="col-12">
              <div class="form-check">
                <input class="form-check-input" type="checkbox" id="newsletter" name="newsletter" style="accent-color: var(--primary-gold);">
                <label class="form-check-label text-muted ms-2" for="newsletter">
                  Subscribe to our newsletter for travel deals and updates
                </label>
              </div>
            </div>
            
            <div class="col-12 mt-4">
              <button type="submit" class="btn-gold w-100 py-3 d-flex align-items-center justify-content-center gap-2" style="font-size: 1.1rem;">
                <i class="bi bi-send"></i> Send Message
              </button>
            </div>
          </div>
        </form>
      </div>

      <!-- FAQ & Details -->
      <div class="col-lg-5" data-aos="fade-left">
        <div class="mb-5">
          <span class="section-tag">FAQ</span>
          <h2 class="section-title h3">Common Questions</h2>
          
          <div class="accordion" id="faqAccordion">
            <div class="accordion-item">
              <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq1">
                  How quickly do you respond?
                </button>
              </h2>
              <div id="faq1" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                  We typically respond to all inquiries within 2 hours during regular business hours. For immediate assistance, we recommend calling our support line or reaching out via WhatsApp.
                </div>
              </div>
            </div>

            <div class="accordion-item">
              <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq2">
                  What payment methods do you accept?
                </button>
              </h2>
              <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                  We accept major credit cards (Visa, Mastercard), Mobile Money (MTN, Airtel), reliable bank transfers, and cash payments at our Kigali office.
                </div>
              </div>
            </div>

            <div class="accordion-item">
              <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq3">
                  How far in advance should I book?
                </button>
              </h2>
              <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                <div class="accordion-body">
                  For the best availability and pricing, we strongly recommend booking international flights and special packages at least 3-4 weeks in advance.
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="bg-light rounded-4 p-4 mt-4">
          <h4 class="fw-bold mb-4 flex align-items-center gap-2 border-bottom pb-3">
            <i class="bi bi-clock-history text-primary-gold"></i> Business Hours
          </h4>
          <ul class="list-unstyled mb-0">
            <li class="d-flex justify-content-between mb-2">
              <span class="text-muted fw-semibold">Mon - Fri:</span>
              <span class="text-dark fw-bold">8:00 AM - 6:00 PM</span>
            </li>
            <li class="d-flex justify-content-between mb-2">
              <span class="text-muted fw-semibold">Saturday:</span>
              <span class="text-dark fw-bold">9:00 AM - 4:00 PM</span>
            </li>
            <li class="d-flex justify-content-between mb-2">
              <span class="text-muted fw-semibold">Sunday:</span>
              <span class="text-dark fw-bold">10:00 AM - 2:00 PM</span>
            </li>
            <li class="d-flex justify-content-between mt-3 pt-3 border-top border-secondary opacity-25"></li>
            <li class="d-flex justify-content-between pt-1">
              <span class="text-muted fw-semibold">Emergency:</span>
              <span class="text-success fw-bold"><i class="bi bi-circle-fill small me-1"></i>24/7 Available</span>
            </li>
          </ul>
        </div>
        
        <div class="mt-4 pt-2">
          <h5 class="fw-bold mb-3">Connect With Us</h5>
          <div class="d-flex gap-2">
            <a href="#" class="social-icon-box"><i class="bi bi-facebook"></i></a>
            <a href="#" class="social-icon-box"><i class="bi bi-instagram"></i></a>
            <a href="#" class="social-icon-box"><i class="bi bi-linkedin"></i></a>
            <a href="https://wa.me/250789007076" class="social-icon-box" target="_blank"><i class="bi bi-whatsapp"></i></a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Map Section -->
<section id="map-section" class="py-5 bg-light">
  <div class="container">
    <div class="text-center mb-5" data-aos="fade-up">
      <h2 class="section-title">Visit Our Location</h2>
      <p class="text-muted max-w-2xl mx-auto">Drop by our main office in Kigali. We're always happy to welcome travelers and help you plan your next big journey in person.</p>
    </div>
    <div class="map-container" data-aos="zoom-in" data-aos-delay="100">
      <iframe
        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3979.8583549459563!2d30.061956075710264!3d-1.9448011980299866!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x19dca6de9c2a1e91%3A0xbd0470be26f580f4!2sKigali%2C%20Rwanda!5e0!3m2!1sen!2srw!4v1716882478740!5m2!1sen!2srw"
        allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
      </iframe>
    </div>
  </div>
</section>

<!-- Custom Utilities -->
<script>
  // Phone number formatter
  const phoneInput = document.getElementById('phone');
  if (phoneInput) {
    phoneInput.addEventListener('input', function(e) {
      let value = e.target.value.replace(/\D/g, '');
      if (value.startsWith('250')) {
        value = value.substring(0, 12);
        e.target.value = '+' + value.replace(/(\d{3})(\d{3})(\d{3})(\d{3})/, '$1 $2 $3 $4');
      }
    });
  }
</script>

@endsection