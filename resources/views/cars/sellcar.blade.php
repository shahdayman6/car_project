@extends('layouts.app')

@section('content')
<div 
    class="max-w-4xl mx-auto p-10 mt-16 bg-white/10 backdrop-blur-xl border border-white/20 text-white rounded-3xl shadow-2xl"
>
    {{-- Title --}}
    <h2 class="text-4xl font-extrabold mb-10 text-center bg-clip-text text-transparent bg-gradient-to-r from-purple-300 via-blue-300 to-pink-300 drop-shadow-lg tracking-wide">
        🚗 Sell Your Car
    </h2>

    {{-- Form --}}
    <form action="{{ route('cars.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
        @csrf

        {{-- Car Images Upload --}}
        <div>
            <label class="block mb-3 text-purple-300 font-semibold">Car Images</label>
            <input 
                type="file" 
                name="images[]" 
                accept="image/*" 
                multiple 
                onchange="previewImages(event)" 
                class="w-full bg-gray-900/60 text-white border border-purple-500 rounded-xl p-3 cursor-pointer focus:outline-none focus:ring-2 focus:ring-pink-500 transition duration-300"
                required
            >
            <div id="imagePreviewContainer" class="mt-4 flex flex-wrap gap-3"></div>
        </div>

        {{-- Input Fields --}}
        @foreach (['Brand' => 'brand', 'Model' => 'model', 'Year' => 'year', 'Price ($)' => 'price'] as $label => $name)
            <div class="relative">
                <label class="block mb-2 text-purple-300 font-semibold">{{ $label }}</label>
                <input 
                    type="{{ in_array($name, ['year', 'price']) ? 'number' : 'text' }}" 
                    name="{{ $name }}" 
                    required 
                    class="w-full pl-4 p-3 rounded-xl bg-gray-900/60 text-white border border-purple-500 focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-300"
                    placeholder="Enter {{ strtolower($label) }}"
                >
            </div>
        @endforeach

        {{-- Submit Button --}}
        <div class="text-center mt-6">
            <button 
                type="submit" 
                class="w-full bg-gradient-to-r from-purple-600 via-blue-500 to-pink-500 hover:from-pink-500 hover:via-purple-500 hover:to-blue-500 hover:scale-105 transform transition-all duration-300 px-6 py-3 rounded-xl text-white font-bold text-lg shadow-lg tracking-wide"
            >
                Submit
            </button>
        </div>
    </form>
</div>

<script>
    function previewImages(event) {
        const files = event.target.files;
        const container = document.getElementById('imagePreviewContainer');
        container.innerHTML = '';

        Array.from(files).forEach(file => {
            const img = document.createElement('img');
            img.src = URL.createObjectURL(file);
            img.classList.add('w-24', 'h-20', 'object-cover', 'rounded-xl', 'shadow-lg');
            container.appendChild(img);
        });
    }
</script>
@endsection
