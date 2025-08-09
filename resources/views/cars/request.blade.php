@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto p-6 bg-gray-900 text-white rounded-xl shadow-xl">
    <h2 class="text-2xl font-bold mb-4">Tell Us What You're Looking For</h2>

    <form method="POST" action="{{ route('cars.request.submit') }}">
        @csrf
        
        <div class="mb-4">
            <label class="block mb-1">Car Brand</label>
            <input type="text" name="brand" required placeholder="e.g. Toyota" class="w-full p-2 rounded bg-gray-800 text-white border border-gray-600">
        </div>

        <div class="mb-4">
            <label class="block mb-1">Car Model</label>
            <input type="text" name="model" required placeholder="e.g. Corolla" class="w-full p-2 rounded bg-gray-800 text-white border border-gray-600">
        </div>

        <div class="mb-4">
            <label class="block mb-1">Manufacture Year</label>
            <input type="number" name="year" required placeholder="e.g. 2022" class="w-full p-2 rounded bg-gray-800 text-white border border-gray-600">
        </div>

        <div class="mb-4">
            <label class="block mb-1">Preferred Color</label>
            <input type="text" name="color" placeholder="Optional" class="w-full p-2 rounded bg-gray-800 text-white border border-gray-600">
        </div>

        <div class="mb-4">
            <label class="block mb-1">Minimum Budget ($)</label>
            <input type="number" name="min_price" placeholder="Optional" class="w-full p-2 rounded bg-gray-800 text-white border border-gray-600">
        </div>

        <div class="mb-4">
            <label class="block mb-1">Maximum Budget ($)</label>
            <input type="number" name="max_price" placeholder="Optional" class="w-full p-2 rounded bg-gray-800 text-white border border-gray-600">
        </div>

        <div class="mb-4">
            <label class="block mb-1">Additional Notes</label>
            <textarea name="message" rows="4" placeholder="Any specific requirements..." class="w-full p-2 rounded bg-gray-800 text-white border border-gray-600"></textarea>
        </div>

        <button type="submit" class="bg-green-600 hover:bg-green-800 px-6 py-2 rounded text-white font-bold">Search Car</button>
    </form>
</div>
@endsection



