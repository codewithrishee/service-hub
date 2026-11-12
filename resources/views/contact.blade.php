@extends('layouts.app')

@section('content')

    <link rel="stylesheet" href="{{ asset('css/contact.css') }}">

    <div class="servicehub-contact-premium">

        {{-- ============================================================
        SECTION 1 — HERO (FULL BACKGROUND + CENTER CONTENT)
        ============================================================ --}}
        <section class="hero-centered">
            <div class="hero-bg-image"></div>
            <div class="hero-cinematic-overlay"></div>

            <div class="hero-content-wrap">
                <div class="hero-content">

                    <span class="hero-eyebrow">
                        <span class="eyebrow-dot"></span>
                        Contact ServiceHub
                    </span>

                    <h1 class="hero-headline">
                        Let's Make Things <span class="hero-accent">Simple.</span>
                    </h1>

                    <p class="hero-subtext">
                        Have a question about a service, booking, or your ServiceHub
                        experience? Our team is here to help.
                    </p>

                    <div class="hero-buttons">
                        <a href="#contact-form-section" class="btn-hero-primary">
                            <i class="bi bi-chat-dots"></i> Get in Touch
                        </a>
                        <a href="#" class="btn-hero-secondary">
                            <i class="bi bi-grid"></i> Explore Services
                        </a>
                    </div>

                    <p class="hero-trust-line">
                        <span class="trust-dash"></span>
                        Here whenever you need us.
                        <span class="trust-dash"></span>
                    </p>

                </div>
            </div>

            <div class="hero-scroll-indicator" aria-hidden="true">
                <span></span>
            </div>
        </section>


        {{-- ============================================================
        SECTION 2 — PREMIUM CONTACT INFORMATION BAR
        ============================================================ --}}
        <section class="contact-info-bar">
            <div class="container">
                <div class="info-bar-inner">

                    <div class="info-bar-item">
                        <div class="ib-icon ib-icon-support">
                            <i class="bi bi-headset"></i>
                        </div>
                        <div class="ib-text">
                            <span class="ib-label">Customer Support</span>
                            <a href="mailto:support@servicehub.com" class="ib-value">
                                support@servicehub.com
                            </a>
                        </div>
                    </div>

                    <div class="info-bar-sep"></div>

                    <div class="info-bar-item">
                        <div class="ib-icon ib-icon-call">
                            <i class="bi bi-telephone"></i>
                        </div>
                        <div class="ib-text">
                            <span class="ib-label">Call Us</span>
                            <a href="tel:+919876543210" class="ib-value">
                                +91 98765 43210
                            </a>
                        </div>
                    </div>

                    <div class="info-bar-sep"></div>

                    <div class="info-bar-item">
                        <div class="ib-icon ib-icon-clock">
                            <i class="bi bi-clock"></i>
                        </div>
                        <div class="ib-text">
                            <span class="ib-label">Working Hours</span>
                            <span class="ib-value ib-value-static">
                                Mon – Sat · 9:00 AM – 7:00 PM
                            </span>
                        </div>
                    </div>

                    <div class="info-bar-sep"></div>

                    <div class="info-bar-item">
                        <div class="ib-icon ib-icon-quick">
                            <i class="bi bi-lightning-charge-fill"></i>
                        </div>
                        <div class="ib-text">
                            <span class="ib-label">Quick Response</span>
                            <span class="ib-value ib-value-static">
                                We're here to help
                            </span>
                        </div>
                    </div>

                </div>
            </div>
        </section>


        {{-- ============================================================
        SECTION 3 — CONTACT FORM + COMPANY INFORMATION
        ============================================================ --}}
        <section class="form-info-section" id="contact-form-section">
            <div class="container">
                <div class="row g-5 align-items-start">

                    {{-- LEFT: Contact Form --}}
                    <div class="col-lg-7">
                        <div class="form-block">
                            <div class="block-heading">
                                <span class="section-eyebrow">Message Us</span>
                                <h2 class="block-title">How Can We Help?</h2>
                                <p class="block-subtext">
                                    Send us a message and our team will get back to you as
                                    soon as possible.
                                </p>
                            </div>


                            {{-- Success Message --}}
                            @if (session('success'))
                                <div class="alert alert-success mb-4" role="alert">
                                    {{ session('success') }}
                                </div>
                            @endif

                            {{-- Validation Errors --}}
                            @if ($errors->any())
                                <div class="alert alert-danger mb-4" role="alert">
                                    <strong>Please correct the following errors:</strong>
                                    <ul class="mb-0 mt-2">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <form action="{{ route('contact.submit') }}" method="POST" class="premium-contact-form">
                                @csrf

                                <div class="row g-3 g-md-4">

                                    {{-- Full Name --}}
                                    <div class="col-md-6">
                                        <label for="pfName" class="sh-form-label">Full Name</label>
                                        <input type="text" class="form-control sh-form-field" id="pfName" name="name"
                                            value="{{ old('name') }}" placeholder="Enter your full name" autocomplete="name"
                                            maxlength="255" required>
                                        @error('name')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    {{-- Email --}}
                                    <div class="col-md-6">
                                        <label for="pfEmail" class="sh-form-label">Email Address</label>
                                        <input type="email" class="form-control sh-form-field" id="pfEmail" name="email"
                                            value="{{ old('email') }}" placeholder="you@example.com" autocomplete="email"
                                            maxlength="255" required>
                                        @error('email')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    {{-- Phone --}}
                                    <div class="col-md-6">
                                        <label for="pfPhone" class="sh-form-label">Phone Number</label>
                                        <input type="tel" class="form-control sh-form-field" id="pfPhone" name="phone"
                                            value="{{ old('phone') }}" placeholder="+91 XXXXX XXXXX" autocomplete="tel"
                                            maxlength="30">
                                        @error('phone')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    {{-- Subject --}}
                                    <div class="col-md-6">
                                        <label for="pfSubject" class="sh-form-label">Subject</label>
                                        <select class="form-select sh-form-field" id="pfSubject" name="subject" required>
                                            <option value="" disabled {{ old('subject') ? '' : 'selected' }}>
                                                Select a subject
                                            </option>

                                            @foreach ([
                                                    'General Enquiry',
                                                    'Booking Support',
                                                    'Service Issue',
                                                    'Payment Question',
                                                    'Partner Enquiry',
                                                    'Other'
                                                ] as $subject)
                                                <option value="{{ $subject }}" {{ old('subject') === $subject ? 'selected' : '' }}>
                                                    {{ $subject }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('subject')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    {{-- Service --}}
                                    <div class="col-12">
                                        <label for="pfService" class="sh-form-label">Service</label>
                                        <select class="form-select sh-form-field" id="pfService" name="service">
                                            <option value="" {{ old('service') ? '' : 'selected' }}>
                                                Select a service
                                            </option>

                                            @foreach ([
                                                    'Home Cleaning',
                                                    'Sofa & Carpet Cleaning',
                                                    'Bathroom Deep Cleaning',
                                                    'Kitchen Deep Cleaning',
                                                    'Appliance Service',
                                                    'Other / Not sure'
                                                ] as $service)
                                                <option value="{{ $service }}" {{ old('service') === $service ? 'selected' : '' }}>
                                                    {{ $service }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('service')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    {{-- Message --}}
                                    <div class="col-12">
                                        <label for="pfMessage" class="sh-form-label">Message</label>
                                        <textarea class="form-control sh-form-field" id="pfMessage" name="message" rows="6"
                                            maxlength="5000" placeholder="Tell us how we can help..."
                                            required>{{ old('message') }}</textarea>
                                        @error('message')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>

                                    {{-- Submit --}}
                                    <div class="col-12">
                                        <div class="form-submit-row">
                                            <button type="submit" class="btn-sh-submit">
                                                <i class="bi bi-send"></i> Send Message
                                            </button>

                                            <p class="submit-note">
                                                <i class="bi bi-shield-lock"></i>
                                                Your information is private and secure.
                                            </p>
                                        </div>
                                    </div>

                                </div>
                            </form>

                        </div>
                    </div>

                    {{-- RIGHT: Contact Details --}}
                    <div class="col-lg-5">
                        <aside class="company-info-card">
                            <div class="company-heading">
                                <span class="section-eyebrow">Reach Us</span>
                                <h2 class="company-title">Visit or Reach Us</h2>
                            </div>

                            <div class="company-detail-list">

                                <div class="company-detail-item">
                                    <div class="cd-icon">
                                        <i class="bi bi-geo-alt"></i>
                                    </div>
                                    <div class="cd-body">
                                        <span class="cd-label">Headquarters</span>
                                        <span class="cd-value">ServiceHub Headquarters</span>
                                        <span class="cd-meta">New Delhi, India</span>
                                    </div>
                                </div>

                                <div class="company-detail-item">
                                    <div class="cd-icon">
                                        <i class="bi bi-telephone"></i>
                                    </div>
                                    <div class="cd-body">
                                        <span class="cd-label">Phone</span>
                                        <a href="tel:+919876543210" class="cd-value cd-link">
                                            +91 98765 43210
                                        </a>
                                        <span class="cd-meta">Mon – Sat, 9 AM – 7 PM</span>
                                    </div>
                                </div>

                                <div class="company-detail-item">
                                    <div class="cd-icon">
                                        <i class="bi bi-envelope"></i>
                                    </div>
                                    <div class="cd-body">
                                        <span class="cd-label">Email</span>
                                        <a href="mailto:hello@servicehub.com" class="cd-value cd-link">
                                            hello@servicehub.com
                                        </a>
                                        <span class="cd-meta">We reply within one business day</span>
                                    </div>
                                </div>

                            </div>

                            <div class="company-status">
                                <span class="status-dot"></span>
                                <div class="status-body">
                                    <strong>Available for support</strong>
                                    <span>Our team is online and ready to help.</span>
                                </div>
                            </div>
                        </aside>
                    </div>

                </div>
            </div>
        </section>


        {{-- ============================================================
        SECTION 4 — LARGE PROFESSIONAL MAP SECTION
        ============================================================ --}}
        <section class="map-section-large">
            <div class="container">

                <div class="map-heading">
                    <span class="section-eyebrow">Find Us</span>
                    <h2 class="map-title">We're based in New Delhi and here to serve you.</h2>
                    <p class="map-subtext">
                        Visit our headquarters or reach out — we're always happy to meet
                        our customers and partners.
                    </p>
                </div>

                <div class="map-frame">
                    <div class="map-frame-inner">
                        {{-- Google Maps Embed — replace the src with your real embed URL --}}
                        <iframe class="map-iframe" src="https://www.google.com/maps?q=New+Delhi,India&output=embed"
                            title="ServiceHub Headquarters location on map — New Delhi, India" loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade" allowfullscreen></iframe>

                        {{-- Overlay marker card (visual reinforcement) --}}
                        <div class="map-marker-card">
                            <div class="marker-icon">
                                <i class="bi bi-geo-alt-fill"></i>
                            </div>
                            <div class="marker-body">
                                <strong>ServiceHub Headquarters</strong>
                                <span>New Delhi, India</span>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </section>


        {{-- ============================================================
        SECTION 5 — WHY CONTACT SERVICEHUB
        ============================================================ --}}
        <section class="why-contact-premium">
            <div class="container">

                <div class="section-heading-centered">
                    <span class="section-eyebrow">Why Reach Out</span>
                    <h2 class="block-title">Why Contact ServiceHub?</h2>
                    <p class="block-subtext">
                        Real people, ready to help — before, during and after your booking.
                    </p>
                </div>

                <div class="row g-4">

                    <div class="col-md-4">
                        <article class="feature-block">
                            <div class="feature-icon">
                                <i class="bi bi-lightning-charge"></i>
                            </div>
                            <h3 class="feature-title">Fast Support</h3>
                            <p class="feature-desc">
                                Get answers without unnecessary waiting.
                            </p>
                        </article>
                    </div>

                    <div class="col-md-4">
                        <article class="feature-block">
                            <div class="feature-icon">
                                <i class="bi bi-calendar2-check"></i>
                            </div>
                            <h3 class="feature-title">Booking Assistance</h3>
                            <p class="feature-desc">
                                We can help with your service bookings.
                            </p>
                        </article>
                    </div>

                    <div class="col-md-4">
                        <article class="feature-block">
                            <div class="feature-icon">
                                <i class="bi bi-emoji-smile"></i>
                            </div>
                            <h3 class="feature-title">Customer First</h3>
                            <p class="feature-desc">
                                Your experience is always our priority.
                            </p>
                        </article>
                    </div>

                </div>
            </div>
        </section>


        {{-- ============================================================
        SECTION 6 — PREMIUM FAQ
        ============================================================ --}}
        <section class="faq-premium-section">
            <div class="container">

                <div class="section-heading-centered">
                    <span class="section-eyebrow">Answers</span>
                    <h2 class="block-title">Frequently Asked Questions</h2>
                    <p class="block-subtext">
                        Quick answers to the questions we hear most often.
                    </p>
                </div>

                <div class="faq-shell">
                    <div class="accordion sh-faq-premium" id="contactFaqPremium">

                        <div class="accordion-item">
                            <h3 class="accordion-header" id="faqHeadA">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#faqA" aria-expanded="true" aria-controls="faqA">
                                    How do I book a service?
                                </button>
                            </h3>
                            <div id="faqA" class="accordion-collapse collapse show" aria-labelledby="faqHeadA"
                                data-bs-parent="#contactFaqPremium">
                                <div class="accordion-body">
                                    Browse our services, choose what you need, select your
                                    preferred date and time, and confirm your booking.
                                    You'll receive a confirmation with your professional's
                                    details right away.
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h3 class="accordion-header" id="faqHeadB">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#faqB" aria-expanded="false" aria-controls="faqB">
                                    Can I modify my booking?
                                </button>
                            </h3>
                            <div id="faqB" class="accordion-collapse collapse" aria-labelledby="faqHeadB"
                                data-bs-parent="#contactFaqPremium">
                                <div class="accordion-body">
                                    Yes. You can modify your booking details — including
                                    date, time and address — from your account up to 12
                                    hours before the scheduled service, subject to
                                    availability.
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h3 class="accordion-header" id="faqHeadC">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#faqC" aria-expanded="false" aria-controls="faqC">
                                    How can I cancel a booking?
                                </button>
                            </h3>
                            <div id="faqC" class="accordion-collapse collapse" aria-labelledby="faqHeadC"
                                data-bs-parent="#contactFaqPremium">
                                <div class="accordion-body">
                                    Open the booking from your bookings page and select
                                    "Cancel Booking". Cancellations made at least 12 hours
                                    in advance are fully refundable as per our refund policy.
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h3 class="accordion-header" id="faqHeadD">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#faqD" aria-expanded="false" aria-controls="faqD">
                                    How can I track my booking?
                                </button>
                            </h3>
                            <div id="faqD" class="accordion-collapse collapse" aria-labelledby="faqHeadD"
                                data-bs-parent="#contactFaqPremium">
                                <div class="accordion-body">
                                    You can track your booking in real time from your
                                    account. You'll also receive status updates via email
                                    and SMS as your professional heads to your location.
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h3 class="accordion-header" id="faqHeadE">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#faqE" aria-expanded="false" aria-controls="faqE">
                                    How can I contact customer support?
                                </button>
                            </h3>
                            <div id="faqE" class="accordion-collapse collapse" aria-labelledby="faqHeadE"
                                data-bs-parent="#contactFaqPremium">
                                <div class="accordion-body">
                                    You can reach us by email at hello@servicehub.com,
                                    by phone at +91 98765 43210, or by using the form on
                                    this page. We respond within one business day.
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </section>


        {{-- ============================================================
        SECTION 7 — FINAL FULL-WIDTH CTA
        ============================================================ --}}
        <section class="cta-fullwidth">
            <div class="cta-bg-image"></div>
            <div class="cta-overlay"></div>

            <div class="cta-content-wrap">
                <div class="cta-content">
                    <span class="cta-eyebrow">Always Available</span>
                    <h2 class="cta-headline">We're Always Here to Help.</h2>
                    <p class="cta-text">
                        From your first question to your completed booking, ServiceHub
                        is here to make the experience effortless.
                    </p>
                    <a href="#" class="btn-cta-primary">
                        <i class="bi bi-grid"></i> Explore Services
                    </a>
                </div>
            </div>
        </section>

    </div>




@endsection