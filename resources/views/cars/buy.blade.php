@extends('layouts.app')

@section('content')
<div 
    x-data="{ show: true }"
    class="max-w-xl mx-auto mt-16 p-8 bg-gradient-to-br from-gray-900 via-gray-800 to-gray-900 text-white rounded-3xl shadow-2xl"
    x-show="show"
    x-transition.duration.700ms
>
    {{-- Toast Success Message --}}
    @if (session('success'))
        <div 
            x-data="{ visible: true }"
            x-show="visible"
            x-transition
            x-init="setTimeout(() => visible = false, 4000)"
            class="mb-6 p-4 bg-green-700 text-white rounded-xl shadow-xl text-center font-semibold"
        >
            ✅ {{ session('success') }}
        </div>
    @endif

    <h2 class="text-3xl font-extrabold mb-8 text-center text-green-400 flex items-center justify-center gap-2">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 13l4 4L21 5" />
        </svg>
        Purchase Request for {{ $car->name }}
    </h2>

    <form method="POST" action="{{ route('cars.buy.submit', $car->id) }}" class="space-y-6">
        @csrf

        {{-- Name --}}
        <div>
            <label class="block mb-2 text-sm font-semibold text-gray-300">Your Name</label>
            <div class="relative">
                <input type="text" name="name" required
                    class="w-full pl-10 p-3 rounded-xl bg-gray-800 text-white border border-gray-700 focus:outline-none focus:ring-2 focus:ring-green-500 transition duration-300">
                <div class="absolute left-3 top-3 text-gray-400">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M5.121 17.804A13.937 13.937 0 0112 15c2.89 0 5.566.915 7.879 2.804M15 10a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                </div>
            </div>
        </div>

        {{-- Phone --}}
        <div>
            <label class="block mb-2 text-sm font-semibold text-gray-300">Phone Number</label>
            <div class="relative">
                <input type="text" name="phone" required
                    class="w-full pl-10 p-3 rounded-xl bg-gray-800 text-white border border-gray-700 focus:outline-none focus:ring-2 focus:ring-green-500 transition duration-300">
                <div class="absolute left-3 top-3 text-gray-400">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 5h2l3.6 7.59-1.35 2.45A1 1 0 008 17h9a1 1 0 001-1v-2H9.42l1.1-2h5.45a1 1 0 00.9-.55l3.1-6.22A1 1 0 0019 5H5z" />
                    </svg>
                </div>
            </div>
        </div>

        {{-- Quantity --}}
        <div>
            <label class="block mb-2 text-sm font-semibold text-gray-300">Number of Cars</label>
            <input type="number" name="quantity" min="1" value="1" required
                class="w-full p-3 rounded-xl bg-gray-800 text-white border border-gray-700 focus:outline-none focus:ring-2 focus:ring-green-500 transition duration-300">
        </div>

        {{-- Payment Type --}}
        <div>
            <label class="block mb-2 text-sm font-semibold text-gray-300">Payment Method</label>
            <select name="payment_type" required
                class="w-full p-3 rounded-xl bg-gray-800 text-white border border-gray-700 focus:outline-none focus:ring-2 focus:ring-green-500 transition duration-300">
                <option value="cash">Cash</option>
                <option value="installments">Installments</option>
            </select>
        </div>

        {{-- Message --}}
        <div>
            <label class="block mb-2 text-sm font-semibold text-gray-300">Message</label>
            <textarea name="message" rows="4"
                class="w-full p-3 rounded-xl bg-gray-800 text-white border border-gray-700 focus:outline-none focus:ring-2 focus:ring-green-500 transition duration-300"
                placeholder="Write any additional notes or requests..."></textarea>
        </div>

        {{-- Submit --}}
        <button type="submit"
            class="w-full bg-green-600 hover:bg-green-700 hover:scale-105 transform transition-all duration-300 px-6 py-3 rounded-xl text-white font-bold text-lg shadow-md">
            Send Purchase Request 🚀
        </button>
    </form>
</div>
@endsection