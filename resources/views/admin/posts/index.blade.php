@extends('layouts.admin')

@section('title', 'Manage Posts')

@push('styles')
<!-- Trix Editor Base CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.min.css">

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

  .bg-published { background: #d1fae5; color: #065f46; }
  .bg-draft { background: #f1f5f9; color: #475569; }

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

  /* Custom Light Theme Trix Overrides */
  trix-toolbar {
    background-color: #fcfcfc !important;
    border: 1px solid #e0e0e0;
    border-radius: 8px 8px 0 0;
    margin-bottom: 0;
  }
  trix-editor {
    background-color: #fff !important;
    color: #333 !important;
    border: 1px solid #e0e0e0 !important;
    border-top: none !important;
    min-height: 250px;
    border-radius: 0 0 8px 8px;
    font-size: 0.9rem;
    padding: 1rem;
  }
  trix-editor:focus {
    border-color: #c9a227 !important;
    outline: none;
    box-shadow: inset 0 0 0 1px #c9a227;
  }
  trix-toolbar .trix-button-group {
    border-color: #e0e0e0 !important;
  }
  trix-toolbar .trix-button {
    background: transparent;
    border-bottom: none;
    color: #555;
  }
  trix-toolbar .trix-button:hover { background-color: #f5f5f5; }
  trix-toolbar .trix-button.trix-active { background-color: #eef2f6; }
  trix-toolbar .trix-button--icon::before {
    filter: none; /* remove invert from old dark theme */
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
  <h5>Manage Posts</h5>
  <button class="btn btn-gold btn-sm" data-bs-toggle="modal" data-bs-target="#createModal">
    <i data-lucide="plus" style="width:16px;height:16px;vertical-align:-2px;margin-right:4px;"></i> Add Post
  </button>
</div>

<div class="panel">
  @if($posts->isEmpty())
    <div class="empty-msg">
      <i data-lucide="file-text" style="width:32px;height:32px;display:block;margin:0 auto 8px;opacity:0.3;"></i>
      No posts published yet
    </div>
  @else
    <div class="table-responsive">
      <table class="table">
        <thead>
          <tr>
            <th style="width: 50px"></th>
            <th>Title</th>
            <th class="hide-mobile">Category</th>
            <th>Status</th>
            <th class="hide-mobile">Published</th>
            <th style="width:80px"></th>
          </tr>
        </thead>
        <tbody>
          @foreach($posts as $post)
            <tr>
              <td>
                @if($post->thumbnail)
                  <img src="{{ asset('storage/' . $post->thumbnail) }}" class="thumbnail-img">
                @else
                  <div class="no-thumb"><i data-lucide="image"></i></div>
                @endif
              </td>
              <td><strong>{{ Str::limit($post->title, 40) }}</strong></td>
              <td class="hide-mobile">{{ $post->category->name ?? 'Uncategorized' }}</td>
              <td>
                <span class="badge-status bg-{{ $post->status }}">
                  {{ ucfirst($post->status) }}
                </span>
              </td>
              <td class="hide-mobile">
                @if($post->published_at)
                  {{ \Carbon\Carbon::parse($post->published_at)->format('M d, Y') }}
                @else
                  <span class="text-muted" style="font-size:0.8rem">-</span>
                @endif
              </td>
              <td class="actions-cell">
                <button class="btn-icon edit-btn"
                  data-id="{{ $post->id }}"
                  data-title="{{ $post->title }}"
                  data-excerpt="{{ $post->excerpt }}"
                  data-video_url="{{ $post->video_url }}"
                  data-category_id="{{ $post->category_id }}"
                  data-status="{{ $post->status }}"
                  data-content="{{ $post->content }}"
                  title="Edit">
                  <i data-lucide="pencil"></i>
                </button>
                <button class="btn-icon danger delete-btn ms-1"
                  data-id="{{ $post->id }}"
                  data-title="{{ Str::limit($post->title, 30) }}"
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

@if($posts->hasPages())
  <div class="mt-3">{{ $posts->links() }}</div>
@endif

{{-- CREATE MODAL (Extra Large so writers have space) --}}
<div class="modal fade" id="createModal" tabindex="-1">
  <div class="modal-dialog modal-xl modal-dialog-centered">
    <div class="modal-content">
      <form method="POST" action="{{ route('admin.posts.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="modal-header">
          <h5 class="modal-title">Write New Post</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body bg-light">
          <div class="p-3 bg-white rounded border row g-3">
            <div class="col-md-8">
              <label class="form-label">Title</label>
              <input type="text" name="title" class="form-control form-control-lg" style="font-size:1.1rem;font-weight:600;" required>
            </div>
            <div class="col-md-4">
              <label class="form-label">Category</label>
              <select name="category_id" class="form-select form-select-lg">
                <option value="">-- Uncategorized --</option>
                @foreach (\App\Models\Category::all() as $category)
                  <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
              </select>
            </div>
            <div class="col-12">
              <label class="form-label">Content</label>
              <input id="content_create" type="hidden" name="content">
              <trix-editor input="content_create"></trix-editor>
            </div>
            <div class="col-md-12 mt-4">
              <h6 class="text-gold border-bottom pb-2 mb-3" style="font-size:0.85rem;font-weight:700;">Additional Options</h6>
            </div>
            <div class="col-md-12">
              <label class="form-label">Short Excerpt <small class="text-muted text-lowercase">(optional summary)</small></label>
              <textarea name="excerpt" class="form-control" rows="2"></textarea>
            </div>
            <div class="col-md-6">
              <label class="form-label">YouTube Video URL <small class="text-muted text-lowercase">(optional)</small></label>
              <input type="url" name="video_url" class="form-control">
            </div>
            <div class="col-md-6">
              <label class="form-label">Thumbnail Image</label>
              <input type="file" name="thumbnail" class="form-control" accept="image/*">
            </div>
            <div class="col-12 mt-3 pt-3 border-top d-flex align-items-center gap-3">
              <label class="form-label mb-0">Status:</label>
              <div class="form-check form-check-inline mb-0">
                <input class="form-check-input" type="radio" name="status" id="c_status_draft" value="draft" checked>
                <label class="form-check-label" for="c_status_draft">Draft</label>
              </div>
              <div class="form-check form-check-inline mb-0">
                <input class="form-check-input" type="radio" name="status" id="c_status_pub" value="published">
                <label class="form-check-label" for="c_status_pub">Published</label>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-sm btn-light" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-gold px-4">Save Post</button>
        </div>
      </form>
    </div>
  </div>
</div>

{{-- EDIT MODAL --}}
<div class="modal fade" id="editModal" tabindex="-1">
  <div class="modal-dialog modal-xl modal-dialog-centered">
    <div class="modal-content">
      <form method="POST" id="editForm" enctype="multipart/form-data">
        @csrf @method('PUT')
        <div class="modal-header">
          <h5 class="modal-title">Edit Post</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body bg-light">
          <div class="p-3 bg-white rounded border row g-3">
            <div class="col-md-8">
              <label class="form-label">Title</label>
              <input type="text" name="title" id="e_title" class="form-control form-control-lg" style="font-size:1.1rem;font-weight:600;" required>
            </div>
            <div class="col-md-4">
              <label class="form-label">Category</label>
              <select name="category_id" id="e_category_id" class="form-select form-select-lg">
                <option value="">-- Uncategorized --</option>
                @foreach (\App\Models\Category::all() as $category)
                  <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
              </select>
            </div>
            <div class="col-12">
              <label class="form-label">Content</label>
              <!-- It is crucial we use a different ID for the edit input so Trix binds uniquely -->
              <input id="content_edit" type="hidden" name="content">
              <trix-editor id="trix_edit" input="content_edit"></trix-editor>
            </div>
            <div class="col-md-12 mt-4">
              <h6 class="text-gold border-bottom pb-2 mb-3" style="font-size:0.85rem;font-weight:700;">Additional Options</h6>
            </div>
            <div class="col-md-12">
              <label class="form-label">Short Excerpt</label>
              <textarea name="excerpt" id="e_excerpt" class="form-control" rows="2"></textarea>
            </div>
            <div class="col-md-6">
              <label class="form-label">YouTube Video URL</label>
              <input type="url" name="video_url" id="e_video_url" class="form-control">
            </div>
            <div class="col-md-6">
              <label class="form-label">Replace Thumbnail</label>
              <input type="file" name="thumbnail" class="form-control" accept="image/*">
            </div>
            <div class="col-12 mt-3 pt-3 border-top d-flex align-items-center gap-3">
              <label class="form-label mb-0">Status:</label>
              <div class="form-check form-check-inline mb-0">
                <input class="form-check-input" type="radio" name="status" id="e_status_draft" value="draft">
                <label class="form-check-label" for="e_status_draft">Draft</label>
              </div>
              <div class="form-check form-check-inline mb-0">
                <input class="form-check-input" type="radio" name="status" id="e_status_pub" value="published">
                <label class="form-check-label" for="e_status_pub">Published</label>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-sm btn-light" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-gold px-4">Update Post</button>
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
          <h5 class="modal-title">Delete Post</h5>
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
<!-- Trix Editor JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
  lucide.createIcons();

  // Auto-dismiss toast
  const toast = document.getElementById('toast');
  if (toast) setTimeout(() => toast.remove(), 3000);

  // Bind Trix attachments to server upload
  document.addEventListener('trix-attachment-add', function (event) {
    const attachment = event.attachment;
    if (!attachment.file) return;

    const form = new FormData();
    form.append('attachment', attachment.file);

    fetch("{{ route('admin.posts.trix-upload') }}", {
      method: 'POST',
      headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
      body: form
    })
    .then(response => response.json())
    .then(result => {
      if (result.url) {
        attachment.setAttributes({ url: result.url, href: result.url });
      }
    })
    .catch(error => console.error('Upload failed:', error));
  });

  // Edit modal populator
  document.querySelectorAll('.edit-btn').forEach(btn => {
    btn.addEventListener('click', function() {
      const d = this.dataset;
      document.getElementById('editForm').action = '/admin/posts/' + d.id;
      
      document.getElementById('e_title').value = d.title || '';
      document.getElementById('e_category_id').value = d.category_id || '';
      document.getElementById('e_excerpt').value = d.excerpt || '';
      document.getElementById('e_video_url').value = d.video_url || '';
      
      if(d.status === 'published') {
        document.getElementById('e_status_pub').checked = true;
      } else {
        document.getElementById('e_status_draft').checked = true;
      }
      
      // Populate Trix Editor
      const trixEditor = document.getElementById('trix_edit').editor;
      trixEditor.loadHTML(d.content || '');
      
      // Delay focus slightly to let modal render, else Safari glitches
      setTimeout(() => trixEditor.setSelectedRange([0, 0]), 100);

      new bootstrap.Modal(document.getElementById('editModal')).show();
    });
  });

  // Delete modal populator
  document.querySelectorAll('.delete-btn').forEach(btn => {
    btn.addEventListener('click', function() {
      document.getElementById('deleteForm').action = '/admin/posts/' + this.dataset.id;
      document.getElementById('deleteName').textContent = this.dataset.title;
      new bootstrap.Modal(document.getElementById('deleteModal')).show();
    });
  });
});
</script>
@endpush
