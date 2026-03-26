@extends('layouts.admin')

@section('title', 'Manage Categories')

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
    padding: 0.8rem 1rem;
    vertical-align: middle;
    color: #3d3830;
    border-color: #f5f5f5;
  }

  .panel .table tbody tr:hover { background: rgba(201,162,39,0.03); }

  .badge-count {
    font-size: 0.75rem;
    padding: 3px 8px;
    border-radius: 6px;
    font-weight: 600;
    background: #f1f5f9;
    color: #475569;
    border: 1px solid #e2e8f0;
  }

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

  .empty-msg { text-align: center; padding: 4rem 2rem; color: #bbb; font-size: 0.9rem; }

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
    margin-bottom: 0.4rem;
  }

  .modal .form-control {
    border: 1px solid #e0e0e0;
    border-radius: 8px;
    padding: 0.65rem 0.85rem;
    font-size: 0.95rem;
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
  <h5>Blog Categories</h5>
  <button class="btn btn-gold btn-sm" data-bs-toggle="modal" data-bs-target="#createModal">
    <i data-lucide="plus" style="width:16px;height:16px;vertical-align:-2px;margin-right:4px;"></i> Add Category
  </button>
</div>

<div class="panel">
  @if($categories->isEmpty())
    <div class="empty-msg">
      <i data-lucide="folder" style="width:36px;height:36px;display:block;margin:0 auto 12px;opacity:0.3;"></i>
      No categories found
    </div>
  @else
    <div class="table-responsive">
      <table class="table">
        <thead>
          <tr>
            <th>Name</th>
            <th>URL Slug</th>
            <th class="text-center">Posts Count</th>
            <th style="width:80px"></th>
          </tr>
        </thead>
        <tbody>
          @foreach($categories as $category)
            <tr>
              <td><strong>{{ $category->name }}</strong></td>
              <td><span style="color:#8a8278;font-family:monospace;font-size:0.8rem;">/{{ $category->slug }}</span></td>
              <td class="text-center">
                <span class="badge-count">{{ $category->posts_count ?? $category->posts()->count() }}</span>
              </td>
              <td class="actions-cell">
                <button class="btn-icon edit-btn"
                  data-id="{{ $category->id }}"
                  data-name="{{ $category->name }}"
                  title="Edit">
                  <i data-lucide="pencil"></i>
                </button>
                <button class="btn-icon danger delete-btn ms-1"
                  data-id="{{ $category->id }}"
                  data-name="{{ $category->name }}"
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

{{-- CREATE MODAL --}}
<div class="modal fade" id="createModal" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <form method="POST" action="{{ route('admin.categories.store') }}">
        @csrf
        <div class="modal-header">
          <h5 class="modal-title">Add Category</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body bg-light">
          <div class="p-3 bg-white rounded border">
            <label class="form-label">Category Name</label>
            <input type="text" name="name" class="form-control" placeholder="e.g. Travel Tips" required>
            <div class="form-text mt-2 text-muted" style="font-size:0.75rem;">The category slug will be generated automatically.</div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-sm btn-light" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-gold btn-sm">Save Category</button>
        </div>
      </form>
    </div>
  </div>
</div>

{{-- EDIT MODAL --}}
<div class="modal fade" id="editModal" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <form method="POST" id="editForm">
        @csrf @method('PUT')
        <div class="modal-header">
          <h5 class="modal-title">Edit Category</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body bg-light">
          <div class="p-3 bg-white rounded border">
            <label class="form-label">Category Name</label>
            <input type="text" name="name" id="e_name" class="form-control" required>
            <div class="form-text mt-2 text-muted" style="font-size:0.75rem;">The slug will automatically update based on the name.</div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-sm btn-light" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-gold btn-sm">Update Category</button>
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
          <h5 class="modal-title">Delete Category</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <p style="font-size:0.9rem;margin:0;">Are you sure you want to delete "<strong id="deleteName"></strong>"?</p>
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
      document.getElementById('editForm').action = '/admin/categories/' + this.dataset.id;
      document.getElementById('e_name').value = this.dataset.name || '';
      
      // Auto-focus input after modal opens
      const editModal = document.getElementById('editModal');
      editModal.addEventListener('shown.bs.modal', () => {
        document.getElementById('e_name').focus();
      }, { once: true });

      new bootstrap.Modal(editModal).show();
    });
  });

  // Delete modal
  document.querySelectorAll('.delete-btn').forEach(btn => {
    btn.addEventListener('click', function() {
      document.getElementById('deleteForm').action = '/admin/categories/' + this.dataset.id;
      document.getElementById('deleteName').textContent = this.dataset.name;
      new bootstrap.Modal(document.getElementById('deleteModal')).show();
    });
  });
});
</script>
@endpush
