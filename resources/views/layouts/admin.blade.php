<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Admin Panel') - ServiceHub</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- Admin CSS -->
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">

    @stack('styles')
</head>

<body>

    <!-- Admin Sidebar -->
    <aside class="admin-sidebar">

        
<div class="admin-brand">
    <a href="{{ route('admin.dashboard') }}">
        <img
            src="{{ asset('images/admin.png') }}"
            alt="ServiceHub"
            class="admin-logo"
        >
    </a>
</div>


        <!-- Sidebar Navigation -->
        <nav class="admin-nav">

            <a href="{{ route('admin.dashboard') }}" class="admin-nav-link">
                <i class="bi bi-grid-1x2-fill"></i>
                <span>Dashboard</span>
            </a>

            <a href="{{ route('admin.categories.index') }}" class="admin-nav-link">
                <i class="bi bi-tags-fill"></i>
                <span>Categories</span>
            </a>

            <a href="{{ route('admin.services.index') }}" class="admin-nav-link">
                <i class="bi bi-tools"></i>
                <span>Services</span>
            </a>

            <a href="{{ route('admin.bookings.index') }}" class="admin-nav-link">
                <i class="bi bi-calendar-check"></i>
                <span>Bookings</span>
            </a>

            <a href="{{ route('admin.users.index') }}" class="admin-nav-link">
                <i class="bi bi-people-fill"></i>
                <span>Users</span>
            </a>


            @php
                $newContactMessagesCount = \App\Models\ContactMessage::where(
                    'status',
                    'new'
                )->count();
            @endphp

            <a href="{{ route('admin.contact-messages.index') }}" class="admin-nav-link">
                <i class="bi bi-envelope-fill"></i>
                <span>Contact Messages</span>

                @if($newContactMessagesCount > 0)
                    <span class="badge bg-danger ms-auto">
                        {{ $newContactMessagesCount > 99 ? '99+' : $newContactMessagesCount }}
                    </span>
                @endif
            </a>


        </nav>

        <!-- Sidebar Bottom -->
        <div class="admin-sidebar-bottom">

            <a href="{{ route('home') }}" class="admin-nav-link">
                <i class="bi bi-house-fill"></i>
                <span>View Website</span>
            </a>

            <form method="POST" action="{{ route('admin.logout') }}">
                @csrf

                <button type="submit" class="admin-nav-link admin-logout">
                    <i class="bi bi-box-arrow-right"></i>
                    <span>Logout</span>
                </button>
            </form>

        </div>

    </aside>

    <!-- Main Admin Area -->
    <div class="admin-main">

        <!-- Topbar -->
        <header class="admin-topbar">

            <!-- Mobile Menu Button -->
            <div>
                <button type="button" class="admin-menu-toggle" id="adminMenuToggle" aria-label="Toggle sidebar">
                    <i class="bi bi-list"></i>
                </button>
            </div>

            <!-- Topbar Right -->
            <div class="admin-topbar-right">

                <!-- Admin Notifications -->
                <div class="dropdown">

                    <button type="button" class="admin-notification-btn" id="adminNotificationDropdown"
                        data-bs-toggle="dropdown" data-bs-auto-close="true" aria-expanded="false"
                        aria-label="Notifications">
                        <i class="bi bi-bell"></i>

                        @php
                            $unreadCount = auth()->user()
                                ->unreadNotifications()
                                ->where(
                                    'type',
                                    \App\Notifications\AdminActivityNotification::class
                                )
                                ->count();
                        @endphp

                        @if($unreadCount > 0)
                            <span class="admin-notification-count">
                                {{ $unreadCount > 99 ? '99+' : $unreadCount }}
                            </span>
                        @endif

                    </button>

                    <ul class="dropdown-menu dropdown-menu-end admin-notification-menu"
                        aria-labelledby="adminNotificationDropdown">

                        <li class="admin-notification-heading">
                            Notifications
                        </li>

                        @forelse(
                                auth()->user()
                                    ->notifications()
                                    ->where(
                                        'type',
                                        \App\Notifications\AdminActivityNotification::class
                                    )
                                    ->latest()
                                    ->take(5)
                                    ->get()
                                as $notification
                            )

                            <li>
                                @if(isset($notification->data['booking_id']))

                                    <a href="{{ route('admin.bookings.show', $notification->data['booking_id']) }}"
                                        class="admin-notification-item {{ $notification->read_at ? '' : 'unread' }}">
                                        <strong>
                                            {{ $notification->data['title'] ?? 'New Notification' }}
                                        </strong>

                                        <small>
                                            {{ $notification->data['message'] ?? 'You have a new notification.' }}
                                        </small>
                                    </a>

                                @else

                                    <div class="admin-notification-item {{ $notification->read_at ? '' : 'unread' }}">
                                        <strong>
                                            {{ $notification->data['title'] ?? 'New Notification' }}
                                        </strong>

                                        <small>
                                            {{ $notification->data['message'] ?? 'You have a new notification.' }}
                                        </small>
                                    </div>

                                @endif
                            </li>

                        @empty

                            <li class="admin-notification-empty">
                                No notifications yet
                            </li>

                        @endforelse

                    </ul>

                </div>

                <!-- Admin Profile -->
                <div class="admin-user">

                    <div class="admin-user-avatar">

                        @if(auth()->user()->profile_image)

                            <img src="{{ asset('storage/' . auth()->user()->profile_image) }}"
                                alt="{{ auth()->user()->name }}">

                        @else

                            <i class="bi bi-person-fill"></i>

                        @endif

                    </div>

                    <div class="admin-user-info">

                        <span class="admin-user-name">
                            {{ auth()->user()->name }}
                        </span>

                        <span class="admin-user-role">
                            Administrator
                        </span>

                    </div>

                </div>

            </div>

        </header>

        <!-- Page Content -->
        <main class="admin-content">
            @yield('content')
        </main>

    </div>

    <!-- Mobile Overlay -->
    <div class="admin-overlay" id="adminOverlay"></div>

    <!-- Bootstrap JavaScript Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Admin JavaScript -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {

            // Mobile Sidebar
            const menuToggle = document.getElementById('adminMenuToggle');
            const sidebar = document.querySelector('.admin-sidebar');
            const overlay = document.getElementById('adminOverlay');

            if (menuToggle && sidebar && overlay) {

                menuToggle.addEventListener('click', function () {
                    sidebar.classList.toggle('show');
                    overlay.classList.toggle('show');
                });

                overlay.addEventListener('click', function () {
                    sidebar.classList.remove('show');
                    overlay.classList.remove('show');
                });

            }

            // Notification Dropdown
            const notificationButton = document.getElementById('adminNotificationDropdown');

            if (notificationButton && window.bootstrap) {
                bootstrap.Dropdown.getOrCreateInstance(notificationButton);
            }

        });
    </script>

    @stack('scripts')

</body>

</html>