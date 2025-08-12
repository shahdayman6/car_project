@extends('layouts.app')
@section('content')
<div class="p-8 container mx-auto">
    <h1 class="text-3xl font-semibold mb-8 text-white">Available Cars for Rent</h1>

    <input type="text" id="search" placeholder="Search by name or year..." 
        class="w-full px-4 py-4 rounded-lg bg-gray-800 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-purple-500 mb-8">

    <div class="grid grid-cols-1 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10" id="cars-container">
        @foreach ($rentals as $index => $rental)
            <div class="bg-gray-900 rounded-2xl overflow-hidden shadow-2xl transform hover:scale-105 transition duration-500">
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
                    <button onclick="prevImage({{ $index }})" class="absolute left-2 top-1/2 -translate-y-1/2 text-white bg-purple-700 bg-opacity-70 rounded-full w-8 h-8 flex items-center justify-center opacity-0 group-hover:opacity-100 transition">‹</button>
                    <button onclick="nextImage({{ $index }})" class="absolute right-2 top-1/2 -translate-y-1/2 text-white bg-purple-700 bg-opacity-70 rounded-full w-8 h-8 flex items-center justify-center opacity-0 group-hover:opacity-100 transition">›</button>
                </div>
                <div class="p-4">
                    <h2 class="text-xl font-bold text-purple-400 mb-2">{{ $rental['title'] }}</h2>
                    <p class="text-gray-300 mb-4">${{ $rental['price_per_day'] }} / day</p>
                    <p class="text-gray-400 mb-2">Location: {{ $rental['location'] ?? 'N/A' }}</p>
                    <a href="{{ route('rentals.showBookingForm', $rental->id) }}" 
                      class="px-4 py-2 bg-purple-600 text-white rounded hover:bg-purple-800 transition">
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
            setInterval(() => nextImage(i), 2000);
        }
    });

    // بحث مباشر
    document.getElementById('search').addEventListener('input', function () {
        const query = this.value.toLowerCase();
        const cards = document.querySelectorAll('#cars-container > div');

        cards.forEach(card => {
            const name = card.querySelector('h2')?.innerText.toLowerCase() || '';
            const location = card.querySelector('p:nth-of-type(2)')?.innerText.toLowerCase() || '';

            if (query === '' || name.includes(query) || location.includes(query)) {
                card.style.display = 'block';
            } else {
                card.style.display = 'none';
            }
        });
    });
</script>

<style>
    .car-image {
        transition: opacity 1s ease-in-out;
    }
</style>
@endsection
