@extends('layouts.admin')

@section('title', 'Users')

@section('content')

    {{-- Page Header --}}
    <div class="admin-page-header d-flex justify-content-between align-items-center">

        <div>

            <span class="admin-page-eyebrow">
                ServiceHub admin
            </span>

            <h1>Users</h1>

            <p>Manage all registered users on the platform.</p>

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


    {{-- Users Card --}}
    <div class="admin-card">

        <div class="admin-card-header">

            <div>

                <h3>All Users</h3>

                <p>
                    {{ $users->count() }} users found
                </p>

            </div>

        </div>


        <div class="table-responsive">

            <table class="admin-table">

                <thead>

                    <tr>

                        <th>#</th>
                        <th>User</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Bookings</th>
                        <th>Joined</th>
                        <th>Actions</th>

                    </tr>

                </thead>


                <tbody>

                    @forelse($users as $user)

                        <tr>

                            {{-- Number --}}
                            <td>
                                {{ $loop->iteration }}
                            </td>


                            {{-- User --}}
                            <td>

                                <div class="d-flex align-items-center gap-3">

                                    <div
                                        class="d-flex align-items-center justify-content-center bg-primary text-white"
                                        style="width:45px;height:45px;border-radius:50%;"
                                    >

                                        {{ strtoupper(substr($user->name, 0, 1)) }}

                                    </div>


                                    <div>

                                        <strong>
                                            {{ $user->name }}
                                        </strong>

                                        <br>

                                        <small class="text-muted">
                                            User #{{ $user->id }}
                                        </small>

                                    </div>

                                </div>

                            </td>


                            {{-- Email --}}
                            <td>

                                <span class="text-muted">
                                    {{ $user->email }}
                                </span>

                            </td>


                            {{-- Role --}}
                            <td>

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

                            </td>


                            {{-- Bookings --}}
                            <td>

                                <strong>
                                    {{ number_format($user->bookings_count) }}
                                </strong>

                            </td>


                            {{-- Joined --}}
                            <td>

                                {{ $user->created_at?->format('d M Y') ?? '—' }}

                            </td>


                            {{-- Actions --}}
                            <td>

                                <div class="d-flex align-items-center gap-2">

                                    <a
                                        href="{{ route('admin.users.show', $user) }}"
                                        class="btn btn-sm btn-outline-primary"
                                        title="View User"
                                    >

                                        <i class="bi bi-eye"></i>

                                    </a>

                                </div>

                            </td>

                        </tr>


                    @empty

                        <tr>

                            <td colspan="7">

                                <div class="admin-empty-state">

                                    <i class="bi bi-people"></i>

                                    <h4>No users found</h4>

                                    <p>
                                        Registered users will appear here.
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