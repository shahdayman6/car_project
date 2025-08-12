@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto p-10 bg-gradient-to-br from-gray-950 via-gray-900 to-gray-950 text-white rounded-3xl shadow-2xl">

    {{-- عنوان الإيجار --}}
    <h2 class="car-title mb-8">
        {{ strtoupper($rental->title) }}
    </h2>

    {{-- صور الإيجار --}}
    @php
        $imgs = $rental->images ?? [];
        if (is_string($imgs)) {
            $imgs = json_decode($imgs, true) ?: [];
        }
    @endphp

    @if(!empty($imgs))
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 mb-14">
            @foreach($imgs as $img)
                <div class="overflow-hidden rounded-2xl shadow-lg transform hover:scale-105 hover:shadow-2xl transition-all duration-500 border border-gray-800">
                    {{-- لو مسارات الصور في قاعدة البيانات زي: images/rentals/hyundai_1.jpg
                         يبقى نستخدم asset مباشرة --}}
                    <img src="{{ asset($img) }}" alt="Rental Image" class="w-full h-64 object-cover rounded-2xl" />
                </div>
            @endforeach
        </div>
    @else
        <div class="w-full h-72 bg-gray-800 rounded flex items-center justify-center text-gray-400 mb-14">
            No image available
        </div>
    @endif

    {{-- معلومات الإيجار --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-16 text-lg">

        <div class="glass-card p-6">
            <p class="text-gray-400 text-sm uppercase tracking-wide mb-2">Price per day</p>
            <p class="text-3xl font-bold text-green-400">${{ number_format($rental->price_per_day, 2) }}</p>
        </div>

        <div class="glass-card p-6">
            <p class="text-gray-400 text-sm uppercase tracking-wide mb-2">Location</p>
            <p class="text-2xl font-semibold">{{ $rental->location ?? 'N/A' }}</p>
        </div>

        <div class="glass-card p-6">
            <p class="text-gray-400 text-sm uppercase tracking-wide mb-2">Description</p>
            <p class="leading-relaxed">{{ $rental->description }}</p>
        </div>
    </div>

    {{-- زر الحجز --}}
    <div class="flex justify-center mt-8">
        @auth
            <form action="{{ route('rentals.book', $rental->id) }}" method="POST" id="bookingForm" class="w-full max-w-md">
                @csrf
                <label class="block mb-1 text-sm font-medium">Start Date</label>
                <input type="date" name="start_date" required class="w-full p-2 rounded mb-4 bg-gray-900/60 text-white" />

                <label class="block mb-1 text-sm font-medium">End Date</label>
                <input type="date" name="end_date" required class="w-full p-2 rounded mb-6 bg-gray-900/60 text-white" />

                <button type="submit" class="premium-btn w-full">Book Now</button>
            </form>
        @else
            <a href="{{ route('login') }}"
               class="text-purple-400 underline text-lg hover:text-purple-200 transition duration-300">
                Login to Book
            </a>
        @endauth
    </div>
</div>
@endsection

<style>
/* إعادة استخدام ستايلات صفحة السيارات */

.car-title {
    font-size: clamp(2.5rem, 5vw, 4rem);
    font-weight: 900;
    letter-spacing: 3px;
    text-align: center;
    text-transform: uppercase;
    background: linear-gradient(90deg, #f3e7bb 0%, #d4af37 40%, #c0c0c0 100%);
    -webkit-background-clip: text;
    color: transparent;
    text-shadow:
        0 2px 4px rgba(0, 0, 0, 0.5),
        0 0 20px rgba(255, 215, 0, 0.2);
    animation: titleGlow 1.8s ease-out forwards;
    opacity: 0;
    margin-bottom: 2rem;
}

@keyframes titleGlow {
    0% {
        opacity: 0;
        transform: scale(0.95) translateY(-15px);
        text-shadow: none;
    }
    50% {
        opacity: 0.7;
        transform: scale(1.02) translateY(0);
        text-shadow:
            0 0 12px rgba(255, 215, 0, 0.4),
            0 0 25px rgba(192, 192, 192, 0.3);
    }
    100% {
        opacity: 1;
        transform: scale(1);
        text-shadow:
            0 2px 4px rgba(0, 0, 0, 0.5),
            0 0 20px rgba(255, 215, 0, 0.5),
            0 0 30px rgba(192, 192, 192, 0.3);
    }
}

/* كروت زجاجية */
.glass-card {
    background: rgba(255, 255, 255, 0.05);
    backdrop-filter: blur(12px);
    border: 1px solid rgba(255, 255, 255, 0.08);
    border-radius: 1rem;
    transition: all 0.4s ease;
}
.glass-card:hover {
    background: rgba(255, 255, 255, 0.08);
    transform: translateY(-5px);
}

/* زر Premium */
.premium-btn {
    background: linear-gradient(90deg, #7c3aed, #ec4899);
    padding: 0.9rem 2.5rem;
    font-size: 1.25rem;
    font-weight: 600;
    border-radius: 0.5rem;
    color: white;
    letter-spacing: 0.5px;
    box-shadow: 0 4px 20px rgba(124, 58, 237, 0.4);
    transition: all 0.3s ease;
    cursor: pointer;
}
.premium-btn:hover {
    background: linear-gradient(90deg, #6d28d9, #db2777);
    box-shadow: 0 6px 25px rgba(236, 72, 153, 0.5);
    transform: translateY(-2px);
}
</style>
