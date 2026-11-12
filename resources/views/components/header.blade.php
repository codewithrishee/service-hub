
{{-- resources/views/components/header.blade.php --}}

@props([
    'active' => null,
])

<header class="sh-header">

    <nav
        class="navbar navbar-expand-lg fixed-top bg-white border-bottom shadow-sm servicehub-navbar"
        aria-label="Main navigation"
    >
        <div class="container sh-navbar-container">

           
{{-- Brand --}}
<a
    class="navbar-brand d-flex align-items-center"
    href="{{ url('/') }}"
>
    <img
        src="{{ asset('images/servicehub.png') }}"
        alt="ServiceHub"
        class="servicehub-logo"
    >
</a>

            {{-- Desktop Navigation --}}
            <ul class="navbar-nav mx-auto d-none d-lg-flex gap-lg-1">

                <li class="nav-item">
                    <a
                        class="nav-link {{ $active === 'home' ? 'active' : '' }}"
                        href="{{ url('/') }}"
                        @if($active === 'home') aria-current="page" @endif
                    >
                        Home
                    </a>
                </li>

                <li class="nav-item">
                    <a
                        class="nav-link {{ $active === 'services' ? 'active' : '' }}"
                        href="{{ url('/services') }}"
                        @if($active === 'services') aria-current="page" @endif
                    >
                        Services
                    </a>
                </li>

                <li class="nav-item">
                    <a
                        class="nav-link {{ $active === 'about' ? 'active' : '' }}"
                        href="{{ url('/about') }}"
                        @if($active === 'about') aria-current="page" @endif
                    >
                        About
                    </a>
                </li>

                <li class="nav-item">
                    <a
                        class="nav-link {{ $active === 'contact' ? 'active' : '' }}"
                        href="{{ url('/contact') }}"
                        @if($active === 'contact') aria-current="page" @endif
                    >
                        Contact
                    </a>
                </li>

            </ul>

            {{-- Desktop Actions --}}
            <div class="sh-desktop-actions d-none d-lg-flex align-items-center">

                @auth
                    {{-- Customer Notifications --}}
                    <div class="dropdown sh-notification-dropdown">

                        <button
                            type="button"
                            class="sh-notification-btn"
                            id="customerNotificationDropdown"
                            data-bs-toggle="dropdown"
                            aria-expanded="false"
                            aria-label="Notifications"
                        >
                            <i class="bi bi-bell" aria-hidden="true"></i>

                            @php
                                $unreadCount = auth()->user()
                                    ->unreadNotifications()
                                    ->count();
                            @endphp

                            @if($unreadCount > 0)
                                <span class="sh-notification-badge">
                                    {{ $unreadCount > 99 ? '99+' : $unreadCount }}
                                </span>
                            @endif
                        </button>

                        <ul
                            class="dropdown-menu dropdown-menu-end sh-notification-menu"
                            aria-labelledby="customerNotificationDropdown"
                        >
                            <li class="sh-notification-title">
                                Notifications
                            </li>

                            <li>
                                <hr class="dropdown-divider">
                            </li>

                            
@forelse(
    auth()->user()
        ->notifications()
        ->where('type', \App\Notifications\BookingStatusNotification::class)
        ->latest()
        ->take(10)
        ->get()
    as $notification
)

                                <li>
                                    <form
                                        method="POST"
                                        action="{{ route('notifications.read', $notification->id) }}"
                                    >
                                        @csrf

                                        <button
                                            type="submit"
                                            class="dropdown-item sh-notification-item {{ $notification->read_at ? '' : 'is-unread' }}"
                                        >
                                            <span class="sh-notification-item-title">
                                                {{ $notification->data['title'] ?? 'Booking Update' }}
                                            </span>

                                            <small>
                                                {{ $notification->data['message'] ?? '' }}
                                            </small>
                                        </button>
                                    </form>
                                </li>
                            @empty
                                <li class="sh-notification-empty">
                                    <i class="bi bi-bell-slash" aria-hidden="true"></i>
                                    <span>No notifications yet.</span>
                                </li>
                            @endforelse

                        </ul>
                    </div>

                    {{-- Customer Account --}}
                    <div class="dropdown sh-account-dropdown">

                        <button
                            type="button"
                            class="btn btn-outline-primary fw-semibold rounded-pill sh-account-btn"
                            data-bs-toggle="dropdown"
                            aria-expanded="false"
                        >
                            <i class="bi bi-person-circle" aria-hidden="true"></i>

                            <span>{{ auth()->user()->name }}</span>

                            <i class="bi bi-chevron-down sh-account-chevron" aria-hidden="true"></i>
                        </button>

                        <ul class="dropdown-menu dropdown-menu-end sh-account-menu">

                            <li>
                                <a
                                    class="dropdown-item"
                                    href="{{ route('customer.dashboard') }}"
                                >
                                    <i class="bi bi-grid" aria-hidden="true"></i>
                                    <span>Dashboard</span>
                                </a>
                            </li>

                            <li>
                                <a
                                    class="dropdown-item"
                                    href="{{ route('bookings.index') }}"
                                >
                                    <i class="bi bi-calendar-check" aria-hidden="true"></i>
                                    <span>My Bookings</span>
                                </a>
                            </li>

                            <li>
                                <a
                                    class="dropdown-item"
                                    href="{{ route('profile') }}"
                                >
                                    <i class="bi bi-person" aria-hidden="true"></i>
                                    <span>Profile</span>
                                </a>
                            </li>

                            <li>
                                <hr class="dropdown-divider">
                            </li>

                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf

                                    <button
                                        type="submit"
                                        class="dropdown-item text-danger"
                                    >
                                        <i class="bi bi-box-arrow-right" aria-hidden="true"></i>
                                        <span>Logout</span>
                                    </button>
                                </form>
                            </li>

                        </ul>
                    </div>

                @else
                    {{-- Guest Login --}}
                    <a
                        href="{{ route('login') }}"
                        class="btn btn-outline-primary fw-semibold rounded-pill sh-login-btn"
                    >
                        <i class="bi bi-box-arrow-in-right" aria-hidden="true"></i>
                        <span>Login</span>
                    </a>
                @endauth

                {{-- Book a Service --}}
                <a
                    href="{{ route('services.index') }}"
                    class="btn btn-primary fw-semibold rounded-pill cta-btn sh-book-btn"
                >
                    <i class="bi bi-calendar2-check" aria-hidden="true"></i>
                    <span>Book a Service</span>
                </a>

            </div>

            {{-- Mobile Actions --}}
            <div class="d-flex d-lg-none align-items-center gap-2 sh-mobile-actions">

                {{-- Compact Book Button --}}
                <a
                    href="{{ route('services.index') }}"
                    class="btn btn-primary fw-semibold rounded-pill sh-mobile-cta-compact d-none d-sm-inline-flex align-items-center justify-content-center"
                    aria-label="Book a service"
                >
                    <i class="bi bi-calendar2-check" aria-hidden="true"></i>
                </a>

                {{-- Mobile Hamburger --}}
                <button
                    class="navbar-toggler sh-hamburger"
                    type="button"
                    id="shMenuToggle"
                    aria-controls="shMobileMenu"
                    aria-expanded="false"
                    aria-label="Open navigation menu"
                >
                    <span class="sh-hamburger-box" aria-hidden="true">
                        <span class="sh-hamburger-line"></span>
                        <span class="sh-hamburger-line"></span>
                        <span class="sh-hamburger-line"></span>
                    </span>
                </button>

            </div>

        </div>
    </nav>

    {{-- Mobile Backdrop --}}
    <div
        class="sh-mobile-backdrop"
        id="shMobileBackdrop"
        hidden
        aria-hidden="true"
    ></div>

    {{-- Mobile Off-Canvas Menu --}}
    <aside
        class="sh-mobile-menu"
        id="shMobileMenu"
        role="dialog"
        aria-modal="true"
        aria-label="Mobile navigation"
        aria-hidden="true"
        tabindex="-1"
    >
        <div class="sh-mobile-menu-inner">

            {{-- Mobile Panel Header --}}
            <div class="sh-mobile-header">

                <a
                    class="navbar-brand d-flex align-items-center gap-2 fw-bold"
                    href="{{ url('/') }}"
                >
                    <span class="brand-mark d-flex align-items-center justify-content-center">
                        <i class="bi bi-tools" aria-hidden="true"></i>
                    </span>

                    <span class="brand-text">
                        Service<span class="brand-accent">Hub</span>
                    </span>
                </a>

                <button
                    type="button"
                    class="sh-mobile-close"
                    id="shMobileClose"
                    aria-label="Close navigation menu"
                >
                    <i class="bi bi-x-lg" aria-hidden="true"></i>
                </button>

            </div>

            {{-- Mobile Customer Account --}}
            @auth
                <div class="sh-mobile-auth">

                    <div class="sh-mobile-user">

                        <div class="sh-mobile-user-avatar">
                            @if(auth()->user()->profile_image)
                                <img
                                    src="{{ asset('storage/' . auth()->user()->profile_image) }}"
                                    alt="{{ auth()->user()->name }}"
                                >
                            @else
                                <i class="bi bi-person-fill" aria-hidden="true"></i>
                            @endif
                        </div>

                        <div class="sh-mobile-user-info">
                            <span class="sh-mobile-user-greeting">
                                Welcome back
                            </span>

                            <span class="sh-mobile-user-name">
                                {{ auth()->user()->name }}
                            </span>
                        </div>

                    </div>

                    <nav class="sh-mobile-auth-links" aria-label="Account navigation">

                        <a
                            href="{{ route('customer.dashboard') }}"
                            class="sh-mobile-auth-link"
                        >
                            <i class="bi bi-grid" aria-hidden="true"></i>
                            <span>Dashboard</span>
                            <i class="bi bi-chevron-right sh-mobile-link-chevron" aria-hidden="true"></i>
                        </a>

                        <a
                            href="{{ route('bookings.index') }}"
                            class="sh-mobile-auth-link"
                        >
                            <i class="bi bi-calendar-check" aria-hidden="true"></i>
                            <span>My Bookings</span>
                            <i class="bi bi-chevron-right sh-mobile-link-chevron" aria-hidden="true"></i>
                        </a>

                        <a
                            href="{{ route('profile') }}"
                            class="sh-mobile-auth-link"
                        >
                            <i class="bi bi-person" aria-hidden="true"></i>
                            <span>Profile</span>
                            <i class="bi bi-chevron-right sh-mobile-link-chevron" aria-hidden="true"></i>
                        </a>

                        <form
                            method="POST"
                            action="{{ route('logout') }}"
                            class="sh-mobile-logout-form"
                        >
                            @csrf

                            <button
                                type="submit"
                                class="sh-mobile-auth-link sh-mobile-logout-btn"
                            >
                                <i class="bi bi-box-arrow-right" aria-hidden="true"></i>
                                <span>Logout</span>
                            </button>
                        </form>

                    </nav>

                </div>
            @endauth

            {{-- Mobile Main Navigation --}}
            <nav class="sh-mobile-nav" aria-label="Mobile navigation links">

                <a
                    href="{{ url('/') }}"
                    class="sh-mobile-link {{ $active === 'home' ? 'active' : '' }}"
                    @if($active === 'home') aria-current="page" @endif
                >
                    <span class="sh-mobile-link-icon">
                        <i class="bi bi-house-door" aria-hidden="true"></i>
                    </span>
                    <span class="sh-mobile-link-text">Home</span>
                    <i class="bi bi-chevron-right sh-mobile-link-chevron" aria-hidden="true"></i>
                </a>

                <a
                    href="{{ url('/services') }}"
                    class="sh-mobile-link {{ $active === 'services' ? 'active' : '' }}"
                    @if($active === 'services') aria-current="page" @endif
                >
                    <span class="sh-mobile-link-icon">
                        <i class="bi bi-grid" aria-hidden="true"></i>
                    </span>
                    <span class="sh-mobile-link-text">Services</span>
                    <i class="bi bi-chevron-right sh-mobile-link-chevron" aria-hidden="true"></i>
                </a>

                <a
                    href="{{ url('/about') }}"
                    class="sh-mobile-link {{ $active === 'about' ? 'active' : '' }}"
                    @if($active === 'about') aria-current="page" @endif
                >
                    <span class="sh-mobile-link-icon">
                        <i class="bi bi-info-circle" aria-hidden="true"></i>
                    </span>
                    <span class="sh-mobile-link-text">About</span>
                    <i class="bi bi-chevron-right sh-mobile-link-chevron" aria-hidden="true"></i>
                </a>

                <a
                    href="{{ url('/contact') }}"
                    class="sh-mobile-link {{ $active === 'contact' ? 'active' : '' }}"
                    @if($active === 'contact') aria-current="page" @endif
                >
                    <span class="sh-mobile-link-icon">
                        <i class="bi bi-envelope" aria-hidden="true"></i>
                    </span>
                    <span class="sh-mobile-link-text">Contact</span>
                    <i class="bi bi-chevron-right sh-mobile-link-chevron" aria-hidden="true"></i>
                </a>

            </nav>

            {{-- Mobile Footer --}}
            <div class="sh-mobile-footer">

                @guest
                    <a href="{{ route('login') }}" class="sh-mobile-login">
                        <i class="bi bi-box-arrow-in-right" aria-hidden="true"></i>
                        <span>Login</span>
                    </a>
                @endguest

                <a href="{{ route('services.index') }}" class="sh-mobile-cta">
                    <i class="bi bi-calendar2-check" aria-hidden="true"></i>
                    <span>Book a Service</span>
                    <i class="bi bi-arrow-right sh-mobile-cta-arrow" aria-hidden="true"></i>
                </a>

                <p class="sh-mobile-tagline">
                    Trusted home services, right at your door.
                </p>

            </div>

        </div>
    </aside>

</header>

@once
    @push('styles')
        <link rel="stylesheet" href="{{ asset('css/header.css') }}">
    @endpush
@endonce

@once
    @push('scripts')
        <script src="{{ asset('js/header.js') }}" defer></script>
    @endpush
@endonce
