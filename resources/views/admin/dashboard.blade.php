@extends('layouts.admin')

@section('title', 'Dashboard')

@push('styles')
<style>
  .greeting { margin-bottom: 1.5rem; }
  .greeting h2 { font-size: 1.35rem; font-weight: 700; margin: 0 0 4px; color: #2c2820; }
  .greeting p { color: #8a8278; font-size: 0.9rem; margin: 0; }

  .stats-row {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(170px, 1fr));
    gap: 14px;
    margin-bottom: 1.75rem;
  }

  .stat-box {
    background: #fff;
    border: 1px solid #eee;
    border-radius: 12px;
    padding: 1.2rem 1.25rem;
    display: flex;
    align-items: center;
    gap: 14px;
    transition: transform 0.2s ease, box-shadow 0.2s ease;
  }

  .stat-box:hover {
    transform: translateY(-3px);
    box-shadow: 0 6px 16px rgba(0,0,0,0.06);
  }

  .stat-icon {
    width: 44px;
    height: 44px;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
  }

  .stat-icon [data-lucide] { width: 20px; height: 20px; }

  .stat-icon.c-gold   { background: #fdf6e3; color: #c9a227; }
  .stat-icon.c-blue   { background: #eef4ff; color: #4a8af4; }
  .stat-icon.c-green  { background: #eefbf3; color: #22a858; }
  .stat-icon.c-purple { background: #f3effe; color: #7c5ce0; }
  .stat-icon.c-orange { background: #fff4eb; color: #e68a2e; }
  .stat-icon.c-rose   { background: #ffeff1; color: #e04058; }

  .stat-text .number {
    font-size: 1.4rem;
    font-weight: 700;
    color: #2c2820;
    line-height: 1.2;
  }

  .stat-text .label {
    font-size: 0.78rem;
    color: #8a8278;
    margin-top: 1px;
  }

  .panel {
    background: #fff;
    border: 1px solid #eee;
    border-radius: 10px;
    margin-bottom: 1.25rem;
    overflow: hidden;
    transition: box-shadow 0.2s ease;
  }

  .panel:hover {
    box-shadow: 0 2px 10px rgba(0,0,0,0.04);
  }

  .panel-head {
    padding: 0.9rem 1.25rem;
    border-bottom: 1px solid #f0f0f0;
    display: flex;
    align-items: center;
    justify-content: space-between;
  }

  .panel-head h6 {
    font-size: 0.9rem;
    font-weight: 700;
    color: #2c2820;
    margin: 0;
  }

  .panel-head a {
    font-size: 0.78rem;
    color: #a8871e;
    text-decoration: none;
    font-weight: 600;
  }

  .panel-head a:hover { text-decoration: underline; }

  .panel .table { margin: 0; font-size: 0.85rem; }

  .panel .table thead th {
    background: #faf8f4;
    font-size: 0.72rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    color: #999;
    font-weight: 600;
    padding: 0.6rem 1rem;
    border-bottom: 1px solid #eee;
    white-space: nowrap;
  }

  .panel .table td {
    padding: 0.65rem 1rem;
    vertical-align: middle;
    color: #3d3830;
    border-color: #f5f5f5;
  }

  .badge-sm {
    font-size: 0.68rem;
    padding: 3px 8px;
    border-radius: 4px;
    font-weight: 600;
  }

  .bg-pending { background: #fef3c7; color: #92400e; }
  .bg-confirmed { background: #d1fae5; color: #065f46; }
  .bg-cancelled { background: #fee2e2; color: #991b1b; }

  .action-link {
    display: block;
    padding: 0.7rem 1.25rem;
    color: #3d3830;
    text-decoration: none;
    font-size: 0.85rem;
    border-bottom: 1px solid #f5f5f5;
    transition: background 0.2s, padding-left 0.2s;
  }

  .action-link:last-child { border-bottom: none; }
  .action-link:hover { padding-left: 1.5rem; }
  .action-link:hover { background: #faf8f4; color: #a8871e; }
  .action-link [data-lucide] { width: 16px; height: 16px; margin-right: 8px; color: #bbb; vertical-align: -2px; }

  .empty-msg {
    text-align: center;
    padding: 2rem;
    color: #bbb;
    font-size: 0.85rem;
  }

  /* Fade-in animation */
  @keyframes fadeUp {
    from { opacity: 0; transform: translateY(12px); }
    to { opacity: 1; transform: translateY(0); }
  }

  .fade-in {
    animation: fadeUp 0.4s ease both;
  }

  .greeting { animation: fadeUp 0.35s ease both; }
  .stat-box:nth-child(1) { animation: fadeUp 0.35s ease 0.05s both; }
  .stat-box:nth-child(2) { animation: fadeUp 0.35s ease 0.1s both; }
  .stat-box:nth-child(3) { animation: fadeUp 0.35s ease 0.15s both; }
  .stat-box:nth-child(4) { animation: fadeUp 0.35s ease 0.2s both; }
  .stat-box:nth-child(5) { animation: fadeUp 0.35s ease 0.25s both; }
  .stat-box:nth-child(6) { animation: fadeUp 0.35s ease 0.3s both; }

  .panel { animation: fadeUp 0.4s ease 0.2s both; }

  @media (max-width: 576px) {
    .stats-row { grid-template-columns: repeat(2, 1fr); }
    .hide-mobile { display: none; }
  }
</style>
@endpush

@section('content')

<div class="greeting">
  <h2>Hi, {{ auth()->user()->name }}</h2>
  <p>{{ now()->format('l, F j, Y') }}</p>
</div>

<div class="stats-row">
  <div class="stat-box">
    <div class="stat-icon c-blue"><i data-lucide="calendar-check"></i></div>
    <div class="stat-text">
      <div class="number">{{ $totalBookings }}</div>
      <div class="label">Bookings</div>
    </div>
  </div>
  <div class="stat-box">
    <div class="stat-icon c-green"><i data-lucide="compass"></i></div>
    <div class="stat-text">
      <div class="number">{{ $totalTrips }}</div>
      <div class="label">Trips</div>
    </div>
  </div>
  <div class="stat-box">
    <div class="stat-icon c-purple"><i data-lucide="map-pin"></i></div>
    <div class="stat-text">
      <div class="number">{{ $totalDestinations }}</div>
      <div class="label">Destinations</div>
    </div>
  </div>
  <div class="stat-box">
    <div class="stat-icon c-orange"><i data-lucide="plane"></i></div>
    <div class="stat-text">
      <div class="number">{{ $totalFlights }}</div>
      <div class="label">Flights</div>
    </div>
  </div>
  <div class="stat-box">
    <div class="stat-icon c-gold"><i data-lucide="users"></i></div>
    <div class="stat-text">
      <div class="number">{{ $totalUsers }}</div>
      <div class="label">Users</div>
    </div>
  </div>
  <div class="stat-box">
    <div class="stat-icon c-rose"><i data-lucide="file-text"></i></div>
    <div class="stat-text">
      <div class="number">{{ $totalPosts }}</div>
      <div class="label">Posts</div>
    </div>
  </div>
</div>

<div class="row g-3">

  {{-- Bookings --}}
  <div class="col-lg-8">
    <div class="panel">
      <div class="panel-head">
        <h6>Recent Bookings</h6>
        <a href="{{ route('admin.bookings.index') }}">View all</a>
      </div>
      @if($recentBookings->isEmpty())
        <div class="empty-msg">No bookings yet</div>
      @else
        <div class="table-responsive">
          <table class="table">
            <thead><tr>
              <th>Name</th>
              <th>Trip</th>
              <th class="hide-mobile">Date</th>
              <th>Status</th>
            </tr></thead>
            <tbody>
              @foreach($recentBookings as $b)
                <tr>
                  <td>{{ $b->full_name }}</td>
                  <td>{{ Str::limit($b->trip->title ?? '—', 25) }}</td>
                  <td class="hide-mobile">{{ \Carbon\Carbon::parse($b->travel_date)->format('M d, Y') }}</td>
                  <td>
                    @php $cls = match($b->status ?? 'pending') { 'confirmed'=>'bg-confirmed','cancelled'=>'bg-cancelled', default=>'bg-pending' }; @endphp
                    <span class="badge-sm {{ $cls }}">{{ ucfirst($b->status ?? 'pending') }}</span>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      @endif
    </div>

    {{-- Trips --}}
    <div class="panel">
      <div class="panel-head">
        <h6>Recent Trips</h6>
        <a href="{{ route('admin.trips.index') }}">Manage</a>
      </div>
      @if($recentTrips->isEmpty())
        <div class="empty-msg">No trips yet — <a href="{{ route('admin.trips.create') }}" style="color:#a8871e;">create one</a></div>
      @else
        <div class="table-responsive">
          <table class="table">
            <thead><tr>
              <th>Title</th>
              <th>Location</th>
              <th class="hide-mobile">Price</th>
              <th class="hide-mobile">Type</th>
            </tr></thead>
            <tbody>
              @foreach($recentTrips as $trip)
                <tr>
                  <td><strong>{{ $trip->title }}</strong></td>
                  <td>{{ $trip->location }}</td>
                  <td class="hide-mobile">{{ number_format($trip->price) }} RWF</td>
                  <td class="hide-mobile">{{ ucfirst($trip->type) }}</td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      @endif
    </div>
  </div>

  {{-- Sidebar --}}
  <div class="col-lg-4">
    <div class="panel">
      <div class="panel-head"><h6>Quick Actions</h6></div>
      <a href="{{ route('admin.trips.create') }}" class="action-link"><i data-lucide="plus"></i> New Trip</a>
      <a href="{{ route('admin.posts.create') }}" class="action-link"><i data-lucide="pen-line"></i> Write Post</a>
      <a href="{{ route('admin.destinations.create') }}" class="action-link"><i data-lucide="map-pin"></i> Add Destination</a>
      <a href="{{ route('admin.bookings.index') }}" class="action-link"><i data-lucide="list"></i> All Bookings</a>
      <a href="{{ route('admin.site-images.index') }}" class="action-link"><i data-lucide="image"></i> Site Images</a>
    </div>

    <div class="panel">
      <div class="panel-head"><h6>New Users</h6></div>
      @if($recentUsers->isEmpty())
        <div class="empty-msg">No users yet</div>
      @else
        @foreach($recentUsers as $u)
          <div class="action-link" style="cursor:default; display:flex; justify-content:space-between; align-items:center;">
            <span>{{ $u->name }}</span>
            <small style="color:#bbb;">{{ $u->created_at->diffForHumans() }}</small>
          </div>
        @endforeach
      @endif
    </div>
  </div>

</div>

@endsection

@push('scripts')
<script>lucide.createIcons();</script>
@endpush
