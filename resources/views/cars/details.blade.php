@extends('layouts.home')

@section('content')
<div class="min-h-screen bg-gray-950 text-white p-8">
    <div class="max-w-4xl mx-auto bg-gray-900 rounded-2xl p-6 shadow-2xl">
        <h2 class="text-3xl font-bold text-purple-400 mb-4">{{ $car->name }}</h2>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
            @foreach ($car->images as $image)
                <img src="{{ asset('images/cars/' . $image) }}" alt="Car Image" class="w-full rounded-xl object-cover h-64">
            @endforeach
        </div>

        <p><span class="font-semibold text-purple-300">Brand:</span> {{ $car->brand }}</p>
        <p><span class="font-semibold text-purple-300">Model:</span> {{ $car->model }}</p>
        <p><span class="font-semibold text-purple-300">Year:</span> {{ $car->year }}</p>
        <p><span class="font-semibold text-purple-300">Price:</span> ${{ $car->price }}</p>

        <a href="{{ route('cars.buy', $car->id) }}" class="inline-block mt-6 px-6 py-2 bg-green-600 hover:bg-green-700 text-white text-xl font-bold rounded-full">+</a>
    </div>
</div>
@endsection