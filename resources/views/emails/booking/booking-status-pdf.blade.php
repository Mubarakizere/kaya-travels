<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Booking PDF</title>
    <style>
        body { font-family: sans-serif; }
    </style>
</head>
<body>
    <h2>Booking Summary</h2>
    <p><strong>Trip:</strong> {{ $booking->trip->title }}</p>
    <p><strong>Name:</strong> {{ $booking->full_name }}</p>
    <p><strong>Email:</strong> {{ $booking->email }}</p>
    <p><strong>Phone:</strong> {{ $booking->phone }}</p>
    <p><strong>Date:</strong> {{ $booking->travel_date }}</p>
    <p><strong>Guests:</strong> {{ $booking->guests }}</p>
    <p><strong>Status:</strong> {{ ucfirst($booking->status) }}</p>
</body>
</html>
