<x-guest-layout>
    <div class="max-w-4xl mx-auto p-10 mt-16 bg-white/10 backdrop-blur-xl border border-white/20 text-white rounded-3xl shadow-2xl">
        
        {{-- عنوان الصفحة --}}
        <h2 class="text-4xl font-extrabold mb-10 text-center bg-clip-text text-transparent bg-gradient-to-r from-purple-300 via-blue-300 to-pink-300 drop-shadow-lg tracking-wide">
            ✨ Create Your Account
        </h2>

        {{-- نموذج التسجيل --}}
        <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data" class="space-y-8">
            @csrf

            {{-- صورة الملف الشخصي --}}
            <div class="flex justify-center">
                <label for="imageUpload" class="relative group cursor-pointer">
                    <img id="profileImagePreview"
                         src="{{ asset('images/default-user-bw.png.jpg') }}"
                         alt="Profile Image"
                         class="w-32 h-32 rounded-full border-4 border-purple-500 object-cover shadow-lg transition duration-300 group-hover:opacity-70" />
                    <input id="imageUpload" type="file" name="image" class="hidden" accept="image/*" onchange="previewImage(event)" />
                    <div class="absolute inset-0 flex items-center justify-center rounded-full opacity-0 group-hover:opacity-100 transition bg-black/50 text-white text-xs font-bold">
                        Change Image
                    </div>
                </label>
            </div>
            <x-input-error :messages="$errors->get('image')" class="mt-2 text-center" />

            {{-- الحقول النصية --}}
            @php
                $fields = [
                    'Name' => ['name' => 'name', 'type' => 'text'],
                    'Email' => ['name' => 'email', 'type' => 'email'],
                    'Password' => ['name' => 'password', 'type' => 'password'],
                    'Confirm Password' => ['name' => 'password_confirmation', 'type' => 'password'],
                ];
            @endphp

            @foreach ($fields as $label => $field)
                <div>
                    <label for="{{ $field['name'] }}" class="block mb-2 text-purple-300 font-semibold">{{ $label }}</label>
                    <input 
                        id="{{ $field['name'] }}"
                        name="{{ $field['name'] }}"
                        type="{{ $field['type'] }}"
                        required
                        @if ($field['type'] !== 'password') value="{{ old($field['name']) }}" @endif
                        class="w-full pl-4 p-3 rounded-xl bg-gray-900/60 text-white border border-purple-500 focus:outline-none focus:ring-2 focus:ring-blue-500 transition duration-300"
                        placeholder="Enter {{ strtolower($label) }}"
                    >
                    <x-input-error :messages="$errors->get($field['name'])" class="mt-2" />
                </div>
            @endforeach

            {{-- زر التسجيل --}}
            <div class="flex justify-between items-center pt-4">
                <a href="{{ route('login') }}" class="text-sm text-purple-300 hover:underline">
                    {{ __('Already registered?') }}
                </a>
                <button 
                    type="submit" 
                    class="bg-gradient-to-r from-purple-600 via-blue-500 to-pink-500 hover:from-pink-500 hover:via-purple-500 hover:to-blue-500 hover:scale-105 transform transition-all duration-300 px-6 py-2 rounded-xl text-white font-bold text-lg shadow-lg tracking-wide"
                >
                    {{ __('Register') }}
                </button>
            </div>
        </form>
    </div>

    <script>
        function previewImage(event) {
            const reader = new FileReader();
            reader.onload = function () {
                const output = document.getElementById('profileImagePreview');
                output.src = reader.result;
            };
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>
</x-guest-layout>
