@extends('layouts.admin')

@section('title', 'Bookings')

@section('content')

    {{-- Page Header --}}
    <div class="admin-page-header d-flex justify-content-between align-items-center">

        <div>

            <span class="admin-page-eyebrow">
                ServiceHub admin
            </span>

            <h1>Bookings</h1>

            <p>Manage all customer bookings on the platform.</p>

        </div>

    </div>


    {{-- Success Message --}}
    @if(session('success'))

        <div class="alert alert-success alert-dismissible fade show mb-4"
             role="alert">

            <i class="bi bi-check-circle-fill me-2"></i>

            {{ session('success') }}

            <button type="button"
                    class="btn-close"
                    data-bs-dismiss="alert">
            </button>

        </div>

    @endif


    {{-- Error Message --}}
    @if($errors->any())

        <div class="alert alert-danger alert-dismissible fade show mb-4"
             role="alert">

            <i class="bi bi-exclamation-triangle-fill me-2"></i>

            Please check the form and try again.

            <button type="button"
                    class="btn-close"
                    data-bs-dismiss="alert">
            </button>

        </div>

    @endif


    {{-- Bookings Card --}}
    <div class="admin-card">

        {{-- Card Header --}}
        <div class="admin-card-header">

            <div>

                <h3>All Bookings</h3>

                <p>
                    {{ $bookings->count() }} bookings found
                </p>

            </div>

        </div>


        {{-- Table --}}
        <div class="table-responsive">

            <table class="admin-table">

                <thead>

                    <tr>

                        <th>#</th>

                        <th>Booking</th>

                        <th>Customer</th>

                        <th>Service</th>

                        <th>Date</th>

                        <th>Time</th>

                        <th>Amount</th>

                        <th>Status</th>

                        <th>Created</th>

                        <th>Actions</th>

                    </tr>

                </thead>


                <tbody>

                    @forelse($bookings as $booking)

                        <tr>

                            {{-- ID --}}
                            <td>

                                <strong>
                                    #{{ $booking->id }}
                                </strong>

                            </td>


                            {{-- Booking --}}
                            <td>

                                <div>

                                    <strong>
                                        Booking #{{ $booking->id }}
                                    </strong>

                                    <br>

                                    <small class="text-muted">

                                        {{ $booking->booking_date
                                            ? \Carbon\Carbon::parse($booking->booking_date)->format('d M Y')
                                            : '—'
                                        }}

                                    </small>

                                </div>

                            </td>


                            {{-- Customer --}}
                            <td>

                                @if($booking->user)

                                    <div>

                                        <strong>
                                            {{ $booking->user->name }}
                                        </strong>

                                        <br>

                                        <small class="text-muted">
                                            {{ $booking->user->email }}
                                        </small>

                                    </div>

                                @else

                                    <span class="text-muted">
                                        —
                                    </span>

                                @endif

                            </td>


                            {{-- Service --}}
                            <td>

                                @if($booking->service)

                                    <div>

                                        <strong>
                                            {{ $booking->service->name }}
                                        </strong>

                                        <br>

                                        <small class="text-muted">

                                            {{ $booking->service->category->name ?? 'Service' }}

                                        </small>

                                    </div>

                                @else

                                    <span class="text-muted">
                                        Service deleted
                                    </span>

                                @endif

                            </td>


                            {{-- Date --}}
                            <td>

                                @if($booking->booking_date)

                                    {{ \Carbon\Carbon::parse($booking->booking_date)->format('d M Y') }}

                                @else

                                    —

                                @endif

                            </td>


                            {{-- Time --}}
                            <td>

                                @if($booking->booking_time)

                                    {{ \Carbon\Carbon::parse($booking->booking_time)->format('h:i A') }}

                                @else

                                    —

                                @endif

                            </td>


                            {{-- Amount --}}
                            <td>

                                <strong>
                                    ₹{{ number_format($booking->total_price, 2) }}
                                </strong>

                            </td>


                            {{-- Status --}}
                            <td>

                                @if($booking->status === 'pending')

                                    <span class="admin-status status-pending">
                                        Pending
                                    </span>

                                @elseif($booking->status === 'confirmed')

                                    <span class="admin-status status-confirmed">
                                        Confirmed
                                    </span>

                                @elseif($booking->status === 'in_progress')

                                    <span class="admin-status status-in-progress">
                                        In Progress
                                    </span>

                                @elseif($booking->status === 'completed')

                                    <span class="admin-status status-completed">
                                        Completed
                                    </span>

                                @elseif($booking->status === 'cancelled')

                                    <span class="admin-status status-cancelled">
                                        Cancelled
                                    </span>

                                @else

                                    <span class="admin-status">
                                        {{ ucfirst($booking->status) }}
                                    </span>

                                @endif

                            </td>


                            {{-- Created --}}
                            <td>

                                {{ $booking->created_at?->format('d M Y') ?? '—' }}

                            </td>


                            {{-- Actions --}}
                            <td>

                                <div class="d-flex align-items-center gap-2">

                                   <a
    href="{{ route('admin.bookings.show', $booking) }}"
    class="btn btn-sm btn-outline-primary"
    title="View Booking"
>
    <i class="bi bi-eye"></i>
</a>

                                </div>

                            </td>

                        </tr>


                    @empty

                        <tr>

                            <td colspan="10">

                                <div class="admin-empty-state">

                                    <i class="bi bi-calendar-x"></i>

                                    <h4>No bookings found</h4>

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

@endsection