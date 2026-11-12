<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\Booking;
use App\Models\User;
use App\Notifications\BookingStatusNotification;
use App\Notifications\AdminActivityNotification;

class BookingController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Customer Bookings
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        $bookings = auth()->user()
            ->bookings()
            ->with('service.category')
            ->latest()
            ->get();

        return view('customer.booking', compact('bookings'));
    }

    /*
    |--------------------------------------------------------------------------
    | Show Booking Details
    |--------------------------------------------------------------------------
    */

    public function show($id)
    {
        $booking = auth()->user()
            ->bookings()
            ->with('service.category')
            ->findOrFail($id);

        return view('customer.booking-show', compact('booking'));
    }

    /*
    |--------------------------------------------------------------------------
    | Cancel Booking
    |--------------------------------------------------------------------------
    */

    public function cancel($id)
    {
        $booking = auth()->user()
            ->bookings()
            ->with(['user', 'service'])
            ->findOrFail($id);

        // Only pending bookings can be cancelled
        if ($booking->status !== 'pending') {
            return back()->with(
                'error',
                'This booking cannot be cancelled.'
            );
        }

        $booking->update([
            'status' => 'cancelled',
        ]);

        // Notify customer about cancellation
        $booking->user->notify(
            new BookingStatusNotification(
                $booking,
                'Booking Cancelled',
                'Your booking has been cancelled successfully.'
            )
        );

        // Notify admins about customer cancellation
        $admins = User::query()
            ->where('role', 'admin')
            ->get();

        foreach ($admins as $admin) {
            $admin->notify(
                new AdminActivityNotification(
                    'Booking Cancelled by Customer',
                    'A customer has cancelled a booking.',
                    $booking,
                    'booking_cancelled'
                )
            );
        }

        return redirect()
            ->route('bookings.index')
            ->with('success', 'Booking cancelled successfully.');
    }

    /*
    |--------------------------------------------------------------------------
    | Create Booking Form
    |--------------------------------------------------------------------------
    */

    public function create(string $service)
    {
        $service = Service::where('slug', $service)
            ->where('status', 1)
            ->firstOrFail();

        return view('booking.create', compact('service'));
    }

    /*
    |--------------------------------------------------------------------------
    | Store Booking
    |--------------------------------------------------------------------------
    */

    public function store(Request $request)
    {
        $validated = $request->validate([
            'service_id' => 'required|exists:services,id',
            'booking_date' => 'required|date|after_or_equal:today',
            'booking_time' => 'required',
            'address' => 'required|string|max:1000',
            'notes' => 'nullable|string|max:1000',
        ]);

        $service = Service::where('status', 1)
            ->findOrFail($validated['service_id']);

        // Create booking
        $booking = Booking::create([
            'user_id' => auth()->id(),
            'service_id' => $service->id,
            'booking_date' => $validated['booking_date'],
            'booking_time' => $validated['booking_time'],
            'address' => $validated['address'],
            'total_price' => $service->price,
            'status' => 'pending',
            'notes' => $validated['notes'] ?? null,
        ]);

        // Load relationships needed for notifications
        $booking->load(['user', 'service']);

        // Notify customer about the new booking
        $booking->user->notify(
            new BookingStatusNotification(
                $booking,
                'Booking Received',
                'Your booking has been received and is pending confirmation.'
            )
        );

        // Notify admins about the new booking
        $admins = User::query()
            ->where('role', 'admin')
            ->get();

        foreach ($admins as $admin) {
            $admin->notify(
                new AdminActivityNotification(
                    'New Booking Received',
                    'A customer has submitted a new service booking.',
                    $booking,
                    'new_booking'
                )
            );
        }

        return redirect()
            ->route('bookings.index')
            ->with('success', 'Booking created successfully.');
    }
}
