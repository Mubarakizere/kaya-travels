@component('mail::message')
# Hello {{ $booking->full_name }}

Thank you for booking with **Kaya Travels**!

- **Trip:** {{ $booking->trip->title ?? 'N/A' }}
- **Guests:** {{ $booking->guests }}
- **Date:** {{ $booking->travel_date }}
- **Phone:** {{ $booking->phone }}

We’ll review and get back to you shortly.

Thanks,<br>
**Kaya Travel And Tours Team**
@endcomponent
