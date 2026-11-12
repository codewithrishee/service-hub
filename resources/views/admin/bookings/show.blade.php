@extends('layouts.admin')

@section('title', 'Booking Details')

@section('content')

    {{-- Page Header --}}
    <div class="admin-page-header d-flex justify-content-between align-items-center">

        <div>

            <span class="admin-page-eyebrow">
                ServiceHub admin
            </span>

            <h1>Booking Details</h1>

            <p>
                View customer, service and booking information.
            </p>

        </div>

        <a href="{{ route('admin.bookings.index') }}"
           class="btn btn-outline-secondary">

            <i class="bi bi-arrow-left me-1"></i>
            Back to Bookings

        </a>

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


    {{-- Booking Overview --}}
    <div class="row g-4">


        {{-- Main Booking Information --}}
        <div class="col-lg-8">

            <div class="admin-card h-100">

                <div class="admin-card-header">

                    <div>

                        <h3>
                            Booking #{{ $booking->id }}
                        </h3>

                        <p>
                            Created
                            {{ $booking->created_at?->format('d M Y, h:i A') ?? '—' }}
                        </p>

                    </div>


                    {{-- Status Badge --}}
                    <div>

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

                    </div>

                </div>


                {{-- Service Information --}}
                <div class="p-4 border-bottom">

                    <h5 class="mb-3">
                        Service Information
                    </h5>

                    @if($booking->service)

                        <div class="d-flex align-items-center gap-3">

                            @if($booking->service->image)

                                <img
                                    src="{{ str_starts_with($booking->service->image, 'http')
                                        ? $booking->service->image
                                        : asset('storage/' . $booking->service->image)
                                    }}"
                                    alt="{{ $booking->service->name }}"
                                    width="75"
                                    height="75"
                                    style="object-fit: cover; border-radius: 10px;"
                                >

                            @else

                                <div
                                    class="d-flex align-items-center justify-content-center bg-light"
                                    style="width:75px;height:75px;border-radius:10px;"
                                >

                                    <i class="bi bi-tools fs-3 text-muted"></i>

                                </div>

                            @endif


                            <div>

                                <h5 class="mb-1">
                                    {{ $booking->service->name }}
                                </h5>

                                <p class="text-muted mb-1">

                                    {{ $booking->service->category->name ?? 'Service' }}

                                </p>

                                <strong>
                                    ₹{{ number_format($booking->total_price, 2) }}
                                </strong>

                            </div>

                        </div>

                    @else

                        <p class="text-muted mb-0">
                            Service information is no longer available.
                        </p>

                    @endif

                </div>


                {{-- Schedule --}}
                <div class="p-4 border-bottom">

                    <h5 class="mb-3">
                        Booking Schedule
                    </h5>

                    <div class="row g-4">

                        <div class="col-md-6">

                            <div class="d-flex gap-3">

                                <div class="text-primary fs-4">
                                    <i class="bi bi-calendar-event"></i>
                                </div>

                                <div>

                                    <small class="text-muted d-block">
                                        Booking Date
                                    </small>

                                    <strong>

                                        {{ $booking->booking_date
                                            ? \Carbon\Carbon::parse($booking->booking_date)->format('d M Y')
                                            : '—'
                                        }}

                                    </strong>

                                </div>

                            </div>

                        </div>


                        <div class="col-md-6">

                            <div class="d-flex gap-3">

                                <div class="text-primary fs-4">
                                    <i class="bi bi-clock"></i>
                                </div>

                                <div>

                                    <small class="text-muted d-block">
                                        Booking Time
                                    </small>

                                    <strong>

                                        {{ $booking->booking_time
                                            ? \Carbon\Carbon::parse($booking->booking_time)->format('h:i A')
                                            : '—'
                                        }}

                                    </strong>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>


                {{-- Address --}}
                <div class="p-4 border-bottom">

                    <h5 class="mb-3">
                        Service Address
                    </h5>

                    <div class="d-flex gap-3">

                        <div class="text-primary fs-4">

                            <i class="bi bi-geo-alt"></i>

                        </div>

                        <p class="mb-0">
                            {{ $booking->address ?: 'No address provided.' }}
                        </p>

                    </div>

                </div>


                {{-- Notes --}}
                <div class="p-4">

                    <h5 class="mb-3">
                        Customer Notes
                    </h5>

                    @if($booking->notes)

                        <p class="mb-0 text-muted">
                            {{ $booking->notes }}
                        </p>

                    @else

                        <p class="mb-0 text-muted">
                            No additional notes provided.
                        </p>

                    @endif

                </div>

            </div>

        </div>


        {{-- Customer + Status --}}
        <div class="col-lg-4">


            {{-- Customer Card --}}
            <div class="admin-card mb-4">

                <div class="admin-card-header">

                    <div>

                        <h3>Customer</h3>

                        <p>
                            Customer information
                        </p>

                    </div>

                </div>

                <div class="p-4">

                    @if($booking->user)

                        <div class="text-center mb-4">

                            <div
                                class="d-inline-flex align-items-center justify-content-center bg-primary text-white"
                                style="width:70px;height:70px;border-radius:50%;"
                            >

                                {{ strtoupper(substr($booking->user->name, 0, 1)) }}

                            </div>

                            <h5 class="mt-3 mb-1">
                                {{ $booking->user->name }}
                            </h5>

                            <p class="text-muted mb-0">
                                {{ $booking->user->email }}
                            </p>

                        </div>


                        <div class="border-top pt-3">

                            <div class="mb-3">

                                <small class="text-muted d-block">
                                    Name
                                </small>

                                <strong>
                                    {{ $booking->user->name }}
                                </strong>

                            </div>

                            <div>

                                <small class="text-muted d-block">
                                    Email
                                </small>

                                <strong>
                                    {{ $booking->user->email }}
                                </strong>

                            </div>

                        </div>

                    @else

                        <p class="text-muted mb-0">
                            Customer information is unavailable.
                        </p>

                    @endif

                </div>

            </div>


            {{-- Update Status --}}
            <div class="admin-card">

                <div class="admin-card-header">

                    <div>

                        <h3>Update Status</h3>

                        <p>
                            Change booking status.
                        </p>

                    </div>

                </div>

                <div class="p-4">

                    <form
                        action="{{ route('admin.bookings.status.update', $booking) }}"
                        method="POST"
                    >

                        @csrf
                        @method('PATCH')


                        <div class="mb-3">

                            <label for="status"
                                   class="form-label">

                                Booking Status

                            </label>

                            <select
                                name="status"
                                id="status"
                                class="form-select @error('status') is-invalid @enderror"
                            >

                                <option value="pending"
                                    {{ $booking->status === 'pending' ? 'selected' : '' }}>
                                    Pending
                                </option>

                                <option value="confirmed"
                                    {{ $booking->status === 'confirmed' ? 'selected' : '' }}>
                                    Confirmed
                                </option>

                                <option value="in_progress"
                                    {{ $booking->status === 'in_progress' ? 'selected' : '' }}>
                                    In Progress
                                </option>

                                <option value="completed"
                                    {{ $booking->status === 'completed' ? 'selected' : '' }}>
                                    Completed
                                </option>

                                <option value="cancelled"
                                    {{ $booking->status === 'cancelled' ? 'selected' : '' }}>
                                    Cancelled
                                </option>

                            </select>


                            @error('status')

                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>

                            @enderror

                        </div>


                        <button type="submit"
                                class="btn btn-primary w-100">

                            <i class="bi bi-check2-circle me-1"></i>

                            Update Status

                        </button>

                    </form>

                </div>

            </div>

        </div>

    </div>

@endsection