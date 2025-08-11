@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto p-10 bg-gradient-to-br from-gray-950 via-gray-900 to-gray-950 text-white rounded-3xl shadow-2xl">

   {{-- عنوان السيارة --}}
<h2 class="car-title">
    {{ strtoupper($car->name) }}
</h2>

<style>
.car-title {
    font-size: clamp(2.5rem, 5vw, 4rem); /* أصغر من قبل */
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
</style>


    {{-- صور السيارة --}}
   <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 mb-14">
    @foreach($car->images as $image)
        @php
            // مسار الصورة لو في مجلد images/cars/
            $imageFromImages = 'images/cars/' . $image;
            // لو الاسم فيه مسار كامل (مثلاً من storage أو مكان تاني)
            $imageFromStorage = $image;

            // تحقق من وجود الصورة في مجلد images/cars/
            $pathInImages = public_path($imageFromImages);
            $pathInStorage = public_path($imageFromStorage);

            // اختر الصورة الموجودة فعلاً
            $finalImagePath = file_exists($pathInImages) ? asset($imageFromImages) : asset($imageFromStorage);
        @endphp

        <div class="overflow-hidden rounded-2xl shadow-lg transform hover:scale-105 hover:shadow-2xl transition-all duration-500 border border-gray-800">
            <img src="{{ $finalImagePath }}" alt="Car Image" class="w-full h-64 object-cover rounded-2xl" />
        </div>
    @endforeach
</div>

    {{-- معلومات السيارة --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-16 text-lg">

        <div class="glass-card p-6">
            <p class="text-gray-400 text-sm uppercase tracking-wide mb-2">Price</p>
            <p class="text-3xl font-bold text-green-400">${{ number_format($car->price) }}</p>
        </div>

        <div class="glass-card p-6">
            <p class="text-gray-400 text-sm uppercase tracking-wide mb-2">Year</p>
            <p class="text-2xl font-semibold">{{ $car->year }}</p>
        </div>

        <div class="glass-card p-6">
            <p class="text-gray-400 text-sm uppercase tracking-wide mb-2">Description</p>
            <p class="leading-relaxed">{{ $car->description }}</p>
        </div>
    </div>

    {{-- زر الشراء --}}
    <div class="flex justify-center mt-8">
        @auth
            <a href="{{ route('cars.buy', $car->id) }}"
               class="premium-btn">
                Buy This Car
            </a>
        @else
            <a href="{{ route('login') }}"
               class="text-purple-400 underline text-lg hover:text-purple-200 transition duration-300">
                Login to buy this car
            </a>
        @endauth
    </div>
</div>
@endsection

<style>
/* تأثير العنوان */
@keyframes titleFade {
    from {
        opacity: 0;
        transform: translateY(-20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}
.animate-title {
    animation: titleFade 1s ease-out forwards;
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
}
.premium-btn:hover {
    background: linear-gradient(90deg, #6d28d9, #db2777);
    box-shadow: 0 6px 25px rgba(236, 72, 153, 0.5);
    transform: translateY(-2px);
}
</style>
