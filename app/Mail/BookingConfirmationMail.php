<?php

namespace App\Mail;

use App\Models\Booking;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Barryvdh\DomPDF\Facade\Pdf;

class BookingConfirmationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $booking;

    public function __construct(Booking $booking)
    {
        $this->booking = $booking;
    }

    public function build()
    {
        $pdf = Pdf::loadView('emails.booking.pdf', ['booking' => $this->booking]);

        return $this->subject('Booking Confirmation - Kaya Travels')
            ->markdown('emails.booking.confirmation')
            ->with('booking', $this->booking)
            ->attachData($pdf->output(), 'booking-confirmation.pdf');
    }
}
