@extends('layouts.admin')

@section('title', 'Upload Trip Images')

@section('content')
<div class="container py-4">
  <h3 class="text-gold mb-4">Upload Images for Trip: {{ $trip->title }}</h3>

  @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif

 <form action="{{ route('admin.trips.uploadImages.store', $trip->id) }}" method="POST" enctype="multipart/form-data">
  @csrf

  <div class="mb-3">
    <label>Thumbnail</label>
    <input type="file" name="thumbnail" class="form-control">
  </div>

  <div class="mb-3">
    <label>Gallery Images</label>
    <input type="file" name="gallery[]" class="form-control" multiple>
  </div>

  <button type="submit" class="btn btn-primary">Upload</button>
</form>

</div>
@endsection
