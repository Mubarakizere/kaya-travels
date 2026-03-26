<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Booking PDF</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 14px; }
        .section { margin-bottom: 20px; }
        .label { font-weight: bold; color: #555; }
    </style>
</head>
<body>
    <h2>Booking Details</h2>

    <div class="section">
        <div><span class="label">Name:</span> {{ $booking->name ?? '-' }}</div>
        <div><span class="label">Email:</span> {{ $booking->email ?? '-' }}</div>
        <div><span class="label">Trip:</span> {{ $booking->trip->title ?? '-' }}</div>
        <div><span class="label">Status:</span> {{ ucfirst($booking->status) }}</div>
        <div><span class="label">Date:</span> {{ $booking->created_at->format('d M Y') }}</div>
    </div>
</body>
</html>
