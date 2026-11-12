@extends('layouts.app')

@section('title', 'Customer Dashboard')

@section('content')

<style>
    .dashboard-page {
        background: #f7f8fc;
        min-height: calc(100vh - 70px);
    }

    /* =========================
       Welcome Header
    ========================== */

    .welcome-card {
        position: relative;
        overflow: hidden;
        background: linear-gradient(135deg, #0d6efd 0%, #4f8dfd 100%);
        border-radius: 24px;
        color: #fff;
        padding: 35px 40px;
        box-shadow: 0 15px 40px rgba(13, 110, 253, 0.18);
    }

    .welcome-card::before,
    .welcome-card::after {
        content: "";
        position: absolute;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.08);
    }

    .welcome-card::before {
        width: 220px;
        height: 220px;
        right: -70px;
        top: -100px;
    }

    .welcome-card::after {
        width: 160px;
        height: 160px;
        right: 120px;
        bottom: -100px;
    }

    .welcome-content {
        position: relative;
        z-index: 2;
    }

    .welcome-label {
        font-size: 12px;
        font-weight: 700;
        letter-spacing: 1.5px;
        opacity: .8;
    }

    .welcome-title {
        font-size: 32px;
        font-weight: 800;
        margin: 8px 0 8px;
    }

    .welcome-description {
        color: rgba(255,255,255,.82);
        margin-bottom: 0;
        max-width: 600px;
    }

    .welcome-icon {
        position: absolute;
        right: 45px;
        bottom: 20px;
        font-size: 110px;
        color: rgba(255,255,255,.10);
        z-index: 1;
    }


    /* =========================
       Section Titles
    ========================== */

    .section-title {
        font-size: 21px;
        font-weight: 750;
        color: #172033;
        margin-bottom: 4px;
    }

    .section-subtitle {
        color: #7c8497;
        font-size: 14px;
        margin-bottom: 0;
    }


    /* =========================
       Statistics Cards
    ========================== */

    .stat-card {
        position: relative;
        overflow: hidden;
        border: 1px solid #edf0f5;
        background: #fff;
        border-radius: 20px;
        transition: all .25s ease;
        height: 100%;
    }

    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 35px rgba(30, 40, 70, .09) !important;
        border-color: transparent;
    }

    .stat-card::after {
        content: "";
        position: absolute;
        width: 90px;
        height: 90px;
        border-radius: 50%;
        right: -35px;
        bottom: -45px;
        background: rgba(13, 110, 253, .035);
    }

    .stat-label {
        font-size: 13px;
        font-weight: 600;
        color: #7c8497;
    }

    .stat-number {
        font-size: 30px;
        font-weight: 800;
        color: #172033;
        line-height: 1;
    }

    .stat-icon {
        width: 52px;
        height: 52px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 15px;
        font-size: 22px;
    }

    .icon-blue {
        background: #eef5ff;
        color: #0d6efd;
    }

    .icon-yellow {
        background: #fff8e5;
        color: #e6a700;
    }

    .icon-green {
        background: #eaf9f0;
        color: #198754;
    }

    .icon-red {
        background: #fff0f1;
        color: #dc3545;
    }


    /* =========================
       Bookings
    ========================== */

    .booking-card {
        background: #fff;
        border: 1px solid #edf0f5;
        border-radius: 20px;
        transition: all .25s ease;
    }

    .booking-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 12px 30px rgba(30, 40, 70, .07);
        border-color: #e1e6ef;
    }

    .service-icon {
        width: 54px;
        height: 54px;
        flex-shrink: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #eef5ff;
        color: #0d6efd;
        border-radius: 15px;
        font-size: 22px;
    }

    .service-name {
        color: #172033;
        font-size: 16px;
        font-weight: 750;
    }

    .booking-id {
        font-size: 12px;
        color: #9aa2b1;
    }

    .booking-meta-label {
        display: block;
        font-size: 11px;
        font-weight: 600;
        color: #9aa2b1;
        text-transform: uppercase;
        letter-spacing: .5px;
        margin-bottom: 5px;
    }

    .booking-meta-value {
        color: #252d3d;
        font-size: 14px;
        font-weight: 650;
    }

    .price-value {
        font-size: 15px;
        font-weight: 750;
        color: #172033;
    }


    /* =========================
       Status
    ========================== */

    .status-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        font-size: 11px;
        font-weight: 700;
        border-radius: 50px;
        padding: 8px 12px;
        white-space: nowrap;
    }

    .status-dot {
        width: 6px;
        height: 6px;
        border-radius: 50%;
        background: currentColor;
    }


    /* =========================
       Buttons
    ========================== */

    .btn-dashboard {
        border-radius: 12px;
        font-weight: 650;
        font-size: 13px;
        padding: 9px 16px;
        transition: all .2s ease;
    }

    .btn-dashboard:hover {
        transform: translateY(-1px);
    }

    .btn-view-all {
        font-size: 13px;
        font-weight: 650;
        border-radius: 10px;
        padding: 9px 17px;
    }


    /* =========================
       Quick Actions
    ========================== */

    .action-card {
        display: block;
        background: #fff;
        border: 1px solid #edf0f5;
        border-radius: 20px;
        color: inherit;
        transition: all .25s ease;
        height: 100%;
    }

    .action-card:hover {
        color: inherit;
        transform: translateY(-4px);
        box-shadow: 0 15px 35px rgba(30, 40, 70, .08);
        border-color: rgba(13, 110, 253, .15);
    }

    .action-icon {
        width: 52px;
        height: 52px;
        border-radius: 15px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #eef5ff;
        color: #0d6efd;
        font-size: 21px;
    }

    .action-title {
        color: #172033;
        font-size: 16px;
        font-weight: 750;
    }

    .action-description {
        color: #7c8497;
        font-size: 13px;
        line-height: 1.6;
    }

    .action-arrow {
        color: #0d6efd;
        transition: transform .2s ease;
    }

    .action-card:hover .action-arrow {
        transform: translateX(4px);
    }


    /* =========================
       Empty State
    ========================== */

    .empty-state {
        background: #fff;
        border: 1px solid #edf0f5;
        border-radius: 20px;
        padding: 60px 20px;
    }

    .empty-icon {
        width: 75px;
        height: 75px;
        margin: 0 auto;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 22px;
        background: #f1f5fa;
        color: #9aa2b1;
        font-size: 32px;
    }


    /* =========================
       Responsive
    ========================== */

    @media (max-width: 767px) {

        .dashboard-page {
            padding-bottom: 30px;
        }

        .welcome-card {
            padding: 28px 24px;
            border-radius: 20px;
        }

        .welcome-title {
            font-size: 25px;
        }

        .welcome-icon {
            display: none;
        }

        .stat-number {
            font-size: 26px;
        }

        .booking-card {
            border-radius: 17px;
        }

        .section-title {
            font-size: 19px;
        }

        .btn-view-all {
            padding: 8px 12px;
        }
    }
</style>


<div class="dashboard-page py-4 py-lg-5">

    <div class="container">


        {{-- =========================
             Welcome Header
        ========================== --}}

        <div class="welcome-card mb-5">

            <div class="welcome-content">

                <div class="welcome-label">
                    MY ACCOUNT
                </div>

                <h1 class="welcome-title">
                    Welcome back, {{ auth()->user()->name }} 👋
                </h1>

                <p class="welcome-description">
                    Manage your bookings, explore services and keep track of everything from your dashboard.
                </p>

            </div>

            <i class="bi bi-grid-1x2-fill welcome-icon"></i>

        </div>


        {{-- =========================
             Statistics
        ========================== --}}

        <div class="mb-5">

            <div class="mb-3">
                <h2 class="section-title">
                    Overview
                </h2>

                <p class="section-subtitle">
                    A quick summary of your service bookings.
                </p>
            </div>


            <div class="row g-4">


                {{-- Total Bookings --}}

                <div class="col-6 col-xl-3">

                    <div class="stat-card shadow-sm">

                        <div class="card-body p-4">

                            <div class="d-flex justify-content-between align-items-start">

                                <div>

                                    <div class="stat-label">
                                        Total Bookings
                                    </div>

                                    <div class="stat-number mt-3">
                                        {{ $totalBookings }}
                                    </div>

                                </div>

                                <div class="stat-icon icon-blue">
                                    <i class="bi bi-calendar-check"></i>
                                </div>

                            </div>

                        </div>

                    </div>

                </div>


                {{-- Pending --}}

                <div class="col-6 col-xl-3">

                    <div class="stat-card shadow-sm">

                        <div class="card-body p-4">

                            <div class="d-flex justify-content-between align-items-start">

                                <div>

                                    <div class="stat-label">
                                        Pending
                                    </div>

                                    <div class="stat-number mt-3">
                                        {{ $pendingBookings }}
                                    </div>

                                </div>

                                <div class="stat-icon icon-yellow">
                                    <i class="bi bi-hourglass-split"></i>
                                </div>

                            </div>

                        </div>

                    </div>

                </div>


                {{-- Completed --}}

                <div class="col-6 col-xl-3">

                    <div class="stat-card shadow-sm">

                        <div class="card-body p-4">

                            <div class="d-flex justify-content-between align-items-start">

                                <div>

                                    <div class="stat-label">
                                        Completed
                                    </div>

                                    <div class="stat-number mt-3">
                                        {{ $completedBookings }}
                                    </div>

                                </div>

                                <div class="stat-icon icon-green">
                                    <i class="bi bi-check-circle"></i>
                                </div>

                            </div>

                        </div>

                    </div>

                </div>


                {{-- Cancelled --}}

                <div class="col-6 col-xl-3">

                    <div class="stat-card shadow-sm">

                        <div class="card-body p-4">

                            <div class="d-flex justify-content-between align-items-start">

                                <div>

                                    <div class="stat-label">
                                        Cancelled
                                    </div>

                                    <div class="stat-number mt-3">
                                        {{ $cancelledBookings }}
                                    </div>

                                </div>

                                <div class="stat-icon icon-red">
                                    <i class="bi bi-x-circle"></i>
                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>


        {{-- =========================
             Recent Bookings
        ========================== --}}

        <div class="mb-5">

            <div class="d-flex justify-content-between align-items-center mb-4">

                <div>

                    <h2 class="section-title">
                        Recent Bookings
                    </h2>

                    <p class="section-subtitle">
                        Your latest service bookings and their current status.
                    </p>

                </div>

                <a href="{{ route('bookings.index') }}"
                   class="btn btn-outline-primary btn-view-all">

                    View All

                    <i class="bi bi-arrow-right ms-1"></i>

                </a>

            </div>


            @forelse($recentBookings as $booking)

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


                <div class="booking-card mb-3">

                    <div class="card-body p-3 p-lg-4">

                        <div class="row align-items-center g-4">


                            {{-- Service --}}

                            <div class="col-lg-4">

                                <div class="d-flex align-items-center gap-3">

                                    <div class="service-icon">
                                        <i class="bi bi-tools"></i>
                                    </div>

                                    <div>

                                        <div class="service-name">
                                            {{ $booking->service->name }}
                                        </div>

                                        <div class="booking-id mt-1">
                                            Booking #{{ $booking->id }}
                                        </div>

                                    </div>

                                </div>

                            </div>


                            {{-- Date --}}

                            <div class="col-6 col-md-4 col-lg-2">

                                <span class="booking-meta-label">
                                    Date
                                </span>

                                <span class="booking-meta-value">
                                    {{ \Carbon\Carbon::parse($booking->booking_date)->format('d M Y') }}
                                </span>

                            </div>


                            {{-- Price --}}

                            <div class="col-6 col-md-4 col-lg-2">

                                <span class="booking-meta-label">
                                    Price
                                </span>

                                <span class="price-value">
                                    ₹{{ number_format($booking->total_price, 0) }}
                                </span>

                            </div>


                            {{-- Status --}}

                            <div class="col-md-4 col-lg-2">

                                <span class="booking-meta-label">
                                    Status
                                </span>

                                <span class="status-badge {{ $statusClass }}">

                                    <span class="status-dot"></span>

                                    {{ ucwords(str_replace('_', ' ', $booking->status)) }}

                                </span>

                            </div>


                            {{-- Details --}}

                            <div class="col-lg-2 text-lg-end">

                                <a href="{{ route('bookings.show', $booking->id) }}"
                                   class="btn btn-outline-primary btn-dashboard">

                                    Details

                                    <i class="bi bi-arrow-right ms-1"></i>

                                </a>

                            </div>


                        </div>

                    </div>

                </div>


            @empty


                <div class="empty-state text-center shadow-sm">

                    <div class="empty-icon">

                        <i class="bi bi-calendar-x"></i>

                    </div>

                    <h4 class="fw-bold mt-4 mb-2">
                        No bookings yet
                    </h4>

                    <p class="text-muted mb-4">
                        You haven't booked any service yet.
                        Start exploring and book your first service.
                    </p>

                    <a href="{{ route('services.index') }}"
                       class="btn btn-primary btn-dashboard px-4">

                        Browse Services

                        <i class="bi bi-arrow-right ms-2"></i>

                    </a>

                </div>


            @endforelse

        </div>


        {{-- =========================
             Quick Actions
        ========================== --}}

        <div>

            <div class="mb-4">

                <h2 class="section-title">
                    Quick Actions
                </h2>

                <p class="section-subtitle">
                    Quickly access the things you use most.
                </p>

            </div>


            <div class="row g-4">


                {{-- Browse Services --}}

                <div class="col-md-6">

                    <a href="{{ route('services.index') }}"
                       class="text-decoration-none">

                        <div class="action-card">

                            <div class="card-body p-4">

                                <div class="d-flex justify-content-between align-items-start">

                                    <div class="action-icon">

                                        <i class="bi bi-search"></i>

                                    </div>

                                    <i class="bi bi-arrow-up-right action-arrow fs-5"></i>

                                </div>

                                <h5 class="action-title mt-4 mb-2">
                                    Browse Services
                                </h5>

                                <p class="action-description mb-0">
                                    Explore available home services and find the right service for your needs.
                                </p>

                            </div>

                        </div>

                    </a>

                </div>


                {{-- Manage Bookings --}}

                <div class="col-md-6">

                    <a href="{{ route('bookings.index') }}"
                       class="text-decoration-none">

                        <div class="action-card">

                            <div class="card-body p-4">

                                <div class="d-flex justify-content-between align-items-start">

                                    <div class="action-icon">

                                        <i class="bi bi-calendar-check"></i>

                                    </div>

                                    <i class="bi bi-arrow-up-right action-arrow fs-5"></i>

                                </div>

                                <h5 class="action-title mt-4 mb-2">
                                    Manage Bookings
                                </h5>

                                <p class="action-description mb-0">
                                    View, track and manage all your current and previous bookings.
                                </p>

                            </div>

                        </div>

                    </a>

                </div>


            </div>

        </div>


    </div>

</div>

@endsection