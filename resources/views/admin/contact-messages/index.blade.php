
@extends('layouts.admin')

@section('title', 'Contact Messages')

@section('content')

<div class="container-fluid px-0">

    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
        <div>
            <h1 class="h3 fw-bold mb-1">Contact Messages</h1>
            <p class="text-muted mb-0">
                Manage customer enquiries and support requests.
            </p>
        </div>

        <span class="badge bg-danger fs-6">
            New: {{ $newCount }}
        </span>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="btn-close"
                data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card border-0 shadow-sm">
        <div class="card-body p-0">

            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="ps-3">#</th>
                            <th>Customer</th>
                            <th>Subject</th>
                            <th>Service</th>
                            <th>Date</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($messages as $message)
                            <tr>
                                <td class="ps-3">
                                    {{ $messages->firstItem() + $loop->index }}
                                </td>

                                <td>
                                    <div class="fw-semibold">
                                        {{ $message->name }}
                                    </div>
                                    <small class="text-muted">
                                        {{ $message->email }}
                                    </small>
                                </td>

                                <td>{{ $message->subject }}</td>

                                <td>
                                    {{ $message->service ?: '—' }}
                                </td>

                                <td>
                                    {{ $message->created_at->format('d M Y') }}
                                </td>

                                <td>
                                    @php
                                        $statusClasses = [
                                            'new' => 'bg-danger',
                                            'read' => 'bg-info text-dark',
                                            'replied' => 'bg-success',
                                        ];
                                    @endphp

                                    <span class="badge {{ $statusClasses[$message->status] ?? 'bg-secondary' }}">
                                        {{ ucfirst($message->status) }}
                                    </span>
                                </td>

                                <td>
                                    <a
                                        href="{{ route('admin.contact-messages.show', $message) }}"
                                        class="btn btn-sm btn-outline-primary"
                                    >
                                        <i class="bi bi-eye"></i> View
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-5">
                                    <i class="bi bi-envelope-open fs-1 text-muted"></i>
                                    <p class="mt-2 mb-0">No contact messages found.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

        </div>

        @if($messages->hasPages())
            <div class="card-footer bg-white">
                {{ $messages->links() }}
            </div>
        @endif
    </div>

</div>

@endsection
