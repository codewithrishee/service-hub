{{-- resources/views/about.blade.php --}}
@extends('layouts.app')

@section('content')

<link rel="stylesheet" href="{{ asset('css/about.css') }}">

<div class="servicehub-about-page">

    {{-- ============================================================
         SECTION 1 — CINEMATIC HERO (Full Background)
    ============================================================ --}}
    <section class="ab-hero">
        <div class="ab-hero-bg"
             style="background-image: url('https://images.unsplash.com/photo-1581578731548-c64695cc6952?auto=format&fit=crop&w=2000&q=80');"
             role="img"
             aria-label="Professional home-service provider working in a modern home">
        </div>
        <div class="ab-hero-overlay"></div>

        <div class="container ab-hero-container">
            <div class="ab-hero-center">

                <span class="ab-eyebrow ab-eyebrow-light">About ServiceHub</span>

                <h1 class="ab-hero-title">
                    We're Making Everyday Services Simpler.
                </h1>

                <p class="ab-hero-subtitle">
                    ServiceHub brings trusted services, convenient booking and
                    better experiences together in one simple platform.
                </p>

                <div class="ab-hero-actions">
                    <a href="#" class="ab-btn ab-btn-primary">
                        Explore Services
                        <i class="bi bi-arrow-right"></i>
                    </a>
                    <a href="#" class="ab-btn ab-btn-ghost">
                        Book a Service
                    </a>
                </div>

                <p class="ab-hero-trust">
                    Built around people. Designed for convenience.
                </p>

            </div>
        </div>
    </section>


    {{-- ============================================================
         SECTION 2 — OUR STORY (Image Left + Content Right)
    ============================================================ --}}
    <section class="ab-story">
        <div class="container">
            <div class="ab-story-layout">

                {{-- LEFT — Premium Story Image --}}
                <div class="ab-story-visual">
                    <div class="ab-story-image-wrap">
                        <img
                            src="https://images.unsplash.com/photo-1600880292203-757bb62b4baf?auto=format&fit=crop&w=1200&q=80"
                            alt="A ServiceHub professional helping a homeowner in a modern living room"
                            class="ab-story-image"
                            loading="lazy"
                        >
                    </div>
                    <div class="ab-story-deco-ring"></div>
                    <div class="ab-story-deco-dot"></div>
                </div>

                {{-- RIGHT — Story Content --}}
                <div class="ab-story-content">
                    <span class="ab-eyebrow">Our Story</span>

                    <h2 class="ab-story-title">
                        A Better Way to Get Things Done.
                    </h2>

                    <p class="ab-story-lead">
                        ServiceHub was created to remove the friction from finding
                        and booking everyday services.
                    </p>

                    <p class="ab-story-body">
                        Customers shouldn't have to spend unnecessary time searching
                        for professionals, comparing confusing information or dealing
                        with complicated booking processes.
                    </p>

                    <p class="ab-story-body">
                        ServiceHub brings discovery, booking and the service
                        experience together in one convenient platform — so taking
                        care of your home feels as simple as it should.
                    </p>

                    <a href="#" class="ab-story-cta">
                        Explore Services
                        <i class="bi bi-arrow-right"></i>
                    </a>

                    <div class="ab-story-meta">
                        <div class="ab-story-meta-item">
                            <span class="ab-story-meta-value">One</span>
                            <span class="ab-story-meta-label">platform for everything</span>
                        </div>
                        <div class="ab-story-meta-item">
                            <span class="ab-story-meta-value">Zero</span>
                            <span class="ab-story-meta-label">unnecessary complexity</span>
                        </div>
                        <div class="ab-story-meta-item">
                            <span class="ab-story-meta-value">Hundreds</span>
                            <span class="ab-story-meta-label">of trusted professionals</span>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>


    {{-- ============================================================
         SECTION 3 — MISSION (Dark Manifesto)
    ============================================================ --}}
    <!-- <section class="ab-mission">
        <div class="ab-mission-texture"></div>
        <div class="container ab-mission-container">

            <div class="ab-mission-inner">
                <span class="ab-eyebrow ab-eyebrow-light">Our Mission</span>

                <h2 class="ab-mission-statement">
                    Make quality services easier to
                    <span class="ab-mission-accent">discover</span>, easier to
                    <span class="ab-mission-accent">book</span> and easier to
                    <span class="ab-mission-accent">trust</span>.
                </h2>

                <p class="ab-mission-support">
                    Our mission is to simplify everyday service experiences by
                    bringing convenience, transparency and reliability together
                    in one place.
                </p>

                <div class="ab-mission-principles">
                    <div class="ab-principle">
                        <span class="ab-principle-marker"></span>
                        <span class="ab-principle-label">Convenience</span>
                    </div>
                    <div class="ab-principle">
                        <span class="ab-principle-marker"></span>
                        <span class="ab-principle-label">Transparency</span>
                    </div>
                    <div class="ab-principle">
                        <span class="ab-principle-marker"></span>
                        <span class="ab-principle-label">Reliability</span>
                    </div>
                </div>
            </div>

        </div>
    </section> -->


    {{-- ============================================================
         SECTION 4 — VISION (Immersive image)
    ============================================================ --}}
    <section class="ab-vision">
        <div class="ab-vision-bg"
             style="background-image: url('https://images.unsplash.com/photo-1600880292203-757bb62b4baf?auto=format&fit=crop&w=2000&q=80');"
             role="img"
             aria-label="A homeowner and professional discussing a service plan">
        </div>
        <div class="ab-vision-overlay"></div>

        <div class="container ab-vision-container">
            <div class="ab-vision-inner">
                <span class="ab-eyebrow ab-eyebrow-light">Our Vision</span>
                <h2 class="ab-vision-title">
                    A World Where Getting Help Is Effortless.
                </h2>
                <p class="ab-vision-text">
                    We're building a trusted digital ecosystem where people can
                    discover, schedule and manage the services they need —
                    without unnecessary complexity.
                </p>
                <a href="#" class="ab-vision-link">
                    Discover ServiceHub
                    <i class="bi bi-arrow-right"></i>
                </a>
            </div>
        </div>
    </section>


    {{-- ============================================================
         SECTION 5 — WHAT WE BELIEVE IN
    ============================================================ --}}
    <section class="ab-beliefs">
        <div class="container">

            <div class="ab-beliefs-header">
                <span class="ab-eyebrow">Our Values</span>
                <h2 class="ab-beliefs-title">What We Believe In</h2>
                <p class="ab-beliefs-subhead">
                    Four principles that guide how we build and grow ServiceHub.
                </p>
            </div>

            <div class="ab-beliefs-grid">

                <article class="ab-belief">
                    <div class="ab-belief-icon">
                        <i class="bi bi-shield-check"></i>
                    </div>
                    <div class="ab-belief-body">
                        <h3 class="ab-belief-title">Trust</h3>
                        <p class="ab-belief-text">
                            People should feel confident about the professionals
                            they invite into their homes.
                        </p>
                    </div>
                </article>

                <article class="ab-belief">
                    <div class="ab-belief-icon">
                        <i class="bi bi-lightning-charge"></i>
                    </div>
                    <div class="ab-belief-body">
                        <h3 class="ab-belief-title">Simplicity</h3>
                        <p class="ab-belief-text">
                            Booking a service should feel effortless.
                        </p>
                    </div>
                </article>

                <article class="ab-belief">
                    <div class="ab-belief-icon">
                        <i class="bi bi-eye"></i>
                    </div>
                    <div class="ab-belief-body">
                        <h3 class="ab-belief-title">Transparency</h3>
                        <p class="ab-belief-text">
                            Customers should clearly understand what they are booking.
                        </p>
                    </div>
                </article>

                <article class="ab-belief">
                    <div class="ab-belief-icon">
                        <i class="bi bi-award"></i>
                    </div>
                    <div class="ab-belief-body">
                        <h3 class="ab-belief-title">Quality</h3>
                        <p class="ab-belief-text">
                            Every interaction should contribute to a better service
                            experience.
                        </p>
                    </div>
                </article>

            </div>
        </div>
    </section>


    {{-- ============================================================
         SECTION 6 — HOW WE'RE DIFFERENT
    ============================================================ --}}
    <section class="ab-different">
        <div class="container">
            <div class="ab-different-layout">

                <div class="ab-different-copy">
                    <span class="ab-eyebrow">How We're Different</span>
                    <h2 class="ab-different-title">
                        Technology That Serves People.
                    </h2>
                    <p class="ab-different-lead">
                        ServiceHub combines thoughtful technology with a
                        customer-first approach — making every step of the
                        experience simpler, clearer and more reliable.
                    </p>

                    <ul class="ab-different-list">
                        <li class="ab-different-item">
                            <span class="ab-different-bullet">
                                <i class="bi bi-check-lg"></i>
                            </span>
                            <span>Simple service discovery</span>
                        </li>
                        <li class="ab-different-item">
                            <span class="ab-different-bullet">
                                <i class="bi bi-check-lg"></i>
                            </span>
                            <span>Convenient scheduling</span>
                        </li>
                        <li class="ab-different-item">
                            <span class="ab-different-bullet">
                                <i class="bi bi-check-lg"></i>
                            </span>
                            <span>Clear service information</span>
                        </li>
                        <li class="ab-different-item">
                            <span class="ab-different-bullet">
                                <i class="bi bi-check-lg"></i>
                            </span>
                            <span>Booking management</span>
                        </li>
                        <li class="ab-different-item">
                            <span class="ab-different-bullet">
                                <i class="bi bi-check-lg"></i>
                            </span>
                            <span>Customer-focused experience</span>
                        </li>
                    </ul>
                </div>

                {{-- UI inspired visual mock --}}
                <div class="ab-different-visual">
                    <div class="ab-ui-card">
                        <div class="ab-ui-card-header">
                            <span class="ab-ui-dot"></span>
                            <span class="ab-ui-dot"></span>
                            <span class="ab-ui-dot"></span>
                        </div>
                        <div class="ab-ui-card-body">

                            <div class="ab-ui-row">
                                <div class="ab-ui-icon ab-ui-icon-primary">
                                    <i class="bi bi-search"></i>
                                </div>
                                <div class="ab-ui-lines">
                                    <span class="ab-ui-line ab-ui-line-lg"></span>
                                    <span class="ab-ui-line ab-ui-line-sm"></span>
                                </div>
                                <span class="ab-ui-chip">Found</span>
                            </div>

                            <div class="ab-ui-row">
                                <div class="ab-ui-icon ab-ui-icon-soft">
                                    <i class="bi bi-calendar-check"></i>
                                </div>
                                <div class="ab-ui-lines">
                                    <span class="ab-ui-line ab-ui-line-lg"></span>
                                    <span class="ab-ui-line ab-ui-line-sm"></span>
                                </div>
                                <span class="ab-ui-chip ab-ui-chip-soft">Booked</span>
                            </div>

                            <div class="ab-ui-row">
                                <div class="ab-ui-icon ab-ui-icon-primary">
                                    <i class="bi bi-patch-check"></i>
                                </div>
                                <div class="ab-ui-lines">
                                    <span class="ab-ui-line ab-ui-line-lg"></span>
                                    <span class="ab-ui-line ab-ui-line-sm"></span>
                                </div>
                                <span class="ab-ui-chip">Verified</span>
                            </div>

                            <div class="ab-ui-row">
                                <div class="ab-ui-icon ab-ui-icon-soft">
                                    <i class="bi bi-star"></i>
                                </div>
                                <div class="ab-ui-lines">
                                    <span class="ab-ui-line ab-ui-line-lg"></span>
                                    <span class="ab-ui-line ab-ui-line-sm"></span>
                                </div>
                                <span class="ab-ui-chip ab-ui-chip-soft">Rated</span>
                            </div>

                        </div>
                    </div>

                    <div class="ab-ui-float-card">
                        <i class="bi bi-shield-check"></i>
                        <div>
                            <strong>Trusted by 1,000+</strong>
                            <span>homeowners every month</span>
                        </div>
                    </div>

                    <div class="ab-ui-deco-ring"></div>
                </div>

            </div>
        </div>
    </section>


    {{-- ============================================================
         SECTION 7 — SERVICEHUB NUMBERS
    ============================================================ --}}
    <section class="ab-numbers">
        <div class="container">
            <div class="ab-numbers-grid">

                <div class="ab-number">
                    <span class="ab-number-value" data-count="500">500<span class="ab-number-suffix">+</span></span>
                    <span class="ab-number-label">Services</span>
                </div>

                <div class="ab-number">
                    <span class="ab-number-value" data-count="1000">1,000<span class="ab-number-suffix">+</span></span>
                    <span class="ab-number-label">Bookings</span>
                </div>

                <div class="ab-number">
                    <span class="ab-number-value" data-count="100">100<span class="ab-number-suffix">+</span></span>
                    <span class="ab-number-label">Professionals</span>
                </div>

                <div class="ab-number">
                    <span class="ab-number-value" data-count="98">98<span class="ab-number-suffix">%</span></span>
                    <span class="ab-number-label">Customer Satisfaction</span>
                </div>

            </div>
        </div>
    </section>


    {{-- ============================================================
         SECTION 8 — PREMIUM BRAND IMAGE
    ============================================================ --}}
    <section class="ab-brand-image">
        <div class="ab-brand-bg"
             style="background-image: url('https://images.unsplash.com/photo-1621905251189-08b45d6a269e?auto=format&fit=crop&w=2000&q=80');"
             role="img"
             aria-label="Professional technician providing a service to a customer at home">
        </div>
        <div class="ab-brand-overlay"></div>

        <div class="container ab-brand-container">
            <div class="ab-brand-center">
                <h2 class="ab-brand-title">
                    Better Services. Better Experiences.
                </h2>
                <p class="ab-brand-text">
                    Everything we build is designed to make everyday service
                    experiences simpler and more dependable.
                </p>
            </div>
        </div>
    </section>

</div>

@endsection

@push('scripts')
<script src="{{ asset('js/about.js') }}" defer></script>
@endpush