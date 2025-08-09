@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

<div class="max-w-4xl mx-auto mt-14 bg-gray-900 text-white p-10 rounded-3xl shadow-2xl animate_animated animate_fadeIn">
    <h2 class="text-6xl font-extrabold text-center text-purple-500 mb-12">🚘 Sell Your Car</h2>

    <form 
        action="{{ route('cars.store') }}" 
        method="POST" 
        enctype="multipart/form-data"
        class="space-y-10"
    >
        @csrf

        <!-- ✅ رفع الصور -->
        <div class="max-w-md mx-auto">
            <label class="block mb-3 text-lg font-bold text-gray-300">📸 Upload Car Images</label>
            <input 
                type="file" 
                name="images[]" 
                accept="image/*" 
                multiple 
                onchange="previewImages(event)" 
                class="w-full text-sm bg-gray-800 text-white border border-purple-700 rounded-xl px-4 py-3 cursor-pointer hover:bg-purple-700 transition"
                required
            >

            <div id="imagePreviewContainer" class="mt-4 flex flex-wrap gap-3"></div>
        </div>

        <!-- ✅ الحقول -->
        <div class="space-y-8 max-w-md mx-auto">
            <!-- Brand -->
            <div>
                <label class="block mb-2 text-lg font-bold text-gray-300">🏷 Brand</label>
                <input 
                    type="text" 
                    name="brand" 
                    required 
                    class="w-full px-4 py-3 rounded-lg bg-gray-800 text-white text-base focus:ring-2 focus:ring-purple-500"
                >
            </div>

            <!-- Model -->
            <div>
                <label class="block mb-2 text-lg font-bold text-gray-300">🚗 Model</label>
                <input 
                    type="text" 
                    name="model" 
                    required 
                    class="w-full px-4 py-3 rounded-lg bg-gray-800 text-white text-base focus:ring-2 focus:ring-purple-500"
                >
            </div>

            <!-- Year -->
            <div>
                <label class="block mb-2 text-lg font-bold text-gray-300">📅 Year</label>
                <input 
                    type="number" 
                    name="year" 
                    required 
                    class="w-full px-4 py-3 rounded-lg bg-gray-800 text-white text-base focus:ring-2 focus:ring-purple-500"
                >
            </div>

            <!-- Price -->
            <div>
                <label class="block mb-2 text-lg font-bold text-gray-300">💰 Price ($)</label>
                <input 
                    type="number" 
                    name="price" 
                    required 
                    class="w-full px-4 py-3 rounded-lg bg-gray-800 text-white text-base focus:ring-2 focus:ring-purple-500"
                >
            </div>
        </div>

        <!-- ✅ زر الإرسال -->
        <div class="text-center mt-12">
            <button type="submit" class="bg-purple-700 hover:bg-purple-900 px-10 py-3 text-lg rounded-full font-bold shadow-xl transition duration-300">
                🚀 Submit Car
            </button>
        </div>
    </form>
</div>

<!-- ✅ سكربت عرض الصور -->
<script>
    function previewImages(event) {
        const files = event.target.files;
        const container = document.getElementById('imagePreviewContainer');
        container.innerHTML = '';

        Array.from(files).forEach(file => {
            const img = document.createElement('img');
            img.src = URL.createObjectURL(file);
            img.classList.add('w-24', 'h-20', 'object-cover', 'rounded-lg', 'border-2', 'border-purple-500', 'shadow-md');
            container.appendChild(img);
        });
    }
</script>
@endsection