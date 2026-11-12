@extends('layouts.app')

@section('title', 'My Profile')

@section('content')

<style>
    .profile-page {
        background: #f7f8fc;
        min-height: calc(100vh - 70px);
    }

    /* =========================
       Header
    ========================== */

    .profile-header {
        position: relative;
        overflow: hidden;
        background: linear-gradient(135deg, #0d6efd 0%, #4f8dfd 100%);
        border-radius: 24px;
        padding: 35px 40px;
        color: #fff;
        box-shadow: 0 15px 40px rgba(13, 110, 253, .16);
    }

    .profile-header::before,
    .profile-header::after {
        content: "";
        position: absolute;
        border-radius: 50%;
        background: rgba(255,255,255,.08);
    }

    .profile-header::before {
        width: 230px;
        height: 230px;
        right: -75px;
        top: -110px;
    }

    .profile-header::after {
        width: 160px;
        height: 160px;
        right: 140px;
        bottom: -105px;
    }

    .header-content {
        position: relative;
        z-index: 2;
    }

    .header-label {
        font-size: 11px;
        font-weight: 700;
        letter-spacing: 1.5px;
        opacity: .75;
    }

    .header-title {
        font-size: 32px;
        font-weight: 800;
        margin: 7px 0 7px;
    }

    .header-description {
        color: rgba(255,255,255,.82);
        font-size: 14px;
        margin: 0;
        max-width: 650px;
    }

    .header-icon {
        position: absolute;
        right: 45px;
        bottom: 0;
        font-size: 115px;
        color: rgba(255,255,255,.10);
        z-index: 1;
    }


    /* =========================
       Alerts
    ========================== */

    .profile-alert {
        border: 0;
        border-radius: 15px;
        padding: 14px 18px;
    }


    /* =========================
       Cards
    ========================== */

    .profile-card {
        background: #fff;
        border: 1px solid #edf0f5;
        border-radius: 21px;
        overflow: hidden;
        transition: all .2s ease;
    }

    .profile-card:hover {
        border-color: #e3e7ee;
    }

    .card-padding {
        padding: 27px;
    }

    .card-title {
        color: #172033;
        font-size: 18px;
        font-weight: 750;
    }

    .card-subtitle {
        color: #8a92a3;
        font-size: 13px;
        line-height: 1.6;
    }


    /* =========================
       Profile Summary
    ========================== */

    .profile-summary {
        text-align: center;
        padding: 32px 25px;
    }

    .profile-avatar-wrapper {
        position: relative;
        display: inline-block;
        margin-bottom: 18px;
    }

    .profile-avatar {
        width: 145px;
        height: 145px;
        object-fit: cover;
        border-radius: 50%;
        border: 5px solid #fff;
        box-shadow: 0 10px 30px rgba(30,40,70,.12);
    }

    .profile-avatar-placeholder {
        width: 145px;
        height: 145px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        background: #eef5ff;
        color: #0d6efd;
        border: 5px solid #fff;
        box-shadow: 0 10px 30px rgba(30,40,70,.10);
    }

    .profile-avatar-placeholder i {
        font-size: 58px;
    }

    .profile-name {
        color: #172033;
        font-size: 20px;
        font-weight: 800;
        margin-bottom: 5px;
    }

    .profile-email {
        color: #8a92a3;
        font-size: 13px;
        word-break: break-word;
    }

    .profile-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: #eef5ff;
        color: #0d6efd;
        padding: 7px 12px;
        border-radius: 50px;
        font-size: 11px;
        font-weight: 700;
        margin-top: 15px;
    }

    .profile-badge-dot {
        width: 6px;
        height: 6px;
        background: #0d6efd;
        border-radius: 50%;
    }


    /* =========================
       Form
    ========================== */

    .form-label {
        color: #303849;
        font-size: 13px;
        font-weight: 650;
        margin-bottom: 8px;
    }

    .form-control {
        border: 1px solid #e2e6ed;
        border-radius: 12px;
        padding: 11px 14px;
        font-size: 13px;
        color: #252d3d;
        background: #fff;
        transition: all .2s ease;
    }

    .form-control:focus {
        border-color: #86b7fe;
        box-shadow: 0 0 0 .2rem rgba(13,110,253,.08);
    }

    .form-control::placeholder {
        color: #a5acb8;
    }

    .form-help {
        color: #969ead;
        font-size: 11px;
        margin-top: 7px;
    }

    .error-text {
        color: #dc3545;
        font-size: 11px;
        margin-top: 7px;
    }


    /* =========================
       Upload
    ========================== */

    .upload-box {
        background: #fafbfc;
        border: 1px dashed #dfe4eb;
        border-radius: 14px;
        padding: 15px;
    }


    /* =========================
       Section Icon
    ========================== */

    .section-icon {
        width: 42px;
        height: 42px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #eef5ff;
        color: #0d6efd;
        border-radius: 12px;
        font-size: 18px;
    }

    .security-icon {
        background: #edf9f2;
        color: #198754;
    }


    /* =========================
       Buttons
    ========================== */

    .profile-btn {
        border-radius: 11px;
        padding: 10px 18px;
        font-size: 13px;
        font-weight: 650;
        transition: all .2s ease;
    }

    .profile-btn:hover {
        transform: translateY(-1px);
    }


    /* =========================
       Security Card
    ========================== */

    .security-note {
        background: #f7fbf9;
        border: 1px solid #e0f0e7;
        border-radius: 13px;
        padding: 12px 14px;
        color: #5c7566;
        font-size: 11px;
        line-height: 1.5;
    }


    /* =========================
       Responsive
    ========================== */

    @media (max-width: 767px) {

        .profile-header {
            padding: 28px 24px;
            border-radius: 20px;
        }

        .header-title {
            font-size: 25px;
        }

        .header-icon {
            display: none;
        }

        .card-padding {
            padding: 21px;
        }

        .profile-summary {
            padding: 28px 20px;
        }

        .profile-avatar,
        .profile-avatar-placeholder {
            width: 125px;
            height: 125px;
        }

        .profile-avatar-placeholder i {
            font-size: 50px;
        }
    }
</style>


<div class="profile-page py-4 py-lg-5">

    <div class="container">


        {{-- =========================
             Success Message
        ========================== --}}

        @if(session('success'))

            <div class="alert alert-success profile-alert alert-dismissible fade show mb-4"
                 role="alert">

                <i class="bi bi-check-circle-fill me-2"></i>

                {{ session('success') }}

                <button type="button"
                        class="btn-close"
                        data-bs-dismiss="alert"
                        aria-label="Close">
                </button>

            </div>

        @endif


        {{-- =========================
             Page Header
        ========================== --}}

        <div class="profile-header mb-5">

            <div class="header-content">

                <div class="header-label">
                    MY ACCOUNT
                </div>

                <h1 class="header-title">
                    My Profile
                </h1>

                <p class="header-description">
                    Manage your personal information, profile picture and account security.
                </p>

            </div>

            <i class="bi bi-person-circle header-icon"></i>

        </div>


        <div class="row g-4">


            {{-- =========================
                 Profile Summary
            ========================== --}}

            <div class="col-lg-4">

                <div class="profile-card h-100">

                    <div class="profile-summary">

                        <div class="profile-avatar-wrapper">

                            @if($user->profile_image)

                                <img src="{{ asset('storage/' . $user->profile_image) }}"
                                     alt="{{ $user->name }}"
                                     class="profile-avatar">

                            @else

                                <div class="profile-avatar-placeholder">

                                    <i class="bi bi-person"></i>

                                </div>

                            @endif

                        </div>


                        <div class="profile-name">
                            {{ $user->name }}
                        </div>

                        <div class="profile-email">
                            {{ $user->email }}
                        </div>

                        <div class="profile-badge">

                            <span class="profile-badge-dot"></span>

                            Active Account

                        </div>

                    </div>

                </div>

            </div>


            {{-- =========================
                 Personal Information
            ========================== --}}

            <div class="col-lg-8">

                <div class="profile-card">

                    <div class="card-padding">

                        <div class="d-flex align-items-center gap-3 mb-4">

                            <div class="section-icon">

                                <i class="bi bi-person-vcard"></i>

                            </div>

                            <div>

                                <h2 class="card-title mb-1">
                                    Personal Information
                                </h2>

                                <p class="card-subtitle mb-0">
                                    Update your basic account information.
                                </p>

                            </div>

                        </div>


                        {{-- Personal Information Form --}}

                        <form action="{{ route('profile.update') }}"
                              method="POST"
                              enctype="multipart/form-data">

                            @csrf
                            @method('PUT')


                            {{-- Profile Image --}}

                            <div class="mb-4">

                                <label class="form-label">
                                    Profile Picture
                                </label>

                                <div class="upload-box">

                                    <input type="file"
                                           name="profile_image"
                                           class="form-control"
                                           accept="image/*">

                                    <div class="form-help">
                                        JPG, JPEG, PNG or WEBP. Maximum file size: 2MB.
                                    </div>

                                </div>

                                @error('profile_image')

                                    <div class="error-text">
                                        {{ $message }}
                                    </div>

                                @enderror

                            </div>


                            {{-- Name --}}

                            <div class="mb-4">

                                <label class="form-label">
                                    Full Name
                                </label>

                                <input type="text"
                                       name="name"
                                       class="form-control"
                                       value="{{ old('name', $user->name) }}"
                                       placeholder="Enter your full name"
                                       required>

                                @error('name')

                                    <div class="error-text">
                                        {{ $message }}
                                    </div>

                                @enderror

                            </div>


                            {{-- Email --}}

                            <div class="mb-4">

                                <label class="form-label">
                                    Email Address
                                </label>

                                <input type="email"
                                       name="email"
                                       class="form-control"
                                       value="{{ old('email', $user->email) }}"
                                       placeholder="Enter your email address"
                                       required>

                                @error('email')

                                    <div class="error-text">
                                        {{ $message }}
                                    </div>

                                @enderror

                            </div>


                            {{-- Save --}}

                            <div class="d-flex justify-content-end">

                                <button type="submit"
                                        class="btn btn-primary profile-btn">

                                    <i class="bi bi-check2-circle me-2"></i>

                                    Save Changes

                                </button>

                            </div>


                        </form>

                    </div>

                </div>

            </div>


            {{-- =========================
                 Change Password
            ========================== --}}

            <div class="col-lg-8 offset-lg-4">

                <div class="profile-card">

                    <div class="card-padding">

                        <div class="d-flex align-items-center gap-3 mb-4">

                            <div class="section-icon security-icon">

                                <i class="bi bi-shield-lock"></i>

                            </div>

                            <div>

                                <h2 class="card-title mb-1">
                                    Change Password
                                </h2>

                                <p class="card-subtitle mb-0">
                                    Update your password to keep your account secure.
                                </p>

                            </div>

                        </div>


                        {{-- Password Success --}}

                        @if(session('password_success'))

                            <div class="alert alert-success profile-alert alert-dismissible fade show mb-4"
                                 role="alert">

                                <i class="bi bi-check-circle-fill me-2"></i>

                                {{ session('password_success') }}

                                <button type="button"
                                        class="btn-close"
                                        data-bs-dismiss="alert"
                                        aria-label="Close">
                                </button>

                            </div>

                        @endif


                        {{-- Password Form --}}

                        <form action="{{ route('profile.password.update') }}"
                              method="POST">

                            @csrf
                            @method('PUT')


                            {{-- Current Password --}}

                            <div class="mb-4">

                                <label class="form-label">
                                    Current Password
                                </label>

                                <input type="password"
                                       name="current_password"
                                       class="form-control"
                                       placeholder="Enter current password"
                                       required>

                                @error('current_password')

                                    <div class="error-text">
                                        {{ $message }}
                                    </div>

                                @enderror

                            </div>


                            {{-- New Password --}}

                            <div class="mb-4">

                                <label class="form-label">
                                    New Password
                                </label>

                                <input type="password"
                                       name="password"
                                       class="form-control"
                                       placeholder="Enter new password"
                                       required>

                                @error('password')

                                    <div class="error-text">
                                        {{ $message }}
                                    </div>

                                @enderror

                            </div>


                            {{-- Confirm Password --}}

                            <div class="mb-4">

                                <label class="form-label">
                                    Confirm New Password
                                </label>

                                <input type="password"
                                       name="password_confirmation"
                                       class="form-control"
                                       placeholder="Confirm your new password"
                                       required>

                            </div>


                            {{-- Security Note --}}

                            <div class="security-note mb-4">

                                <i class="bi bi-info-circle me-1"></i>

                                Choose a strong password that you don't use on other websites.

                            </div>


                            {{-- Change Password --}}

                            <div class="d-flex justify-content-end">

                                <button type="submit"
                                        class="btn btn-primary profile-btn">

                                    <i class="bi bi-shield-check me-2"></i>

                                    Change Password

                                </button>

                            </div>


                        </form>

                    </div>

                </div>

            </div>


        </div>

    </div>

</div>

@endsection