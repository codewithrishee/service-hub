@extends('layouts.app')



@section('content')



<link rel="stylesheet" href="{{ asset('css/services-show.css') }}">





<div class="servicehub-service-detail">



    {{-- ============================================================

         SECTION 1 — BREADCRUMB

         ============================================================ --}}

    <nav aria-label="breadcrumb" class="service-breadcrumb">

        <div class="container">

            <ol class="breadcrumb mb-0">

                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>

                <li class="breadcrumb-item"><a href="{{ route('services.index') }}">Services</a></li>

                <li class="breadcrumb-item"><a href="{{ route('categories.index') }}">{{ $service->category->name }}</a></li>

                <li class="breadcrumb-item active" aria-current="page">{{ $service->name }}</li>

            </ol>

        </div>

    </nav>





    {{-- ============================================================

         SECTION 2 — SERVICE HERO / DETAILS

         ============================================================ --}}

    <section class="service-hero">

        <div class="container">

            <div class="row g-4 g-lg-5">



                {{-- LEFT: Gallery --}}

                <div class="col-lg-7">

                    @php
                        $galleryImages = collect([$service->image])
                            ->merge($service->gallery ?? [])
                            ->filter()
                            ->values();
                    @endphp

                    <div class="service-gallery">

                        <div class="gallery-main">

                            @if($galleryImages->count())
                                <img
                                    src="{{ str_starts_with($galleryImages->first(), 'http') ? $galleryImages->first() : asset('storage/' . $galleryImages->first()) }}"
                                    alt="{{ $service->name }}"
                                    class="gallery-main-img"
                                    id="galleryMainImage"
                                >
                            @else
                                <img
                                    src="https://images.unsplash.com/photo-1581578731548-c64695cc6952?w=1200&q=80&auto=format&fit=crop"
                                    alt="{{ $service->name }}"
                                    class="gallery-main-img"
                                    id="galleryMainImage"
                                >
                            @endif

                            <span class="gallery-count">
                                <i class="bi bi-images"></i>
                                {{ $galleryImages->count() }} Photos
                            </span>

                            @if($service->verified)
                                <span class="gallery-badge">
                                    <i class="bi bi-patch-check-fill"></i>
                                    Verified Service
                                </span>
                            @endif

                        </div>

                        @if($galleryImages->count())
                            <div class="gallery-thumbs">
                                @foreach($galleryImages as $index => $galleryImage)
                                    @php
                                        $galleryUrl = str_starts_with($galleryImage, 'http')
                                            ? $galleryImage
                                            : asset('storage/' . $galleryImage);
                                    @endphp

                                    <button
                                        type="button"
                                        class="gallery-thumb {{ $index === 0 ? 'active' : '' }}"
                                        data-img="{{ $galleryUrl }}"
                                    >
                                        <img
                                            src="{{ $galleryUrl }}"
                                            alt="{{ $service->name }} image {{ $index + 1 }}"
                                        >
                                    </button>
                                @endforeach
                            </div>
                        @endif

                    </div>

                </div>

                {{-- RIGHT: Service Info --}}

{{-- RIGHT: Service Info --}}

                <div class="col-lg-5">

                    <div class="service-info">



                        <span class="info-category">{{ $service->category->name }}</span>



                        <h1 class="info-title">{{ $service->name }}</h1>



                        <p class="info-desc">

                            {{ $service->description }}

                        </p>



                        <div class="info-rating">
                            <span class="stars">
                                @for($i = 1; $i <= 5; $i++)
                                    @if($service->rating >= $i)
                                        <i class="bi bi-star-fill"></i>
                                    @elseif($service->rating >= ($i - 0.5))
                                        <i class="bi bi-star-half"></i>
                                    @else
                                        <i class="bi bi-star"></i>
                                    @endif
                                @endfor
                            </span>
                            <span class="rating-score">{{ number_format((float) $service->rating, 1) }}</span>
                            <span class="rating-divider"></span>
                            <a href="#reviews" class="rating-reviews">{{ number_format($service->review_count) }} Reviews</a>
                            @if($service->verified)
                                <span class="verified-pill">
                                    <i class="bi bi-patch-check-fill"></i> Verified Service
                                </span>
                            @endif
                        </div>

                        <div class="info-price-box">

                            <div class="price-row">

                                <div class="price-block">

                                    <span class="price-label">Starting at</span>

                                    <span class="price-value">₹{{ number_format($service->price, 0) }}</span>

                                </div>

                                <div class="duration-block">

                                    <span class="duration-label">Duration</span>

                                    <span class="duration-value">

                                        <i class="bi bi-clock"></i> {{ $service->duration }} min

                                    </span>

                                </div>

                            </div>

                            <p class="price-note">

                                <i class="bi bi-info-circle"></i>

                                Final price may vary depending on home size and service requirements.

                            </p>

                        </div>



                        <div class="info-cta">

                            <a href="{{ route('booking.create', $service->slug) }}" class="btn btn-book">

                                <i class="bi bi-calendar-check"></i> Book This Service

                            </a>

                        </div>



                    </div>

                </div>



            </div>

        </div>

    </section>





    {{-- ============================================================

         SECTION 3 — TRUST INFORMATION

         ============================================================ --}}

    <section class="trust-strip">

        <div class="container">

            <div class="trust-inner">

                <div class="trust-item">

                    <i class="bi bi-patch-check-fill"></i>

                    <span>Verified Professionals</span>

                </div>

                <div class="trust-item">

                    <i class="bi bi-currency-rupee"></i>

                    <span>Transparent Pricing</span>

                </div>

                <div class="trust-item">

                    <i class="bi bi-shield-lock-fill"></i>

                    <span>Secure Booking</span>

                </div>

                <div class="trust-item">

                    <i class="bi bi-headset"></i>

                    <span>Satisfaction Support</span>

                </div>

            </div>

        </div>

    </section>





    {{-- ============================================================

         SECTION 4 — ABOUT THIS SERVICE

         ============================================================ --}}

    <section class="section-block about-section">

        <div class="container">

            <div class="section-heading">

                <span class="section-eyebrow">Overview</span>

                <h2 class="section-title">About This Service</h2>

            </div>



            <div class="about-content">
                <p>{{ $service->description }}</p>
            </div>
        </div>
    </section>





    {{-- ============================================================

         SECTION 5 — WHAT'S INCLUDED

         ============================================================ --}}

    <section class="section-block included-section">

        <div class="container">

            <div class="section-heading">

                <span class="section-eyebrow">Inclusions</span>

                <h2 class="section-title">What's Included</h2>

            </div>



            <div class="included-list">
                @forelse($service->included ?? [] as $item)
                    <div class="included-item">
                        <span class="included-check"><i class="bi bi-check-lg"></i></span>
                        <span>{{ $item }}</span>
                    </div>
                @empty
                    <div class="included-item">
                        <span class="included-check"><i class="bi bi-check-lg"></i></span>
                        <span>Service details will be updated soon.</span>
                    </div>
                @endforelse
            </div>
        </div>
    </section>





    {{-- ============================================================

         SECTION 6 — WHAT'S NOT INCLUDED

         ============================================================ --}}

    <section class="section-block excluded-section">

        <div class="container">

            <div class="section-heading">

                <span class="section-eyebrow">Exclusions</span>

                <h2 class="section-title section-title-muted">What's Not Included</h2>

            </div>



            <div class="excluded-list">
                @forelse($service->excluded ?? [] as $item)
                    <div class="excluded-item">
                        <i class="bi bi-dash-circle"></i>
                        <span>{{ $item }}</span>
                    </div>
                @empty
                    <div class="excluded-item">
                        <i class="bi bi-dash-circle"></i>
                        <span>No exclusions specified.</span>
                    </div>
                @endforelse
            </div>
        </div>
    </section>





    {{-- ============================================================

         SECTION 7 — HOW IT WORKS

         ============================================================ --}}

    <section class="section-block process-section">

        <div class="container">

            <div class="section-heading">

                <span class="section-eyebrow">Process</span>

                <h2 class="section-title">How It Works</h2>

            </div>



            <div class="process-steps">
                @forelse($service->how_it_works ?? [] as $index => $step)
                    <div class="process-step">
                        <div class="step-number">{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}</div>
                        <div class="step-body">
                            <h3 class="step-title">{{ $step }}</h3>
                            <p class="step-desc">Follow this step to complete your service smoothly.</p>
                        </div>
                    </div>
                @empty
                    <div class="process-step">
                        <div class="step-number">01</div>
                        <div class="step-body">
                            <h3 class="step-title">Book</h3>
                            <p class="step-desc">Choose your preferred date and time.</p>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </section>





    {{-- ============================================================

         SECTION 8 — SERVICE INFORMATION

         ============================================================ --}}

    <section class="section-block info-grid-section">

        <div class="container">

            <div class="section-heading">

                <span class="section-eyebrow">Details</span>

                <h2 class="section-title">Service Information</h2>

            </div>



            <div class="info-grid">
                <div class="info-grid-item">
                    <span class="info-grid-label">Service Type</span>
                    <span class="info-grid-value">{{ $service->category->name }}</span>
                </div>
                <div class="info-grid-item">
                    <span class="info-grid-label">Duration</span>
                    <span class="info-grid-value">{{ $service->duration }} minutes</span>
                </div>
                <div class="info-grid-item">
                    <span class="info-grid-label">Availability</span>
                    <span class="info-grid-value">{{ $service->availability ?? 'Not specified' }}</span>
                </div>
                <div class="info-grid-item">
                    <span class="info-grid-label">Service Area</span>
                    <span class="info-grid-value">{{ $service->service_area ?? 'Selected locations' }}</span>
                </div>
                <div class="info-grid-item">
                    <span class="info-grid-label">Professionals</span>
                    <span class="info-grid-value">
                        @if($service->verified)
                            <i class="bi bi-patch-check-fill text-success"></i> Verified
                        @else
                            Not Verified
                        @endif
                    </span>
                </div>
            </div>
        </div>
    </section>





    {{-- ============================================================

         SECTION 9 — REVIEWS

         ============================================================ --}}

    <section class="section-block reviews-section" id="reviews">

        <div class="container">

            <div class="section-heading">

                <span class="section-eyebrow">Feedback</span>

                <h2 class="section-title">Customer Reviews</h2>

            </div>



            <div class="reviews-layout">



                {{-- Rating Summary --}}
                <div class="reviews-summary">
                    <div class="summary-score">
                        <span class="summary-number">{{ number_format((float) $service->rating, 1) }}</span>
                        <span class="summary-stars">
                            @for($i = 1; $i <= 5; $i++)
                                @if($service->rating >= $i)
                                    <i class="bi bi-star-fill"></i>
                                @elseif($service->rating >= ($i - 0.5))
                                    <i class="bi bi-star-half"></i>
                                @else
                                    <i class="bi bi-star"></i>
                                @endif
                            @endfor
                        </span>
                        <span class="summary-count">{{ number_format($service->review_count) }} Reviews</span>
                    </div>

                    <div class="rating-breakdown">
                        <div class="breakdown-row">
                            <span class="breakdown-label">5 <i class="bi bi-star-fill"></i></span>
                            <div class="breakdown-bar"><div class="breakdown-fill" style="width: 0%;"></div></div>
                            <span class="breakdown-count">—</span>
                        </div>
                        <div class="breakdown-row">
                            <span class="breakdown-label">4 <i class="bi bi-star-fill"></i></span>
                            <div class="breakdown-bar"><div class="breakdown-fill" style="width: 0%;"></div></div>
                            <span class="breakdown-count">—</span>
                        </div>
                        <div class="breakdown-row">
                            <span class="breakdown-label">3 <i class="bi bi-star-fill"></i></span>
                            <div class="breakdown-bar"><div class="breakdown-fill" style="width: 0%;"></div></div>
                            <span class="breakdown-count">—</span>
                        </div>
                        <div class="breakdown-row">
                            <span class="breakdown-label">2 <i class="bi bi-star-fill"></i></span>
                            <div class="breakdown-bar"><div class="breakdown-fill" style="width: 0%;"></div></div>
                            <span class="breakdown-count">—</span>
                        </div>
                        <div class="breakdown-row">
                            <span class="breakdown-label">1 <i class="bi bi-star-fill"></i></span>
                            <div class="breakdown-bar"><div class="breakdown-fill" style="width: 0%;"></div></div>
                            <span class="breakdown-count">—</span>
                        </div>
                    </div>
                </div>

                {{-- Review Cards --}}

                <div class="reviews-list">



                    <article class="review-card">

                        <div class="review-head">

                            <img

                                src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?w=120&q=80&auto=format&fit=crop"

                                alt="Priya Sharma"

                                class="review-avatar"

                            >

                            <div class="review-meta">

                                <h3 class="review-name">Priya Sharma</h3>

                                <div class="review-sub">

                                    <span class="review-stars">

                                        <i class="bi bi-star-fill"></i>

                                        <i class="bi bi-star-fill"></i>

                                        <i class="bi bi-star-fill"></i>

                                        <i class="bi bi-star-fill"></i>

                                        <i class="bi bi-star-fill"></i>

                                    </span>

                                    <span class="review-date">12 Jan 2025</span>

                                </div>

                            </div>

                            <span class="review-verified">

                                <i class="bi bi-patch-check-fill"></i> Verified Booking

                            </span>

                        </div>

                        <p class="review-text">

                            Very professional service. The team arrived on time and cleaned every

                            corner of the house. The booking process was also very smooth.

                        </p>

                    </article>



                    <article class="review-card">

                        <div class="review-head">

                            <img

                                src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=120&q=80&auto=format&fit=crop"

                                alt="Rahul Mehta"

                                class="review-avatar"

                            >

                            <div class="review-meta">

                                <h3 class="review-name">Rahul Mehta</h3>

                                <div class="review-sub">

                                    <span class="review-stars">

                                        <i class="bi bi-star-fill"></i>

                                        <i class="bi bi-star-fill"></i>

                                        <i class="bi bi-star-fill"></i>

                                        <i class="bi bi-star-fill"></i>

                                        <i class="bi bi-star-fill"></i>

                                    </span>

                                    <span class="review-date">28 Dec 2024</span>

                                </div>

                            </div>

                            <span class="review-verified">

                                <i class="bi bi-patch-check-fill"></i> Verified Booking

                            </span>

                        </div>

                        <p class="review-text">

                            I booked this for a post-renovation clean-up and the results were

                            excellent. The kitchen and bathrooms looked brand new. Worth every rupee.

                        </p>

                    </article>



                    <article class="review-card">

                        <div class="review-head">

                            <img

                                src="https://images.unsplash.com/photo-1438761681033-6461ffad8d80?w=120&q=80&auto=format&fit=crop"

                                alt="Ananya Iyer"

                                class="review-avatar"

                            >

                            <div class="review-meta">

                                <h3 class="review-name">Ananya Iyer</h3>

                                <div class="review-sub">

                                    <span class="review-stars">

                                        <i class="bi bi-star-fill"></i>

                                        <i class="bi bi-star-fill"></i>

                                        <i class="bi bi-star-fill"></i>

                                        <i class="bi bi-star-fill"></i>

                                        <i class="bi bi-star-half"></i>

                                    </span>

                                    <span class="review-date">05 Dec 2024</span>

                                </div>

                            </div>

                            <span class="review-verified">

                                <i class="bi bi-patch-check-fill"></i> Verified Booking

                            </span>

                        </div>

                        <p class="review-text">

                            The professionals were polite and thorough. They paid attention to

                            details I usually miss, like switchboards and skirting. Highly recommended.

                        </p>

                    </article>



                </div>

            </div>

        </div>

    </section>





    {{-- ============================================================

         SECTION 10 — RELATED SERVICES

         ============================================================ --}}

    <section class="section-block related-section">

        <div class="container">

            <div class="section-heading">

                <span class="section-eyebrow">Explore</span>

                <h2 class="section-title">You May Also Like</h2>

            </div>



            <div class="row g-4">



                @foreach($relatedServices as $related)

                <div class="col-md-6 col-lg-4">

                    <article class="related-card">

                        <div class="related-image">

                            <img

                                src="{{ $related->image ? (str_starts_with($related->image, 'http') ? $related->image : asset('storage/' . $related->image)) : 'https://images.unsplash.com/photo-1584622650111-993a426fbf0a?w=600&q=80&auto=format&fit=crop' }}"

                                alt="{{ $related->name }}"

                            >

                        </div>

                        <div class="related-body">

                            <h3 class="related-title">{{ $related->name }}</h3>

                            <div class="related-meta">

                                <span class="related-rating">

                                    <i class="bi bi-star-fill"></i> {{ number_format((float) $related->rating, 1) }}

                                </span>

                                <span class="related-price">From ₹{{ number_format($related->price, 0) }}</span>

                            </div>

                            <a href="{{ route('services.show', $related->slug) }}" class="btn btn-related">

                                View Details <i class="bi bi-arrow-right"></i>

                            </a>

                        </div>

                    </article>

                </div>

                @endforeach



            </div>

        </div>

    </section>





    {{-- ============================================================

         SECTION 11 — FINAL BOOKING CTA

         ============================================================ --}}

    <section class="final-cta" id="booking-cta">

        <div class="container">

            <div class="final-cta-inner">

                <h2 class="final-cta-title">Ready to Book Your Service?</h2>

                <p class="final-cta-desc">

                    Choose your preferred time and let a trusted professional take care of the rest.

                </p>

                <div class="final-cta-price">

                    <span class="final-price-label">Starting at</span>

                    <span class="final-price-value">₹{{ number_format($service->price, 0) }}</span>

                </div>

                <a href="{{ route('booking.create', $service->slug) }}" class="btn btn-final-cta">

                    <i class="bi bi-calendar-check"></i> Book This Service

                </a>

                <p class="final-cta-trust">

                    Secure booking &bull; Verified professionals &bull; Transparent pricing

                </p>

            </div>

        </div>

    </section>





    {{-- ============================================================

         STICKY BOOKING BAR

         ============================================================ --}}

    <div class="booking-bar" id="bookingBar">

        <div class="container">

            <div class="booking-bar-inner">

                <div class="booking-bar-info">

                    <span class="booking-bar-title">{{ $service->name }}</span>

                    <span class="booking-bar-price">Starting at <strong>₹{{ number_format($service->price, 0) }}</strong></span>

                </div>

                <a href="{{ route('booking.create', $service->slug) }}" class="btn btn-booking-bar">

                    <i class="bi bi-calendar-check"></i> Book This Service

                </a>

            </div>

        </div>

    </div>



</div>



@push('scripts')

<script src="{{ asset('js/services-show.js') }}" defer></script>

@endpush
@endsection