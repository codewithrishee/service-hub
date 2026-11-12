@extends('layouts.auth')

@section('title', 'Create Account')

@section('content')

<div class="servicehub-auth servicehub-auth--register">
    <div class="auth-shell">

        {{-- ============================================================
             LEFT / FORM PANEL
             ============================================================ --}}
        <main class="auth-form-panel">

            {{-- Mobile brand bar --}}
            <div class="auth-mobile-brand">
               <a href="{{ url('/') }}" class="auth-mobile-brand-text">
    <img
        src="{{ asset('images/servicehub.png') }}"
        alt="ServiceHub"
        class="auth-logo"
    >
</a>
                <span class="auth-mobile-tagline">
                    Create your account in seconds.
                </span>
            </div>

            <div class="auth-form-wrap">

                <div class="auth-form-header">
                    <span class="auth-form-eyebrow">Get Started</span>
                    <h1 class="auth-form-title">Create your ServiceHub account</h1>
                    <p class="auth-form-subtitle">
                        Book trusted professionals, manage your services and keep
                        everything in one place.
                    </p>
                </div>

                {{-- Global error summary --}}
                @if ($errors->any())
                    <div class="auth-alert auth-alert-error" role="alert">
                        <i class="bi bi-exclamation-triangle-fill" aria-hidden="true"></i>
                        <span>Please review the highlighted fields below and try again.</span>
                    </div>
                @endif

                <form method="POST" action="{{ route('register.store') }}" id="servicehub-register-form">
                    @csrf

                    {{-- Name --}}
                    <div class="auth-field">
                        <label for="name" class="auth-label">Full Name</label>

                        <div class="auth-input-group">
                            <i class="bi bi-person auth-input-icon" aria-hidden="true"></i>

                            <input
                                type="text"
                                id="name"
                                name="name"
                                value="{{ old('name') }}"
                                class="auth-input @error('name') is-invalid @enderror"
                                placeholder="Enter your full name"
                                autocomplete="name"
                                @error('name') aria-describedby="name-error" aria-invalid="true" @enderror
                                required
                                autofocus
                            >
                        </div>

                        @error('name')
                            <div class="auth-error" id="name-error" role="alert">
                                <i class="bi bi-exclamation-circle-fill" aria-hidden="true"></i>
                                <span>{{ $message }}</span>
                            </div>
                        @enderror
                    </div>

                    {{-- Email --}}
                    <div class="auth-field">
                        <label for="email" class="auth-label">Email Address</label>

                        <div class="auth-input-group">
                            <i class="bi bi-envelope auth-input-icon" aria-hidden="true"></i>

                            <input
                                type="email"
                                id="email"
                                name="email"
                                value="{{ old('email') }}"
                                class="auth-input @error('email') is-invalid @enderror"
                                placeholder="you@example.com"
                                autocomplete="email"
                                inputmode="email"
                                spellcheck="false"
                                autocapitalize="none"
                                @error('email') aria-describedby="email-error" aria-invalid="true" @enderror
                                required
                            >
                        </div>

                        @error('email')
                            <div class="auth-error" id="email-error" role="alert">
                                <i class="bi bi-exclamation-circle-fill" aria-hidden="true"></i>
                                <span>{{ $message }}</span>
                            </div>
                        @enderror
                    </div>

                    {{-- Password --}}
                    <div class="auth-field">
                        <label for="password" class="auth-label">Password</label>

                        <div class="auth-input-group">
                            <i class="bi bi-lock auth-input-icon" aria-hidden="true"></i>

                            <input
                                type="password"
                                id="password"
                                name="password"
                                class="auth-input auth-input-has-toggle @error('password') is-invalid @enderror"
                                placeholder="Create a strong password"
                                autocomplete="new-password"
                                @error('password') aria-describedby="password-error" aria-invalid="true" @enderror
                                required
                            >

                            <button
                                type="button"
                                class="auth-toggle"
                                data-password-toggle="password"
                                aria-label="Show password"
                                aria-controls="password"
                                aria-pressed="false"
                            >
                                <i class="bi bi-eye" aria-hidden="true"></i>
                            </button>
                        </div>

                        {{-- Password strength (populated by auth.js) --}}
                        <div class="auth-strength" aria-live="polite">
                            <div class="auth-strength-track">
                                <span class="auth-strength-bar"></span>
                                <span class="auth-strength-bar"></span>
                                <span class="auth-strength-bar"></span>
                            </div>
                            <span class="auth-strength-label"></span>
                        </div>

                        @error('password')
                            <div class="auth-error" id="password-error" role="alert">
                                <i class="bi bi-exclamation-circle-fill" aria-hidden="true"></i>
                                <span>{{ $message }}</span>
                            </div>
                        @enderror
                    </div>

                    {{-- Confirm Password --}}
                    <div class="auth-field">
                        <label for="password_confirmation" class="auth-label">
                            Confirm Password
                        </label>

                        <div class="auth-input-group">
                            <i class="bi bi-shield-lock auth-input-icon" aria-hidden="true"></i>

                            <input
                                type="password"
                                id="password_confirmation"
                                name="password_confirmation"
                                class="auth-input auth-input-has-toggle"
                                placeholder="Re-enter your password"
                                autocomplete="new-password"
                                required
                            >

                            <button
                                type="button"
                                class="auth-toggle"
                                data-password-toggle="password_confirmation"
                                aria-label="Show password"
                                aria-controls="password_confirmation"
                                aria-pressed="false"
                            >
                                <i class="bi bi-eye" aria-hidden="true"></i>
                            </button>
                        </div>
                    </div>

                    <button type="submit" class="auth-submit" id="servicehub-register-submit">
                        <i class="bi bi-person-plus btn-icon" aria-hidden="true"></i>
                        <span class="btn-label">Create Account</span>
                    </button>

                </form>

                <p class="auth-form-footer">
                    Already have an account?
                    <a href="{{ route('login') }}">Login</a>
                </p>

                <p class="auth-form-note">
                    <i class="bi bi-shield-lock-fill" aria-hidden="true"></i>
                    Your information is kept private and secure.
                </p>

            </div>
        </main>

        {{-- ============================================================
             RIGHT / VISUAL PANEL (mirrored — desktop & tablet)
             ============================================================ --}}
        <aside class="auth-visual auth-visual--right" aria-hidden="true">

            <div class="auth-visual-inner">

                {{-- Brand --}}
<a href="{{ url('/') }}" class="auth-brand">
    <img
        src="{{ asset('images/admin.png') }}"
        alt="ServiceHub"
        class="auth-logo"
    >
</a>

                {{-- Content --}}
                <div class="auth-visual-content">

                    <span class="auth-visual-eyebrow">
                        <span class="dot"></span>
                        Join ServiceHub
                    </span>

                    <h2 class="auth-visual-headline">
                        Everything you need.<br>
                        <span class="accent">All in one place.</span>
                    </h2>

                    <p class="auth-visual-text">
                        Create your free account to book services, manage
                        professionals and keep every booking organised.
                    </p>

                    <ul class="auth-visual-points">
                        <li class="auth-visual-point">
                            <span class="auth-visual-point-icon">
                                <i class="bi bi-check2"></i>
                            </span>
                            <span>Free to create an account</span>
                        </li>
                        <li class="auth-visual-point">
                            <span class="auth-visual-point-icon">
                                <i class="bi bi-check2"></i>
                            </span>
                            <span>Book verified professionals</span>
                        </li>
                        <li class="auth-visual-point">
                            <span class="auth-visual-point-icon">
                                <i class="bi bi-check2"></i>
                            </span>
                            <span>Manage everything in one dashboard</span>
                        </li>
                    </ul>

                </div>

                {{-- Footer --}}
                <div class="auth-visual-footer">
                    &copy; {{ date('Y') }} ServiceHub. All rights reserved.
                </div>

            </div>

        </aside>

    </div>
</div>

@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
@endpush

@push('scripts')
    <script src="{{ asset('js/auth.js') }}" defer></script>
@endpush