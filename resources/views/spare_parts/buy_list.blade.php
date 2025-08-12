@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto p-10 mt-10 bg-gray-900/80 backdrop-blur-2xl border border-gray-700 rounded-3xl shadow-2xl">

    {{-- Title --}}
    <h1 class="text-5xl font-extrabold mb-12 text-center text-transparent bg-clip-text bg-gradient-to-r from-purple-400 via-blue-300 to-pink-400 drop-shadow-lg tracking-widest">
        🔍 Buy Spare Parts
    </h1>

    {{-- Search form --}}
    <form method="GET" action="{{ route('spare-parts.buy') }}" class="mb-10 flex gap-3">
        <div class="flex items-center w-full bg-gray-800/60 rounded-2xl overflow-hidden border border-purple-500/50 focus-within:ring-2 focus-within:ring-pink-500 transition">
            <span class="px-4 text-gray-400">🔎</span>
            <input type="text" name="search" value="{{ $search }}" placeholder="Search spare parts..."
                class="w-full px-4 py-4 bg-transparent text-white placeholder-gray-400 focus:outline-none text-lg">
        </div>
        <button type="submit" 
            class="px-8 py-4 bg-gradient-to-r from-purple-600 via-blue-500 to-pink-500 hover:scale-105 transform transition-all duration-300 rounded-2xl text-white font-bold shadow-lg text-lg">
            Search
        </button>
    </form>

    {{-- Messages --}}
    @if(session('success'))
        <div class="bg-gradient-to-r from-purple-600 via-blue-500 to-pink-500 text-white p-4 rounded-xl mb-6 shadow-lg text-center font-semibold">
            {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class="bg-gradient-to-r from-pink-600 via-red-500 to-purple-600 text-white p-4 rounded-xl mb-6 shadow-lg text-center font-semibold">
            {{ session('error') }}
        </div>
    @endif

    {{-- Spare parts list --}}
    <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-10">
        @forelse($spareParts as $part)
            @php
                $images = $part->images;
                $firstImage = is_array($images) && count($images) > 0 ? $images[0] : null;
            @endphp

            <div class="bg-gray-800/50 border border-gray-700 rounded-3xl shadow-xl overflow-hidden group hover:scale-105 hover:shadow-2xl hover:border-purple-400/50 transform transition-all duration-500 relative">
                
                {{-- Image --}}
                @if($firstImage)
                    <img src="{{ asset($firstImage) }}" alt="{{ $part->name }}" 
                        class="w-full h-60 object-cover group-hover:brightness-110 transition duration-300">
                @else
                    <div class="w-full h-60 flex items-center justify-center bg-gradient-to-r from-purple-600 via-blue-500 to-pink-500 text-white font-bold text-lg">
                        No Image
                    </div>
                @endif

                {{-- Price Badge --}}
                <span class="absolute top-5 right-5 bg-gradient-to-r from-pink-500 to-purple-600 px-4 py-2 rounded-full text-base font-extrabold shadow-lg text-white">
                    {{ $part->price ? '$'.$part->price : 'N/A' }}
                </span>

                {{-- Content --}}
                <div class="p-6 flex flex-col h-full">
                    <h2 class="text-xl font-extrabold bg-gradient-to-r from-purple-300 to-pink-300 bg-clip-text text-transparent mb-3">
                        {{ $part->name }}
                    </h2>
                    <p class="text-sm text-gray-300 line-clamp-2 flex-grow">{{ $part->description }}</p>

                    <div class="mt-4 text-sm space-y-1">
                        <p><span class="text-pink-400 font-semibold">Condition:</span> {{ ucfirst($part->condition) }}</p>
                        <p><span class="text-pink-400 font-semibold">Quantity:</span> {{ $part->quantity }}</p>
                    </div>

                    {{-- Buy Button --}}
                    <a href="{{ route('spare-parts.purchase', $part->id) }}"
                       class="mt-6 flex items-center justify-center gap-2 px-5 py-3 bg-gradient-to-r from-purple-600 via-blue-500 to-pink-500 
                              hover:scale-105 transform transition-all duration-300 rounded-2xl text-white font-bold shadow-md">
                        🛒 Buy Now
                    </a>
                </div>
            </div>
        @empty
            <p class="text-center text-gray-400 col-span-full">No spare parts found.</p>
        @endforelse
    </div>
</div>
@endsection
