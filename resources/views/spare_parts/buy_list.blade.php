@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-2xl font-semibold mb-4">Buy Spare Parts</h1>

    {{-- Search form --}}
    <form method="GET" action="{{ route('spare-parts.buy') }}" class="mb-4 flex gap-2">
        <input type="text" name="search" value="{{ $search }}" placeholder="Search spare parts..."
               class="border rounded px-3 py-2 w-full">
        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">Search</button>
    </form>

    {{-- Messages --}}
    @if(session('success'))
        <div class="bg-green-100 text-green-800 p-3 rounded mb-4">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="bg-red-100 text-red-800 p-3 rounded mb-4">{{ session('error') }}</div>
    @endif

    {{-- Spare parts list --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        @forelse($spareParts as $part)
            @php
                $images = $part->images; // array متاحة مباشرة
                $firstImage = is_array($images) && count($images) > 0 ? $images[0] : null;
            @endphp

            <div class="border rounded shadow p-4">
                @if($firstImage)
                    <img src="{{ asset($firstImage) }}" alt="{{ $part->name }}" class="mb-2 w-full h-40 object-cover rounded">
                @endif
                <h2 class="text-lg font-semibold">{{ $part->name }}</h2>
                <p class="text-sm text-gray-600">{{ $part->description }}</p>
                <p class="mt-2"><strong>Price:</strong> ${{ $part->price ?? 'N/A' }}</p>
                <p><strong>Condition:</strong> {{ ucfirst($part->condition) }}</p>
                <p><strong>Quantity:</strong> {{ $part->quantity }}</p>

                <form action="{{ route('spare-parts.buyNow', $part->id) }}" method="POST" class="mt-3">
                    @csrf
                    <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded w-full">Buy</button>
                </form>
            </div>
        @empty
            <p>No spare parts found.</p>
        @endforelse
    </div>
</div>
@endsection

