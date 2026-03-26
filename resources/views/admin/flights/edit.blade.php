@extends('layouts.admin')

@section('title', 'Edit Flight')

@section('content')
<div class="container">
    <h2 class="text-gold mb-4">Edit Flight: {{ $flight->flight_number }}</h2>

    <form action="{{ route('admin.flights.update', $flight) }}" method="POST">
        @csrf
        @method('PUT')
        @include('admin.flights.form')
        <button type="submit" class="btn btn-gold mt-3">Update Flight</button>
    </form>
</div>
@endsection
