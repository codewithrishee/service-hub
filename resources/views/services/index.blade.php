{{-- resources/views/services/index.blade.php --}}
@extends('layouts.app')

@section('content')

    <div class="servicehub-services" data-services-root>

        {{-- ============================================================
        SECTION 1 — PREMIUM SERVICES HERO
        ============================================================ --}}
        <section class="services-hero">
            <div class="hero-decor" aria-hidden="true">
                <span class="hero-blob hero-blob-1"></span>
                <span class="hero-blob hero-blob-2"></span>
                <span class="hero-grid"></span>
            </div>

            <div class="container hero-container">
                <div class="hero-inner">

                    <span class="eyebrow">Our Services</span>

                    <h1 class="hero-headline">
                        Professional Services,<br>
                        <span class="accent-text">Made Simple.</span>
                    </h1>

                    <p class="hero-lead">
                        From everyday cleaning to essential repairs, discover trusted
                        professionals ready to take care of your home.
                    </p>

                    {{-- Search Bar --}}
                    <div class="hero-search-wrap">
                        <form class="hero-search" role="search" aria-label="Search services" data-search-form>
                            <i class="bi bi-search search-icon" aria-hidden="true"></i>
                            <input type="text" class="search-input" placeholder="Search for a service..."
                                aria-label="Search for a service" data-search-input autocomplete="off">
                            <button type="button" class="search-btn" data-search-submit>
                                Search
                            </button>
                        </form>

                        <div class="search-popular">
                            <span class="popular-label">Popular:</span>
                            <button type="button" class="popular-tag" data-quick-search="Cleaning">Cleaning</button>
                            <span class="popular-dot" aria-hidden="true">·</span>
                            <button type="button" class="popular-tag" data-quick-search="AC">AC Service</button>
                            <span class="popular-dot" aria-hidden="true">·</span>
                            <button type="button" class="popular-tag" data-quick-search="Plumbing">Plumbing</button>
                            <span class="popular-dot" aria-hidden="true">·</span>
                            <button type="button" class="popular-tag" data-quick-search="Electrical">Electrical</button>
                        </div>
                    </div>

                    {{-- Trust indicators --}}
                    <div class="hero-trust">
                        <div class="trust-badge">
                            <i class="bi bi-patch-check-fill" aria-hidden="true"></i>
                            <span>10,000+ services completed</span>
                        </div>
                        <div class="trust-badge">
                            <i class="bi bi-star-fill" aria-hidden="true"></i>
                            <span>4.9 average rating</span>
                        </div>
                        <div class="trust-badge">
                            <i class="bi bi-shield-check" aria-hidden="true"></i>
                            <span>Verified professionals</span>
                        </div>
                    </div>

                </div>
            </div>
        </section>


        {{-- ============================================================
        SECTION 2 — CATEGORY NAVIGATION
        ========{{-- ============================================================
        SECTION 2 — CATEGORY NAVIGATION
        ============================================================ --}}
        <section class="category-nav" aria-label="Browse by category">
            <div class="container">
                <div class="category-header">
                    <h2 class="category-heading">Browse by Category</h2>
                </div>

                <div class="category-scroll" data-category-scroll>
                    <div class="category-pills" role="tablist">

                        {{-- All Services --}}
                        <button type="button" class="cat-pill active" data-category="all" role="tab" aria-selected="true">
                            <i class="bi bi-grid-3x3-gap-fill" aria-hidden="true"></i>
                            <span>All Services</span>
                        </button>

                        {{-- Dynamic Categories --}}
                        @foreach($categories as $category)
                            <button type="button" class="cat-pill" data-category="{{ strtolower($category->slug) }}" role="tab"
                                aria-selected="false">
                                <i class="{{ $category->icon ?? 'bi bi-grid' }}" aria-hidden="true"></i>

                                <span>{{ $category->name }}</span>
                            </button>
                        @endforeach

                    </div>
                </div>
            </div>
        </section>


        {{-- ============================================================
        SECTION 3 — SERVICES MARKETPLACE
        ============================================================ --}}
        <section class="marketplace">
            <div class="container">
                <div class="marketplace-layout">

                    {{-- ============ FILTER SIDEBAR ============ --}}
                    <aside class="filter-sidebar" id="filterSidebar" aria-label="Filter services">

                        <div class="filter-header">
                            <h3 class="filter-title">
                                <i class="bi bi-sliders" aria-hidden="true"></i>
                                Filter Services
                            </h3>
                            <button type="button" class="filter-close" id="filterClose" aria-label="Close filters">
                                <i class="bi bi-x-lg" aria-hidden="true"></i>
                            </button>
                        </div>

                        <div class="filter-body">

                            {{-- Category --}}
                            <div class="filter-group">
                                <h4 class="filter-group-title">Category</h4>

                                <div class="filter-options">

                                    {{-- All --}}
                                    <label class="filter-check">
                                        <input type="radio" name="filter-category" value="all" checked data-filter-category>
                                        <span class="check-mark" aria-hidden="true"></span>
                                        <span class="check-label">All</span>
                                    </label>

                                    {{-- Dynamic Categories --}}
                                    @foreach($categories as $category)
                                        <label class="filter-check">
                                            <input type="radio" name="filter-category" value="{{ strtolower($category->slug) }}"
                                                data-filter-category>
                                            <span class="check-mark" aria-hidden="true"></span>
                                            <span class="check-label">{{ $category->name }}</span>
                                        </label>
                                    @endforeach

                                </div>
                            </div>

                            {{-- Price Range --}}
                            <div class="filter-group">
                                <h4 class="filter-group-title">Price Range</h4>
                                <div class="price-range">
                                    <div class="price-values">
                                        <span data-price-min-label>₹299</span>
                                        <span data-price-max-label>₹2,499</span>
                                    </div>
                                    <div class="range-track" data-range-track>
                                        <div class="range-fill" data-range-fill></div>
                                        <input type="range" class="range-input range-input-min" min="0" max="2500"
                                            value="299" aria-label="Minimum price" data-range-min>
                                        <input type="range" class="range-input range-input-max" min="0" max="2500"
                                            value="2499" aria-label="Maximum price" data-range-max>
                                    </div>
                                </div>
                            </div>

                            {{-- Duration --}}
                            <div class="filter-group">
                                <h4 class="filter-group-title">Duration</h4>
                                <div class="filter-options">
                                    <label class="filter-check">
                                        <input type="checkbox" value="under-60" data-filter-duration>
                                        <span class="check-mark" aria-hidden="true"></span>
                                        <span class="check-label">Under 1 hour</span>
                                    </label>
                                    <label class="filter-check">
                                        <input type="checkbox" value="60-120" data-filter-duration>
                                        <span class="check-mark" aria-hidden="true"></span>
                                        <span class="check-label">1–2 hours</span>
                                    </label>
                                    <label class="filter-check">
                                        <input type="checkbox" value="120-plus" data-filter-duration>
                                        <span class="check-mark" aria-hidden="true"></span>
                                        <span class="check-label">2+ hours</span>
                                    </label>
                                </div>
                            </div>

                            {{-- Rating --}}
                            <div class="filter-group">
                                <h4 class="filter-group-title">Rating</h4>
                                <div class="filter-options">
                                    <label class="filter-check">
                                        <input type="radio" name="filter-rating" value="4.5" data-filter-rating>
                                        <span class="check-mark" aria-hidden="true"></span>
                                        <span class="check-label">
                                            <span class="stars-inline" aria-hidden="true">★★★★★</span> 4.5+
                                        </span>
                                    </label>
                                    <label class="filter-check">
                                        <input type="radio" name="filter-rating" value="4.0" data-filter-rating>
                                        <span class="check-mark" aria-hidden="true"></span>
                                        <span class="check-label">
                                            <span class="stars-inline" aria-hidden="true">★★★★</span> 4.0+
                                        </span>
                                    </label>
                                </div>
                            </div>

                            {{-- Availability --}}
                            <div class="filter-group">
                                <h4 class="filter-group-title">Availability</h4>
                                <div class="filter-options">
                                    <label class="filter-check">
                                        <input type="checkbox" value="today" data-filter-availability>
                                        <span class="check-mark" aria-hidden="true"></span>
                                        <span class="check-label">Available today</span>
                                    </label>
                                    <label class="filter-check">
                                        <input type="checkbox" value="week" data-filter-availability>
                                        <span class="check-mark" aria-hidden="true"></span>
                                        <span class="check-label">Available this week</span>
                                    </label>
                                </div>
                            </div>

                        </div>

                        <div class="filter-footer">
                            <button type="button" class="clear-all" data-clear-filters>
                                <i class="bi bi-arrow-counterclockwise" aria-hidden="true"></i>
                                Clear All
                            </button>
                        </div>

                    </aside>

                    {{-- ============ SERVICES AREA ============ --}}
                    <div class="services-area">

                        {{-- Result header --}}
                        <div class="results-header">

                            <div class="results-info">
                                <button type="button" class="filter-toggle" id="filterOpen">
                                    <i class="bi bi-sliders" aria-hidden="true"></i>
                                    Filters
                                </button>
                                <div>
                                    <h2 class="results-title" data-results-title>Popular Services</h2>
                                    <p class="results-count"><span data-results-count>24</span> services available</p>
                                </div>
                            </div>

                            <div class="results-sort">
                                <label for="sortSelect" class="sort-label">Sort by:</label>
                                <select class="sort-select" id="sortSelect" aria-label="Sort services" data-sort-select>
                                    <option value="recommended">Recommended</option>
                                    <option value="price-asc">Price: Low to High</option>
                                    <option value="price-desc">Price: High to Low</option>
                                    <option value="rating-desc">Top Rated</option>
                                </select>
                            </div>

                        </div>

                        {{-- Services grid --}}
                        <div class="services-grid" data-services-grid>

                            @forelse($services as $service)

                                <article class="service-card" data-service-card
                                    data-category="{{ strtolower($service->category->slug ?? '') }}"
                                    data-name="{{ $service->name }}" data-description="{{ $service->description }}"
                                    data-price="{{ $service->price }}" data-rating="{{ $service->rating ?? 0 }}"
                                    data-duration="{{ $service->duration }}"
                                    data-availability="{{ $service->availability ?? 'Available' }}">

                                    <div class="card-media">

                                        {{-- Static/Dummy image intentionally kept --}}
                                        <img src="https://images.unsplash.com/photo-1581578731548-c64695cc6952?auto=format&fit=crop&w=800&q=80"
                                            alt="{{ $service->name }}" loading="lazy">

                                        <span class="card-badge badge-popular">
                                            Popular
                                        </span>

                                        <span class="card-duration">
                                            <i class="bi bi-clock" aria-hidden="true"></i>
                                            {{ $service->duration }} min
                                        </span>

                                    </div>


                                    <div class="card-body">

                                        <span class="card-category">
                                            {{ $service->category->name ?? 'Service' }}
                                        </span>

                                        <h3 class="card-title">
                                            {{ $service->name }}
                                        </h3>

                                        <p class="service-desc">
                                            {{ \Illuminate\Support\Str::limit($service->description, 100) }}
                                        </p>


                                        <div class="card-rating">

                                            <span class="stars" aria-hidden="true">
                                                ★★★★★
                                            </span>

                                            <span class="rating-value">
                                                {{ $service->rating ?? 0 }}
                                            </span>

                                            <span class="review-count">
                                                ({{ $service->review_count ?? 0 }})
                                            </span>

                                        </div>


                                        <div class="card-footer">

                                            <div class="card-price">

                                                <span class="price-label">
                                                    Starting at
                                                </span>

                                                <span class="price-value">
                                                    ₹{{ number_format($service->price, 0) }}
                                                </span>

                                            </div>


                                            <div class="card-actions">

                                                <a href="{{ route('services.show', $service->slug) }}"
                                                    class="btn-card btn-outline">
                                                    View
                                                </a>

                                                <a href="{{ route('booking.create', $service->slug) }}"
                                                    class="btn-card btn-solid">
                                                    Book Now
                                                </a>

                                            </div>

                                        </div>

                                    </div>

                                </article>

                            @empty

                                <div class="col-12">
                                    <div class="text-center py-5">

                                        <i class="bi bi-grid fs-1 text-muted"></i>

                                        <h3 class="mt-3">
                                            No services available
                                        </h3>

                                        <p class="text-muted">
                                            Please check back later.
                                        </p>

                                    </div>
                                </div>

                            @endforelse

                        </div>

                        {{-- Empty state --}}
                        <div class="services-empty" data-services-empty hidden>
                            <div class="empty-icon">
                                <i class="bi bi-search" aria-hidden="true"></i>
                            </div>
                            <h3 class="empty-title">No services found</h3>
                            <p class="empty-text">
                                Try a different search term or clear your filters.
                            </p>
                            <button type="button" class="empty-btn" data-clear-filters>
                                Clear All Filters
                            </button>
                        </div>

                        {{-- FEATURED BANNER --}}
                        <div class="featured-banner">
                            <div class="featured-bg">
                                <img src="https://images.unsplash.com/photo-1600585154340-be6161a56a0c?auto=format&fit=crop&w=1600&q=80"
                                    alt="Bright modern living room after a complete home refresh" loading="lazy">
                            </div>
                            <div class="featured-overlay" aria-hidden="true"></div>
                            <div class="featured-content">
                                <span class="featured-eyebrow">Home Care Bundle</span>
                                <h3 class="featured-title">Need a complete home refresh?</h3>
                                <p class="featured-text">
                                    Get your home cleaned, maintained and ready in one
                                    convenient booking.
                                </p>
                                <a href="{{ url('/services/home-care') }}" class="btn-featured">
                                    Explore Home Care
                                    <i class="bi bi-arrow-right" aria-hidden="true"></i>
                                </a>
                            </div>
                        </div>

                        {{-- PAGINATION --}}
                        <nav class="services-pagination" aria-label="Services pagination">

                            {{-- Previous --}}
                            @if($services->onFirstPage())
                                <span class="page-link disabled">Previous</span>
                            @else
                                <a href="{{ $services->previousPageUrl() }}" class="page-link">
                                    Previous
                                </a>
                            @endif

                            {{-- Page Numbers --}}
                            @for($page = 1; $page <= $services->lastPage(); $page++)

                                <a href="{{ $services->url($page) }}"
                                    class="page-link {{ $services->currentPage() == $page ? 'active' : '' }}">
                                    {{ $page }}
                                </a>

                            @endfor

                            {{-- Next --}}
                            @if($services->hasMorePages())
                                <a href="{{ $services->nextPageUrl() }}" class="page-link page-next">
                                    Next <i class="bi bi-arrow-right" aria-hidden="true"></i>
                                </a>
                            @else
                                <span class="page-link page-next disabled">
                                    Next <i class="bi bi-arrow-right" aria-hidden="true"></i>
                                </span>
                            @endif

                        </nav>
                    </div>

                </div>
            </div>
        </section>


        {{-- ============================================================
        TRUST SECTION
        ============================================================ --}}
        <section class="trust-section">
            <div class="container">
                <div class="trust-header">
                    <span class="eyebrow">Why ServiceHub</span>
                    <h2 class="trust-heading">Why Book Through ServiceHub?</h2>
                </div>

                <div class="trust-grid">

                    <div class="trust-item">
                        <div class="trust-icon">
                            <i class="bi bi-patch-check" aria-hidden="true"></i>
                        </div>
                        <h3 class="trust-title">Verified Professionals</h3>
                        <p class="trust-desc">
                            Every professional is carefully reviewed before serving customers.
                        </p>
                    </div>

                    <div class="trust-item">
                        <div class="trust-icon">
                            <i class="bi bi-receipt" aria-hidden="true"></i>
                        </div>
                        <h3 class="trust-title">Transparent Pricing</h3>
                        <p class="trust-desc">
                            Clear upfront pricing so you always know what to expect.
                        </p>
                    </div>

                    <div class="trust-item">
                        <div class="trust-icon">
                            <i class="bi bi-shield-lock" aria-hidden="true"></i>
                        </div>
                        <h3 class="trust-title">Secure Booking</h3>
                        <p class="trust-desc">
                            Book confidently with protected payments and data.
                        </p>
                    </div>

                    <div class="trust-item">
                        <div class="trust-icon">
                            <i class="bi bi-headset" aria-hidden="true"></i>
                        </div>
                        <h3 class="trust-title">Reliable Support</h3>
                        <p class="trust-desc">
                            We're here to help before, during and after your booking.
                        </p>
                    </div>

                </div>
            </div>
        </section>


        {{-- ============================================================
        BOTTOM CTA
        ============================================================ --}}
        <section class="bottom-cta">
            <div class="container">
                <div class="cta-card">

                    <div class="cta-deco cta-deco-1" aria-hidden="true"></div>
                    <div class="cta-deco cta-deco-2" aria-hidden="true"></div>

                    <div class="cta-content">
                        <h2 class="cta-headline">Can't Find What You Need?</h2>
                        <p class="cta-text">
                            Tell us what you need and we'll help you find the right service.
                        </p>
                        <div class="cta-buttons">
                            <a href="{{ url('/contact') }}" class="btn-cta btn-cta-primary">
                                Contact Us
                                <i class="bi bi-arrow-right" aria-hidden="true"></i>
                            </a>
                            <a href="{{ url('/') }}" class="btn-cta btn-cta-ghost">
                                Go to Home
                            </a>
                        </div>
                    </div>

                </div>
            </div>
        </section>

    </div>

@endsection


@push('styles')
    <link rel="stylesheet" href="{{ asset('css/services-index.css') }}">
@endpush

@push('scripts')
    <script src="{{ asset('js/services-index.js') }}" defer></script>
@endpush