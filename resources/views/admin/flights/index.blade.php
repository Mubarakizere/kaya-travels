@extends('layouts.admin')

@section('title', 'Flights')

@push('styles')
<style>
  .page-head {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 1.25rem;
    flex-wrap: wrap;
    gap: 10px;
  }

  .page-head h5 { font-weight: 700; margin: 0; font-size: 1.1rem; }

  .panel {
    background: #fff;
    border: 1px solid #eee;
    border-radius: 12px;
    overflow: hidden;
  }

  .panel .table { margin: 0; font-size: 0.85rem; }

  .panel .table thead th {
    background: #faf8f4;
    font-size: 0.72rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    color: #999;
    font-weight: 600;
    padding: 0.65rem 1rem;
    border-bottom: 1px solid #eee;
    white-space: nowrap;
  }

  .panel .table td {
    padding: 0.65rem 1rem;
    vertical-align: middle;
    color: #3d3830;
    border-color: #f5f5f5;
  }

  .panel .table tbody tr:hover { background: rgba(201,162,39,0.03); }

  .route-badge {
    display: inline-flex;
    align-items: center;
    gap: 4px;
    font-size: 0.82rem;
    font-weight: 600;
    color: #3d3830;
  }

  .route-badge [data-lucide] { width: 14px; height: 14px; color: #c9a227; }

  .actions-cell { white-space: nowrap; }

  .btn-icon {
    width: 32px;
    height: 32px;
    padding: 0;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    border-radius: 8px;
    border: 1px solid #eee;
    background: #fff;
    color: #666;
    cursor: pointer;
    transition: all 0.15s;
  }

  .btn-icon:hover { border-color: #c9a227; color: #c9a227; }
  .btn-icon.danger:hover { border-color: #e04058; color: #e04058; }
  .btn-icon [data-lucide] { width: 15px; height: 15px; }

  .empty-msg { text-align: center; padding: 3rem; color: #bbb; font-size: 0.9rem; }

  /* Modal styling */
  .modal-content {
    border: none;
    border-radius: 14px;
    box-shadow: 0 20px 60px rgba(0,0,0,0.12);
  }

  .modal-header {
    border-bottom: 1px solid #f0f0f0;
    padding: 1.25rem 1.5rem;
  }

  .modal-header .modal-title { font-weight: 700; font-size: 1rem; }

  .modal-body { padding: 1.5rem; }

  .modal-footer {
    border-top: 1px solid #f0f0f0;
    padding: 1rem 1.5rem;
  }

  .modal .form-label {
    font-size: 0.78rem;
    font-weight: 600;
    color: #666;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    margin-bottom: 0.3rem;
  }

  .modal .form-control {
    border: 1px solid #e0e0e0;
    border-radius: 8px;
    padding: 0.55rem 0.75rem;
    font-size: 0.88rem;
    transition: border-color 0.2s;
  }

  .modal .form-control:focus {
    border-color: #c9a227;
    box-shadow: 0 0 0 3px rgba(201,162,39,0.08);
  }

  .toast-success {
    position: fixed;
    top: 1rem;
    right: 1rem;
    z-index: 1060;
    background: #d1fae5;
    color: #065f46;
    border: 1px solid #a7f3d0;
    border-radius: 10px;
    padding: 0.75rem 1.25rem;
    font-size: 0.85rem;
    font-weight: 500;
    animation: fadeUp 0.3s ease;
  }

  @keyframes fadeUp {
    from { opacity: 0; transform: translateY(8px); }
    to { opacity: 1; transform: translateY(0); }
  }

  @media (max-width: 768px) {
    .hide-mobile { display: none; }
  }
</style>
@endpush

@section('content')

{{-- Success toast --}}
@if(session('success'))
  <div class="toast-success" id="toast">
    <i data-lucide="check-circle" style="width:16px;height:16px;vertical-align:-2px;margin-right:6px;"></i>
    {{ session('success') }}
  </div>
@endif

<div class="page-head">
  <h5>Manage Flights</h5>
  <button class="btn btn-gold btn-sm" data-bs-toggle="modal" data-bs-target="#createModal">
    <i data-lucide="plus" style="width:16px;height:16px;vertical-align:-2px;margin-right:4px;"></i> Add Flight
  </button>
</div>

<div class="panel">
  @if($flights->isEmpty())
    <div class="empty-msg">
      <i data-lucide="plane" style="width:32px;height:32px;display:block;margin:0 auto 8px;opacity:0.3;"></i>
      No flights yet
    </div>
  @else
    <div class="table-responsive">
      <table class="table">
        <thead>
          <tr>
            <th>Route</th>
            <th>Airline</th>
            <th>Flight #</th>
            <th class="hide-mobile">Departure</th>
            <th class="hide-mobile">Arrival</th>
            <th class="hide-mobile">Seats</th>
            <th>Price</th>
            <th style="width:80px"></th>
          </tr>
        </thead>
        <tbody>
          @foreach($flights as $flight)
            <tr>
              <td>
                <span class="route-badge">
                  {{ $flight->from_location }} <i data-lucide="arrow-right"></i> {{ $flight->to_location }}
                </span>
              </td>
              <td>{{ $flight->airline }}</td>
              <td><strong>{{ $flight->flight_number }}</strong></td>
              <td class="hide-mobile">{{ \Carbon\Carbon::parse($flight->departure_date)->format('M d') }}, {{ $flight->departure_time }}</td>
              <td class="hide-mobile">{{ \Carbon\Carbon::parse($flight->arrival_date)->format('M d') }}, {{ $flight->arrival_time }}</td>
              <td class="hide-mobile">{{ $flight->seat_capacity }}</td>
              <td>{{ number_format($flight->price) }}</td>
              <td class="actions-cell">
                <button class="btn-icon edit-btn"
                  data-id="{{ $flight->id }}"
                  data-airline="{{ $flight->airline }}"
                  data-flight_number="{{ $flight->flight_number }}"
                  data-from_location="{{ $flight->from_location }}"
                  data-to_location="{{ $flight->to_location }}"
                  data-departure_date="{{ $flight->departure_date }}"
                  data-departure_time="{{ $flight->departure_time }}"
                  data-arrival_date="{{ $flight->arrival_date }}"
                  data-arrival_time="{{ $flight->arrival_time }}"
                  data-seat_capacity="{{ $flight->seat_capacity }}"
                  data-price="{{ $flight->price }}"
                  data-description="{{ $flight->description }}"
                  title="Edit">
                  <i data-lucide="pencil"></i>
                </button>
                <button class="btn-icon danger delete-btn"
                  data-id="{{ $flight->id }}"
                  data-name="{{ $flight->airline }} {{ $flight->flight_number }}"
                  title="Delete">
                  <i data-lucide="trash-2"></i>
                </button>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  @endif
</div>

@if($flights->hasPages())
  <div class="mt-3">{{ $flights->links() }}</div>
@endif

{{-- CREATE MODAL --}}
<div class="modal fade" id="createModal" tabindex="-1">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <form method="POST" action="{{ route('admin.flights.store') }}">
        @csrf
        <div class="modal-header">
          <h5 class="modal-title">Add New Flight</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          @include('admin.flights.form', ['flight' => null])
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-sm btn-light" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-gold btn-sm">Save Flight</button>
        </div>
      </form>
    </div>
  </div>
</div>

{{-- EDIT MODAL --}}
<div class="modal fade" id="editModal" tabindex="-1">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <form method="POST" id="editForm">
        @csrf @method('PUT')
        <div class="modal-header">
          <h5 class="modal-title">Edit Flight</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <div class="row g-3">
            <div class="col-md-6">
              <label class="form-label">Airline</label>
              <input type="text" name="airline" id="e_airline" class="form-control" required>
            </div>
            <div class="col-md-6">
              <label class="form-label">Flight Number</label>
              <input type="text" name="flight_number" id="e_flight_number" class="form-control" required>
            </div>
            <div class="col-md-6">
              <label class="form-label">From</label>
              <input type="text" name="from_location" id="e_from_location" class="form-control" required>
            </div>
            <div class="col-md-6">
              <label class="form-label">To</label>
              <input type="text" name="to_location" id="e_to_location" class="form-control" required>
            </div>
            <div class="col-md-6">
              <label class="form-label">Departure Date</label>
              <input type="date" name="departure_date" id="e_departure_date" class="form-control" required>
            </div>
            <div class="col-md-6">
              <label class="form-label">Departure Time</label>
              <input type="time" name="departure_time" id="e_departure_time" class="form-control" required>
            </div>
            <div class="col-md-6">
              <label class="form-label">Arrival Date</label>
              <input type="date" name="arrival_date" id="e_arrival_date" class="form-control" required>
            </div>
            <div class="col-md-6">
              <label class="form-label">Arrival Time</label>
              <input type="time" name="arrival_time" id="e_arrival_time" class="form-control" required>
            </div>
            <div class="col-md-4">
              <label class="form-label">Seat Capacity</label>
              <input type="number" name="seat_capacity" id="e_seat_capacity" class="form-control" required>
            </div>
            <div class="col-md-4">
              <label class="form-label">Price (RWF)</label>
              <input type="number" step="0.01" name="price" id="e_price" class="form-control" required>
            </div>
            <div class="col-12">
              <label class="form-label">Description</label>
              <textarea name="description" id="e_description" rows="3" class="form-control"></textarea>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-sm btn-light" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-gold btn-sm">Update Flight</button>
        </div>
      </form>
    </div>
  </div>
</div>

{{-- DELETE MODAL --}}
<div class="modal fade" id="deleteModal" tabindex="-1">
  <div class="modal-dialog modal-sm modal-dialog-centered">
    <div class="modal-content">
      <form method="POST" id="deleteForm">
        @csrf @method('DELETE')
        <div class="modal-header">
          <h5 class="modal-title">Delete Flight</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <p style="font-size:0.9rem;margin:0;">Are you sure you want to delete <strong id="deleteName"></strong>?</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-sm btn-light" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-sm btn-danger">Delete</button>
        </div>
      </form>
    </div>
  </div>
</div>

@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
  lucide.createIcons();

  // Auto-dismiss toast
  const toast = document.getElementById('toast');
  if (toast) setTimeout(() => toast.remove(), 3000);

  // Edit modal
  document.querySelectorAll('.edit-btn').forEach(btn => {
    btn.addEventListener('click', function() {
      const id = this.dataset.id;
      document.getElementById('editForm').action = '/admin/flights/' + id;
      ['airline','flight_number','from_location','to_location','departure_date','departure_time','arrival_date','arrival_time','seat_capacity','price','description']
        .forEach(f => {
          document.getElementById('e_' + f).value = this.dataset[f] || '';
        });
      new bootstrap.Modal(document.getElementById('editModal')).show();
    });
  });

  // Delete modal
  document.querySelectorAll('.delete-btn').forEach(btn => {
    btn.addEventListener('click', function() {
      document.getElementById('deleteForm').action = '/admin/flights/' + this.dataset.id;
      document.getElementById('deleteName').textContent = this.dataset.name;
      new bootstrap.Modal(document.getElementById('deleteModal')).show();
    });
  });
});
</script>
@endpush
