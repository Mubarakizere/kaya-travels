<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Booking Confirmation</title>
    <style>
        body { font-family: sans-serif; color: #333; }
        .heading { color: #d1af65; font-size: 20px; margin-bottom: 10px; }
    </style>
</head>
<body>
    <h2 class="heading">Booking Confirmation</h2>
    <p><strong>Name:</strong> {{ $booking->full_name }}</p>
    <p><strong>Trip:</strong> {{ $booking->trip->title ?? 'N/A' }}</p>
    <p><strong>Guests:</strong> {{ $booking->guests }}</p>
    <p><strong>Travel Date:</strong> {{ $booking->travel_date }}</p>
    <p><strong>Phone:</strong> {{ $booking->phone }}</p>
    <p><strong>Notes:</strong> {{ $booking->notes }}</p>
</body>
</html>
