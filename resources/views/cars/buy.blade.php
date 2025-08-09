@extends('layouts.app')

@section('content')
<div 
    x-data="{ show: true }"
    class="max-w-3xl mx-auto p-10 mt-16 bg-white/10 backdrop-blur-xl border border-white/20 text-white rounded-3xl shadow-2xl"
    x-show="show"
    x-transition.duration.700ms
>
    {{-- Title --}}
    <h2 class="text-4xl font-extrabold mb-10 text-center bg-clip-text text-transparent bg-gradient-to-r from-purple-300 via-blue-300 to-pink-300 drop-shadow-lg tracking-wide flex items-center justify-center gap-2">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-10 h-10 text-purple-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 13l4 4L21 5" />
        </svg>
        Purchase Request for {{ $car->name }}
    </h2>

    {{-- Toast Success Message --}}
    @if (session('success'))
        <div 
            x-data="{ visible: true }"
            x-show="visible"
            x-transition
            x-init="setTimeout(() => visible = false, 4000)"
            class="mb-6 p-4 bg-gradient-to-r from-green-500 to-teal-500 text-white rounded-xl shadow-lg text-center font-semibold"
        >
            ✅ {{ session('success') }}
        </div>
    @endif

    {{-- Form --}}
    <form method="POST" action="{{ route('cars.buy.submit', $car->id) }}" class="space-y-6">
        @csrf

        {{-- Name --}}
        <div class="relative">
            <label class="block mb-2 text-sm font-semibold text-purple-200">Your Name</label>
            <input type="text" name="name" required
                class="w-full pl-12 p-3 rounded-xl bg-gray-900/60 text-white border border-purple-500 focus:outline-none focus:ring-2 focus:ring-pink-500 transition duration-300">
            <span class="absolute left-4 top-10 text-pink-400">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 15c2.89 0 5.566.915 7.879 2.804M15 10a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
            </span>
        </div>

        {{-- Phone --}}
        <div class="relative">
            <label class="block mb-2 text-sm font-semibold text-purple-200">Phone Number</label>
            <input type="text" name="phone" required
                class="w-full pl-12 p-3 rounded-xl bg-gray-900/60 text-white border border-purple-500 focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-300">
            <span class="absolute left-4 top-10 text-blue-400">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5h2l3.6 7.59-1.35 2.45A1 1 0 008 17h9a1 1 0 001-1v-2H9.42l1.1-2h5.45a1 1 0 00.9-.55l3.1-6.22A1 1 0 0019 5H5z" />
                </svg>
            </span>
        </div>

        {{-- Quantity --}}
        <div class="relative">
            <label class="block mb-2 text-sm font-semibold text-purple-200">Number of Cars</label>
            <input type="number" name="quantity" min="1" value="1" required
                class="w-full pl-12 p-3 rounded-xl bg-gray-900/60 text-white border border-purple-500 focus:outline-none focus:ring-2 focus:ring-pink-500 transition duration-300">
            <span class="absolute left-4 top-10 text-pink-400">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.105 0-2 .895-2 2 0 1.105.895 2 2 2s2-.895 2-2c0-1.105-.895-2-2-2z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 2v2m0 16v2m6-10h2M4 12H2m15.364 6.364l1.414 1.414M6.222 6.222l1.414 1.414m12.728 0l-1.414 1.414M6.222 17.778l-1.414 1.414" />
                </svg>
            </span>
        </div>

        {{-- Payment Type --}}
        <div class="relative">
            <label class="block mb-2 text-sm font-semibold text-purple-200">Payment Method</label>
            <select name="payment_type" required
                class="w-full pl-12 p-3 rounded-xl bg-gray-900/60 text-white border border-purple-500 focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-300">
                <option value="cash">Cash</option>
                <option value="installments">Installments</option>
            </select>
            <span class="absolute left-4 top-10 text-blue-400">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.105 0-2 .895-2 2 0 1.105.895 2 2 2s2-.895 2-2c0-1.105-.895-2-2-2z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 2v2m0 16v2m6-10h2M4 12H2m15.364 6.364l1.414 1.414M6.222 6.222l1.414 1.414m12.728 0l-1.414 1.414M6.222 17.778l-1.414 1.414" />
                </svg>
            </span>
        </div>

        {{-- Message --}}
        <div class="relative">
            <label class="block mb-2 text-sm font-semibold text-purple-200">Message</label>
            <textarea name="message" rows="4" placeholder="Write any additional notes or requests..."
                class="w-full pl-12 p-3 rounded-xl bg-gray-900/60 text-white border border-purple-500 focus:outline-none focus:ring-2 focus:ring-pink-500 transition duration-300"></textarea>
            <span class="absolute left-4 top-10 text-pink-400">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8h.01M3 21h18a2 2 0 002-2v-1a2 2 0 00-2-2H3v5z" />
                </svg>
            </span>
        </div>

        {{-- Submit --}}
        <button type="submit"
            class="w-full bg-gradient-to-r from-purple-600 via-blue-500 to-pink-500 hover:from-pink-500 hover:via-purple-500 hover:to-blue-500 hover:scale-105 transform transition-all duration-300 px-6 py-3 rounded-xl text-white font-bold text-lg shadow-lg tracking-wide">
            Send Purchase Request 🚀
        </button>
    </form>
</div>
@endsection
