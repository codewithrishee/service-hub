@extends('layouts.app')
@section('content')
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">

    <div class="servicehub-home">

        {{-- ═══════════════════════════════════════════════════════════
        SECTION 1 — HERO
        ═══════════════════════════════════════════════════════════ --}}
        <section class="hero-section" aria-labelledby="hero-heading">
            <div class="hero-decor" aria-hidden="true">
                <span class="decor-blob decor-blob-1"></span>
                <span class="decor-blob decor-blob-2"></span>
                <span class="decor-grid"></span>
            </div>

            <div class="container position-relative">
                <div class="row align-items-center g-5 gx-lg-5">

                    {{-- Hero Content --}}
                    <div class="col-lg-6 hero-content">
                        <span class="hero-badge">
                            <span class="hero-badge-dot" aria-hidden="true"></span>
                            Trusted Home Services
                        </span>

                        <h1 id="hero-heading" class="hero-title">
                            Professional Services.<br>
                            <span class="hero-accent">Right at Your Door.</span>
                        </h1>

                        <p class="hero-desc">
                            Book verified professionals for cleaning, repairs,
                            maintenance and more — with transparent pricing and
                            reliable service, every single time.
                        </p>

                        <div class="hero-actions">
                            <a href="{{ url('/services') }}" class="btn hero-btn-primary">
                                Book a Service
                                <i class="bi bi-arrow-right" aria-hidden="true"></i>
                            </a>
                            <a href="{{ url('/services') }}" class="btn hero-btn-ghost">
                                Explore Services
                            </a>
                        </div>

                        <div class="hero-proof">
                            <div class="hero-stars" aria-label="Rated 4.9 out of 5">
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                            </div>
                            <div class="hero-proof-text">
                                <strong>4.9/5</strong>
                                <span>from 10,000+ happy customers</span>
                            </div>
                        </div>
                    </div>

                    {{-- Hero Visual --}}
                    <div class="col-lg-6">
                        <div class="hero-visual">

                            <div class="hero-image-frame">
                                <img src="https://images.unsplash.com/photo-1581578731548-c64695cc6952?auto=format&fit=crop&w=1100&q=80"
                                    alt="Professional home service expert providing premium cleaning service"
                                    class="hero-image" loading="eager">
                                <div class="hero-image-glow" aria-hidden="true"></div>
                            </div>

                            {{-- Glass Cards --}}
                            <div class="glass-card glass-card-rating">
                                <div class="glass-icon glass-icon-amber">
                                    <i class="bi bi-star-fill" aria-hidden="true"></i>
                                </div>
                                <div>
                                    <strong>4.9</strong>
                                    <span>Customer Rating</span>
                                </div>
                            </div>

                            <div class="glass-card glass-card-services">
                                <div class="glass-icon glass-icon-indigo">
                                    <i class="bi bi-check2-circle" aria-hidden="true"></i>
                                </div>
                                <div>
                                    <strong>10K+</strong>
                                    <span>Services Completed</span>
                                </div>
                            </div>

                            <div class="glass-card glass-card-verified">
                                <div class="glass-icon glass-icon-emerald">
                                    <i class="bi bi-patch-check-fill" aria-hidden="true"></i>
                                </div>
                                <div>
                                    <strong>Verified</strong>
                                    <span>Professionals</span>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </section>

        {{-- ═══════════════════════════════════════════════════════════
        SECTION 2 — TRUST STRIP
        ═══════════════════════════════════════════════════════════ --}}
        <section class="trust-strip" aria-label="ServiceHub metrics">
            <div class="container">
                <div class="trust-grid">

                    <div class="trust-item">
                        <strong>10K+</strong>
                        <span>Services Completed</span>
                    </div>

                    <div class="trust-divider" aria-hidden="true"></div>

                    <div class="trust-item">
                        <strong>500+</strong>
                        <span>Verified Professionals</span>
                    </div>

                    <div class="trust-divider" aria-hidden="true"></div>

                    <div class="trust-item">
                        <strong>4.9/5</strong>
                        <span>Customer Rating</span>
                    </div>

                    <div class="trust-divider" aria-hidden="true"></div>

                    <div class="trust-item">
                        <strong>24/7</strong>
                        <span>Customer Support</span>
                    </div>

                </div>
            </div>
        </section>

        {{-- ═══════════════════════════════════════════════════════════
        SECTION 3 — SERVICE SEARCH
        ═══════════════════════════════════════════════════════════ --}}
        <section class="search-section" aria-labelledby="search-heading">
            <div class="container">
                <div class="search-panel">

                    <div class="search-panel-head">
                        <h2 id="search-heading" class="search-title">
                            What can we help you with?
                        </h2>
                        <p class="search-sub">
                            Find the right professional in seconds.
                        </p>
                    </div>

                    <form class="search-form" role="search" aria-label="Service search">
                        <div class="search-grid">

                            <div class="search-field">
                                <label for="search-service" class="search-label">Service</label>
                                <div class="search-input-wrap">
                                    <i class="bi bi-search" aria-hidden="true"></i>
                                    <input type="text" id="search-service" name="service" class="search-input"
                                        placeholder="Search for a service" autocomplete="off">
                                </div>
                            </div>

                            <div class="search-field">
                                <label for="search-location" class="search-label">Location</label>
                                <div class="search-input-wrap">
                                    <i class="bi bi-geo-alt" aria-hidden="true"></i>
                                    <input type="text" id="search-location" name="location" class="search-input"
                                        placeholder="Enter your location" autocomplete="off">
                                </div>
                            </div>

                            <div class="search-field search-field-action">
                                <button type="submit" class="search-btn">
                                    <i class="bi bi-search" aria-hidden="true"></i>
                                    <span>Search</span>
                                </button>
                            </div>

                        </div>
                    </form>

                    <div class="search-popular">
                        <span class="search-popular-label">Popular:</span>
                        <a href="{{ url('/services/cleaning') }}" class="search-chip">Cleaning</a>
                        <a href="{{ url('/services/ac-service') }}" class="search-chip">AC Service</a>
                        <a href="{{ url('/services/plumbing') }}" class="search-chip">Plumbing</a>
                        <a href="{{ url('/services/electrical') }}" class="search-chip">Electrical</a>
                    </div>

                </div>
            </div>
        </section>

        {{-- ═══════════════════════════════════════════════════════════
        SECTION 4 — POPULAR CATEGORIES (CAROUSEL)
        ═══════════════════════════════════════════════════════════ --}}
        <section class="categories-section" aria-labelledby="categories-heading">
            <div class="container">

                <div class="section-head section-head-split">
                    <div>
                        <span class="section-eyebrow">Categories</span>

                        <h2 id="categories-heading" class="section-title">
                            Everything Your Home Needs
                        </h2>

                        <p class="section-subtitle">
                            From everyday maintenance to deep cleaning, find trusted
                            professionals for every job.
                        </p>
                    </div>

                    <div class="carousel-nav" aria-label="Category navigation">
                        <button type="button" class="carousel-nav-btn" data-carousel-prev="categories"
                            aria-label="Previous categories">

                            <i class="bi bi-arrow-left" aria-hidden="true"></i>

                        </button>

                        <button type="button" class="carousel-nav-btn" data-carousel-next="categories"
                            aria-label="Next categories">

                            <i class="bi bi-arrow-right" aria-hidden="true"></i>

                        </button>
                    </div>
                </div>


                <div class="carousel" data-carousel="categories">

                    <div class="carousel-track category-track" role="list">

                        @forelse($categories as $category)

                            <div class="carousel-slide" role="listitem">

                                <a href="{{ route('categories.show', $category->slug) }}" class="category-card">

                                    <div class="category-icon">

                                        <i class="{{ $category->icon ?? 'bi bi-grid' }}" aria-hidden="true"></i>

                                    </div>

                                    <h3 class="category-name">
                                        {{ $category->name }}
                                    </h3>

                                    <p class="category-desc">
                                        {{ $category->description }}
                                    </p>

                                    <span class="category-arrow" aria-hidden="true">
                                        <i class="bi bi-arrow-right"></i>
                                    </span>

                                </a>

                            </div>

                        @empty

                            <div class="carousel-slide" role="listitem">

                                <div class="category-card">

                                    <div class="category-icon">

                                        <i class="bi bi-grid" aria-hidden="true"></i>

                                    </div>

                                    <h3 class="category-name">
                                        No Categories
                                    </h3>

                                    <p class="category-desc">
                                        Categories will appear here soon.
                                    </p>

                                </div>

                            </div>

                        @endforelse

                    </div>

                    <div class="carousel-dots" data-carousel-dots="categories" role="tablist"
                        aria-label="Category pagination">
                    </div>

                </div>

            </div>
        </section>

        {{-- ═══════════════════════════════════════════════════════════
        SECTION 5 — POPULAR SERVICES
        ═══════════════════════════════════════════════════════════ --}}
        <section class="services-section" aria-labelledby="services-heading">

            <div class="container">

                <div class="section-head section-head-split">

                    <div>

                        <span class="section-eyebrow">
                            Featured
                        </span>

                        <h2 id="services-heading" class="section-title">
                            Popular Services
                        </h2>

                        <p class="section-subtitle">
                            Highly rated services booked by customers near you.
                        </p>

                    </div>


                    <a href="{{ route('services.index') }}" class="section-link">

                        View all services

                        <i class="bi bi-arrow-right" aria-hidden="true"></i>

                    </a>

                </div>


                <div class="row g-4">

                    @forelse($services as $service)

                                    <div class="col-lg-4 col-md-6 d-flex">

                                        <article class="service-card">


                                            {{-- Service Image --}}

                                            <div class="service-media">

                                                @if($service->image)

                                                                    <img src="{{ str_starts_with($service->image, 'http')
                                                    ? $service->image
                                                    : asset('storage/' . $service->image)
                                                                            }}" alt="{{ $service->name }}" loading="lazy">

                                                @else

                                                    <img src="https://images.unsplash.com/photo-1600585154340-be6161a56a0c?auto=format&fit=crop&w=900&q=80"
                                                        alt="{{ $service->name }}" loading="lazy">

                                                @endif

                                            </div>


                                            {{-- Service Content --}}

                                            <div class="service-body">


                                                {{-- Rating --}}

                                                <div class="service-rating">

                                                    <i class="bi bi-star-fill" aria-hidden="true"></i>

                                                    <strong>
                                                        {{ number_format((float) $service->rating, 1) }}
                                                    </strong>

                                                    <span>
                                                        {{ number_format($service->review_count) }}
                                                        {{ $service->review_count == 1 ? 'Review' : 'Reviews' }}
                                                    </span>

                                                </div>


                                                {{-- Category --}}

                                                <span class="service-category">

                                                    {{ $service->category->name ?? 'Service' }}

                                                </span>


                                                {{-- Service Name --}}

                                                <h3 class="service-name">

                                                    {{ $service->name }}

                                                </h3>


                                                {{-- Description --}}

                                                <p class="service-desc">

                                                    {{ \Illuminate\Support\Str::limit(
                            $service->description,
                            120
                        ) }}

                                                </p>


                                                {{-- Price + Duration --}}

                                                <div class="service-meta">


                                                    <div class="service-meta-item">

                                                        <span class="service-meta-label">
                                                            Starting at
                                                        </span>

                                                        <strong class="service-price">

                                                            ₹{{ number_format($service->price, 0) }}

                                                        </strong>

                                                    </div>


                                                    <div class="service-meta-item service-meta-item-right">

                                                        <i class="bi bi-clock" aria-hidden="true"></i>

                                                        <span>

                                                            {{ $service->duration }} min

                                                        </span>

                                                    </div>

                                                </div>


                                                {{-- Actions --}}

                                                <div class="service-actions">


                                                    <a href="{{ route('services.show', $service->slug) }}" class="btn service-btn-ghost">

                                                        View Details

                                                    </a>


                                                    <a href="{{ route('booking.create', $service->slug) }}" class="btn service-btn-primary">

                                                        Book Now

                                                    </a>

                                                </div>


                                            </div>

                                        </article>

                                    </div>


                    @empty


                        {{-- No Services --}}

                        <div class="col-12">

                            <div class="text-center py-5">

                                <div class="mb-3">

                                    <i class="bi bi-grid-3x3-gap fs-1 text-muted" aria-hidden="true"></i>

                                </div>


                                <h3 class="mb-2">

                                    No Services Available

                                </h3>


                                <p class="text-muted mb-0">

                                    Services will appear here soon.

                                </p>

                            </div>

                        </div>


                    @endforelse

                </div>

            </div>

        </section>

        {{-- ═══════════════════════════════════════════════════════════
        SECTION 6 — HOW IT WORKS
        ═══════════════════════════════════════════════════════════ --}}
        <section class="how-section" aria-labelledby="how-heading">
            <div class="how-decor" aria-hidden="true">
                <span class="how-glow how-glow-1"></span>
                <span class="how-glow how-glow-2"></span>
            </div>

            <div class="container position-relative">

                <div class="section-head section-head-light">
                    <span class="section-eyebrow section-eyebrow-light">Process</span>
                    <h2 id="how-heading" class="section-title section-title-light">
                        Simple. Fast. Reliable.
                    </h2>
                    <p class="section-subtitle section-subtitle-light">
                        Booking a professional takes less than two minutes.
                    </p>
                </div>

                <div class="how-grid">

                    <div class="how-step">
                        <span class="how-number">01</span>
                        <h3 class="how-title">Choose a Service</h3>
                        <p class="how-desc">Browse services and select what you need.</p>
                    </div>

                    <div class="how-step">
                        <span class="how-number">02</span>
                        <h3 class="how-title">Pick Date &amp; Time</h3>
                        <p class="how-desc">Choose a slot that suits your schedule.</p>
                    </div>

                    <div class="how-step">
                        <span class="how-number">03</span>
                        <h3 class="how-title">Confirm Booking</h3>
                        <p class="how-desc">Review details and confirm securely.</p>
                    </div>

                    <div class="how-step">
                        <span class="how-number">04</span>
                        <h3 class="how-title">Relax — We've Got It</h3>
                        <p class="how-desc">Your professional arrives at your doorstep.</p>
                    </div>

                </div>
            </div>
        </section>

        {{-- ═══════════════════════════════════════════════════════════
        SECTION 7 — WHY SERVICEHUB
        ═══════════════════════════════════════════════════════════ --}}
        <section class="why-section" aria-labelledby="why-heading">
            <div class="container">
                <div class="row g-5 align-items-start">

                    {{-- Editorial Left --}}
                    <div class="col-lg-5 why-editorial">
                        <span class="section-eyebrow">Why ServiceHub</span>
                        <h2 id="why-heading" class="section-title">
                            Quality Service,<br>
                            Without the Hassle.
                        </h2>
                        <p class="section-subtitle">
                            We built ServiceHub to make hiring a trusted professional
                            as simple as ordering a ride. No haggling, no surprises —
                            just vetted experts, upfront pricing and service you can rely on.
                        </p>
                        <a href="{{ url('/about') }}" class="why-link">
                            Why ServiceHub
                            <i class="bi bi-arrow-right" aria-hidden="true"></i>
                        </a>
                    </div>

                    {{-- Feature Blocks --}}
                    <div class="col-lg-7">
                        <div class="why-grid">

                            <div class="why-block">
                                <div class="why-block-icon">
                                    <i class="bi bi-patch-check" aria-hidden="true"></i>
                                </div>
                                <div>
                                    <h3 class="why-block-title">Verified Professionals</h3>
                                    <p class="why-block-desc">
                                        Every professional is background-checked and skill-verified.
                                    </p>
                                </div>
                            </div>

                            <div class="why-block">
                                <div class="why-block-icon">
                                    <i class="bi bi-cash-coin" aria-hidden="true"></i>
                                </div>
                                <div>
                                    <h3 class="why-block-title">Transparent Pricing</h3>
                                    <p class="why-block-desc">
                                        See the full price before you book — no hidden charges.
                                    </p>
                                </div>
                            </div>

                            <div class="why-block">
                                <div class="why-block-icon">
                                    <i class="bi bi-shield-lock" aria-hidden="true"></i>
                                </div>
                                <div>
                                    <h3 class="why-block-title">Secure Booking</h3>
                                    <p class="why-block-desc">
                                        Your data and payments are protected end-to-end.
                                    </p>
                                </div>
                            </div>

                            <div class="why-block">
                                <div class="why-block-icon">
                                    <i class="bi bi-headset" aria-hidden="true"></i>
                                </div>
                                <div>
                                    <h3 class="why-block-title">Reliable Support</h3>
                                    <p class="why-block-desc">
                                        Real humans, ready to help — before, during and after.
                                    </p>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </section>

        {{-- ═══════════════════════════════════════════════════════════
        SECTION 8 — PREMIUM PROMO BANNER
        ═══════════════════════════════════════════════════════════ --}}
        <section class="promo-section" aria-labelledby="promo-heading">
            <div class="container">
                <div class="promo-banner">

                    <img src="https://images.unsplash.com/photo-1600607687939-ce8a6c25118c?auto=format&fit=crop&w=1600&q=80"
                        alt="" class="promo-bg" loading="lazy" aria-hidden="true">
                    <div class="promo-overlay" aria-hidden="true"></div>

                    <div class="promo-content">
                        <h2 id="promo-heading" class="promo-title">
                            Your Home Deserves Better Care.
                        </h2>
                        <p class="promo-desc">
                            Book trusted professionals and get the job done right —
                            without the hassle.
                        </p>
                        <a href="{{ url('/service') }}" class="btn promo-btn">
                            Book a Service
                            <i class="bi bi-arrow-right" aria-hidden="true"></i>
                        </a>
                        <p class="promo-trust">
                            No hidden charges
                            <span aria-hidden="true">•</span>
                            Verified professionals
                            <span aria-hidden="true">•</span>
                            Secure booking
                        </p>
                    </div>

                </div>
            </div>
        </section>

        {{-- ═══════════════════════════════════════════════════════════
        SECTION 9 — TESTIMONIALS (CAROUSEL)
        ═══════════════════════════════════════════════════════════ --}}
        <section class="testimonials-section" aria-labelledby="testimonials-heading">
            <div class="container">

                <div class="section-head section-head-split">
                    <div>
                        <span class="section-eyebrow">Testimonials</span>
                        <h2 id="testimonials-heading" class="section-title">
                            Loved by Homeowners
                        </h2>
                        <p class="section-subtitle">
                            Real experiences from customers who trust ServiceHub.
                        </p>
                    </div>

                    <div class="carousel-nav" aria-label="Testimonial navigation">
                        <button type="button" class="carousel-nav-btn" data-carousel-prev="testimonials"
                            aria-label="Previous testimonials">
                            <i class="bi bi-arrow-left" aria-hidden="true"></i>
                        </button>
                        <button type="button" class="carousel-nav-btn" data-carousel-next="testimonials"
                            aria-label="Next testimonials">
                            <i class="bi bi-arrow-right" aria-hidden="true"></i>
                        </button>
                    </div>
                </div>

                <div class="carousel" data-carousel="testimonials" data-carousel-autoplay="6000">
                    <div class="carousel-track testimonial-track" role="list">

                        <div class="carousel-slide" role="listitem">
                            <article class="testimonial-card">
                                <div class="testimonial-quote" aria-hidden="true">
                                    <i class="bi bi-quote"></i>
                                </div>
                                <div class="testimonial-stars" aria-label="Rated 5 out of 5">
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                </div>
                                <p class="testimonial-text">
                                    "Booking was incredibly easy. The professional arrived
                                    exactly on time and the service quality was excellent.
                                    My apartment has never looked better."
                                </p>
                                <div class="testimonial-author">
                                    <div class="testimonial-avatar" aria-hidden="true">RS</div>
                                    <div class="testimonial-author-info">
                                        <strong>Rahul Sharma</strong>
                                        <span>Mumbai, MH</span>
                                    </div>
                                </div>
                                <div class="testimonial-service">
                                    <i class="bi bi-check2-circle" aria-hidden="true"></i>
                                    Full Home Deep Cleaning
                                </div>
                            </article>
                        </div>

                        <div class="carousel-slide" role="listitem">
                            <article class="testimonial-card">
                                <div class="testimonial-quote" aria-hidden="true">
                                    <i class="bi bi-quote"></i>
                                </div>
                                <div class="testimonial-stars" aria-label="Rated 5 out of 5">
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                </div>
                                <p class="testimonial-text">
                                    "The AC technician was professional, punctual and
                                    explained everything clearly. Transparent pricing and
                                    no upselling — exactly what I hoped for."
                                </p>
                                <div class="testimonial-author">
                                    <div class="testimonial-avatar" aria-hidden="true">PM</div>
                                    <div class="testimonial-author-info">
                                        <strong>Priya Mehta</strong>
                                        <span>Bengaluru, KA</span>
                                    </div>
                                </div>
                                <div class="testimonial-service">
                                    <i class="bi bi-check2-circle" aria-hidden="true"></i>
                                    AC Service &amp; Repair
                                </div>
                            </article>
                        </div>

                        <div class="carousel-slide" role="listitem">
                            <article class="testimonial-card">
                                <div class="testimonial-quote" aria-hidden="true">
                                    <i class="bi bi-quote"></i>
                                </div>
                                <div class="testimonial-stars" aria-label="Rated 5 out of 5">
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                </div>
                                <p class="testimonial-text">
                                    "I had an urgent leak and the plumber arrived within
                                    two hours. Fixed quickly and cleaned up after. Truly
                                    reliable — I've since booked them three more times."
                                </p>
                                <div class="testimonial-author">
                                    <div class="testimonial-avatar" aria-hidden="true">AK</div>
                                    <div class="testimonial-author-info">
                                        <strong>Arjun Kapoor</strong>
                                        <span>Delhi, DL</span>
                                    </div>
                                </div>
                                <div class="testimonial-service">
                                    <i class="bi bi-check2-circle" aria-hidden="true"></i>
                                    Plumbing Repair
                                </div>
                            </article>
                        </div>

                        <div class="carousel-slide" role="listitem">
                            <article class="testimonial-card">
                                <div class="testimonial-quote" aria-hidden="true">
                                    <i class="bi bi-quote"></i>
                                </div>
                                <div class="testimonial-stars" aria-label="Rated 5 out of 5">
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                    <i class="bi bi-star-fill"></i>
                                </div>
                                <p class="testimonial-text">
                                    "The electrician diagnosed the issue in minutes and
                                    fixed it the same visit. Fair pricing, polite
                                    behaviour, and clean work. Highly recommend."
                                </p>
                                <div class="testimonial-author">
                                    <div class="testimonial-avatar" aria-hidden="true">SN</div>
                                    <div class="testimonial-author-info">
                                        <strong>Sneha Nair</strong>
                                        <span>Pune, MH</span>
                                    </div>
                                </div>
                                <div class="testimonial-service">
                                    <i class="bi bi-check2-circle" aria-hidden="true"></i>
                                    Electrician Visit
                                </div>
                            </article>
                        </div>

                    </div>

                    <div class="carousel-dots" data-carousel-dots="testimonials" role="tablist"
                        aria-label="Testimonial pagination"></div>
                </div>
            </div>
        </section>

        {{-- ═══════════════════════════════════════════════════════════
        SECTION 10 — FINAL CTA
        ═══════════════════════════════════════════════════════════ --}}
        <section class="final-cta-section" aria-labelledby="final-heading">
            <div class="final-cta-decor" aria-hidden="true">
                <span class="final-blob final-blob-1"></span>
                <span class="final-blob final-blob-2"></span>
            </div>

            <div class="container position-relative">
                <div class="final-cta">

                    <span class="final-eyebrow">Get Started Today</span>

                    <h2 id="final-heading" class="final-title">
                        Ready to Get Things Done?
                    </h2>

                    <p class="final-desc">
                        Find trusted professionals and book your service in just
                        a few clicks.
                    </p>

                    <div class="final-actions">
                        <a href="{{ url('/book') }}" class="btn final-btn-primary">
                            Book a Service
                            <i class="bi bi-arrow-right" aria-hidden="true"></i>
                        </a>
                        <a href="{{ url('/services') }}" class="btn final-btn-ghost">
                            Explore Services
                        </a>
                    </div>

                </div>
            </div>
        </section>

    </div>

    <script src="{{ asset('js/home.js') }}"></script>

@endsection