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
        🛠 Sell Your Spare Part
    </h2>

    {{-- Success Message --}}
    @if(session('success'))
        <div class="bg-green-100 text-green-800 p-3 rounded mb-4">{{ session('success') }}</div>
    @endif

    {{-- Error Messages --}}
    @if($errors->any())
        <div class="bg-red-100 text-red-800 p-3 rounded mb-4">
            <ul class="list-disc pl-5">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Form --}}
    <form action="{{ route('spare-parts.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf

        {{-- Part Name --}}
        <div class="relative">
            <label class="block mb-2 text-sm font-semibold text-purple-200">Part Name</label>
            <input type="text" name="name" value="{{ old('name') }}" placeholder="e.g. Brake Pad"
                class="w-full pl-12 p-3 rounded-xl bg-gray-900/60 text-white border border-purple-500 focus:outline-none focus:ring-2 focus:ring-pink-500 transition duration-300" required>
            <span class="absolute left-4 top-10 text-pink-400">
                <i class="fas fa-cog"></i>
            </span>
        </div>

        {{-- Description --}}
        <div class="relative">
            <label class="block mb-2 text-sm font-semibold text-purple-200">Description</label>
            <textarea name="description" rows="4" placeholder="Describe the spare part..."
                class="w-full pl-12 p-3 rounded-xl bg-gray-900/60 text-white border border-purple-500 focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-300">{{ old('description') }}</textarea>
            <span class="absolute left-4 top-10 text-blue-400">
                <i class="fas fa-align-left"></i>
            </span>
        </div>

        {{-- Price & Condition --}}
        <div class="grid grid-cols-2 gap-4">
            <div class="relative">
                <label class="block mb-2 text-sm font-semibold text-purple-200">Price ($)</label>
                <input type="number" step="0.01" name="price" value="{{ old('price') }}" placeholder="Optional"
                    class="w-full pl-12 p-3 rounded-xl bg-gray-900/60 text-white border border-purple-500 focus:outline-none focus:ring-2 focus:ring-pink-500 transition duration-300">
                <span class="absolute left-4 top-10 text-pink-300">
                    <i class="fas fa-dollar-sign"></i>
                </span>
            </div>

            <div class="relative">
                <label class="block mb-2 text-sm font-semibold text-purple-200">Condition</label>
                <select name="condition"
                    class="w-full pl-12 p-3 rounded-xl bg-gray-900/60 text-white border border-purple-500 focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-300">
                    <option value="used" {{ old('condition') == 'used' ? 'selected' : '' }}>Used</option>
                    <option value="new" {{ old('condition') == 'new' ? 'selected' : '' }}>New</option>
                </select>
                <span class="absolute left-4 top-10 text-blue-300">
                    <i class="fas fa-tag"></i>
                </span>
            </div>
        </div>

        {{-- Quantity --}}
        <div class="relative">
            <label class="block mb-2 text-sm font-semibold text-purple-200">Quantity</label>
            <input type="number" name="quantity" min="1" value="{{ old('quantity', 1) }}" 
                class="w-24 pl-12 p-3 rounded-xl bg-gray-900/60 text-white border border-purple-500 focus:outline-none focus:ring-2 focus:ring-pink-500 transition duration-300">
            <span class="absolute left-4 top-10 text-purple-400">
                <i class="fas fa-sort-numeric-up"></i>
            </span>
        </div>

        {{-- Images --}}
        <div class="relative">
            <label class="block mb-2 text-sm font-semibold text-purple-200">Part Images</label>
            <input type="file" name="images[]" multiple accept="image/*"
                class="w-full pl-12 p-3 rounded-xl bg-gray-900/60 text-white border border-purple-500 focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-300">
            <span class="absolute left-4 top-10 text-pink-400">
                <i class="fas fa-image"></i>
            </span>
        </div>

        {{-- Submit --}}
        <button type="submit"
            class="w-full bg-gradient-to-r from-purple-600 via-blue-500 to-pink-500 hover:from-pink-500 hover:via-purple-500 hover:to-blue-500 hover:scale-105 transform transition-all duration-300 px-6 py-3 rounded-xl text-white font-bold text-lg shadow-lg tracking-wide">
            Upload Part 
        </button>
    </form>
</div>
@endsection
