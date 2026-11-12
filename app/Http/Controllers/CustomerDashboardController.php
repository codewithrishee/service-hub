<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class CustomerDashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $totalBookings = $user->bookings()->count();

        $pendingBookings = $user->bookings()
            ->where('status', 'pending')
            ->count();

        $completedBookings = $user->bookings()
            ->where('status', 'completed')
            ->count();

        $cancelledBookings = $user->bookings()
            ->where('status', 'cancelled')
            ->count();

        $recentBookings = $user->bookings()
            ->with('service')
            ->latest()
            ->take(5)
            ->get();

        return view('customer.dashboard', compact(
            'totalBookings',
            'pendingBookings',
            'completedBookings',
            'cancelledBookings',
            'recentBookings'
        ));
    }
}