@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')

<div class="admin-page-header">

    <div>

        <span class="admin-page-eyebrow">
            ServiceHub admin
        </span>

        <h1>
            Dashboard
        </h1>

        <p>
            Welcome back, {{ auth()->user()->name }}. Here's what's happening today.
        </p>

    </div>

</div>


{{-- =========================================================
     STATISTICS
========================================================= --}}

<div class="row g-4 mb-4">

    {{-- Total Users --}}
    <div class="col-xl-3 col-md-6">

        <div class="admin-stat-card">

            <div class="admin-stat-icon">
                <i class="bi bi-people-fill"></i>
            </div>

            <div class="admin-stat-content">

                <span>Total Users</span>

                <h2>
                    {{ number_format($totalUsers) }}
                </h2>

                <small>
                    Registered customers
                </small>

            </div>

        </div>

    </div>


    {{-- Total Services --}}
    <div class="col-xl-3 col-md-6">

        <div class="admin-stat-card">

            <div class="admin-stat-icon">
                <i class="bi bi-tools"></i>
            </div>

            <div class="admin-stat-content">

                <span>Total Services</span>

                <h2>
                    {{ number_format($totalServices) }}
                </h2>

                <small>
                    Active service listings
                </small>

            </div>

        </div>

    </div>


    {{-- Total Bookings --}}
    <div class="col-xl-3 col-md-6">

        <div class="admin-stat-card">

            <div class="admin-stat-icon">
                <i class="bi bi-calendar-check-fill"></i>
            </div>

            <div class="admin-stat-content">

                <span>Total Bookings</span>

                <h2>
                    {{ number_format($totalBookings) }}
                </h2>

                <small>
                    All customer bookings
                </small>

            </div>

        </div>

    </div>


    {{-- Pending --}}
    <div class="col-xl-3 col-md-6">

        <div class="admin-stat-card">

            <div class="admin-stat-icon">
                <i class="bi bi-hourglass-split"></i>
            </div>

            <div class="admin-stat-content">

                <span>Pending Bookings</span>

                <h2>
                    {{ number_format($pendingBookings) }}
                </h2>

                <small>
                    Require attention
                </small>

            </div>

        </div>

    </div>

</div>


{{-- =========================================================
     RECENT BOOKINGS
========================================================= --}}

<div class="admin-card">

    <div class="admin-card-header">

        <div>

            <h3>
                Recent Bookings
            </h3>

            <p>
                Latest customer booking activity
            </p>

        </div>

        <a href="{{ route('admin.bookings.index') }}"
           class="admin-view-all">

            View All

            <i class="bi bi-arrow-right"></i>

        </a>

    </div>


    <div class="table-responsive">

        <table class="admin-table">

            <thead>

                <tr>

                    <th>Customer</th>

                    <th>Service</th>

                    <th>Date</th>

                    <th>Price</th>

                    <th>Status</th>

                </tr>

            </thead>


            <tbody>

                @forelse($recentBookings as $booking)

                    <tr>

                        <td>

                            <div class="admin-table-user">

                                <div class="admin-table-avatar">

                                    {{ strtoupper(substr($booking->user->name ?? 'U', 0, 1)) }}

                                </div>

                                <div>

                                    <strong>
                                        {{ $booking->user->name ?? 'Unknown User' }}
                                    </strong>

                                    <small>
                                        {{ $booking->user->email ?? '' }}
                                    </small>

                                </div>

                            </div>

                        </td>


                        <td>

                            <span class="admin-service-name">

                                {{ $booking->service->name ?? 'Service unavailable' }}

                            </span>

                        </td>


                        <td>

                            <span class="admin-booking-date">

                                {{ $booking->booking_date
                                    ? \Carbon\Carbon::parse($booking->booking_date)->format('d M Y')
                                    : '—'
                                }}

                            </span>

                        </td>


                        <td>

                            <strong>

                                ₹{{ number_format($booking->total_price, 0) }}

                            </strong>

                        </td>


                        <td>

                            @php

                                $statusClass = match($booking->status) {

                                    'pending' => 'status-pending',

                                    'confirmed' => 'status-confirmed',

                                    'in_progress' => 'status-progress',

                                    'completed' => 'status-completed',

                                    'cancelled' => 'status-cancelled',

                                    default => 'status-default',

                                };

                            @endphp


                            <span class="admin-status {{ $statusClass }}">

                                {{ ucfirst(str_replace('_', ' ', $booking->status)) }}

                            </span>

                        </td>

                    </tr>


                @empty

                    <tr>

                        <td colspan="5">

                            <div class="admin-empty-state">

                                <i class="bi bi-calendar-x"></i>

                                <h4>No bookings yet</h4>

                                <p>
                                    Customer bookings will appear here.
                                </p>

                            </div>

                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>


{{-- =========================================================
     QUICK ACTIONS
========================================================= --}}

<div class="admin-card admin-quick-actions">

    <div class="admin-card-header">

        <div>

            <h3>
                Quick Actions
            </h3>

            <p>
                Manage your ServiceHub platform
            </p>

        </div>

    </div>


    <div class="row g-3">


        {{-- Add Service --}}
        <div class="col-lg-4">

            <a href="{{ route('admin.services.create') }}"
               class="admin-action-card">

                <span class="admin-action-icon">

                    <i class="bi bi-plus-lg"></i>

                </span>

                <span>

                    <strong>
                        Add Service
                    </strong>

                    <small>
                        Create a new service
                    </small>

                </span>

                <i class="bi bi-arrow-up-right"></i>

            </a>

        </div>


        {{-- Manage Categories --}}
        <div class="col-lg-4">

            <a href="{{ route('admin.categories.index') }}"
               class="admin-action-card">

                <span class="admin-action-icon">

                    <i class="bi bi-tags-fill"></i>

                </span>

                <span>

                    <strong>
                        Manage Categories
                    </strong>

                    <small>
                        Organize service categories
                    </small>

                </span>

                <i class="bi bi-arrow-up-right"></i>

            </a>

        </div>


        {{-- Manage Bookings --}}
        <div class="col-lg-4">

            <a href="{{ route('admin.bookings.index') }}"
               class="admin-action-card">

                <span class="admin-action-icon">

                    <i class="bi bi-calendar-check-fill"></i>

                </span>

                <span>

                    <strong>
                        Manage Bookings
                    </strong>

                    <small>
                        Review customer bookings
                    </small>

                </span>

                <i class="bi bi-arrow-up-right"></i>

            </a>

        </div>

    </div>

</div>

@endsection