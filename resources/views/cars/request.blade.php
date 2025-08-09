@extends('layouts.app')

@section('content')
<div 
    x-data="{ show: true }"
    class="max-w-3xl mx-auto p-10 mt-16 bg-white/10 backdrop-blur-xl border border-white/20 text-white rounded-3xl shadow-2xl"
    x-show="show"
    x-transition.duration.700ms
>
    {{-- Title --}}
    <h2 class="text-4xl font-extrabold mb-10 text-center bg-clip-text text-transparent bg-gradient-to-r from-purple-300 via-blue-300 to-pink-300 drop-shadow-lg tracking-wide">
        🚗 Find Your Dream Car
    </h2>

    {{-- Form --}}
    <form method="POST" action="{{ route('cars.request.submit') }}" class="space-y-6">
        @csrf

        {{-- Car Brand --}}
        <div class="relative">
            <label class="block mb-2 text-sm font-semibold text-purple-200">Car Brand</label>
            <input type="text" name="brand" required placeholder="e.g. Toyota"
                class="w-full pl-12 p-3 rounded-xl bg-gray-900/60 text-white border border-purple-500 focus:outline-none focus:ring-2 focus:ring-pink-500 transition duration-300">
            <span class="absolute left-4 top-10 text-pink-400">
                <i class="fas fa-car"></i>
            </span>
        </div>

        {{-- Car Model --}}
        <div class="relative">
            <label class="block mb-2 text-sm font-semibold text-purple-200">Car Model</label>
            <input type="text" name="model" required placeholder="e.g. Corolla"
                class="w-full pl-12 p-3 rounded-xl bg-gray-900/60 text-white border border-purple-500 focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-300">
            <span class="absolute left-4 top-10 text-blue-400">
                <i class="fas fa-tags"></i>
            </span>
        </div>

        {{-- Manufacture Year --}}
        <div class="relative">
            <label class="block mb-2 text-sm font-semibold text-purple-200">Manufacture Year</label>
            <input type="number" name="year" required placeholder="e.g. 2022"
                class="w-full pl-12 p-3 rounded-xl bg-gray-900/60 text-white border border-purple-500 focus:outline-none focus:ring-2 focus:ring-pink-500 transition duration-300">
            <span class="absolute left-4 top-10 text-purple-400">
                <i class="fas fa-calendar-alt"></i>
            </span>
        </div>

        {{-- Preferred Color --}}
        <div class="relative">
            <label class="block mb-2 text-sm font-semibold text-purple-200">Preferred Color</label>
            <input type="text" name="color" placeholder="Optional"
                class="w-full pl-12 p-3 rounded-xl bg-gray-900/60 text-white border border-purple-500 focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-300">
            <span class="absolute left-4 top-10 text-blue-300">
                <i class="fas fa-palette"></i>
            </span>
        </div>

        {{-- Minimum Budget --}}
        <div class="relative">
            <label class="block mb-2 text-sm font-semibold text-purple-200">Minimum Budget ($)</label>
            <input type="number" name="min_price" placeholder="Optional"
                class="w-full pl-12 p-3 rounded-xl bg-gray-900/60 text-white border border-purple-500 focus:outline-none focus:ring-2 focus:ring-pink-500 transition duration-300">
            <span class="absolute left-4 top-10 text-pink-300">
                <i class="fas fa-dollar-sign"></i>
            </span>
        </div>

        {{-- Maximum Budget --}}
        <div class="relative">
            <label class="block mb-2 text-sm font-semibold text-purple-200">Maximum Budget ($)</label>
            <input type="number" name="max_price" placeholder="Optional"
                class="w-full pl-12 p-3 rounded-xl bg-gray-900/60 text-white border border-purple-500 focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-300">
            <span class="absolute left-4 top-10 text-blue-300">
                <i class="fas fa-coins"></i>
            </span>
        </div>

        {{-- Additional Notes --}}
        <div class="relative">
            <label class="block mb-2 text-sm font-semibold text-purple-200">Additional Notes</label>
            <textarea name="message" rows="4" placeholder="Any specific requirements..."
                class="w-full pl-12 p-3 rounded-xl bg-gray-900/60 text-white border border-purple-500 focus:outline-none focus:ring-2 focus:ring-pink-500 transition duration-300"></textarea>
            <span class="absolute left-4 top-10 text-pink-400">
                <i class="fas fa-comment-dots"></i>
            </span>
        </div>

        {{-- Submit Button --}}
        <button type="submit"
            class="w-full bg-gradient-to-r from-purple-600 via-blue-500 to-pink-500 hover:from-pink-500 hover:via-purple-500 hover:to-blue-500 hover:scale-105 transform transition-all duration-300 px-6 py-3 rounded-xl text-white font-bold text-lg shadow-lg tracking-wide">
            Search Car 🔍
        </button>
    </form>
</div>
@endsection
