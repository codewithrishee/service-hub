<?php

namespace App\Notifications;

use App\Models\Booking;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AdminActivityNotification extends Notification
{
    use Queueable;

    public function __construct(
        public string $title,
        public string $message,
        public ?Booking $booking = null,
        public string $type = 'general'
    ) {}

    public function via(object $notifiable): array
    {
        return ['database', 'mail'];
    }

    public function toDatabase(object $notifiable): array
    {
        return [
            'type' => $this->type,
            'title' => $this->title,
            'message' => $this->message,
            'booking_id' => $this->booking?->id,
            'service_name' => $this->booking?->service?->name,
        ];
    }

    public function toMail(object $notifiable): MailMessage
    {
        $mail = (new MailMessage)
            ->subject($this->title)
            ->greeting('Hello ' . $notifiable->name . '!')
            ->line($this->message);

        if ($this->booking) {
            $mail->line('Booking ID: ' . $this->booking->id)
                ->line('Service: ' . $this->booking->service->name)
                ->action('View Admin Bookings', url('/admin/bookings'));
        } else {
            $mail->action('Open Admin Panel', url('/admin'));
        }

        return $mail->line('ServiceHub Admin Notification.');
    }
}
