@extends('layouts.app')

@section('title', 'Page Not Found')

@section('content')

<section class="page-center">
  <div class="container" data-aos="fade-up">
    <i class="bi bi-exclamation-triangle-fill"></i>
    <h1 class="text-gold">404 - Not Found</h1>
    <p>The page you're looking for doesn't exist or has been moved.</p>
    <a href="{{ url('/') }}" class="btn btn-gold">Back to Home</a>
  </div>
</section>

@endsection
