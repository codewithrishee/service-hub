@extends('layouts.admin')

@section('title', 'User Details')

@section('content')

    {{-- Page Header --}}
    <div class="admin-page-header d-flex justify-content-between align-items-center">

        <div>

            <span class="admin-page-eyebrow">
                ServiceHub admin
            </span>

            <h1>User Details</h1>

            <p>
                View user information and booking history.
            </p>

        </div>

        <a href="{{ route('admin.users.index') }}"
           class="btn btn-outline-secondary">

            <i class="bi bi-arrow-left me-1"></i>
            Back to Users

        </a>

    </div>


    {{-- User Overview --}}
    <div class="row g-4">


        {{-- User Information --}}
        <div class="col-lg-4">

            <div class="admin-card">

                <div class="admin-card-header">

                    <div>

                        <h3>User Profile</h3>

                        <p>
                            Account information
                        </p>
<div class="mt-4 pt-4 border-top">

    <form
        action="{{ route('admin.users.role.update', $user) }}"
        method="POST"
    >

        @csrf
        @method('PATCH')

        <div class="mb-3">

            <label for="role" class="form-label">
                User Role
            </label>

            <select
                name="role"
                id="role"
                class="form-select @error('role') is-invalid @enderror"
            >

                <option value="customer"
                    {{ $user->role === 'customer' ? 'selected' : '' }}>
                    Customer
                </option>

                <option value="admin"
                    {{ $user->role === 'admin' ? 'selected' : '' }}>
                    admin
                </option>

            </select>

            @error('role')

                <div class="invalid-feedback">
                    {{ $message }}
                </div>

            @enderror

        </div>

        <button type="submit"
                class="btn btn-primary w-100">

            <i class="bi bi-shield-check me-1"></i>
            Update Role

        </button>

    </form>

</div>
                    </div>

                </div>


                <div class="p-4 text-center">

                    {{-- Avatar --}}
                    <div
                        class="d-inline-flex align-items-center justify-content-center bg-primary text-white"
                        style="width:90px;height:90px;border-radius:50%;font-size:32px;"
                    >

                        {{ strtoupper(substr($user->name, 0, 1)) }}

                    </div>


                    <h4 class="mt-3 mb-1">
                        {{ $user->name }}
                    </h4>


                    <p class="text-muted mb-3">
                        {{ $user->email }}
                    </p>


                    {{-- Role --}}
                    @if($user->role === 'admin')

                        <span class="admin-status status-completed">

                            <i class="bi bi-shield-check me-1"></i>
                            admin

                        </span>

                    @else

                        <span class="admin-status status-confirmed">

                            <i class="bi bi-person me-1"></i>
                            Customer

                        </span>

                    @endif


                    {{-- Details --}}
                    <div class="text-start border-top mt-4 pt-4">

                        <div class="mb-3">

                            <small class="text-muted d-block">
                                User ID
                            </small>

                            <strong>
                                #{{ $user->id }}
                            </strong>

                        </div>


                        <div class="mb-3">

                            <small class="text-muted d-block">
                                Email
                            </small>

                            <strong>
                                {{ $user->email }}
                            </strong>

                        </div>


                        <div class="mb-3">

                            <small class="text-muted d-block">
                                Total Bookings
                            </small>

                            <strong>
                                {{ $user->bookings->count() }}
                            </strong>

                        </div>


                        <div>

                            <small class="text-muted d-block">
                                Joined
                            </small>

                            <strong>
                                {{ $user->created_at?->format('d M Y, h:i A') ?? '—' }}
                            </strong>

                        </div>

                    </div>

                </div>

            </div>

        </div>


        {{-- Booking History --}}
        <div class="col-lg-8">

            <div class="admin-card">

                <div class="admin-card-header">

                    <div>

                        <h3>Booking History</h3>

                        <p>
                            All bookings made by this user.
                        </p>

                    </div>

                    <span class="badge bg-light text-dark">

                        {{ $user->bookings->count() }} Bookings

                    </span>

                </div>


                <div class="table-responsive">

                    <table class="admin-table">

                        <thead>

                            <tr>

                                <th>#</th>
                                <th>Service</th>
                                <th>Date</th>
                                <th>Amount</th>
                                <th>Status</th>

                            </tr>

                        </thead>


                        <tbody>

                            @forelse($user->bookings as $booking)

                                <tr>

                                    {{-- Booking ID --}}
                                    <td>

                                        <strong>
                                            #{{ $booking->id }}
                                        </strong>

                                    </td>


                                    {{-- Service --}}
                                    <td>

                                        @if($booking->service)

                                            <strong>
                                                {{ $booking->service->name }}
                                            </strong>

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

                                </tr>


                            @empty

                                <tr>

                                    <td colspan="5">

                                        <div class="admin-empty-state">

                                            <i class="bi bi-calendar-x"></i>

                                            <h4>No bookings yet</h4>

                                            <p>
                                                This user has not made any bookings.
                                            </p>

                                        </div>

                                    </td>

                                </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    </div>

@endsection