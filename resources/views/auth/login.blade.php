@extends('layouts.auth')

@section('title', 'Login')

@section('content')

<div class="servicehub-auth">
    <div class="auth-shell">

        {{-- ============================================================
             LEFT / VISUAL PANEL (Desktop & Tablet)
             ============================================================ --}}
        <aside class="auth-visual" aria-hidden="true">

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
                        Welcome Back
                    </span>

                    <h2 class="auth-visual-headline">
                        Trusted services.<br>
                        <span class="accent">Simplified for you.</span>
                    </h2>

                    <p class="auth-visual-text">
                        Sign in to manage your bookings, discover trusted
                        professionals and keep every service in one place.
                    </p>

                    <ul class="auth-visual-points">
                        <li class="auth-visual-point">
                            <span class="auth-visual-point-icon">
                                <i class="bi bi-patch-check-fill"></i>
                            </span>
                            <span>Verified professionals</span>
                        </li>
                        <li class="auth-visual-point">
                            <span class="auth-visual-point-icon">
                                <i class="bi bi-shield-lock-fill"></i>
                            </span>
                            <span>Secure account access</span>
                        </li>
                        <li class="auth-visual-point">
                            <span class="auth-visual-point-icon">
                                <i class="bi bi-calendar2-week"></i>
                            </span>
                            <span>Manage bookings effortlessly</span>
                        </li>
                    </ul>

                </div>

                {{-- Footer --}}
                <div class="auth-visual-footer">
                    &copy; {{ date('Y') }} ServiceHub. All rights reserved.
                </div>

            </div>

        </aside>

        {{-- ============================================================
             RIGHT / FORM PANEL
             ============================================================ --}}
        <main class="auth-form-panel">

            {{-- Mobile brand header --}}
            <div class="auth-mobile-brand">
               <a href="{{ url('/') }}" class="auth-mobile-brand-text">
    <img
        src="{{ asset('images/servicehub.png') }}"
        alt="ServiceHub"
        class="auth-logo"
    >
</a>
                <span class="auth-mobile-tagline">
                    Trusted services, simplified for you.
                </span>
            </div>

            <div class="auth-form-wrap">

                <div class="auth-form-header">
                    <span class="auth-form-eyebrow">Sign In</span>
                    <h1 class="auth-form-title">Welcome Back</h1>
                    <p class="auth-form-subtitle">
                        Login to continue to your ServiceHub account.
                    </p>
                </div>

                {{-- Success message --}}
                @if (session('success'))
                    <div class="auth-alert auth-alert-success" role="status">
                        <i class="bi bi-check-circle-fill" aria-hidden="true"></i>
                        <span>{{ session('success') }}</span>
                    </div>
                @endif

                {{-- Validation summary --}}
                @if ($errors->any())
                    <div class="auth-alert auth-alert-error" role="alert">
                        <i class="bi bi-exclamation-triangle-fill" aria-hidden="true"></i>
                        <span>Please check the highlighted fields below and try again.</span>
                    </div>
                @endif

                <form method="POST" action="{{ route('login.store') }}" id="servicehub-login-form">
                    @csrf

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
                                autofocus
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
                                placeholder="Enter your password"
                                autocomplete="current-password"
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

                        @error('password')
                            <div class="auth-error" id="password-error" role="alert">
                                <i class="bi bi-exclamation-circle-fill" aria-hidden="true"></i>
                                <span>{{ $message }}</span>
                            </div>
                        @enderror
                    </div>

                    <button type="submit" class="auth-submit" id="servicehub-login-submit">
                        <i class="bi bi-box-arrow-in-right btn-icon" aria-hidden="true"></i>
                        <span class="btn-label">Login</span>
                    </button>

                </form>

                <p class="auth-form-footer">
                    Don't have an account?
                    <a href="{{ route('register') }}">Create Account</a>
                </p>

                <p class="auth-form-note">
                    <i class="bi bi-shield-lock-fill" aria-hidden="true"></i>
                    Your information is kept private and secure.
                </p>

            </div>
        </main>

    </div>
</div>

@endsection

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
@endpush

@push('scripts')
    <script src="{{ asset('js/auth.js') }}" defer></script>
@endpush