@extends('layouts.admin')

@section('title', 'Add Flight')

@section('content')
<div class="container">
    <h2 class="text-gold mb-4">Add New Flight</h2>

    <form action="{{ route('admin.flights.store') }}" method="POST">
        @csrf
        @include('admin.flights.form')
        <button type="submit" class="btn btn-gold mt-3">Save Flight</button>
    </form>
</div>
@endsection
