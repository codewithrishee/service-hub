@extends('layouts.auth')

@section('title', 'Service-Hub Admin Login')

@section('content')

<div class="servicehub-admin-login">

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');

        .servicehub-admin-login {
            --sh-navy: #0f2744;
            --sh-navy-deep: #0a1c33;
            --sh-teal: #0d9488;
            --sh-teal-deep: #0f766e;
            --sh-ink: #0f172a;
            --sh-muted: #64748b;
            --sh-line: #e2e8f0;
            --sh-radius: 14px;

            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            min-height: calc(100vh - 80px);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 48px 16px;
            background: #f6f7f9;
            overflow-x: hidden;
        }

        .servicehub-admin-login *,
        .servicehub-admin-login *::before,
        .servicehub-admin-login *::after {
            box-sizing: border-box;
        }

        .servicehub-admin-login__card {
            width: 100%;
            max-width: 420px;
            background: #ffffff;
            border: 1px solid var(--sh-line);
            border-radius: var(--sh-radius);
            padding: 36px 32px 30px;
            box-shadow:
                0 1px 2px rgba(15, 23, 42, 0.04),
                0 12px 32px -8px rgba(15, 23, 42, 0.10);
        }

        /* Logo */
        .servicehub-admin-login__logo-wrap {
            display: flex;
            justify-content: center;
            margin-bottom: 20px;
        }

        .servicehub-admin-login__logo {
            max-height: 38px;
            width: auto;
            max-width: 180px;
            object-fit: contain;
            display: block;
        }

        /* Label */
        .servicehub-admin-login__label {
            display: block;
            text-align: center;
            font-size: 10.5px;
            font-weight: 700;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            color: var(--sh-teal-deep);
            margin-bottom: 14px;
        }

        /* Headings */
        .servicehub-admin-login__heading {
            font-size: 24px;
            font-weight: 700;
            letter-spacing: -0.02em;
            color: var(--sh-ink);
            text-align: center;
            margin: 0 0 8px;
            line-height: 1.3;
        }

        .servicehub-admin-login__subheading {
            font-size: 13.5px;
            line-height: 1.55;
            color: var(--sh-muted);
            text-align: center;
            margin: 0 0 26px;
        }

        /* Alerts */
        .servicehub-admin-login__alert {
            display: flex;
            align-items: flex-start;
            gap: 9px;
            padding: 11px 13px;
            border-radius: 9px;
            font-size: 13px;
            font-weight: 500;
            line-height: 1.5;
            margin-bottom: 18px;
            border: 1px solid transparent;
        }

        .servicehub-admin-login__alert svg {
            width: 16px;
            height: 16px;
            flex-shrink: 0;
            margin-top: 1px;
        }

        .servicehub-admin-login__alert--error {
            color: #b91c1c;
            background: #fef2f2;
            border-color: #fecaca;
        }

        .servicehub-admin-login__alert--success {
            color: #047857;
            background: #f0fdf4;
            border-color: #bbf7d0;
        }

        /* Fields */
        .servicehub-admin-login__field {
            margin-bottom: 18px;
        }

        .servicehub-admin-login__field-label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            color: #334155;
            margin-bottom: 7px;
        }

        .servicehub-admin-login__control {
            position: relative;
        }

        .servicehub-admin-login__icon {
            position: absolute;
            left: 13px;
            top: 50%;
            transform: translateY(-50%);
            width: 17px;
            height: 17px;
            color: #94a3b8;
            pointer-events: none;
            transition: color 0.15s ease;
            z-index: 2;
        }

        .servicehub-admin-login__icon svg {
            width: 100%;
            height: 100%;
            display: block;
        }

        .servicehub-admin-login__input {
            width: 100%;
            height: 46px;
            padding: 0 14px 0 40px;
            font-family: inherit;
            font-size: 14px;
            font-weight: 400;
            color: var(--sh-ink);
            background: #ffffff;
            border: 1px solid var(--sh-line);
            border-radius: 9px;
            outline: none;
            transition: border-color 0.15s ease, box-shadow 0.15s ease;
            -webkit-appearance: none;
            appearance: none;
        }

        .servicehub-admin-login__input::placeholder {
            color: #9ca8b8;
        }

        .servicehub-admin-login__input:hover {
            border-color: #cbd5e1;
        }

        .servicehub-admin-login__input:focus {
            border-color: var(--sh-teal);
            box-shadow: 0 0 0 3px rgba(13, 148, 136, 0.12);
        }

        .servicehub-admin-login__input:focus-visible {
            outline: 2px solid var(--sh-teal);
            outline-offset: 1px;
        }

        .servicehub-admin-login__control:focus-within .servicehub-admin-login__icon {
            color: var(--sh-teal);
        }

        .servicehub-admin-login__input--password {
            padding-right: 46px;
        }

        /* Toggle */
        .servicehub-admin-login__toggle {
            position: absolute;
            right: 6px;
            top: 50%;
            transform: translateY(-50%);
            width: 34px;
            height: 34px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0;
            border: 0;
            border-radius: 7px;
            background: transparent;
            color: #94a3b8;
            cursor: pointer;
            transition: color 0.15s ease, background-color 0.15s ease;
            z-index: 3;
        }

        .servicehub-admin-login__toggle:hover {
            color: var(--sh-teal);
            background: rgba(13, 148, 136, 0.08);
        }

        .servicehub-admin-login__toggle:focus-visible {
            outline: 2px solid var(--sh-teal);
            outline-offset: 1px;
        }

        .servicehub-admin-login__toggle svg {
            width: 18px;
            height: 18px;
            display: block;
        }

        .servicehub-admin-login__toggle .icon-eye-off {
            display: none;
        }

        .servicehub-admin-login__toggle[aria-pressed="true"] .icon-eye {
            display: none;
        }

        .servicehub-admin-login__toggle[aria-pressed="true"] .icon-eye-off {
            display: block;
        }

        /* Submit */
        .servicehub-admin-login__submit {
            width: 100%;
            height: 46px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            margin-top: 6px;
            padding: 0 18px;
            font-family: inherit;
            font-size: 14px;
            font-weight: 600;
            letter-spacing: 0.01em;
            color: #ffffff;
            background: var(--sh-navy);
            border: 0;
            border-radius: 9px;
            cursor: pointer;
            transition: background-color 0.15s ease, box-shadow 0.15s ease;
            box-shadow: 0 1px 2px rgba(15, 23, 42, 0.08);
        }

        .servicehub-admin-login__submit svg {
            width: 16px;
            height: 16px;
            flex-shrink: 0;
        }

        .servicehub-admin-login__submit:hover {
            background: var(--sh-navy-deep);
            box-shadow: 0 2px 6px rgba(15, 23, 42, 0.14);
        }

        .servicehub-admin-login__submit:active {
            background: #081628;
        }

        .servicehub-admin-login__submit:focus-visible {
            outline: 2px solid var(--sh-teal);
            outline-offset: 2px;
        }

        /* Footer */
        .servicehub-admin-login__footer {
            margin-top: 20px;
            padding-top: 16px;
            border-top: 1px solid #f1f5f9;
            text-align: center;
            font-size: 13px;
            color: var(--sh-muted);
        }

        .servicehub-admin-login__footer a {
            color: var(--sh-teal-deep);
            font-weight: 600;
            text-decoration: none;
            border-radius: 3px;
            transition: color 0.15s ease;
        }

        .servicehub-admin-login__footer a:hover {
            color: var(--sh-navy);
            text-decoration: underline;
            text-underline-offset: 2px;
        }

        .servicehub-admin-login__footer a:focus-visible {
            outline: 2px solid var(--sh-teal);
            outline-offset: 2px;
        }

        /* Security note */
        .servicehub-admin-login__security {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            margin: 14px 0 0;
            font-size: 11.5px;
            font-weight: 500;
            color: #94a3b8;
        }

        .servicehub-admin-login__security svg {
            width: 13px;
            height: 13px;
            flex-shrink: 0;
            color: var(--sh-teal);
        }

        /* Reduced motion */
        @media (prefers-reduced-motion: reduce) {
            .servicehub-admin-login *,
            .servicehub-admin-login *::before,
            .servicehub-admin-login *::after {
                transition-duration: 0.01ms !important;
                animation-duration: 0.01ms !important;
            }
        }

        /* Mobile */
        @media (max-width: 575.98px) {
            .servicehub-admin-login {
                padding: 24px 14px 36px;
                min-height: calc(100vh - 60px);
            }

            .servicehub-admin-login__card {
                padding: 28px 22px 24px;
                border-radius: 12px;
            }

            .servicehub-admin-login__heading {
                font-size: 22px;
            }

            .servicehub-admin-login__subheading {
                margin-bottom: 22px;
            }
        }
    </style>

    <div class="servicehub-admin-login__card">

        {{-- Logo --}}
        <div class="servicehub-admin-login__logo-wrap">
            <img
                src="{{ asset('images/servicehub.png') }}"
                alt="ServiceHub"
                class="servicehub-admin-login__logo"
                width="180"
                height="38"
                loading="eager"
                decoding="async"
            >
        </div>

        {{-- Label --}}
        <span class="servicehub-admin-login__label">
            Administrator Access
        </span>

        {{-- Headings --}}
        <h1 class="servicehub-admin-login__heading">
            Welcome Back
        </h1>

        <p class="servicehub-admin-login__subheading">
            Sign in to manage your ServiceHub platform.
        </p>

        {{-- Validation errors --}}
        @if ($errors->any())
            <div class="servicehub-admin-login__alert servicehub-admin-login__alert--error" role="alert">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                    <circle cx="12" cy="12" r="10"></circle>
                    <line x1="12" y1="8" x2="12" y2="12"></line>
                    <line x1="12" y1="16" x2="12.01" y2="16"></line>
                </svg>
                <span>{{ $errors->first() }}</span>
            </div>
        @endif

        {{-- Success message --}}
        @if (session('success'))
            <div class="servicehub-admin-login__alert servicehub-admin-login__alert--success" role="status">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                    <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                    <polyline points="22 4 12 14.01 9 11.01"></polyline>
                </svg>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        {{-- Form --}}
        <form method="POST" action="{{ route('admin.login.store') }}">
            @csrf

            {{-- Email --}}
            <div class="servicehub-admin-login__field">
                <label for="email" class="servicehub-admin-login__field-label">
                    Email Address
                </label>

                <div class="servicehub-admin-login__control">
                    <span class="servicehub-admin-login__icon" aria-hidden="true">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="2" y="4" width="20" height="16" rx="2"></rect>
                            <path d="m2 7 10 7 10-7"></path>
                        </svg>
                    </span>

                    <input
                        type="email"
                        id="email"
                        name="email"
                        class="servicehub-admin-login__input"
                        value="{{ old('email') }}"
                        placeholder="admin@servicehub.com"
                        autocomplete="username"
                        inputmode="email"
                        spellcheck="false"
                        autocapitalize="none"
                        required
                        autofocus
                    >
                </div>
            </div>

            {{-- Password --}}
            <div class="servicehub-admin-login__field">
                <label for="password" class="servicehub-admin-login__field-label">
                    Password
                </label>

                <div class="servicehub-admin-login__control">
                    <span class="servicehub-admin-login__icon" aria-hidden="true">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="3" y="11" width="18" height="11" rx="2"></rect>
                            <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                        </svg>
                    </span>

                    <input
                        type="password"
                        id="password"
                        name="password"
                        class="servicehub-admin-login__input servicehub-admin-login__input--password"
                        placeholder="Enter your password"
                        autocomplete="current-password"
                        required
                    >

                    <button
                        type="button"
                        class="servicehub-admin-login__toggle"
                        id="admin-login-password-toggle"
                        aria-label="Show password"
                        aria-controls="password"
                        aria-pressed="false"
                    >
                        <svg class="icon-eye" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <path d="M2 12s3.5-7 10-7 10 7 10 7-3.5 7-10 7-10-7-10-7z"></path>
                            <circle cx="12" cy="12" r="3"></circle>
                        </svg>
                        <svg class="icon-eye-off" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94"></path>
                            <path d="M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19"></path>
                            <path d="M14.12 14.12a3 3 0 1 1-4.24-4.24"></path>
                            <line x1="1" y1="1" x2="23" y2="23"></line>
                        </svg>
                    </button>
                </div>
            </div>

            {{-- Submit --}}
            <button type="submit" class="servicehub-admin-login__submit">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                    <path d="M15 3h4a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2h-4"></path>
                    <polyline points="10 17 15 12 10 7"></polyline>
                    <line x1="15" y1="12" x2="3" y2="12"></line>
                </svg>
                Sign In
            </button>
        </form>

        {{-- Customer login --}}
        <div class="servicehub-admin-login__footer">
            <a href="{{ route('login') }}">
                Login as a customer
            </a>
        </div>

        {{-- Security note --}}
        <p class="servicehub-admin-login__security">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
            </svg>
            Secure administrator access
        </p>

    </div>

    <script>
        (function () {
            'use strict';

            var toggle = document.getElementById('admin-login-password-toggle');
            var password = document.getElementById('password');

            if (!toggle || !password) {
                return;
            }

            toggle.addEventListener('click', function () {
                var isVisible = password.getAttribute('type') === 'text';

                password.setAttribute('type', isVisible ? 'password' : 'text');
                toggle.setAttribute('aria-pressed', isVisible ? 'false' : 'true');
                toggle.setAttribute('aria-label', isVisible ? 'Show password' : 'Hide password');

                password.focus({ preventScroll: true });
            });
        })();
    </script>

</div>

@endsection