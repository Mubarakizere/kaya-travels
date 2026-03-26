@extends('layouts.admin')

@section('title', 'Manage Destinations')

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

  .bg-featured { background: #fffbeb; color: #b45309; border: 1px solid #fde68a; }

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
  <h5>Manage Destinations</h5>
  <button class="btn btn-gold btn-sm" data-bs-toggle="modal" data-bs-target="#createModal">
    <i data-lucide="plus" style="width:16px;height:16px;vertical-align:-2px;margin-right:4px;"></i> Add Destination
  </button>
</div>

<div class="panel">
  @if($destinations->isEmpty())
    <div class="empty-msg">
      <i data-lucide="map-pin" style="width:32px;height:32px;display:block;margin:0 auto 8px;opacity:0.3;"></i>
      No destinations yet
    </div>
  @else
    <div class="table-responsive">
      <table class="table">
        <thead>
          <tr>
            <th style="width: 50px"></th>
            <th>Name</th>
            <th class="hide-mobile">Type</th>
            <th>Featured</th>
            <th style="width:80px"></th>
          </tr>
        </thead>
        <tbody>
          @foreach($destinations as $destination)
            <tr>
              <td>
                @if($destination->image)
                  <img src="{{ asset('storage/' . $destination->image) }}" class="thumbnail-img">
                @else
                  <div class="no-thumb"><i data-lucide="image"></i></div>
                @endif
              </td>
              <td><strong>{{ $destination->name }}</strong></td>
              <td class="hide-mobile">{{ ucfirst($destination->type) }}</td>
              <td>
                @if($destination->is_featured)
                  <span class="badge-status bg-featured"><i data-lucide="star" style="width:12px;height:12px;fill:currentColor;margin-right:3px;vertical-align:-1px;"></i>Top</span>
                @else
                  <span class="text-muted" style="font-size:0.8rem;">-</span>
                @endif
              </td>
              <td class="actions-cell">
                <button class="btn-icon edit-btn"
                  data-id="{{ $destination->id }}"
                  data-name="{{ $destination->name }}"
                  data-type="{{ $destination->type }}"
                  data-description="{{ $destination->description }}"
                  data-is_featured="{{ $destination->is_featured ? '1' : '0' }}"
                  title="Edit">
                  <i data-lucide="pencil"></i>
                </button>
                <button class="btn-icon danger delete-btn ms-1"
                  data-id="{{ $destination->id }}"
                  data-name="{{ $destination->name }}"
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

@if($destinations->hasPages())
  <div class="mt-3">{{ $destinations->links() }}</div>
@endif

{{-- CREATE MODAL --}}
<div class="modal fade" id="createModal" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <form method="POST" action="{{ route('admin.destinations.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="modal-header">
          <h5 class="modal-title">Add Destination</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body bg-light">
          <div class="p-3 bg-white rounded border row g-3">
            <div class="col-12">
              <label class="form-label">Name</label>
              <input type="text" name="name" class="form-control" required>
            </div>
            <div class="col-12">
              <label class="form-label">Type</label>
              <select name="type" class="form-select" required>
                <option value="" disabled selected>Select Category</option>
                @foreach(['adventure','luxury','cultural','weekend'] as $cat)
                  <option value="{{ $cat }}">{{ ucfirst($cat) }}</option>
                @endforeach
              </select>
            </div>
            <div class="col-12">
              <label class="form-label">Main Image</label>
              <input type="file" name="image" class="form-control" accept="image/*">
            </div>
            <div class="col-12">
              <label class="form-label">Description</label>
              <textarea name="description" class="form-control" rows="3"></textarea>
            </div>
            <div class="col-12 mt-3">
              <div class="form-check form-switch pt-2 border-top">
                <input class="form-check-input" type="checkbox" role="switch" name="is_featured" id="is_featured_create">
                <label class="form-check-label ms-2" for="is_featured_create">Featured Destination</label>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-sm btn-light" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-gold btn-sm">Save Destination</button>
        </div>
      </form>
    </div>
  </div>
</div>

{{-- EDIT MODAL --}}
<div class="modal fade" id="editModal" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <form method="POST" id="editForm" enctype="multipart/form-data">
        @csrf @method('PUT')
        <div class="modal-header">
          <h5 class="modal-title">Edit Destination</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body bg-light">
          <div class="p-3 bg-white rounded border row g-3">
            <div class="col-12">
              <label class="form-label">Name</label>
              <input type="text" name="name" id="e_name" class="form-control" required>
            </div>
            <div class="col-12">
              <label class="form-label">Type</label>
              <select name="type" id="e_type" class="form-select" required>
                @foreach(['adventure','luxury','cultural','weekend'] as $cat)
                  <option value="{{ $cat }}">{{ ucfirst($cat) }}</option>
                @endforeach
              </select>
            </div>
            <div class="col-12">
              <label class="form-label">Replace Image <small class="text-muted text-lowercase">(leave empty to keep current)</small></label>
              <input type="file" name="image" class="form-control" accept="image/*">
            </div>
            <div class="col-12">
              <label class="form-label">Description</label>
              <textarea name="description" id="e_description" class="form-control" rows="3"></textarea>
            </div>
            <div class="col-12 mt-3">
              <div class="form-check form-switch pt-2 border-top">
                <input class="form-check-input" type="checkbox" role="switch" name="is_featured" id="e_is_featured">
                <label class="form-check-label ms-2" for="e_is_featured">Featured Destination</label>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-sm btn-light" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-gold btn-sm">Update Destination</button>
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
          <h5 class="modal-title">Delete Destination</h5>
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
      document.getElementById('editForm').action = '/admin/destinations/' + d.id;
      
      ['name','type','description'].forEach(f => {
        const el = document.getElementById('e_' + f);
        if(el) el.value = d[f] || '';
      });
      
      document.getElementById('e_is_featured').checked = d.is_featured === '1';
      
      new bootstrap.Modal(document.getElementById('editModal')).show();
    });
  });

  // Delete modal
  document.querySelectorAll('.delete-btn').forEach(btn => {
    btn.addEventListener('click', function() {
      document.getElementById('deleteForm').action = '/admin/destinations/' + this.dataset.id;
      document.getElementById('deleteName').textContent = this.dataset.name;
      new bootstrap.Modal(document.getElementById('deleteModal')).show();
    });
  });
});
</script>
@endpush
