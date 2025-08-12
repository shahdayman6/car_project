@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-gray-950 to-gray-900 p-6">
    <div class="w-full max-w-3xl bg-gray-900/80 backdrop-blur-lg text-white rounded-3xl shadow-2xl p-10 border border-gray-800">
        
        <!-- Title -->
        <h2 class="text-4xl font-bold mb-2 flex items-center gap-3">
            <span class="text-purple-400"></span> Book: {{ $rental->title }}
        </h2>
        <p class="text-gray-400 mb-8">Fill in your rental details below to confirm your booking.</p>

        <!-- Form -->
        <form action="{{ route('rentals.book', $rental->id) }}" method="POST" class="space-y-6">
            @csrf

            <!-- Start Date -->
            <div>
                <label class="block text-sm font-medium mb-2">Start Date:</label>
                <input type="date" name="start_date" required 
                       class="w-full p-3 rounded-lg bg-gray-800 text-white border border-gray-700 focus:outline-none focus:ring-2 focus:ring-purple-500">
            </div>

            <!-- End Date -->
            <div>
                <label class="block text-sm font-medium mb-2">End Date:</label>
                <input type="date" name="end_date" required 
                       class="w-full p-3 rounded-lg bg-gray-800 text-white border border-gray-700 focus:outline-none focus:ring-2 focus:ring-purple-500">
            </div>

            <!-- Confirm Button -->
            <button type="submit" 
                    class="w-full py-3 rounded-lg bg-gradient-to-r from-purple-600 to-pink-500 font-semibold text-lg hover:from-purple-700 hover:to-pink-600 transition-all shadow-lg">
                ✅ Confirm Booking
            </button>
        </form>
    </div>
</div>
@endsection
