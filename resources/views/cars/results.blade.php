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

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
        @foreach ($data as $car)
            @php
                $imageUrl = "https://loremflickr.com/600/400/" . urlencode($car['make'] . '-' . $car['model']) . ",car";
            @endphp

            <div class="bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition transform hover:-translate-y-1">
                <img src="{{ $imageUrl }}" class="w-full h-56 object-cover"
                     onerror="this.onerror=null; this.src='https://via.placeholder.com/600x400?text=Image+Unavailable';">
                <div class="p-5">
                    <h5 class="text-xl font-semibold mb-4 text-purple-700">
                        {{ $car['make'] }} {{ $car['model'] }} ({{ $car['year'] ?? 'Unknown' }})
                    </h5>
                    <div class="flex flex-wrap gap-3 text-sm">
                        <span class="bg-purple-100 text-purple-800 px-3 py-1 rounded-full shadow-sm">
                            <strong>Fuel:</strong> {{ $car['fuel_type'] ?? 'N/A' }}
                        </span>
                        <span class="bg-purple-100 text-purple-800 px-3 py-1 rounded-full shadow-sm">
                            <strong>Cylinders:</strong> {{ $car['cylinders'] ?? 'N/A' }}
                        </span>

                        @if (!str_contains($car['city_mpg'] ?? '', 'premium'))
                            <span class="bg-purple-100 text-purple-800 px-3 py-1 rounded-full shadow-sm">
                                <strong>MPG (City/Highway):</strong> {{ $car['city_mpg'] }} / {{ $car['highway_mpg'] ?? '-' }}
                            </span>
                        @endif

                        <span class="bg-purple-100 text-purple-800 px-3 py-1 rounded-full shadow-sm">
                            <strong>Displacement:</strong> {{ $car['displacement'] ?? '-' }}L
                        </span>
                        <span class="bg-purple-100 text-purple-800 px-3 py-1 rounded-full shadow-sm">
                            <strong>Class:</strong> {{ $car['class'] ?? 'N/A' }}
                        </span>
                        <span class="bg-purple-100 text-purple-800 px-3 py-1 rounded-full shadow-sm">
                            <strong>Drive:</strong> {{ $car['drive'] ?? 'N/A' }}
                        </span>
                        <span class="bg-purple-100 text-purple-800 px-3 py-1 rounded-full shadow-sm">
                            <strong>Transmission:</strong> {{ $car['transmission'] ?? 'N/A' }}
                        </span>
                    </div>
                </div>
            </div>
        @endforeach
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
