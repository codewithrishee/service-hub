@extends('layouts.app')

@section('title', 'My Bookings')

@section('content')

<style>
    .bookings-page {
        background: #f7f8fc;
        min-height: calc(100vh - 70px);
    }

    /* =========================
       Page Header
    ========================== */

    .bookings-header {
        position: relative;
        overflow: hidden;
        background: linear-gradient(135deg, #0d6efd 0%, #4f8dfd 100%);
        border-radius: 24px;
        padding: 35px 40px;
        color: #fff;
        box-shadow: 0 15px 40px rgba(13, 110, 253, .16);
    }

    .bookings-header::before,
    .bookings-header::after {
        content: "";
        position: absolute;
        border-radius: 50%;
        background: rgba(255,255,255,.08);
    }

    .bookings-header::before {
        width: 220px;
        height: 220px;
        right: -70px;
        top: -100px;
    }

    .bookings-header::after {
        width: 150px;
        height: 150px;
        right: 150px;
        bottom: -100px;
    }

    .header-content {
        position: relative;
        z-index: 2;
    }

    .header-label {
        font-size: 12px;
        font-weight: 700;
        letter-spacing: 1.5px;
        opacity: .8;
    }

    .header-title {
        font-size: 32px;
        font-weight: 800;
        margin: 8px 0 8px;
    }

    .header-description {
        color: rgba(255,255,255,.82);
        margin: 0;
        max-width: 650px;
    }

    .header-icon {
        position: absolute;
        right: 45px;
        bottom: 10px;
        font-size: 105px;
        color: rgba(255,255,255,.10);
        z-index: 1;
    }


    /* =========================
       Success Alert
    ========================== */

    .booking-alert {
        border: 0;
        border-radius: 15px;
        padding: 14px 18px;
        box-shadow: 0 5px 20px rgba(25,135,84,.07);
    }


    /* =========================
       Booking Card
    ========================== */

    .booking-card {
        background: #fff;
        border: 1px solid #edf0f5;
        border-radius: 22px;
        overflow: hidden;
        transition: all .25s ease;
    }

    .booking-card:hover {
        transform: translateY(-4px);
        border-color: transparent;
        box-shadow: 0 15px 40px rgba(30,40,70,.08);
    }

    .booking-main {
        padding: 25px;
    }


    /* =========================
       Service
    ========================== */

    .service-icon {
        width: 58px;
        height: 58px;
        flex-shrink: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #eef5ff;
        color: #0d6efd;
        border-radius: 16px;
        font-size: 23px;
    }

    .service-name {
        font-size: 17px;
        font-weight: 750;
        color: #172033;
        margin-bottom: 4px;
    }

    .service-category {
        font-size: 13px;
        color: #8a92a3;
    }

    .booking-number {
        display: inline-block;
        font-size: 11px;
        font-weight: 650;
        color: #9aa2b1;
        background: #f6f7fa;
        border-radius: 6px;
        padding: 4px 8px;
        margin-top: 8px;
    }


    /* =========================
       Information
    ========================== */

    .info-box {
        background: #fafbfc;
        border: 1px solid #f0f2f6;
        border-radius: 13px;
        padding: 12px 14px;
    }

    .info-label {
        display: block;
        color: #9aa2b1;
        font-size: 10px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: .7px;
        margin-bottom: 5px;
    }

    .info-value {
        color: #252d3d;
        font-size: 14px;
        font-weight: 650;
    }

    .price-value {
        color: #172033;
        font-size: 18px;
        font-weight: 800;
    }


    /* =========================
       Status
    ========================== */

    .status-wrapper {
        display: flex;
        align-items: center;
        gap: 7px;
    }

    .status-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        border-radius: 50px;
        padding: 8px 12px;
        font-size: 11px;
        font-weight: 700;
    }

    .status-dot {
        width: 6px;
        height: 6px;
        border-radius: 50%;
        background: currentColor;
    }


    /* =========================
       Address
    ========================== */

    .address-section {
        border-top: 1px solid #edf0f5;
        padding: 18px 25px;
        background: #fcfcfd;
    }

    .address-icon {
        width: 38px;
        height: 38px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #eef5ff;
        color: #0d6efd;
        border-radius: 11px;
        flex-shrink: 0;
    }

    .address-label {
        font-size: 10px;
        font-weight: 700;
        color: #9aa2b1;
        text-transform: uppercase;
        letter-spacing: .6px;
        margin-bottom: 3px;
    }

    .address-text {
        font-size: 13px;
        color: #424b5d;
        line-height: 1.5;
    }


    /* =========================
       Details Button
    ========================== */

    .details-btn {
        border-radius: 11px;
        padding: 9px 16px;
        font-size: 12px;
        font-weight: 650;
        transition: all .2s ease;
    }

    .details-btn:hover {
        transform: translateY(-1px);
    }


    /* =========================
       Empty State
    ========================== */

    .empty-state {
        background: #fff;
        border: 1px solid #edf0f5;
        border-radius: 22px;
        padding: 70px 25px;
        text-align: center;
    }

    .empty-icon {
        width: 82px;
        height: 82px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto;
        background: #f1f5fa;
        color: #9aa2b1;
        border-radius: 24px;
        font-size: 34px;
    }

    .empty-title {
        color: #172033;
        font-weight: 800;
        margin-top: 22px;
    }

    .empty-description {
        color: #8a92a3;
        font-size: 14px;
        margin-bottom: 24px;
    }

    .browse-btn {
        border-radius: 11px;
        padding: 10px 19px;
        font-size: 13px;
        font-weight: 650;
    }


    /* =========================
       Responsive
    ========================== */

    @media (max-width: 767px) {

        .bookings-page {
            padding-bottom: 30px;
        }

        .bookings-header {
            padding: 28px 24px;
            border-radius: 20px;
        }

        .header-title {
            font-size: 25px;
        }

        .header-icon {
            display: none;
        }

        .booking-main {
            padding: 20px;
        }

        .address-section {
            padding: 16px 20px;
        }

        .service-name {
            font-size: 16px;
        }

        .info-box {
            padding: 11px 12px;
        }
    }
</style>


<div class="bookings-page py-4 py-lg-5">

    <div class="container">


        {{-- =========================
             Success Message
        ========================== --}}

        @if(session('success'))

            <div class="alert alert-success booking-alert alert-dismissible fade show mb-4"
                 role="alert">

                <i class="bi bi-check-circle-fill me-2"></i>

                {{ session('success') }}

                <button type="button"
                        class="btn-close"
                        data-bs-dismiss="alert"
                        aria-label="Close">
                </button>

            </div>

        @endif


        {{-- =========================
             Page Header
        ========================== --}}

        <div class="bookings-header mb-5">

            <div class="header-content">

                <div class="header-label">
                    MY ACCOUNT
                </div>

                <h1 class="header-title">
                    My Bookings
                </h1>

                <p class="header-description">
                    View, track and manage all your service bookings in one place.
                </p>

            </div>

            <i class="bi bi-calendar2-check-fill header-icon"></i>

        </div>


        {{-- =========================
             Bookings
        ========================== --}}

        @forelse($bookings as $booking)

            @php

                $statusClass = match($booking->status) {

                    'pending'
                        => 'bg-warning-subtle text-warning-emphasis',

                    'confirmed'
                        => 'bg-primary-subtle text-primary',

                    'in_progress'
                        => 'bg-info-subtle text-info-emphasis',

                    'completed'
                        => 'bg-success-subtle text-success',

                    'cancelled'
                        => 'bg-danger-subtle text-danger',

                    default
                        => 'bg-secondary-subtle text-secondary',

                };

            @endphp


            <div class="booking-card mb-4">

                {{-- =========================
                     Main Booking Content
                ========================== --}}

                <div class="booking-main">

                    <div class="row g-4 align-items-center">


                        {{-- Service Info --}}

                        <div class="col-lg-4">

                            <div class="d-flex align-items-start gap-3">

                                <div class="service-icon">
                                    <i class="bi bi-tools"></i>
                                </div>

                                <div>

                                    <div class="service-name">
                                        {{ $booking->service->name }}
                                    </div>

                                    <div class="service-category">
                                        {{ $booking->service->category->name ?? 'Service' }}
                                    </div>

                                    <span class="booking-number">
                                        Booking #{{ $booking->id }}
                                    </span>

                                </div>

                            </div>

                        </div>


                        {{-- Date & Time --}}

                        <div class="col-6 col-lg-2">

                            <div class="info-box">

                                <span class="info-label">
                                    Date
                                </span>

                                <div class="info-value">
                                    {{ \Carbon\Carbon::parse($booking->booking_date)->format('d M Y') }}
                                </div>

                            </div>

                            <div class="info-box mt-2">

                                <span class="info-label">
                                    Time
                                </span>

                                <div class="info-value">
                                    {{ \Carbon\Carbon::parse($booking->booking_time)->format('h:i A') }}
                                </div>

                            </div>

                        </div>


                        {{-- Price --}}

                        <div class="col-6 col-lg-2">

                            <div class="info-box h-100 d-flex flex-column justify-content-center">

                                <span class="info-label">
                                    Total Price
                                </span>

                                <div class="price-value">
                                    ₹{{ number_format($booking->total_price, 0) }}
                                </div>

                            </div>

                        </div>


                        {{-- Status --}}

                        <div class="col-md-6 col-lg-2">

                            <div class="info-box">

                                <span class="info-label">
                                    Status
                                </span>

                                <div class="status-wrapper">

                                    <span class="status-badge {{ $statusClass }}">

                                        <span class="status-dot"></span>

                                        {{ ucwords(str_replace('_', ' ', $booking->status)) }}

                                    </span>

                                </div>

                            </div>

                        </div>


                        {{-- Action --}}

                        <div class="col-md-6 col-lg-2 text-lg-end">

                            <a href="{{ route('bookings.show', $booking->id) }}"
                               class="btn btn-outline-primary details-btn">

                                View Details

                                <i class="bi bi-arrow-right ms-1"></i>

                            </a>

                        </div>


                    </div>

                </div>


                {{-- =========================
                     Address
                ========================== --}}

                <div class="address-section">

                    <div class="d-flex align-items-start gap-3">

                        <div class="address-icon">
                            <i class="bi bi-geo-alt"></i>
                        </div>

                        <div>

                            <div class="address-label">
                                Service Address
                            </div>

                            <div class="address-text">
                                {{ $booking->address }}
                            </div>

                        </div>

                    </div>

                </div>

            </div>


        @empty


            {{-- =========================
                 Empty State
            ========================== --}}

            <div class="empty-state shadow-sm">

                <div class="empty-icon">

                    <i class="bi bi-calendar-x"></i>

                </div>

                <h3 class="empty-title">
                    No Bookings Yet
                </h3>

                <p class="empty-description">
                    You haven't booked any services yet.
                    Explore our services and make your first booking.
                </p>

                <a href="{{ route('services.index') }}"
                   class="btn btn-primary browse-btn">

                    Browse Services

                    <i class="bi bi-arrow-right ms-2"></i>

                </a>

            </div>


        @endforelse


    </div>

</div>

@endsection