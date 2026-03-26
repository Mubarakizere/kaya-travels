<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
</head>
<body>
    <p>Hello {{ $booking->name }},</p>

    <p>Your booking for <strong>{{ $booking->trip->title }}</strong> has been updated.</p>

    <p><strong>Status:</strong> {{ ucfirst($booking->status) }}</p>

    <p>Please find the attached PDF with full details.</p>

    <p>Thanks,<br>{{ config('app.name') }}</p>
</body>
</html>
