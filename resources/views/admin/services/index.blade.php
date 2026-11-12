@extends('layouts.admin')

@section('title', 'Services')

@section('content')

    <div class="admin-page-header d-flex justify-content-between align-items-center">

        <div>

            <span class="admin-page-eyebrow">
                ServiceHub admin
            </span>

            <h1>Services</h1>

            <p>Manage all services available on the platform.</p>

        </div>

        <a href="{{ route('admin.services.create') }}"
           class="btn btn-success">

            <i class="bi bi-plus-lg me-1"></i>
            Add Service

        </a>

    </div>


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


    <div class="admin-card">

        <div class="admin-card-header">

            <div>

                <h3>All Services</h3>

                <p>
                    {{ $services->count() }} services found
                </p>

            </div>

        </div>


        <div class="table-responsive">

            <table class="admin-table">

                <thead>

                    <tr>

                        <th>#</th>

                        <th>Service</th>

                        <th>Category</th>

                        <th>Price</th>

                        <th>Duration</th>

                        <th>Rating</th>

                        <th>Reviews</th>

                        <th>Verified</th>

                        <th>Status</th>

                        <th>Created</th>

                        <th>Actions</th>

                    </tr>

                </thead>


                <tbody>

                    @forelse($services as $service)

                        <tr>

                            {{-- Number --}}

                            <td>
                                {{ $loop->iteration }}
                            </td>


                            {{-- Service --}}

                            <td>

                                <div class="d-flex align-items-center gap-3">

                                    @if($service->image)

                                        <img
                                            src="{{ $service->image }}"
                                            alt="{{ $service->name }}"
                                            width="55"
                                            height="55"
                                            style="object-fit: cover; border-radius: 8px;"
                                        >

                                    @else

                                        <div
                                            class="d-flex align-items-center justify-content-center bg-light"
                                            style="width:55px;height:55px;border-radius:8px;"
                                        >

                                            <i class="bi bi-tools text-muted"></i>

                                        </div>

                                    @endif


                                    <div>

                                        <strong>
                                            {{ $service->name }}
                                        </strong>

                                        <br>

                                        <small class="text-muted">
                                            {{ $service->slug }}
                                        </small>

                                    </div>

                                </div>

                            </td>


                            {{-- Category --}}

                            <td>

                                <span class="text-muted">

                                    {{ $service->category->name ?? '—' }}

                                </span>

                            </td>


                            {{-- Price --}}

                            <td>

                                <strong>
                                    ₹{{ number_format($service->price, 2) }}
                                </strong>

                            </td>


                            {{-- Duration --}}

                            <td>

                                {{ $service->duration }} min

                            </td>


                            {{-- Rating --}}

                            <td>

                                <span class="d-inline-flex align-items-center gap-1">

                                    <i class="bi bi-star-fill text-warning"></i>

                                    {{ number_format((float) $service->rating, 1) }}

                                </span>

                            </td>


                            {{-- Reviews --}}

                            <td>

                                {{ number_format($service->review_count) }}

                            </td>


                            {{-- Verified --}}

                            <td>

                                @if($service->verified)

                                    <span class="admin-status status-completed">

                                        <i class="bi bi-patch-check-fill me-1"></i>
                                        Verified

                                    </span>

                                @else

                                    <span class="admin-status status-cancelled">
                                        Not Verified
                                    </span>

                                @endif

                            </td>


                            {{-- Status --}}

                            <td>

                                @if($service->status)

                                    <span class="admin-status status-completed">
                                        Active
                                    </span>

                                @else

                                    <span class="admin-status status-cancelled">
                                        Inactive
                                    </span>

                                @endif

                            </td>


                            {{-- Created --}}

                            <td>

                                {{ $service->created_at?->format('d M Y') ?? '—' }}

                            </td>


                            {{-- Actions --}}

                            <td>

                                <div class="d-flex align-items-center gap-2">

                                    <a
                                        href="{{ route('admin.services.edit', $service) }}"
                                        class="btn btn-sm btn-outline-primary"
                                        title="Edit"
                                    >

                                        <i class="bi bi-pencil"></i>

                                    </a>


                                    <form
                                        action="{{ route('admin.services.destroy', $service) }}"
                                        method="POST"
                                        class="d-inline"
                                        onsubmit="return confirm('Are you sure you want to delete this service?');"
                                    >

                                        @csrf

                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="btn btn-sm btn-outline-danger"
                                            title="Delete"
                                        >

                                            <i class="bi bi-trash"></i>

                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="11">

                                <div class="admin-empty-state">

                                    <i class="bi bi-tools"></i>

                                    <h4>No services found</h4>

                                    <p>
                                        Create your first service.
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