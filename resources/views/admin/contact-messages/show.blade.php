
@extends('layouts.admin')

@section('title', 'View Contact Message')

@section('content')

<div class="container-fluid px-0">

    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">
        <div>
            <h1 class="h3 fw-bold mb-1">Contact Message Details</h1>
            <p class="text-muted mb-0">
                Message #{{ $contactMessage->id }}
            </p>
        </div>

        <a href="{{ route('admin.contact-messages.index') }}"
            class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left"></i> Back to Messages
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body p-4">

            <h5 class="fw-bold mb-4">Customer Information</h5>

            <div class="row g-4">
                <div class="col-md-6">
                    <small class="text-muted d-block">Full Name</small>
                    <strong>{{ $contactMessage->name }}</strong>
                </div>

                <div class="col-md-6">
                    <small class="text-muted d-block">Email</small>
                    <a href="mailto:{{ $contactMessage->email }}">
                        {{ $contactMessage->email }}
                    </a>
                </div>

                <div class="col-md-6">
                    <small class="text-muted d-block">Phone</small>
                    @if($contactMessage->phone)
                        <a href="tel:{{ $contactMessage->phone }}">
                            {{ $contactMessage->phone }}
                        </a>
                    @else
                        —
                    @endif
                </div>

                <div class="col-md-6">
                    <small class="text-muted d-block">Submitted On</small>
                    {{ $contactMessage->created_at->format('d M Y, h:i A') }}
                </div>
            </div>

            <hr class="my-4">

            <h5 class="fw-bold mb-4">Enquiry Details</h5>

            <div class="mb-3">
                <small class="text-muted d-block">Subject</small>
                <strong>{{ $contactMessage->subject }}</strong>
            </div>

            <div class="mb-4">
                <small class="text-muted d-block">Service</small>
                {{ $contactMessage->service ?: 'Not specified' }}
            </div>

            <div>
                <small class="text-muted d-block mb-2">Message</small>
                <div class="border rounded p-3" style="white-space: pre-wrap; overflow-wrap: anywhere;">{{ $contactMessage->message }}</div>
            </div>

        </div>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body p-4">

            <h5 class="fw-bold mb-3">Manage Message</h5>

            <form
                action="{{ route('admin.contact-messages.status.update', $contactMessage) }}"
                method="POST"
                class="d-flex flex-wrap align-items-end gap-3"
            >
                @csrf
                @method('PATCH')

                <div>
                    <label for="status" class="form-label">Message Status</label>
                    <select name="status" id="status" class="form-select">
                        <option value="new" {{ $contactMessage->status === 'new' ? 'selected' : '' }}>New</option>
                        <option value="read" {{ $contactMessage->status === 'read' ? 'selected' : '' }}>Read</option>
                        <option value="replied" {{ $contactMessage->status === 'replied' ? 'selected' : '' }}>Replied</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-check-circle"></i> Update Status
                </button>
            </form>

            <hr class="my-4">

            <form
                action="{{ route('admin.contact-messages.destroy', $contactMessage) }}"
                method="POST"
                onsubmit="return confirm('Are you sure you want to delete this message?');"
            >
                @csrf
                @method('DELETE')

                <button type="submit" class="btn btn-outline-danger">
                    <i class="bi bi-trash"></i> Delete Message
                </button>
            </form>

        </div>
    </div>

</div>

@endsection
