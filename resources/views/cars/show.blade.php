@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto p-10 bg-gray-950 text-white rounded-3xl shadow-2xl">

    {{-- عنوان السيارة --}}
    <h2 class="text-6xl lg:text-7xl font-black tracking-wider text-center text-transparent bg-clip-text bg-gradient-to-r from-purple-400 via-pink-500 to-red-500 mb-12 drop-shadow-xl uppercase animate-glow">
    {{ strtoupper($car->name) }}
</h2>

    {{-- صور السيارة --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-12">
        @foreach($car->images as $image)
            <div class="overflow-hidden rounded-2xl shadow-lg transform hover:scale-105 transition duration-500">
                <img src="{{ asset('images/cars/' . $image) }}" alt="Car Image"
                     class="w-full h-60 object-cover rounded-2xl border border-gray-800" />
            </div>
        @endforeach
    </div>

    {{-- معلومات السيارة --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12 text-lg">

        <div class="bg-gray-900 rounded-xl p-6 shadow-inner border border-gray-800 animate-fade-in">
            <p class="text-gray-400 mb-2">💰 <span class="font-bold">Price</span></p>
            <p class="text-green-400 text-2xl font-bold">${{ number_format($car->price) }}</p>
        </div>

        <div class="bg-gray-900 rounded-xl p-6 shadow-inner border border-gray-800 animate-fade-in">
            <p class="text-gray-400 mb-2">📅 <span class="font-bold">Year</span></p>
            <p class="text-white text-xl">{{ $car->year }}</p>
        </div>

        <div class="bg-gray-900 rounded-xl p-6 shadow-inner border border-gray-800 animate-fade-in">
            <p class="text-gray-400 mb-2">📝 <span class="font-bold">Description</span></p>
            <p class="text-white">{{ $car->description }}</p>
        </div>
    </div>

    {{-- زر الشراء --}}
    <div class="flex justify-center mt-8">
        @auth
            <a href="{{ route('cars.buy', $car->id) }}"
               class="bg-purple-600 hover:bg-purple-700 px-8 py-3 text-xl rounded-full shadow-lg text-white font-semibold flex items-center gap-3 transition duration-300 animate-bounce">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
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
@keyframes glow {
    0% {
        text-shadow: 0 0 10px #d946ef, 0 0 20px #ec4899, 0 0 30px #ef4444;
        opacity: 0;
        transform: translateY(-20px);
    }
    100% {
        text-shadow: 0 0 20px #d946ef, 0 0 30px #ec4899, 0 0 40px #ef4444;
        opacity: 1;
        transform: translateY(0);
    }
}

.animate-glow {
    animation: glow 1s ease-out forwards;
}
</style>