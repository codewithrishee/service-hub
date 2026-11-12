@extends('layouts.app')

@section('title', $category->name . ' Services | ServiceHub')

@section('content')


{{-- =========================================================
     CATEGORY HERO
========================================================= --}}

<section class="category-show-hero">

    <div class="container">

        {{-- Breadcrumb --}}
        <div class="category-breadcrumb">

            <a href="{{ route('home') }}">
                Home
            </a>

            <i class="bi bi-chevron-right"></i>

            <a href="{{ route('categories.index') }}">
                Categories
            </a>

            <i class="bi bi-chevron-right"></i>

            <span>
                {{ $category->name }}
            </span>

        </div>


        <div class="category-hero-layout">


            {{-- Left Content --}}
            <div class="category-hero-content">

                <span class="category-hero-eyebrow">

                    <i class="bi bi-grid-3x3-gap-fill"></i>

                    Service Category

                </span>


                <h1>
                    {{ $category->name }}
                </h1>


                <p>

                    {{ $category->description
                        ?: 'Find trusted professionals and reliable services for all your ' . strtolower($category->name) . ' needs.'
                    }}

                </p>


                {{-- Category Stats --}}
                <div class="category-hero-stats">

                    <div class="category-hero-stat">

                        <span class="category-stat-icon">
                            <i class="bi bi-tools"></i>
                        </span>

                        <div>

                            <strong>
                                {{ $services->total() }}
                            </strong>

                            <small>
                                {{ $services->total() == 1 ? 'Service' : 'Services' }}
                            </small>

                        </div>

                    </div>


                    <div class="category-stat-divider"></div>


                    <div class="category-hero-stat">

                        <span class="category-stat-icon">
                            <i class="bi bi-shield-check"></i>
                        </span>

                        <div>

                            <strong>
                                Trusted
                            </strong>

                            <small>
                                Professionals
                            </small>

                        </div>

                    </div>

                </div>

            </div>


            {{-- Right Category Visual --}}
            <!-- <div class="category-hero-visual">

                <div class="category-visual-glow"></div>

                <div class="category-visual-card">

                    <div class="category-visual-icon">

                        <i class="{{ $category->icon ?? 'bi bi-grid' }}"></i>

                    </div>

                    <span>
                        Explore
                    </span>

                    <strong>
                        {{ $category->name }}
                    </strong>

                    <small>
                        Professional services
                    </small>

                </div> -->

            </div>

        </div>

    </div>

</section>



{{-- =========================================================
     SERVICES SECTION
========================================================= --}}

<section class="category-services">

    <div class="container">


        {{-- Section Header --}}
        <div class="category-services-header">

            <div>

                <span class="section-eyebrow">
                    Available Services
                </span>

                <h2>
                    Choose the right service
                </h2>

                <p>
                    Explore trusted services in
                    <strong>{{ $category->name }}</strong>
                    and book a professional when you need them.
                </p>

            </div>


            <a href="{{ route('services.index') }}"
               class="category-view-all">

                View All Services

                <i class="bi bi-arrow-right"></i>

            </a>

        </div>



        {{-- Services --}}
        <div class="category-services-grid">

            @forelse($services as $service)

                <article class="category-service-card">


                    {{-- Image --}}
                    <div class="category-service-image">

                        @if($service->image)

                            <img
                                src="{{ str_starts_with($service->image, 'http')
                                    ? $service->image
                                    : asset('storage/' . $service->image)
                                }}"
                                alt="{{ $service->name }}"
                                loading="lazy"
                            >

                        @else

                            <img
                                src="https://images.unsplash.com/photo-1581578731548-c64695cc6952?auto=format&fit=crop&w=900&q=80"
                                alt="{{ $service->name }}"
                                loading="lazy"
                            >

                        @endif


                        {{-- Image Overlay --}}
                        <div class="category-service-overlay"></div>


                        {{-- Category Badge --}}
                        <span class="category-service-badge">

                            {{ $category->name }}

                        </span>


                        {{-- Duration --}}
                        <span class="category-service-duration">

                            <i class="bi bi-clock"></i>

                            {{ $service->duration }} min

                        </span>

                    </div>



                    {{-- Card Body --}}
                    <div class="category-service-body">


                        {{-- Rating --}}
                        <div class="category-service-rating">

                            <span class="rating-stars">

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


                            <strong>
                                {{ number_format((float) $service->rating, 1) }}
                            </strong>


                            <span>
                                ({{ number_format($service->review_count) }})
                            </span>

                        </div>



                        {{-- Service Name --}}
                        <h3>

                            {{ $service->name }}

                        </h3>



                        {{-- Description --}}
                        <p>

                            {{ \Illuminate\Support\Str::limit(
                                $service->description ?: 'Professional and reliable service from trusted experts.',
                                105
                            ) }}

                        </p>



                        {{-- Bottom Meta --}}
                        <div class="category-service-bottom">


                            <div class="category-service-price">

                                <small>
                                    Starting at
                                </small>

                                <strong>
                                    ₹{{ number_format($service->price, 0) }}
                                </strong>

                            </div>


                            <div class="category-service-actions">

                                <a
                                    href="{{ route('services.show', $service->slug) }}"
                                    class="category-service-view"
                                    aria-label="View {{ $service->name }}"
                                >

                                    <i class="bi bi-arrow-up-right"></i>

                                </a>

                            </div>

                        </div>



                        {{-- Buttons --}}
                        <div class="category-service-buttons">

                            <a
                                href="{{ route('services.show', $service->slug) }}"
                                class="category-btn-outline"
                            >

                                View Details

                            </a>


                            <a
                                href="{{ route('booking.create', $service->slug) }}"
                                class="category-btn-primary"
                            >

                                Book Now

                                <i class="bi bi-arrow-right"></i>

                            </a>

                        </div>

                    </div>

                </article>


            @empty

                {{-- Empty State --}}
                <div class="category-empty-state">

                    <div class="category-empty-icon">

                        <i class="bi bi-tools"></i>

                    </div>

                    <h3>
                        No services available yet
                    </h3>

                    <p>
                        We don't have any active services in
                        <strong>{{ $category->name }}</strong>
                        right now.
                    </p>

                    <a
                        href="{{ route('services.index') }}"
                        class="category-btn-primary"
                    >

                        Browse All Services

                        <i class="bi bi-arrow-right"></i>

                    </a>

                </div>

            @endforelse

        </div>



        {{-- =====================================================
             PAGINATION
        ====================================================== --}}

        @if($services->hasPages())

            <div class="category-pagination">


                {{-- Previous --}}
                @if($services->onFirstPage())

                    <span class="category-page disabled">

                        <i class="bi bi-arrow-left"></i>

                        Previous

                    </span>

                @else

                    <a
                        href="{{ $services->previousPageUrl() }}"
                        class="category-page"
                    >

                        <i class="bi bi-arrow-left"></i>

                        Previous

                    </a>

                @endif



                {{-- Pages --}}
                <div class="category-page-numbers">

                    @for(
                        $page = 1;
                        $page <= $services->lastPage();
                        $page++
                    )

                        <a
                            href="{{ $services->url($page) }}"
                            class="category-page-number
                                {{ $services->currentPage() == $page ? 'active' : '' }}"
                        >

                            {{ $page }}

                        </a>

                    @endfor

                </div>



                {{-- Next --}}
                @if($services->hasMorePages())

                    <a
                        href="{{ $services->nextPageUrl() }}"
                        class="category-page"
                    >

                        Next

                        <i class="bi bi-arrow-right"></i>

                    </a>

                @else

                    <span class="category-page disabled">

                        Next

                        <i class="bi bi-arrow-right"></i>

                    </span>

                @endif

            </div>

        @endif

    </div>

</section>



{{-- =========================================================
     FINAL CTA
========================================================= --}}

<section class="category-final-cta">

    <div class="container">

        <div class="category-final-inner">

            <div class="category-final-content">

                <span class="section-eyebrow">
                    ServiceHub
                </span>

                <h2>
                    Can't find what you're looking for?
                </h2>

                <p>
                    Explore our complete range of home services
                    and find the right professional for your needs.
                </p>

            </div>


            <a
                href="{{ route('services.index') }}"
                class="category-final-btn"
            >

                Explore All Services

                <i class="bi bi-arrow-right"></i>

            </a>

        </div>

    </div>

</section>



{{-- =========================================================
     PAGE STYLES
========================================================= --}}

@push('styles')

<style>

    /* =====================================================
       CATEGORY HERO
    ===================================================== */

    .category-show-hero {
        position: relative;
        overflow: hidden;
        padding: 42px 0 72px;
        background:
            radial-gradient(
                circle at 85% 20%,
                rgba(36, 153, 103, 0.10),
                transparent 35%
            ),
            linear-gradient(
                135deg,
                #f7faf8 0%,
                #ffffff 55%,
                #f3f8f5 100%
            );
        border-bottom: 1px solid #e8eee9;
    }


    .category-breadcrumb {
        display: flex;
        align-items: center;
        flex-wrap: wrap;
        gap: 10px;
        margin-bottom: 54px;
        font-size: 14px;
        color: #7a847e;
    }


    .category-breadcrumb a {
        color: #5d6962;
        text-decoration: none;
        transition: .2s ease;
    }


    .category-breadcrumb a:hover {
        color: #16865b;
    }


    .category-breadcrumb i {
        font-size: 10px;
        color: #aab3ae;
    }


    .category-breadcrumb span {
        color: #17211c;
        font-weight: 600;
    }


    .category-hero-layout {
        display: grid;
        grid-template-columns: minmax(0, 1.35fr) minmax(320px, .65fr);
        align-items: center;
        gap: 70px;
    }


    .category-hero-eyebrow {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 8px 14px;
        margin-bottom: 18px;
        border: 1px solid #d9e9df;
        border-radius: 999px;
        background: rgba(255,255,255,.8);
        color: #16865b;
        font-size: 12px;
        font-weight: 700;
        letter-spacing: .08em;
        text-transform: uppercase;
    }


    .category-hero-eyebrow i {
        font-size: 14px;
    }


    .category-hero-content h1 {
        max-width: 720px;
        margin: 0 0 18px;
        color: #14201a;
        font-size: clamp(42px, 5vw, 68px);
        line-height: 1.04;
        font-weight: 800;
        letter-spacing: -2px;
    }


    .category-hero-content > p {
        max-width: 680px;
        margin: 0;
        color: #68736d;
        font-size: 18px;
        line-height: 1.75;
    }


    .category-hero-stats {
        display: flex;
        align-items: center;
        gap: 26px;
        margin-top: 34px;
    }


    .category-hero-stat {
        display: flex;
        align-items: center;
        gap: 12px;
    }


    .category-stat-icon {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 44px;
        height: 44px;
        border-radius: 12px;
        background: #e8f6ef;
        color: #16865b;
        font-size: 18px;
    }


    .category-hero-stat strong,
    .category-hero-stat small {
        display: block;
    }


    .category-hero-stat strong {
        color: #18231d;
        font-size: 16px;
        line-height: 1.2;
    }


    .category-hero-stat small {
        margin-top: 3px;
        color: #7c8781;
        font-size: 12px;
    }


    .category-stat-divider {
        width: 1px;
        height: 42px;
        background: #dce4df;
    }


    /* Hero Visual */

    .category-hero-visual {
        position: relative;
        display: flex;
        align-items: center;
        justify-content: center;
        min-height: 320px;
    }


    .category-visual-glow {
        position: absolute;
        width: 250px;
        height: 250px;
        border-radius: 50%;
        background: rgba(32, 157, 105, .13);
        filter: blur(8px);
    }


    .category-visual-card {
        position: relative;
        z-index: 1;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        width: 270px;
        min-height: 290px;
        padding: 32px;
        border: 1px solid rgba(255,255,255,.9);
        border-radius: 28px;
        background: rgba(255,255,255,.84);
        box-shadow:
            0 25px 70px rgba(30, 65, 48, .12),
            inset 0 1px 0 rgba(255,255,255,.9);
        backdrop-filter: blur(15px);
        text-align: center;
    }


    .category-visual-icon {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 92px;
        height: 92px;
        margin-bottom: 24px;
        border-radius: 25px;
        background: linear-gradient(145deg, #e4f7ed, #f4fbf7);
        color: #16865b;
        font-size: 38px;
        box-shadow: 0 15px 35px rgba(22, 134, 91, .10);
    }


    .category-visual-card > span {
        margin-bottom: 5px;
        color: #8a948f;
        font-size: 12px;
        text-transform: uppercase;
        letter-spacing: .12em;
        font-weight: 700;
    }


    .category-visual-card strong {
        color: #17211c;
        font-size: 23px;
    }


    .category-visual-card small {
        margin-top: 5px;
        color: #7c8781;
    }



    /* =====================================================
       SERVICES
    ===================================================== */

    .category-services {
        padding: 90px 0;
        background: #fff;
    }


    .category-services-header {
        display: flex;
        align-items: flex-end;
        justify-content: space-between;
        gap: 30px;
        margin-bottom: 42px;
    }


    .category-services-header .section-eyebrow {
        display: block;
        margin-bottom: 10px;
    }


    .category-services-header h2 {
        margin: 0 0 10px;
        color: #17211c;
        font-size: clamp(30px, 4vw, 42px);
        line-height: 1.15;
        font-weight: 800;
        letter-spacing: -.8px;
    }


    .category-services-header p {
        max-width: 650px;
        margin: 0;
        color: #77817c;
        line-height: 1.7;
    }


    .category-view-all {
        display: inline-flex;
        align-items: center;
        gap: 9px;
        flex-shrink: 0;
        color: #16865b;
        text-decoration: none;
        font-size: 14px;
        font-weight: 700;
    }


    .category-view-all i {
        transition: transform .2s ease;
    }


    .category-view-all:hover i {
        transform: translateX(4px);
    }


    .category-services-grid {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 26px;
    }


    /* Service Card */

    .category-service-card {
        overflow: hidden;
        border: 1px solid #e7ece9;
        border-radius: 20px;
        background: #fff;
        box-shadow: 0 10px 35px rgba(24, 46, 35, .055);
        transition:
            transform .28s ease,
            box-shadow .28s ease,
            border-color .28s ease;
    }


    .category-service-card:hover {
        transform: translateY(-7px);
        border-color: #d6e7de;
        box-shadow: 0 22px 50px rgba(24, 46, 35, .11);
    }


    .category-service-image {
        position: relative;
        height: 225px;
        overflow: hidden;
        background: #edf2ef;
    }


    .category-service-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform .5s ease;
    }


    .category-service-card:hover .category-service-image img {
        transform: scale(1.055);
    }


    .category-service-overlay {
        position: absolute;
        inset: 0;
        background: linear-gradient(
            to bottom,
            rgba(0,0,0,.02),
            rgba(0,0,0,.38)
        );
    }


    .category-service-badge {
        position: absolute;
        top: 15px;
        left: 15px;
        padding: 7px 11px;
        border: 1px solid rgba(255,255,255,.45);
        border-radius: 999px;
        background: rgba(255,255,255,.92);
        color: #25332b;
        font-size: 11px;
        font-weight: 700;
        backdrop-filter: blur(8px);
    }


    .category-service-duration {
        position: absolute;
        right: 15px;
        bottom: 15px;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 7px 11px;
        border-radius: 999px;
        background: rgba(20, 28, 24, .78);
        color: #fff;
        font-size: 11px;
        font-weight: 600;
        backdrop-filter: blur(8px);
    }


    .category-service-body {
        padding: 23px;
    }


    .category-service-rating {
        display: flex;
        align-items: center;
        gap: 6px;
        margin-bottom: 12px;
        font-size: 12px;
    }


    .rating-stars {
        display: inline-flex;
        gap: 2px;
        color: #f3b72f;
        font-size: 12px;
    }


    .category-service-rating strong {
        color: #26342c;
    }


    .category-service-rating > span:last-child {
        color: #929b96;
    }


    .category-service-body h3 {
        margin: 0 0 10px;
        color: #18231d;
        font-size: 20px;
        line-height: 1.3;
        font-weight: 750;
    }


    .category-service-body > p {
        min-height: 49px;
        margin: 0 0 22px;
        color: #78837d;
        font-size: 13px;
        line-height: 1.65;
    }


    .category-service-bottom {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding-top: 17px;
        border-top: 1px solid #edf0ee;
    }


    .category-service-price small {
        display: block;
        margin-bottom: 2px;
        color: #929b96;
        font-size: 11px;
    }


    .category-service-price strong {
        color: #17211c;
        font-size: 21px;
    }


    .category-service-view {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 39px;
        height: 39px;
        border: 1px solid #dfe7e2;
        border-radius: 11px;
        color: #34423a;
        text-decoration: none;
        transition: .2s ease;
    }


    .category-service-view:hover {
        border-color: #16865b;
        background: #16865b;
        color: #fff;
    }


    .category-service-buttons {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 10px;
        margin-top: 18px;
    }


    .category-btn-outline,
    .category-btn-primary {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 7px;
        min-height: 43px;
        padding: 0 13px;
        border-radius: 10px;
        text-decoration: none;
        font-size: 12px;
        font-weight: 700;
        transition: .22s ease;
    }


    .category-btn-outline {
        border: 1px solid #dce5e0;
        background: #fff;
        color: #34423a;
    }


    .category-btn-outline:hover {
        border-color: #16865b;
        color: #16865b;
    }


    .category-btn-primary {
        border: 1px solid #16865b;
        background: #16865b;
        color: #fff;
    }


    .category-btn-primary:hover {
        border-color: #116b49;
        background: #116b49;
        color: #fff;
        transform: translateY(-1px);
    }



    /* =====================================================
       EMPTY STATE
    ===================================================== */

    .category-empty-state {
        grid-column: 1 / -1;
        padding: 80px 25px;
        border: 1px dashed #d9e3dd;
        border-radius: 22px;
        background: #fafcfb;
        text-align: center;
    }


    .category-empty-icon {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 72px;
        height: 72px;
        margin: 0 auto 20px;
        border-radius: 20px;
        background: #edf7f2;
        color: #16865b;
        font-size: 28px;
    }


    .category-empty-state h3 {
        margin-bottom: 8px;
        color: #1b2720;
    }


    .category-empty-state p {
        max-width: 500px;
        margin: 0 auto 25px;
        color: #7b8580;
    }



    /* =====================================================
       PAGINATION
    ===================================================== */

    .category-pagination {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 18px;
        margin-top: 50px;
    }


    .category-page,
    .category-page-number {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        text-decoration: none;
        transition: .2s ease;
    }


    .category-page {
        gap: 7px;
        min-height: 42px;
        padding: 0 15px;
        border: 1px solid #dfe6e2;
        border-radius: 10px;
        color: #536159;
        font-size: 13px;
        font-weight: 600;
    }


    .category-page:hover {
        border-color: #16865b;
        color: #16865b;
    }


    .category-page.disabled {
        opacity: .45;
        pointer-events: none;
    }


    .category-page-numbers {
        display: flex;
        gap: 7px;
    }


    .category-page-number {
        width: 40px;
        height: 40px;
        border-radius: 10px;
        color: #5b6760;
        font-size: 13px;
        font-weight: 700;
    }


    .category-page-number:hover,
    .category-page-number.active {
        background: #16865b;
        color: #fff;
    }



    /* =====================================================
       FINAL CTA
    ===================================================== */

    .category-final-cta {
        padding: 0 0 90px;
    }


    .category-final-inner {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 35px;
        padding: 48px 55px;
        border-radius: 25px;
        background:
            radial-gradient(
                circle at 90% 30%,
                rgba(255,255,255,.13),
                transparent 30%
            ),
            #17241d;
        box-shadow: 0 20px 55px rgba(21, 39, 29, .12);
    }


    .category-final-content .section-eyebrow {
        color: #8ed8b5;
    }


    .category-final-content h2 {
        max-width: 620px;
        margin: 9px 0 10px;
        color: #fff;
        font-size: clamp(25px, 3vw, 36px);
        line-height: 1.2;
        font-weight: 800;
    }


    .category-final-content p {
        max-width: 620px;
        margin: 0;
        color: #b6c4bc;
        line-height: 1.7;
    }


    .category-final-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 9px;
        flex-shrink: 0;
        min-height: 48px;
        padding: 0 20px;
        border-radius: 11px;
        background: #fff;
        color: #17241d;
        text-decoration: none;
        font-size: 13px;
        font-weight: 750;
        transition: .22s ease;
    }


    .category-final-btn:hover {
        background: #e8f6ef;
        color: #116b49;
        transform: translateY(-2px);
    }



    /* =====================================================
       RESPONSIVE
    ===================================================== */

    @media (max-width: 991px) {

        .category-hero-layout {
            grid-template-columns: 1fr;
            gap: 45px;
        }


        .category-hero-visual {
            min-height: 260px;
        }


        .category-services-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }


        .category-final-inner {
            padding: 40px;
        }

    }


    @media (max-width: 767px) {

        .category-show-hero {
            padding: 30px 0 55px;
        }


        .category-breadcrumb {
            margin-bottom: 35px;
        }


        .category-hero-content h1 {
            font-size: 42px;
            letter-spacing: -1.5px;
        }


        .category-hero-content > p {
            font-size: 16px;
        }


        .category-hero-stats {
            gap: 16px;
        }


        .category-services {
            padding: 65px 0;
        }


        .category-services-header {
            display: block;
            margin-bottom: 32px;
        }


        .category-view-all {
            margin-top: 18px;
        }


        .category-services-grid {
            grid-template-columns: 1fr;
        }


        .category-service-image {
            height: 235px;
        }


        .category-pagination {
            flex-wrap: wrap;
        }


        .category-final-inner {
            display: block;
            padding: 32px 25px;
        }


        .category-final-btn {
            margin-top: 25px;
        }

    }


    @media (max-width: 480px) {

        .category-hero-content h1 {
            font-size: 36px;
        }


        .category-hero-stats {
            align-items: flex-start;
        }


        .category-stat-divider {
            display: none;
        }


        .category-hero-stat {
            flex: 1;
        }


        .category-service-buttons {
            grid-template-columns: 1fr;
        }

    }

</style>

@endpush

@endsection