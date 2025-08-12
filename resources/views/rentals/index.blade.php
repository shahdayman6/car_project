@extends('layouts.app')
@section('content')
<div class="p-8 container mx-auto">
    <h1 class="text-4xl font-bold mb-10 text-center text-transparent bg-clip-text bg-gradient-to-r from-purple-400 to-pink-500">
        🚗 Available Cars for Rent
    </h1>

    <div class="relative max-w-lg mx-auto mb-10">
        <input type="text" id="search" placeholder="Search by name, location, or year..." 
            class="w-full px-5 py-4 rounded-full bg-gray-900 text-white placeholder-gray-400 border border-gray-700 focus:outline-none focus:ring-2 focus:ring-purple-500">
        <svg class="w-6 h-6 text-gray-400 absolute top-1/2 right-5 -translate-y-1/2 pointer-events-none" fill="none" stroke="currentColor" stroke-width="2" 
             viewBox="0 0 24 24">
             <path stroke-linecap="round" stroke-linejoin="round" 
                   d="M21 21l-4.35-4.35M17 10.5a6.5 6.5 0 11-13 0 6.5 6.5 0 0113 0z" />
        </svg>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10" id="cars-container">
        @foreach ($rentals as $index => $rental)
            <div class="bg-gradient-to-br from-gray-900 to-gray-800 rounded-3xl overflow-hidden shadow-2xl hover:shadow-purple-500/30 transform hover:-translate-y-2 transition duration-500">
                <!-- Image Carousel -->
                <div class="relative h-64 overflow-hidden group">
                    @foreach ($rental['images'] as $i => $image)
                        @php
                            $imagePath = file_exists(public_path('images/rentals/' . $image)) 
                                ? asset('images/rentals/' . $image) 
                                : asset($image);
                        @endphp
                        <img 
                            src="{{ $imagePath }}" 
                            alt="{{ $rental['name'] }}"
                            class="absolute w-full h-full object-cover car-image car-{{ $index }}"
                            style="opacity: {{ $i === 0 ? 1 : 0 }};"
                        >
                    @endforeach

                    <!-- Navigation Arrows -->
                    <button onclick="prevImage({{ $index }})" 
                        class="absolute left-3 top-1/2 -translate-y-1/2 bg-black/50 p-2 rounded-full text-white opacity-0 group-hover:opacity-100 transition">
                        &#10094;
                    </button>
                    <button onclick="nextImage({{ $index }})" 
                        class="absolute right-3 top-1/2 -translate-y-1/2 bg-black/50 p-2 rounded-full text-white opacity-0 group-hover:opacity-100 transition">
                        &#10095;
                    </button>

                    <!-- Price Tag -->
                    <span class="absolute top-3 left-3 bg-purple-600 text-white px-3 py-1 rounded-full text-sm font-bold shadow">
                        ${{ $rental['price_per_day'] }}/day
                    </span>
                </div>

                <!-- Details -->
                <div class="p-6">
                    <h2 class="text-2xl font-bold text-purple-400 mb-2">{{ $rental['title'] }}</h2>
                    <p class="text-gray-400 mb-3"><i class="fas fa-map-marker-alt"></i> {{ $rental['location'] ?? 'N/A' }}</p>
                    
                    <a href="{{ route('rentals.showBookingForm', $rental->id) }}" 
                       class="inline-block w-full px-4 py-3 text-center bg-purple-600 hover:bg-purple-800 text-white rounded-lg transition">
                        Book Now
                    </a>
                </div>
            </div>
        @endforeach
    </div>
</div>

<script>
    const imageIndexes = Array({{ count($rentals) }}).fill(0);
    const imageCounts = [
        @foreach ($rentals as $rental)
            {{ count($rental['images']) }},
        @endforeach
    ];

    function updateImageDisplay(carIndex) {
        const images = document.querySelectorAll(`.car-${carIndex}`);
        images.forEach((img, i) => {
            img.style.opacity = (i === imageIndexes[carIndex]) ? 1 : 0;
        });
    }

    function nextImage(carIndex) {
        imageIndexes[carIndex] = (imageIndexes[carIndex] + 1) % imageCounts[carIndex];
        updateImageDisplay(carIndex);
    }

    function prevImage(carIndex) {
        imageIndexes[carIndex] = (imageIndexes[carIndex] - 1 + imageCounts[carIndex]) % imageCounts[carIndex];
        updateImageDisplay(carIndex);
    }

    document.addEventListener('DOMContentLoaded', () => {
        const carCount = {{ count($rentals) }};
        for (let i = 0; i < carCount; i++) {
            setInterval(() => nextImage(i), 3000);
        }
    });

    document.getElementById('search').addEventListener('input', function () {
        const query = this.value.toLowerCase();
        const cards = document.querySelectorAll('#cars-container > div');

        cards.forEach(card => {
            const name = card.querySelector('h2')?.innerText.toLowerCase() || '';
            const location = card.querySelector('p')?.innerText.toLowerCase() || '';

            if (name.includes(query) || location.includes(query) || query === '') {
                card.style.display = 'block';
                card.style.opacity = 1;
            } else {
                card.style.opacity = 0;
                setTimeout(() => card.style.display = 'none', 300);
            }
        });
    });
</script>

<style>
    .car-image {
        transition: opacity 0.8s ease-in-out;
    }
</style>
@endsection
