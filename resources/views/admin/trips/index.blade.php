@extends('layouts.admin')

@section('title', 'Manage Trips')

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

  .thumbnail-img {
    width: 44px;
    height: 44px;
    object-fit: cover;
    border-radius: 8px;
    background: #f0ece3;
    display: block;
  }

  .no-thumb {
    width: 44px;
    height: 44px;
    border-radius: 8px;
    background: #f0ece3;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #c9a227;
  }

  .no-thumb [data-lucide] { width: 18px; height: 18px; opacity: 0.5; }

  .badge-status {
    font-size: 0.7rem;
    padding: 3px 8px;
    border-radius: 4px;
    font-weight: 600;
  }

  .bg-active { background: #d1fae5; color: #065f46; }
  .bg-inactive { background: #f1f5f9; color: #475569; }

  .actions-cell { white-space: nowrap; }

  .btn-icon, .btn-link-icon {
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
    text-decoration: none;
  }

  .btn-icon:hover, .btn-link-icon:hover { border-color: #c9a227; color: #c9a227; }
  .btn-icon.danger:hover { border-color: #e04058; color: #e04058; }
  .btn-icon [data-lucide], .btn-link-icon [data-lucide] { width: 15px; height: 15px; }

  .empty-msg { text-align: center; padding: 3rem; color: #bbb; font-size: 0.9rem; }

  /* Modal styling */
  .modal-content {
    border: none;
    border-radius: 14px;
    box-shadow: 0 20px 60px rgba(0,0,0,0.12);
  }

  .modal-header { border-bottom: 1px solid #f0f0f0; padding: 1.25rem 1.5rem; }
  .modal-header .modal-title { font-weight: 700; font-size: 1rem; }
  .modal-body { padding: 1.5rem; }
  .modal-footer { border-top: 1px solid #f0f0f0; padding: 1rem 1.5rem; }

  .modal .form-label {
    font-size: 0.78rem;
    font-weight: 600;
    color: #666;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    margin-bottom: 0.3rem;
  }

  .modal .form-control, .modal .form-select {
    border: 1px solid #e0e0e0;
    border-radius: 8px;
    padding: 0.55rem 0.75rem;
    font-size: 0.88rem;
    transition: border-color 0.2s;
  }

  .modal .form-control:focus, .modal .form-select:focus {
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
  <h5>Manage Trips</h5>
  <button class="btn btn-gold btn-sm" data-bs-toggle="modal" data-bs-target="#createModal">
    <i data-lucide="plus" style="width:16px;height:16px;vertical-align:-2px;margin-right:4px;"></i> Add Trip
  </button>
</div>

<div class="panel">
  @if($trips->isEmpty())
    <div class="empty-msg">
      <i data-lucide="compass" style="width:32px;height:32px;display:block;margin:0 auto 8px;opacity:0.3;"></i>
      No trips yet
    </div>
  @else
    <div class="table-responsive">
      <table class="table">
        <thead>
          <tr>
            <th style="width: 50px"></th>
            <th>Title</th>
            <th class="hide-mobile">Location</th>
            <th>Price</th>
            <th class="hide-mobile">Category</th>
            <th>Status</th>
            <th style="width:120px"></th>
          </tr>
        </thead>
        <tbody>
          @foreach($trips as $trip)
            <tr>
              <td>
                @if($trip->thumbnail)
                  <img src="{{ asset('storage/' . $trip->thumbnail) }}" class="thumbnail-img">
                @else
                  <div class="no-thumb"><i data-lucide="image"></i></div>
                @endif
              </td>
              <td><strong>{{ $trip->title }}</strong></td>
              <td class="hide-mobile">{{ $trip->location }}</td>
              <td>{{ number_format($trip->price) }} RWF</td>
              <td class="hide-mobile">{{ ucfirst($trip->category) }}</td>
              <td>
                @if($trip->status)
                  <span class="badge-status bg-active">Active</span>
                @else
                  <span class="badge-status bg-inactive">Inactive</span>
                @endif
              </td>
              <td class="actions-cell">
                <a href="{{ route('admin.trips.uploadImagesForm', $trip->id) }}" class="btn-link-icon" title="Manage Images">
                  <i data-lucide="image"></i>
                </a>
                <button class="btn-icon edit-btn ms-1"
                  data-id="{{ $trip->id }}"
                  data-title="{{ $trip->title }}"
                  data-destination_id="{{ $trip->destination_id }}"
                  data-price="{{ $trip->price }}"
                  data-duration="{{ $trip->duration }}"
                  data-category="{{ $trip->category }}"
                  data-short_description="{{ $trip->short_description }}"
                  data-full_description="{{ $trip->full_description }}"
                  data-itinerary="{{ is_array($trip->itinerary) ? implode('\n', $trip->itinerary) : '' }}"
                  data-inclusions="{{ is_array($trip->inclusions) ? implode('\n', $trip->inclusions) : '' }}"
                  data-exclusions="{{ is_array($trip->exclusions) ? implode('\n', $trip->exclusions) : '' }}"
                  data-status="{{ $trip->status ? '1' : '0' }}"
                  data-is_top="{{ $trip->is_top ? '1' : '0' }}"
                  title="Edit">
                  <i data-lucide="pencil"></i>
                </button>
                <button class="btn-icon danger delete-btn ms-1"
                  data-id="{{ $trip->id }}"
                  data-name="{{ $trip->title }}"
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

@if($trips->hasPages())
  <div class="mt-3">{{ $trips->links() }}</div>
@endif

{{-- CREATE MODAL --}}
<div class="modal fade" id="createModal" tabindex="-1">
  <div class="modal-dialog modal-xl modal-dialog-centered">
    <div class="modal-content">
      <form method="POST" action="{{ route('admin.trips.store') }}">
        @csrf
        <div class="modal-header">
          <h5 class="modal-title">Add New Trip</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body bg-light">
          <div class="p-3 bg-white rounded border">
            @include('admin.trips.form', ['trip' => null])
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-sm btn-light" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-gold btn-sm">Save & Continue to Images</button>
        </div>
      </form>
    </div>
  </div>
</div>

{{-- EDIT MODAL --}}
<div class="modal fade" id="editModal" tabindex="-1">
  <div class="modal-dialog modal-xl modal-dialog-centered">
    <div class="modal-content">
      <form method="POST" id="editForm">
        @csrf @method('PUT')
        <div class="modal-header">
          <h5 class="modal-title">Edit Trip</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body bg-light">
          <div class="p-3 bg-white rounded border">
             <div class="row g-3">
              <div class="col-md-6">
                <label class="form-label">Title</label>
                <input type="text" name="title" id="e_title" class="form-control" required>
              </div>
              <div class="col-md-6">
                <label class="form-label">Destination</label>
                <select name="destination_id" id="e_destination_id" class="form-select" required>
                  <option value="" disabled>Select Destination</option>
                  @foreach(\App\Models\Destination::all() as $destination)
                    <option value="{{ $destination->id }}">{{ $destination->name }}</option>
                  @endforeach
                </select>
              </div>
              <div class="col-md-4">
                <label class="form-label">Price (RWF)</label>
                <input type="number" name="price" id="e_price" class="form-control" required>
              </div>
              <div class="col-md-4">
                <label class="form-label">Duration</label>
                <input type="text" name="duration" id="e_duration" class="form-control" required>
              </div>
              <div class="col-md-4">
                <label class="form-label">Category</label>
                <select name="category" id="e_category" class="form-select" required>
                  @foreach(['adventure','luxury','cultural','weekend'] as $cat)
                    <option value="{{ $cat }}">{{ ucfirst($cat) }}</option>
                  @endforeach
                </select>
              </div>

              <div class="col-12 mt-4"><h6 class="text-gold border-bottom pb-2 mb-3" style="font-size:0.85rem;font-weight:700;">Descriptions</h6></div>

              <div class="col-md-6">
                <label class="form-label">Short Description</label>
                <textarea name="short_description" id="e_short_description" class="form-control" rows="3"></textarea>
              </div>
              <div class="col-md-6">
                <label class="form-label">Full Description</label>
                <textarea name="full_description" id="e_full_description" class="form-control" rows="3"></textarea>
              </div>
              <div class="col-md-12">
                <label class="form-label">Itinerary <small class="text-muted text-lowercase">(each line = one day)</small></label>
                <textarea name="itinerary" id="e_itinerary" class="form-control" rows="3"></textarea>
              </div>

              <div class="col-12 mt-4"><h6 class="text-gold border-bottom pb-2 mb-3" style="font-size:0.85rem;font-weight:700;">Details & Options</h6></div>

              <div class="col-md-6">
                <label class="form-label">Inclusions <small class="text-muted text-lowercase">(one per line)</small></label>
                <textarea name="inclusions" id="e_inclusions" class="form-control" rows="3"></textarea>
              </div>
              <div class="col-md-6">
                <label class="form-label">Exclusions <small class="text-muted text-lowercase">(one per line)</small></label>
                <textarea name="exclusions" id="e_exclusions" class="form-control" rows="3"></textarea>
              </div>

              <div class="col-12 mt-3 p-3 bg-light rounded border">
                <div class="form-check form-switch mb-2">
                  <input class="form-check-input" type="checkbox" role="switch" name="status" id="e_status">
                  <label class="form-check-label ms-2" for="e_status">Active (Visible to public)</label>
                </div>
                <div class="form-check form-switch">
                  <input class="form-check-input" type="checkbox" role="switch" name="is_top" id="e_is_top">
                  <label class="form-check-label ms-2" for="e_is_top">Top Featured</label>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-sm btn-light" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-gold btn-sm">Update Trip</button>
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
          <h5 class="modal-title">Delete Trip</h5>
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
      const d = this.dataset;
      document.getElementById('editForm').action = '/admin/trips/' + d.id;
      
      ['title','destination_id','price','duration','category','short_description','full_description']
        .forEach(f => { document.getElementById('e_' + f).value = d[f] || ''; });
      
      // Handle arrays (linebreaks)
      ['itinerary','inclusions','exclusions'].forEach(f => {
        document.getElementById('e_' + f).value = (d[f] || '').replace(/\\n/g, '\n');
      });

      // Handle checkboxes
      document.getElementById('e_status').checked = d.status === '1';
      document.getElementById('e_is_top').checked = d.is_top === '1';
      
      new bootstrap.Modal(document.getElementById('editModal')).show();
    });
  });

  // Delete modal
  document.querySelectorAll('.delete-btn').forEach(btn => {
    btn.addEventListener('click', function() {
      document.getElementById('deleteForm').action = '/admin/trips/' + this.dataset.id;
      document.getElementById('deleteName').textContent = this.dataset.name;
      new bootstrap.Modal(document.getElementById('deleteModal')).show();
    });
  });
});
</script>
@endpush
