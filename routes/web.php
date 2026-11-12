<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CustomerDashboardController;
use App\Http\Controllers\ProfileController;

use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\CategoryController as adminCategoryController;
use App\Http\Controllers\admin\ServiceController as adminServiceController;
use App\Http\Controllers\admin\BookingController as adminBookingController;
use App\Http\Controllers\admin\UserController as adminUserController;
use App\Http\Controllers\ContactMessageController;
use App\Http\Controllers\admin\ContactMessageController as AdminContactMessageController;


/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'index'])
    ->name('home');

Route::get('/about', function () {
    return view('about');
});

Route::get('/contact', function () {
    return view('contact');
});

Route::post('/contact', [ContactMessageController::class, 'store'])
    ->name('contact.submit');


/*
|--------------------------------------------------------------------------
| Services
|--------------------------------------------------------------------------
*/

Route::get('/services', [ServiceController::class, 'index'])
    ->name('services.index');

Route::get('/services/{slug}', [ServiceController::class, 'show'])
    ->name('services.show');


/*
|--------------------------------------------------------------------------
| Categories
|--------------------------------------------------------------------------
*/

Route::get('/categories', [CategoryController::class, 'index'])
    ->name('categories.index');

Route::get('/categories/{slug}', [CategoryController::class, 'show'])
    ->name('categories.show');


/*
|--------------------------------------------------------------------------
| Website Authentication
|--------------------------------------------------------------------------
*/

// Register
Route::get('/register', [AuthController::class, 'showRegister'])
    ->name('register');

Route::post('/register', [AuthController::class, 'register'])
    ->name('register.store');


// Website Login
Route::get('/login', [AuthController::class, 'showLogin'])
    ->name('login');

Route::post('/login', [AuthController::class, 'login'])
    ->name('login.store');


// Website Logout
Route::post('/logout', [AuthController::class, 'logout'])
    ->name('logout');


/*
|--------------------------------------------------------------------------
| admin Authentication
|--------------------------------------------------------------------------
*/

// admin Login Page
Route::get('/admin/login', [AuthController::class, 'showadminLogin'])
    ->name('admin.login');

// admin Login Submit
Route::post('/admin/login', [AuthController::class, 'adminLogin'])
    ->name('admin.login.store');


/*
|--------------------------------------------------------------------------
| Customer Routes
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    // Customer Dashboard
    Route::get('/dashboard', [CustomerDashboardController::class, 'index'])
        ->name('customer.dashboard');


    // Bookings
    Route::get('/bookings', [BookingController::class, 'index'])
        ->name('bookings.index');

    Route::get('/bookings/{id}', [BookingController::class, 'show'])
        ->name('bookings.show');

    Route::patch('/bookings/{id}/cancel', [BookingController::class, 'cancel'])
        ->name('bookings.cancel');


    // Create Booking
    Route::get('/booking/{service}/create', [BookingController::class, 'create'])
        ->name('booking.create');

    Route::post('/booking', [BookingController::class, 'store'])
        ->name('booking.store');


    // Profile
    Route::get('/profile', [ProfileController::class, 'index'])
        ->name('profile');

    Route::put('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])
        ->name('profile.password.update');

    Route::post('/notifications/{notification}/read', function (\Illuminate\Notifications\DatabaseNotification $notification) {
        abort_unless(
            $notification->notifiable_id === auth()->id()
            && $notification->notifiable_type === \App\Models\User::class,
            403
        );

        $notification->markAsRead();

        return back();
    })->name('notifications.read');

});


/*
|--------------------------------------------------------------------------
| admin Routes
|--------------------------------------------------------------------------
*/

Route::middleware('admin')
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        // admin Dashboard
        Route::get('/', [DashboardController::class, 'index'])
            ->name('dashboard');


        // Categories
        Route::resource('categories', adminCategoryController::class)
            ->except(['show']);


        // Services
        Route::resource('services', adminServiceController::class)
            ->except(['show']);


        // Bookings
        Route::get('/bookings', [adminBookingController::class, 'index'])
            ->name('bookings.index');

        Route::get('/bookings/{booking}', [adminBookingController::class, 'show'])
            ->name('bookings.show');

        Route::patch('/bookings/{booking}/status', [adminBookingController::class, 'updateStatus'])
            ->name('bookings.status.update');


        // Users
        Route::get('/users', [adminUserController::class, 'index'])
            ->name('users.index');

        Route::get('/users/{user}', [adminUserController::class, 'show'])
            ->name('users.show');

        Route::patch('/users/{user}/role', [adminUserController::class, 'updateRole'])
            ->name('users.role.update');


        // Admin Logout
        Route::post('/logout', [AuthController::class, 'adminLogout'])
            ->name('logout');


        Route::get('/contact-messages', [
            AdminContactMessageController::class,
            'index'
        ])->name('contact-messages.index');

        Route::get('/contact-messages/{contactMessage}', [
            AdminContactMessageController::class,
            'show'
        ])->name('contact-messages.show');

        Route::patch('/contact-messages/{contactMessage}/status', [
            AdminContactMessageController::class,
            'updateStatus'
        ])->name('contact-messages.status.update');

        Route::delete('/contact-messages/{contactMessage}', [
            AdminContactMessageController::class,
            'destroy'
        ])->name('contact-messages.destroy');

    });

