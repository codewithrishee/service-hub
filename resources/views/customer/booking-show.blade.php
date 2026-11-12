@extends('layouts.app')

@section('title', 'Booking Details')

@section('content')

<style>
    .details-page {
        background: #f7f8fc;
        min-height: calc(100vh - 70px);
    }

    /* =========================
       Header
    ========================== */

    .details-header {
        position: relative;
        overflow: hidden;
        background: linear-gradient(135deg, #0d6efd 0%, #4f8dfd 100%);
        border-radius: 24px;
        padding: 35px 40px;
        color: #fff;
        box-shadow: 0 15px 40px rgba(13, 110, 253, .16);
    }

    .details-header::before,
    .details-header::after {
        content: "";
        position: absolute;
        border-radius: 50%;
        background: rgba(255,255,255,.08);
    }

    .details-header::before {
        width: 230px;
        height: 230px;
        right: -75px;
        top: -110px;
    }

    .details-header::after {
        width: 160px;
        height: 160px;
        right: 140px;
        bottom: -105px;
    }

    .header-content {
        position: relative;
        z-index: 2;
    }

    .back-link {
        display: inline-flex;
        align-items: center;
        color: rgba(255,255,255,.82);
        text-decoration: none;
        font-size: 13px;
        font-weight: 600;
        margin-bottom: 18px;
        transition: all .2s ease;
    }

    .back-link:hover {
        color: #fff;
        transform: translateX(-2px);
    }

    .header-label {
        font-size: 11px;
        font-weight: 700;
        letter-spacing: 1.5px;
        opacity: .75;
    }

    .header-title {
        font-size: 31px;
        font-weight: 800;
        margin: 7px 0 5px;
    }

    .header-booking-id {
        font-size: 13px;
        color: rgba(255,255,255,.75);
    }

    .header-icon {
        position: absolute;
        right: 45px;
        bottom: 5px;
        font-size: 110px;
        color: rgba(255,255,255,.10);
        z-index: 1;
    }


    /* =========================
       Cards
    ========================== */

    .detail-card {
        background: #fff;
        border: 1px solid #edf0f5;
        border-radius: 20px;
        overflow: hidden;
        transition: all .2s ease;
    }

    .detail-card:hover {
        border-color: #e4e8ef;
    }

    .card-padding {
        padding: 26px;
    }

    .card-title {
        color: #172033;
        font-size: 18px;
        font-weight: 750;
    }

    .card-subtitle {
        color: #8a92a3;
        font-size: 13px;
    }


    /* =========================
       Service Card
    ========================== */

    .service-icon {
        width: 64px;
        height: 64px;
        flex-shrink: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #eef5ff;
        color: #0d6efd;
        border-radius: 17px;
        font-size: 26px;
    }

    .service-category {
        color: #8a92a3;
        font-size: 12px;
        font-weight: 600;
        margin-bottom: 4px;
    }

    .service-name {
        color: #172033;
        font-size: 21px;
        font-weight: 800;
        margin-bottom: 8px;
    }

    .service-description {
        color: #7c8497;
        font-size: 13px;
        line-height: 1.7;
        margin: 0;
    }


    /* =========================
       Information
    ========================== */

    .info-item {
        height: 100%;
        background: #fafbfc;
        border: 1px solid #f0f2f6;
        border-radius: 15px;
        padding: 17px;
        transition: all .2s ease;
    }

    .info-item:hover {
        background: #fff;
        border-color: #e4e8ef;
    }

    .info-icon {
        width: 43px;
        height: 43px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #eef5ff;
        color: #0d6efd;
        border-radius: 12px;
        font-size: 18px;
        flex-shrink: 0;
    }

    .info-label {
        display: block;
        color: #9aa2b1;
        font-size: 10px;
        font-weight: 700;
        letter-spacing: .7px;
        text-transform: uppercase;
        margin-bottom: 4px;
    }

    .info-value {
        color: #252d3d;
        font-size: 14px;
        font-weight: 650;
        line-height: 1.5;
    }


    /* =========================
       Status
    ========================== */

    .status-container {
        display: flex;
        align-items: center;
        justify-content: space-between;
        background: #fafbfc;
        border: 1px solid #f0f2f6;
        border-radius: 14px;
        padding: 13px 15px;
    }

    .status-label {
        color: #8a92a3;
        font-size: 12px;
        font-weight: 600;
    }

    .status-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        border-radius: 50px;
        padding: 8px 13px;
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
       Payment
    ========================== */

    .payment-row {
        display: flex;
        align-items: center;
        justify-content: space-between;
        color: #6f7788;
        font-size: 13px;
    }

    .payment-row strong {
        color: #252d3d;
        font-weight: 650;
    }

    .payment-total {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-top: 16px;
        padding-top: 17px;
        border-top: 1px dashed #e2e6ed;
    }

    .payment-total-label {
        color: #172033;
        font-size: 14px;
        font-weight: 750;
    }

    .payment-total-price {
        color: #0d6efd;
        font-size: 22px;
        font-weight: 800;
    }


    /* =========================
       Action Buttons
    ========================== */

    .action-btn {
        border-radius: 11px;
        padding: 11px 15px;
        font-size: 13px;
        font-weight: 650;
        transition: all .2s ease;
    }

    .action-btn:hover {
        transform: translateY(-1px);
    }

    .cancel-btn {
        border-radius: 11px;
        padding: 11px 15px;
        font-size: 13px;
        font-weight: 650;
    }


    /* =========================
       Notes
    ========================== */

    .notes-box {
        background: #fffaf0;
        border: 1px solid #f7e7bd;
        border-radius: 15px;
        padding: 17px;
    }

    .notes-icon {
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #fff1c9;
        color: #c28a00;
        border-radius: 11px;
        flex-shrink: 0;
    }

    .notes-label {
        color: #9b7721;
        font-size: 10px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: .7px;
        margin-bottom: 4px;
    }

    .notes-text {
        color: #5e4d27;
        font-size: 13px;
        line-height: 1.6;
    }


    /* =========================
       Responsive
    ========================== */

    @media (max-width: 767px) {

        .details-header {
            padding: 28px 24px;
            border-radius: 20px;
        }

        .header-title {
            font-size: 25px;
        }

        .header-icon {
            display: none;
        }

        .card-padding {
            padding: 20px;
        }

        .service-name {
            font-size: 18px;
        }

        .info-item {
            padding: 14px;
        }
    }
</style>


<div class="details-page py-4 py-lg-5">

    <div class="container">


        {{-- =========================
             Header
        ========================== --}}

        <div class="details-header mb-5">

            <div class="header-content">

                <a href="{{ route('bookings.index') }}"
                   class="back-link">

                    <i class="bi bi-arrow-left me-2"></i>
                    Back to My Bookings

                </a>

                <div class="header-label">
                    BOOKING DETAILS
                </div>

                <h1 class="header-title">
                    {{ $booking->service->name }}
                </h1>

                <div class="header-booking-id">
                    Booking #{{ $booking->id }}
                </div>

            </div>

            <i class="bi bi-calendar2-check-fill header-icon"></i>

        </div>


        <div class="row g-4">


            {{-- =========================
                 Main Content
            ========================== --}}

            <div class="col-lg-8">


                {{-- Service Card --}}

                <div class="detail-card mb-4">

                    <div class="card-padding">

                        <div class="d-flex align-items-start gap-3">

                            <div class="service-icon">

                                <i class="bi bi-tools"></i>

                            </div>

                            <div class="flex-grow-1">

                                <div class="service-category">
                                    {{ $booking->service->category->name ?? 'Service' }}
                                </div>

                                <h2 class="service-name">
                                    {{ $booking->service->name }}
                                </h2>

                                <p class="service-description">
                                    {{ $booking->service->description }}
                                </p>

                            </div>

                        </div>

                    </div>

                </div>


                {{-- Booking Information --}}

                <div class="detail-card mb-4">

                    <div class="card-padding">

                        <div class="mb-4">

                            <h3 class="card-title mb-1">
                                Booking Information
                            </h3>

                            <p class="card-subtitle mb-0">
                                Details related to your scheduled service.
                            </p>

                        </div>


                        <div class="row g-3">


                            {{-- Date --}}

                            <div class="col-md-6">

                                <div class="info-item">

                                    <div class="d-flex align-items-center gap-3">

                                        <div class="info-icon">
                                            <i class="bi bi-calendar-event"></i>
                                        </div>

                                        <div>

                                            <span class="info-label">
                                                Booking Date
                                            </span>

                                            <div class="info-value">
                                                {{ \Carbon\Carbon::parse($booking->booking_date)->format('d M Y') }}
                                            </div>

                                        </div>

                                    </div>

                                </div>

                            </div>


                            {{-- Time --}}

                            <div class="col-md-6">

                                <div class="info-item">

                                    <div class="d-flex align-items-center gap-3">

                                        <div class="info-icon">
                                            <i class="bi bi-clock"></i>
                                        </div>

                                        <div>

                                            <span class="info-label">
                                                Booking Time
                                            </span>

                                            <div class="info-value">
                                                {{ \Carbon\Carbon::parse($booking->booking_time)->format('h:i A') }}
                                            </div>

                                        </div>

                                    </div>

                                </div>

                            </div>


                            {{-- Address --}}

                            <div class="col-12">

                                <div class="info-item">

                                    <div class="d-flex align-items-start gap-3">

                                        <div class="info-icon">
                                            <i class="bi bi-geo-alt"></i>
                                        </div>

                                        <div>

                                            <span class="info-label">
                                                Service Address
                                            </span>

                                            <div class="info-value">
                                                {{ $booking->address }}
                                            </div>

                                        </div>

                                    </div>

                                </div>

                            </div>


                            {{-- Notes --}}

                            @if($booking->notes)

                                <div class="col-12">

                                    <div class="notes-box">

                                        <div class="d-flex align-items-start gap-3">

                                            <div class="notes-icon">
                                                <i class="bi bi-chat-left-text"></i>
                                            </div>

                                            <div>

                                                <div class="notes-label">
                                                    Additional Notes
                                                </div>

                                                <div class="notes-text">
                                                    {{ $booking->notes }}
                                                </div>

                                            </div>

                                        </div>

                                    </div>

                                </div>

                            @endif


                        </div>

                    </div>

                </div>


            </div>


            {{-- =========================
                 Sidebar
            ========================== --}}

            <div class="col-lg-4">


                {{-- Status Card --}}

                <div class="detail-card mb-4">

                    <div class="card-padding">

                        <h3 class="card-title mb-3">
                            Booking Status
                        </h3>

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


                        <div class="status-container">

                            <span class="status-label">
                                Current Status
                            </span>

                            <span class="status-badge {{ $statusClass }}">

                                <span class="status-dot"></span>

                                {{ ucwords(str_replace('_', ' ', $booking->status)) }}

                            </span>

                        </div>

                    </div>

                </div>


                {{-- Payment Summary --}}

                <div class="detail-card mb-4">

                    <div class="card-padding">

                        <h3 class="card-title mb-4">
                            Payment Summary
                        </h3>


                        <div class="payment-row">

                            <span>
                                Service
                            </span>

                            <strong>
                                ₹{{ number_format($booking->total_price, 0) }}
                            </strong>

                        </div>


                        <div class="payment-total">

                            <span class="payment-total-label">
                                Total
                            </span>

                            <span class="payment-total-price">
                                ₹{{ number_format($booking->total_price, 0) }}
                            </span>

                        </div>

                    </div>

                </div>


                {{-- Actions --}}

                <div class="detail-card">

                    <div class="card-padding">

                        <h3 class="card-title mb-3">
                            Actions
                        </h3>


                        <a href="{{ route('bookings.index') }}"
                           class="btn btn-primary w-100 action-btn mb-2">

                            <i class="bi bi-arrow-left me-2"></i>

                            Back to My Bookings

                        </a>


                        @if($booking->status === 'pending')

                            <form action="{{ route('bookings.cancel', $booking->id) }}"
                                  method="POST"
                                  onsubmit="return confirm('Are you sure you want to cancel this booking?');">

                                @csrf
                                @method('PATCH')

                                <button type="submit"
                                        class="btn btn-outline-danger w-100 cancel-btn">

                                    <i class="bi bi-x-circle me-2"></i>

                                    Cancel Booking

                                </button>

                            </form>

                        @endif


                    </div>

                </div>


            </div>


        </div>

    </div>

</div>

@endsection