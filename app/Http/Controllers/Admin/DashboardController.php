<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Service;
use App\Models\Booking;

class DashboardController extends Controller
{
    public function index()
    {
        $totalUsers = User::count();

        $totalServices = Service::count();

        $totalBookings = Booking::count();

        $pendingBookings = Booking::where('status', 'pending')->count();

        $confirmedBookings = Booking::where('status', 'confirmed')->count();

        $inProgressBookings = Booking::where('status', 'in_progress')->count();

        $completedBookings = Booking::where('status', 'completed')->count();

        $cancelledBookings = Booking::where('status', 'cancelled')->count();

        $totalRevenue = Booking::where('status', 'completed')
            ->sum('total_price');

        $recentBookings = Booking::with(['user', 'service'])
            ->latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'totalUsers',
            'totalServices',
            'totalBookings',
            'pendingBookings',
            'confirmedBookings',
            'inProgressBookings',
            'completedBookings',
            'cancelledBookings',
            'totalRevenue',
            'recentBookings'
        ));
    }
}