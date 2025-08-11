@extends('layouts.app')

@section('content')
<div class="container mx-auto py-10 px-4">
    <h2 class="text-3xl font-bold mb-8 text-center text-gradient">
        Search Results
    </h2>

    @if($message)
        <div class="bg-yellow-100 text-yellow-800 px-4 py-3 rounded-lg mb-6 shadow">
            {{ $message }}
        </div>
    @endif

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 mb-10">
        @foreach ($data as $car)
            @php
                $imageUrl = "https://loremflickr.com/600/400/" . urlencode($car['make'] . '-' . $car['model']) . ",car";
            @endphp

            <div class="flex flex-col gap-3 p-4 border border-gray-600 rounded-lg bg-gray-900/30">
                <img src="{{ $imageUrl }}" class="w-full h-56 object-cover rounded-lg"
                     onerror="this.onerror=null; this.src='https://via.placeholder.com/600x400?text=Image+Unavailable';">
                
                <h5 class="text-xl font-semibold mb-2 text-purple-300">
                    {{ $car['make'] }} {{ $car['model'] }} ({{ $car['year'] ?? 'Unknown' }})
                </h5>

                <div class="flex flex-wrap gap-2 text-sm text-gray-200">
                    <span class="bg-purple-700 bg-opacity-40 px-3 py-1 rounded-full">
                        <strong>Fuel:</strong> {{ $car['fuel_type'] ?? 'N/A' }}
                    </span>
                    <span class="bg-purple-700 bg-opacity-40 px-3 py-1 rounded-full">
                        <strong>Cylinders:</strong> {{ $car['cylinders'] ?? 'N/A' }}
                    </span>

                    @if (!str_contains($car['city_mpg'] ?? '', 'premium'))
                        <span class="bg-purple-700 bg-opacity-40 px-3 py-1 rounded-full">
                            <strong>MPG (City/Highway):</strong> {{ $car['city_mpg'] }} / {{ $car['highway_mpg'] ?? '-' }}
                        </span>
                    @endif

                    <span class="bg-purple-700 bg-opacity-40 px-3 py-1 rounded-full">
                        <strong>Displacement:</strong> {{ $car['displacement'] ?? '-' }}L
                    </span>
                    <span class="bg-purple-700 bg-opacity-40 px-3 py-1 rounded-full">
                        <strong>Class:</strong> {{ $car['class'] ?? 'N/A' }}
                    </span>
                    <span class="bg-purple-700 bg-opacity-40 px-3 py-1 rounded-full">
                        <strong>Drive:</strong> {{ $car['drive'] ?? 'N/A' }}
                    </span>
                    <span class="bg-purple-700 bg-opacity-40 px-3 py-1 rounded-full">
                        <strong>Transmission:</strong> {{ $car['transmission'] ?? 'N/A' }}
                    </span>
                </div>
            </div>
        @endforeach
    </div>

    <div class="flex justify-center mt-10">
       <a href="{{ route('cars.buy', $data[0]['id'] ?? 1) }}"
           class="px-6 py-3 bg-purple-600 hover:bg-purple-800 text-white rounded-full text-lg font-semibold transition">
           Go to Buy Page
        </a>
    </div>
</div>

<style>
    /* تدرج لوني للبنفسجي والأزرق والوردي */
    .text-gradient {
        background: linear-gradient(90deg, #a855f7, #3b82f6, #ec4899);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }
</style>
@endsection
