@extends('layouts.admin')

@section('title', 'Manage Bookings')

@push('styles')
<style>
  .page-head {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 1.25rem;
    flex-wrap: wrap;
    gap: 15px;
  }

  .page-head h5 { font-weight: 700; margin: 0; font-size: 1.1rem; }

  .filter-bar {
    background: #fff;
    border: 1px solid #eee;
    border-radius: 12px;
    padding: 1rem 1.25rem;
    margin-bottom: 1.25rem;
    display: flex;
    gap: 10px;
    align-items: center;
    flex-wrap: wrap;
  }

  .filter-bar .form-select, .filter-bar .btn {
    border-radius: 8px;
    font-size: 0.85rem;
    padding: 0.5rem 1rem;
    border: 1px solid #e0e0e0;
    transition: all 0.2s;
  }

  .filter-bar .form-select:focus {
    border-color: #c9a227;
    box-shadow: 0 0 0 3px rgba(201,162,39,0.08);
  }

  .filter-bar .btn-gold {
    background: #d1af65;
    color: #fff;
    font-weight: 600;
    border: none;
  }
  .filter-bar .btn-gold:hover { background: #c69c45; }

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
    padding: 0.8rem 1rem;
    vertical-align: middle;
    color: #3d3830;
    border-color: #f5f5f5;
  }

  .panel .table tbody tr:hover { background: rgba(201,162,39,0.02); }

  .customer-info strong { display: block; color: #2c2820; font-weight: 600; }
  .customer-info small { display: block; color: #8a8278; font-size: 0.75rem; margin-top: 2px; }

  .badge-status {
    font-size: 0.7rem;
    padding: 4px 10px;
    border-radius: 6px;
    font-weight: 600;
    display: inline-block;
  }

  .status-pending { background: #fffbeb; color: #b45309; border: 1px solid #fde68a; }
  .status-accepted { background: #d1fae5; color: #065f46; border: 1px solid #a7f3d0; }
  .status-declined { background: #ffe4e6; color: #be123c; border: 1px solid #fecdd3; }
  .status-completed { background: #f1f5f9; color: #475569; border: 1px solid #e2e8f0; }

  .status-form {
    display: flex;
    gap: 6px;
    max-width: 200px;
  }

  .status-form .form-select {
    font-size: 0.8rem;
    padding: 0.3rem 1.5rem 0.3rem 0.6rem;
    border-radius: 6px;
    border: 1px solid #ddd;
    background-color: #f9f9f9;
  }

  .status-form .btn-icon {
    width: 30px;
    height: 30px;
    padding: 0;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    border-radius: 6px;
    border: 1px solid #eee;
    background: #fff;
    color: #666;
    cursor: pointer;
    transition: all 0.15s;
    flex-shrink: 0;
  }

  .status-form .btn-icon:hover { border-color: #c9a227; color: #c9a227; }
  .status-form .btn-icon [data-lucide] { width: 14px; height: 14px; }

  .empty-msg { text-align: center; padding: 4rem 2rem; color: #bbb; font-size: 0.9rem; }

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

  @media (max-width: 992px) {
    .hide-mobile { display: none; }
    .filter-bar { flex-direction: column; align-items: stretch; }
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
  <h5>Manage Bookings</h5>
</div>

<!-- Filter Bar -->
<div class="filter-bar">
  <form method="GET" style="display:contents;">
    <div style="flex:1;min-width:200px;">
      <select name="trip_id" class="form-select">
        <option value="">All Trips</option>
        @foreach($trips as $trip)
          <option value="{{ $trip->id }}" {{ request('trip_id') == $trip->id ? 'selected' : '' }}>{{ Str::limit($trip->title, 40) }}</option>
        @endforeach
      </select>
    </div>
    
    <div style="flex:1;min-width:150px;">
      <select name="status" class="form-select">
        <option value="">All Statuses</option>
        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
        <option value="accepted" {{ request('status') == 'accepted' ? 'selected' : '' }}>Accepted</option>
        <option value="declined" {{ request('status') == 'declined' ? 'selected' : '' }}>Declined</option>
        <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Completed</option>
      </select>
    </div>

    <button type="submit" class="btn btn-gold">
      <i data-lucide="filter" style="width:14px;height:14px;margin-right:4px;"></i> Filter Results
    </button>
    
    @if(request()->filled('trip_id') || request()->filled('status'))
      <a href="{{ route('admin.bookings.index') }}" class="btn btn-light border">Clear</a>
    @endif
  </form>
</div>

<!-- Bookings Table -->
<div class="panel">
  @if($bookings->isEmpty())
    <div class="empty-msg">
      <i data-lucide="calendar-x" style="width:36px;height:36px;display:block;margin:0 auto 12px;opacity:0.3;"></i>
      No bookings match your criteria.
    </div>
  @else
    <div class="table-responsive">
      <table class="table">
        <thead>
          <tr>
            <th style="width: 60px">#ID</th>
            <th>Customer Info</th>
            <th>Trip Details</th>
            <th class="hide-mobile">Travel Date</th>
            <th class="text-center">Status</th>
            <th style="width: 200px">Update Status</th>
          </tr>
        </thead>
        <tbody>
          @foreach($bookings as $booking)
            <tr>
              <td><strong style="color:#a8871e;">#{{ sprintf('%04d', $booking->id) }}</strong></td>
              <td class="customer-info">
                <strong>{{ $booking->full_name }}</strong>
                <small><i data-lucide="phone" style="width:10px;height:10px;margin-right:2px"></i>{{ $booking->phone }}</small>
                <small><i data-lucide="mail" style="width:10px;height:10px;margin-right:2px"></i>{{ $booking->email }}</small>
              </td>
              <td>
                <span style="font-weight:600;color:#3d3830;display:block;">{{ $booking->trip->title ?? 'N/A' }}</span>
                <small style="color:#8a8278;display:block;margin-top:2px;">
                  <i data-lucide="users" style="width:11px;height:11px;margin-right:2px;vertical-align:-1px;"></i> {{ $booking->guests }} Guest(s)
                </small>
              </td>
              <td class="hide-mobile">
                @if($booking->travel_date)
                  <span style="display:inline-flex;align-items:center;background:#f9f9f9;border:1px solid #eee;border-radius:6px;padding:3px 8px;font-size:0.8rem;color:#555;">
                    <i data-lucide="calendar" style="width:12px;height:12px;margin-right:5px;color:#c9a227;"></i>
                    {{ \Carbon\Carbon::parse($booking->travel_date)->format('M d, Y') }}
                  </span>
                @else
                  <span class="text-muted" style="font-size:0.8rem;">Not specified</span>
                @endif
              </td>
              <td class="text-center">
                <span class="badge-status status-{{ strtolower($booking->status) }}">
                  {{ ucfirst($booking->status) }}
                </span>
              </td>
              <td>
                <form method="POST" action="{{ route('admin.bookings.status', $booking) }}" class="status-form">
                  @csrf
                  <select name="status" class="form-select" onchange="this.form.submit.disabled = (this.value === '{{ $booking->status }}')">
                    <option value="pending" {{ $booking->status == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="accepted" {{ $booking->status == 'accepted' ? 'selected' : '' }}>Accepted</option>
                    <option value="declined" {{ $booking->status == 'declined' ? 'selected' : '' }}>Declined</option>
                    <option value="completed" {{ $booking->status == 'completed' ? 'selected' : '' }}>Completed</option>
                  </select>
                  <button type="submit" name="submit" class="btn-icon" title="Save Status" disabled style="opacity:1;">
                    <i data-lucide="check"></i>
                  </button>
                </form>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  @endif
</div>

@if($bookings->hasPages())
  <div class="mt-4">{{ $bookings->withQueryString()->links() }}</div>
@endif

@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
  lucide.createIcons();

  // Auto-dismiss toast
  const toast = document.getElementById('toast');
  if (toast) setTimeout(() => toast.remove(), 3000);
});
</script>
@endpush
