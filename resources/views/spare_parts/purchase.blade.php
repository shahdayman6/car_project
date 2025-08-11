@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto p-10 mt-10 bg-white/10 backdrop-blur-xl border border-white/20 text-white rounded-3xl shadow-2xl">
    <h1 class="text-4xl font-extrabold mb-6 text-center text-purple-300">Purchase: {{ $part->name }}</h1>

    @if(session('error'))
        <div class="bg-gradient-to-r from-pink-600 via-red-500 to-purple-600 text-white p-3 rounded mb-6 shadow-lg text-center">
            {{ session('error') }}
        </div>
    @endif

    <div class="mb-6">
        <img src="{{ is_array($part->images) && count($part->images) ? asset($part->images[0]) : '' }}" 
             alt="{{ $part->name }}" class="rounded-lg w-full h-64 object-cover mb-4" />
        <p class="text-gray-300 mb-4">{{ $part->description }}</p>
        <p><span class="text-pink-400 font-semibold">Price:</span> {{ $part->price ? '$'.$part->price : 'N/A' }}</p>
        <p><span class="text-pink-400 font-semibold">Condition:</span> {{ ucfirst($part->condition) }}</p>
        <p><span class="text-pink-400 font-semibold">Available Quantity:</span> {{ $part->quantity }}</p>
    </div>

    <form action="{{ route('spare-parts.processPurchase', $part->id) }}" method="POST">
        @csrf

        <div class="mb-4">
            <label for="name" class="block mb-1 font-semibold">Your Name:</label>
            <input type="text" name="name" id="name" placeholder="Enter your full name"
                   class="w-full px-4 py-2 rounded-lg bg-gray-900/60 border border-purple-500 text-white focus:outline-none focus:ring-2 focus:ring-pink-500" required>
        </div>

        <div class="mb-4">
            <label for="phone" class="block mb-1 font-semibold">Phone Number:</label>
            <input type="tel" name="phone" id="phone" placeholder="Enter your phone number"
                   class="w-full px-4 py-2 rounded-lg bg-gray-900/60 border border-purple-500 text-white focus:outline-none focus:ring-2 focus:ring-pink-500" required>
        </div>

        <div class="mb-4">
            <label for="address" class="block mb-1 font-semibold">Shipping Address:</label>
            <textarea name="address" id="address" rows="3" placeholder="Enter your shipping address"
                   class="w-full px-4 py-2 rounded-lg bg-gray-900/60 border border-purple-500 text-white focus:outline-none focus:ring-2 focus:ring-pink-500" required></textarea>
        </div>

        <div class="mb-4">
            <label for="quantity" class="block mb-1 font-semibold">Quantity to buy:</label>
            <input type="number" name="quantity" id="quantity" value="1" min="1" max="{{ $part->quantity }}"
                   class="w-full px-4 py-2 rounded-lg bg-gray-900/60 border border-purple-500 text-white focus:outline-none focus:ring-2 focus:ring-pink-500" required>
        </div>

        <button type="submit" 
            class="w-full px-6 py-3 bg-gradient-to-r from-purple-600 via-blue-500 to-pink-500 hover:scale-[1.02] transform transition-all duration-300 rounded-xl text-white font-semibold shadow-md">
            Confirm Purchase
        </button>
    </form>
</div>
@endsection
