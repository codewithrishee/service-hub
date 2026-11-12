<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index()
    {
        $bookings = Booking::with(['user', 'service'])
            ->latest()
            ->get();

        return view('admin.bookings.index', compact('bookings'));
    }

    public function show(Booking $booking)
{
    $booking->load(['user', 'service.category']);

    return view('admin.bookings.show', compact('booking'));
}

public function updateStatus(Request $request, Booking $booking)
{
    $validated = $request->validate([
        'status' => 'required|in:pending,confirmed,in_progress,completed,cancelled',
    ]);

    // Avoid duplicate notifications if status is unchanged
    if ($booking->status === $validated['status']) {
        return redirect()
            ->route('admin.bookings.show', $booking)
            ->with('info', 'Booking status is unchanged.');
    }

    $booking->update([
        'status' => $validated['status'],
    ]);

    $booking->load(['user', 'service']);

    $status = $booking->status;

    $titles = [
        'pending' => 'Booking Received',
        'confirmed' => 'Booking Confirmed',
        'in_progress' => 'Service In Progress',
        'completed' => 'Booking Completed',
        'cancelled' => 'Booking Cancelled',
    ];

    $messages = [
        'pending' => 'Your booking has been received and is pending confirmation.',
        'confirmed' => 'Your service booking has been confirmed.',
        'in_progress' => 'Your booked service is now in progress.',
        'completed' => 'Your booked service has been completed.',
        'cancelled' => 'Your service booking has been cancelled.',
    ];

    $booking->user->notify(
        new \App\Notifications\BookingStatusNotification(
            $booking,
            $titles[$status],
            $messages[$status]
        )
    );

    return redirect()
        ->route('admin.bookings.show', $booking)
        ->with('success', 'Booking status updated and customer notified.');
}
}