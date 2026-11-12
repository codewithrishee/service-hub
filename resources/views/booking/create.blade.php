@extends('layouts.app')

@section('content')

    <link rel="stylesheet" href="{{ asset('css/form.css') }}">

    <div class="servicehub-booking-create">

        {{-- ============================================================
        SECTION 1 — PAGE HEADER / BREADCRUMB
        ============================================================ --}}
        <nav aria-label="breadcrumb" class="booking-breadcrumb">
            <div class="container">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('services.index') }}">Services</a></li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('services.show', $service->slug) }}">{{ $service->name }}</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Book Service</li>
                </ol>
            </div>
        </nav>


        {{-- ============================================================
        SECTION 2 — PAGE INTRO
        ============================================================ --}}
        <section class="booking-intro">
            <div class="container">
                <div class="booking-intro-inner">
                    <span class="booking-eyebrow">
                        <i class="bi bi-calendar-check"></i> Booking
                    </span>
                    <h1 class="booking-heading">Confirm Your Booking</h1>
                    <p class="booking-subheading">
                        Fill in your details below and a verified professional will be assigned
                        to your service. You will receive a confirmation shortly.
                    </p>
                </div>
            </div>
        </section>


        {{-- ============================================================
        SECTION 3 — BOOKING LAYOUT
        ============================================================ --}}
        <section class="booking-section">
            <div class="container">
                <div class="row g-4 g-lg-5">

                    {{-- ============================================
                    LEFT / TOP: SERVICE SUMMARY CARD
                    ============================================ --}}
                    <div class="col-lg-5 order-lg-2">
                        <aside class="booking-summary-card">

                            <div class="summary-card-header">
                                <span class="summary-card-eyebrow">Selected Service</span>
                                <h2 class="summary-card-title">{{ $service->name }}</h2>
                                <span class="summary-card-category">
                                    <i class="bi bi-tag"></i> {{ $service->category->name }}
                                </span>
                            </div>

                            <div class="summary-card-body">

                                <div class="summary-row">
                                    <span class="summary-label">
                                        <i class="bi bi-currency-rupee"></i> Price
                                    </span>
                                    <span class="summary-value summary-value-price">
                                        ₹{{ number_format($service->price, 0) }}
                                    </span>
                                </div>

                                <div class="summary-row">
                                    <span class="summary-label">
                                        <i class="bi bi-clock"></i> Duration
                                    </span>
                                    <span class="summary-value">
                                        {{ $service->duration }} min
                                    </span>
                                </div>

                                <div class="summary-row">
                                    <span class="summary-label">
                                        <i class="bi bi-patch-check-fill"></i> Professional
                                    </span>
                                    <span class="summary-value summary-value-verified">
                                        Verified
                                    </span>
                                </div>

                            </div>

                            <div class="summary-card-footer">
                                <div class="summary-trust">
                                    <span class="trust-pill">
                                        <i class="bi bi-shield-lock-fill"></i> Secure
                                    </span>
                                    <span class="trust-pill">
                                        <i class="bi bi-patch-check-fill"></i> Verified
                                    </span>
                                    <span class="trust-pill">
                                        <i class="bi bi-headset"></i> Support
                                    </span>
                                </div>
                            </div>

                        </aside>
                    </div>


                    {{-- ============================================
                    RIGHT / BOTTOM: BOOKING FORM
                    ============================================ --}}
                    <div class="col-lg-7 order-lg-1">
                        <div class="booking-form-card">

                            <div class="form-card-header">
                                <h2 class="form-card-title">Booking Details</h2>
                                <p class="form-card-desc">
                                    Provide your preferred date, time and service address.
                                </p>
                            </div>

                            <form action="{{ route('booking.store') }}" method="POST" class="booking-form">
                                @csrf

                                <input type="hidden" name="service_id" value="{{ $service->id }}">


                                @if($errors->any())
                                    <div class="alert alert-danger mb-4">
                                        <strong>Please fix the following:</strong>

                                        <ul class="mb-0 mt-2">
                                            @foreach($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                <div class="row g-3 g-md-4">

                                    {{-- Booking Date --}}
                                    <div class="col-md-6">
                                        <label for="booking_date" class="form-label">
                                            Booking Date <span class="required">*</span>
                                        </label>
                                        <div class="input-icon-wrap">
                                            <i class="bi bi-calendar-event input-icon"></i>
                                            <input type="date" id="booking_date" name="booking_date"
                                                class="form-control form-control-premium" value="{{ old('booking_date') }}"
                                                min="{{ date('Y-m-d') }}" required>
                                        </div>
                                    </div>

                                    {{-- Booking Time --}}
                                    <div class="col-md-6">
                                        <label for="booking_time" class="form-label">
                                            Booking Time <span class="required">*</span>
                                        </label>
                                        <div class="input-icon-wrap">
                                            <i class="bi bi-clock input-icon"></i>
                                            <input type="time" id="booking_time" name="booking_time"
                                                class="form-control form-control-premium" value="{{ old('booking_time') }}"
                                                required>
                                        </div>
                                    </div>

                                    {{-- Address --}}
                                    <div class="col-12">
                                        <label for="address" class="form-label">
                                            Service Address <span class="required">*</span>
                                        </label>
                                        <textarea id="address" name="address" rows="3"
                                            class="form-control form-control-premium"
                                            placeholder="Enter your full address with landmark"
                                            required>{{ old('address') }}</textarea>
                                    </div>

                                    {{-- Notes --}}
                                    <div class="col-12">
                                        <label for="notes" class="form-label">
                                            Additional Notes <span class="optional">(optional)</span>
                                        </label>
                                        <textarea id="notes" name="notes" rows="3" class="form-control form-control-premium"
                                            placeholder="Any specific instructions for the professional">{{ old('notes') }}</textarea>
                                    </div>

                                </div>

                                <div class="booking-form-actions">
                                    <button type="submit" class="btn btn-confirm-booking">
                                        <i class="bi bi-check-circle"></i> Confirm Booking
                                    </button>
                                </div>

                                <p class="booking-form-note">
                                    <i class="bi bi-info-circle"></i>
                                    By confirming, you agree to our terms of service. You can cancel
                                    or reschedule from your bookings page.
                                </p>

                            </form>

                        </div>
                    </div>

                </div>
            </div>
        </section>

    </div>

@endsection