<div class="row g-3">
    <div class="col-md-6">
        <label class="form-label">Airline</label>
        <input type="text" name="airline" class="form-control" value="{{ old('airline', $flight?->airline ?? '') }}" required>
    </div>
    <div class="col-md-6">
        <label class="form-label">Flight Number</label>
        <input type="text" name="flight_number" class="form-control" value="{{ old('flight_number', $flight?->flight_number ?? '') }}" required>
    </div>
    <div class="col-md-6">
        <label class="form-label">From</label>
        <input type="text" name="from_location" class="form-control" value="{{ old('from_location', $flight?->from_location ?? '') }}" required>
    </div>
    <div class="col-md-6">
        <label class="form-label">To</label>
        <input type="text" name="to_location" class="form-control" value="{{ old('to_location', $flight?->to_location ?? '') }}" required>
    </div>
    <div class="col-md-6">
        <label class="form-label">Departure Date</label>
        <input type="date" name="departure_date" class="form-control" value="{{ old('departure_date', $flight?->departure_date ?? '') }}" required>
    </div>
    <div class="col-md-6">
        <label class="form-label">Departure Time</label>
        <input type="time" name="departure_time" class="form-control" value="{{ old('departure_time', $flight?->departure_time ?? '') }}" required>
    </div>
    <div class="col-md-6">
        <label class="form-label">Arrival Date</label>
        <input type="date" name="arrival_date" class="form-control" value="{{ old('arrival_date', $flight?->arrival_date ?? '') }}" required>
    </div>
    <div class="col-md-6">
        <label class="form-label">Arrival Time</label>
        <input type="time" name="arrival_time" class="form-control" value="{{ old('arrival_time', $flight?->arrival_time ?? '') }}" required>
    </div>
    <div class="col-md-4">
        <label class="form-label">Seat Capacity</label>
        <input type="number" name="seat_capacity" class="form-control" value="{{ old('seat_capacity', $flight?->seat_capacity ?? '') }}" required>
    </div>
    <div class="col-md-4">
        <label class="form-label">Price (RWF)</label>
        <input type="number" step="0.01" name="price" class="form-control" value="{{ old('price', $flight?->price ?? '') }}" required>
    </div>
    <div class="col-12">
        <label class="form-label">Description</label>
        <textarea name="description" rows="3" class="form-control">{{ old('description', $flight?->description ?? '') }}</textarea>
    </div>
</div>

