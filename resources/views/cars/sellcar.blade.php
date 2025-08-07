@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto mt-12 bg-gray-900 text-white p-10 rounded-2xl shadow-2xl">
    <h2 class="text-4xl font-bold text-purple-500 mb-10 text-center">🚗 Sell Your Car</h2>

    <form 
        action="{{ route('cars.store') }}" 
        method="POST" 
        enctype="multipart/form-data"
        class="space-y-8"
    >
        @csrf

        <!-- ✅ تحميل الصور ومعاينة متعددة -->
        <div>
            <label class="block mb-3 text-sm font-bold text-gray-300">Upload Images</label>
            <input 
                type="file" 
                name="images[]" 
                accept="image/*" 
                multiple 
                onchange="previewImages(event)" 
                class="block w-full text-white bg-gray-800 border border-purple-700 rounded-lg px-4 py-2 cursor-pointer hover:bg-purple-700 transition"
                required
            >

            <div id="imagePreviewContainer" class="mt-4 flex flex-wrap gap-4"></div>
        </div>

        <!-- ✅ الحقول -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Brand -->
            <div>
                <label class="block mb-2 text-sm font-bold text-gray-300">Brand</label>
                <input type="text" name="brand" required class="w-full px-4 py-3 rounded bg-gray-800 text-white focus:ring-2 focus:ring-purple-500">
            </div>

            <!-- Model -->
            <div>
                <label class="block mb-2 text-sm font-bold text-gray-300">Model</label>
                <input type="text" name="model" required class="w-full px-4 py-3 rounded bg-gray-800 text-white focus:ring-2 focus:ring-purple-500">
            </div>

            <!-- Year -->
            <div>
                <label class="block mb-2 text-sm font-bold text-gray-300">Year</label>
                <input type="number" name="year" required class="w-full px-4 py-3 rounded bg-gray-800 text-white focus:ring-2 focus:ring-purple-500">
            </div>

            <!-- Price -->
            <div>
                <label class="block mb-2 text-sm font-bold text-gray-300">Price ($)</label>
                <input type="number" name="price" required class="w-full px-4 py-3 rounded bg-gray-800 text-white focus:ring-2 focus:ring-purple-500">
            </div>
        </div>

        <!-- ✅ زر الإرسال -->
        <div class="text-center mt-10">
            <button type="submit" class="bg-purple-700 hover:bg-purple-900 px-10 py-3 text-lg rounded-full font-bold shadow-lg transition duration-300">
                🚀 Submit Car
            </button>
        </div>
    </form>
</div>

<!-- ✅ سكربت معاينة الصور -->
<script>
    function previewImages(event) {
        const files = event.target.files;
        const container = document.getElementById('imagePreviewContainer');
        container.innerHTML = ''; // تفريغ الصور السابقة

        Array.from(files).forEach(file => {
            const img = document.createElement('img');
            img.src = URL.createObjectURL(file);
            img.classList.add('w-32', 'h-24', 'object-cover', 'rounded', 'border-2', 'border-purple-500', 'shadow-md');
            container.appendChild(img);
        });
    }
</script>
@endsection