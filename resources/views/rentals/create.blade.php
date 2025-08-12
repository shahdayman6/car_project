@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto p-10 mt-8 bg-white/10 backdrop-blur-xl border border-white/20 text-white rounded-3xl shadow-2xl">
    <h2 class="text-3xl font-extrabold mb-6 text-center">Create Rental Listing</h2>

    @if($errors->any())
        <div class="bg-red-100 text-red-800 p-3 rounded mb-4">
            <ul class="list-disc pl-5">
                @foreach($errors->all() as $err)
                    <li>{{ $err }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('rentals.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
        @csrf

        <div>
            <label class="block mb-2 text-sm font-semibold text-purple-200">Title</label>
            <input type="text" name="title" value="{{ old('title') }}" required
                   class="w-full p-3 rounded-xl bg-gray-900/60 border border-purple-500 focus:ring-2 focus:ring-pink-500">
        </div>

        <div>
            <label class="block mb-2 text-sm font-semibold text-purple-200">Description</label>
            <textarea name="description" rows="4"
                      class="w-full p-3 rounded-xl bg-gray-900/60 border border-purple-500 focus:ring-2 focus:ring-blue-500">{{ old('description') }}</textarea>
        </div>

        <div class="grid grid-cols-2 gap-4">
            <div>
                <label class="block mb-2 text-sm font-semibold text-purple-200">Price per day ($)</label>
                <input type="number" step="0.01" name="price_per_day" value="{{ old('price_per_day') ?? 0 }}" required
                       class="w-full p-3 rounded-xl bg-gray-900/60 border border-purple-500">
            </div>

            <div>
                <label class="block mb-2 text-sm font-semibold text-purple-200">Location</label>
                <input type="text" name="location" value="{{ old('location') }}"
                       class="w-full p-3 rounded-xl bg-gray-900/60 border border-purple-500">
            </div>
        </div>

        <div>
            <label class="block mb-2 text-sm font-semibold text-purple-200">Images (optional)</label>
            <input type="file" name="images[]" multiple accept="image/*" class="w-full">
        </div>

        <div>
            <button type="submit"
                    class="w-full bg-gradient-to-r from-purple-600 via-blue-500 to-pink-500 px-6 py-3 rounded-xl text-white font-bold">
                Publish Rental
            </button>
        </div>
    </form>
</div>
@endsection
