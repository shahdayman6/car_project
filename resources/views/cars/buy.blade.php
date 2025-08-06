@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto p-6 bg-gray-900 text-white rounded-xl shadow-xl">
    <h2 class="text-2xl font-bold mb-4">Purchase Request for {{ $car->name }}</h2>

    <form method="POST" action="{{ route('cars.buy.submit', $car->id) }}">
        @csrf

        <div class="mb-4">
            <label class="block mb-1">Your Name</label>
            <input type="text" name="name" required class="w-full p-2 rounded bg-gray-800 text-white border border-gray-600">
        </div>

        <div class="mb-4">
            <label class="block mb-1">Phone Number</label>
            <input type="text" name="phone" required class="w-full p-2 rounded bg-gray-800 text-white border border-gray-600">
        </div>

        <div class="mb-4">
            <label class="block mb-1">Message</label>
            <textarea name="message" rows="4" class="w-full p-2 rounded bg-gray-800 text-white border border-gray-600"></textarea>
        </div>

        <button type="submit" class="bg-green-600 hover:bg-green-800 px-6 py-2 rounded text-white font-bold">Send Request</button>
    </form>
</div>
@endsection