<?php

namespace App\Mail;

use App\Models\Booking;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Barryvdh\DomPDF\Facade\Pdf;

class BookingStatusUpdateMail extends Mailable
{
    use Queueable, SerializesModels;

    public $booking;

    public function __construct(Booking $booking)
    {
        $this->booking = $booking;
    }

    public function build()
    {
        $pdf = Pdf::loadView('emails.booking-status-pdf', ['booking' => $this->booking]);

        return $this->subject('Your Booking Status Has Been Updated')
            ->view('emails.booking-status')
            ->attachData($pdf->output(), 'Booking-Details.pdf', [
                'mime' => 'application/pdf',
            ]);
    }
}
