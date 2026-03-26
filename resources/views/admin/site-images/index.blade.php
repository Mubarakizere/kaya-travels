@extends('layouts.admin')

@section('title', 'Site Images')

@push('styles')
<style>
  .image-group-title {
    color: #a8871e;
    font-weight: 700;
    font-size: 1.3rem;
    margin-bottom: 1rem;
    padding-bottom: 0.5rem;
    border-bottom: 2px solid #c9a227;
  }

  .image-card {
    background: #fff;
    border: 1px solid rgba(0,0,0,0.07);
    border-radius: 12px;
    overflow: hidden;
    transition: 0.3s ease;
  }

  .image-card:hover {
    border-color: #c9a227;
    box-shadow: 0 4px 16px rgba(201,162,39,0.12);
  }

  .image-preview {
    width: 100%;
    height: 180px;
    object-fit: cover;
    background: #f3efe7;
    display: block;
  }

  .image-preview-placeholder {
    width: 100%;
    height: 180px;
    background: #f3efe7;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #bbb;
    font-size: 0.9rem;
  }

  .image-card-body {
    padding: 1rem;
  }

  .image-label {
    font-weight: 600;
    color: #2c2820;
    margin-bottom: 0.25rem;
  }

  .image-size {
    color: #8a8278;
    font-size: 0.85rem;
    margin-bottom: 0.75rem;
  }

  .image-size .size-warning {
    color: #d44;
    font-weight: 600;
  }

  .image-size .size-ok {
    color: #2a9d5c;
  }

  .file-input-wrapper input[type="file"] {
    background: #f3efe7;
    border: 1px dashed #ccc;
    border-radius: 8px;
    padding: 8px;
    color: #555;
    width: 100%;
    font-size: 0.85rem;
  }

  .file-input-wrapper input[type="file"]::file-selector-button {
    background: #c9a227;
    color: #fff;
    border: none;
    padding: 4px 12px;
    border-radius: 6px;
    font-weight: 600;
    cursor: pointer;
    margin-right: 8px;
  }

  .btn-compress {
    background: linear-gradient(135deg, #c9a227, #a8871e);
    color: #fff;
    border: none;
    padding: 12px 40px;
    border-radius: 50px;
    font-weight: 700;
    font-size: 1rem;
    transition: 0.3s ease;
  }

  .btn-compress:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(201,162,39,0.25);
    color: #fff;
  }
</style>
@endpush

@section('content')
<div class="container-fluid py-4">

  {{-- Header --}}
  <div class="d-flex justify-content-between align-items-center mb-4">
    <div>
      <h2 class="text-gold fw-bold mb-1">
        <i data-lucide="image" class="me-2"></i>Site Images
      </h2>
      <p class="text-muted mb-0">Upload and manage website images. All images are automatically compressed.</p>
    </div>
  </div>

  {{-- Alerts --}}
  @if(session('success'))
    <div class="alert alert-success alert-custom">
      <i data-lucide="check-circle" class="me-2"></i>{{ session('success') }}
    </div>
  @endif

  @if(session('info'))
    <div class="alert alert-info alert-custom">
      <i data-lucide="info" class="me-2"></i>{{ session('info') }}
    </div>
  @endif

  {{-- Upload Form --}}
  <form action="{{ route('admin.site-images.update') }}" method="POST" enctype="multipart/form-data">
    @csrf

    @foreach($groups as $groupName => $images)
      <div class="mb-5">
        <h4 class="image-group-title">
          @if($groupName === 'Hero Slides')
            <i data-lucide="monitor" class="me-2"></i>
          @elseif($groupName === 'Footer Instagram')
            <i data-lucide="instagram" class="me-2"></i>
          @elseif($groupName === 'Page Backgrounds')
            <i data-lucide="layout" class="me-2"></i>
          @else
            <i data-lucide="palette" class="me-2"></i>
          @endif
          {{ $groupName }}
        </h4>

        <div class="row g-3">
          @foreach($images as $image)
            <div class="col-lg-3 col-md-4 col-sm-6">
              <div class="image-card">
                {{-- Preview --}}
                @if($image['exists'])
                  <img
                    src="{{ asset('images/' . $image['filename']) }}?v={{ time() }}"
                    alt="{{ $image['label'] }}"
                    class="image-preview"
                  >
                @else
                  <div class="image-preview-placeholder">
                    <span>No image</span>
                  </div>
                @endif

                {{-- Info & Upload --}}
                <div class="image-card-body">
                  <div class="image-label">{{ $image['label'] }}</div>
                  <div class="image-size">
                    {{ $image['filename'] }} —
                    @php
                      $sizeStr = $image['size'];
                      $isLarge = str_contains($sizeStr, 'MB') && (float) $sizeStr > 1;
                    @endphp
                    @if($isLarge)
                      <span class="size-warning">{{ $sizeStr }} ⚠️</span>
                    @else
                      <span class="size-ok">{{ $sizeStr }}</span>
                    @endif
                  </div>

                  <div class="file-input-wrapper">
                    <input
                      type="file"
                      name="{{ $image['key'] }}"
                      accept="image/jpeg,image/png,image/webp"
                    >
                  </div>
                </div>
              </div>
            </div>
          @endforeach
        </div>
      </div>
    @endforeach

    {{-- Submit --}}
    <div class="text-center mt-4 mb-5">
      <button type="submit" class="btn-compress">
        <i data-lucide="upload" class="me-2"></i>
        Upload & Compress Selected Images
      </button>
      <p class="text-muted mt-2 small">Images are automatically resized and compressed for optimal performance</p>
    </div>
  </form>
</div>
@endsection

@push('scripts')
<script>
  lucide.createIcons();

  // Live preview when file is selected
  document.querySelectorAll('input[type="file"]').forEach(input => {
    input.addEventListener('change', function() {
      if (this.files && this.files[0]) {
        const card = this.closest('.image-card');
        let preview = card.querySelector('.image-preview');

        if (!preview) {
          // Replace placeholder with img
          const placeholder = card.querySelector('.image-preview-placeholder');
          if (placeholder) {
            preview = document.createElement('img');
            preview.className = 'image-preview';
            placeholder.replaceWith(preview);
          }
        }

        if (preview) {
          const reader = new FileReader();
          reader.onload = e => { preview.src = e.target.result; };
          reader.readAsDataURL(this.files[0]);
        }

        // Show selected file size
        const sizeEl = card.querySelector('.image-size');
        if (sizeEl) {
          const sizeMB = (this.files[0].size / 1048576).toFixed(1);
          const sizeKB = (this.files[0].size / 1024).toFixed(0);
          const display = sizeMB >= 1 ? sizeMB + ' MB' : sizeKB + ' KB';
          sizeEl.innerHTML = `New: <span class="text-warning">${display}</span> → will be compressed`;
        }
      }
    });
  });
</script>
@endpush
