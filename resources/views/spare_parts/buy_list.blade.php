@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto p-10 mt-10 bg-white/10 backdrop-blur-xl border border-white/20 text-white rounded-3xl shadow-2xl">
    
    {{-- Title --}}
    <h1 class="text-4xl font-extrabold mb-10 text-center bg-clip-text text-transparent bg-gradient-to-r from-purple-300 via-blue-300 to-pink-300 drop-shadow-lg tracking-wide">
        🔍 Buy Spare Parts
    </h1>

    {{-- Search form --}}
    <form method="GET" action="{{ route('spare-parts.buy') }}" class="mb-8 flex gap-3">
        <input type="text" name="search" value="{{ $search }}" placeholder="Search spare parts..."
            class="w-full px-4 py-3 rounded-xl bg-gray-900/60 text-white border border-purple-500 focus:outline-none focus:ring-2 focus:ring-pink-500 transition duration-300">
        <button type="submit" 
            class="px-6 py-3 bg-gradient-to-r from-purple-600 via-blue-500 to-pink-500 hover:scale-105 transform transition-all duration-300 rounded-xl text-white font-semibold shadow-lg">
            Search
        </button>
    </form>

    {{-- Messages --}}
    @if(session('success'))
        <div class="bg-gradient-to-r from-purple-600 via-blue-500 to-pink-500 text-white p-3 rounded mb-6 shadow-lg text-center">
            {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class="bg-gradient-to-r from-pink-600 via-red-500 to-purple-600 text-white p-3 rounded mb-6 shadow-lg text-center">
            {{ session('error') }}
        </div>
    @endif

    {{-- Spare parts list --}}
    <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-8">
        @forelse($spareParts as $part)
            @php
                $images = $part->images;
                $firstImage = is_array($images) && count($images) > 0 ? $images[0] : null;
            @endphp

            <div class="bg-gray-900/60 border border-purple-500 rounded-2xl shadow-lg overflow-hidden group hover:scale-105 transform transition duration-300">
                @if($firstImage)
                    <img src="{{ asset($firstImage) }}" alt="{{ $part->name }}" 
                        class="w-full h-48 object-cover group-hover:brightness-110 transition duration-300">
                @else
                    <div class="w-full h-48 flex items-center justify-center bg-gradient-to-r from-purple-600 via-blue-500 to-pink-500 text-white font-bold text-lg">
                        No Image
                    </div>
                @endif
                <div class="p-5">
                    <h2 class="text-xl font-bold text-purple-300 mb-2">{{ $part->name }}</h2>
                    <p class="text-sm text-gray-300 line-clamp-2 mb-4">{{ $part->description }}</p>
                    
                    <div class="space-y-1 mb-4 text-sm">
                        <p><span class="text-pink-400 font-semibold"> Price:</span> {{ $part->price ? '$'.$part->price : 'N/A' }}</p>
                        <p><span class="text-pink-400 font-semibold"> Condition:</span> {{ ucfirst($part->condition) }}</p>
                        <p><span class="text-pink-400 font-semibold"> Quantity:</span> {{ $part->quantity }}</p>
                    </div>

                    <form action="{{ route('spare-parts.buyNow', $part->id) }}" method="POST">
                        @csrf
                       <a href="{{ route('spare-parts.purchase', $part->id) }}"
   class="w-full inline-block text-center px-4 py-2 bg-gradient-to-r from-purple-600 via-blue-500 to-pink-500 hover:scale-[1.02] transform transition-all duration-300 rounded-xl text-white font-semibold shadow-md">
   Buy Now
</a>

                    </form>
                </div>
            </div>
        @empty
            <p class="text-center text-gray-400 col-span-full">No spare parts found.</p>
        @endforelse
    </div>
</div>
@endsection
