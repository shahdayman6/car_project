@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto p-8 bg-gray-950 text-white rounded-2xl shadow-2xl">
    <h2 class="text-4xl font-extrabold text-purple-400 mb-8 text-center">{{ $car->name }}</h2>

    {{-- صور السيارة --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-10">
        @foreach($car->images as $image)
            <div class="overflow-hidden rounded-xl shadow-lg transform hover:scale-105 transition duration-300">
              <img src="{{ asset('images/cars/' . $image) }}" alt="Car Image" class="w-full h-64 object-cover">
            </div>
        @endforeach
    </div>

    {{-- بيانات السيارة --}}
    <div class="bg-gray-900 p-6 rounded-xl shadow-inner space-y-4 text-lg">
        <p><strong class="text-gray-400">💰 Price:</strong> <span class="text-green-400 font-bold text-xl">${{ number_format($car->price) }}</span></p>
        <p><strong class="text-gray-400">📅 Year:</strong> {{ $car->year }}</p>
        <p><strong class="text-gray-400">📝 Description:</strong> {{ $car->description }}</p>
    </div>

    {{-- زر الشراء --}}
    <div class="mt-8 flex justify-center">
        @auth
            <a href="{{ route('cars.buy', $car->id) }}"
               class="bg-purple-600 hover:bg-purple-700 text-white font-semibold px-10 py-3 rounded-full text-xl shadow-lg transition duration-300">
                +
            </a>
        @else
            <a href="{{ route('login') }}"
               class="text-purple-400 underline text-lg hover:text-purple-200">
               Login to buy
            </a>
        @endauth
    </div>
</div>
@endsection