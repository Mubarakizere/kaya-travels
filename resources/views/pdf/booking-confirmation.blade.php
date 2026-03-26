<!DOCTYPE html>
<html>
<head><meta charset="utf-8"><title>Booking PDF</title></head>
<body>
    <h2>Booking Confirmation - {{ $booking->trip->title }}</h2>
    <p>Name: {{ $booking->full_name }}</p>
    <p>Phone: {{ $booking->phone }}</p>
    <p>Email: {{ $booking->email }}</p>
    <p>Guests: {{ $booking->guests }}</p>
    <p>Travel Date: {{ $booking->travel_date }}</p>
</body>
</html>
