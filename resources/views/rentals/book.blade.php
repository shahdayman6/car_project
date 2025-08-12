@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto p-10 bg-gray-900 text-white rounded-3xl shadow-lg">
    <h2 class="text-3xl font-bold mb-6">Book: {{ $rental->title }}</h2>

    <form action="{{ route('rentals.book', $rental->id) }}" method="POST" class="space-y-5">
        @csrf

        <label>Start Date:</label>
        <input type="date" name="start_date" required class="w-full p-2 rounded bg-gray-800" />

        <label>End Date:</label>
        <input type="date" name="end_date" required class="w-full p-2 rounded bg-gray-800" />

        <button type="submit" class="w-full bg-purple-700 p-3 rounded font-semibold hover:bg-purple-900">
            Confirm Booking
        </button>
    </form>
</div>
@endsection
