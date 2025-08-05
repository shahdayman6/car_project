<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-black via-gray-900 to-purple-900 p-6">
        <div class="bg-gray-900/80 backdrop-blur-xl p-10 rounded-3xl shadow-[0_0_30px_rgba(128,0,255,0.4)] w-full max-w-md text-white animate-fade-in space-y-6">

            <!-- نموذج التسجيل -->
            <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data" class="space-y-5">
                @csrf

                 <!-- صورة الملف الشخصي -->
            <div class="flex justify-center">
                <label for="imageUpload" class="relative group cursor-pointer">
                    <img id="profileImagePreview"
                         src="{{ asset('images/default-user-bw.png.jpg') }}"
                         alt="Profile Image"
                         class="w-32 h-32 rounded-full border-4 border-purple-500 object-cover shadow-lg transition duration-300 group-hover:opacity-70" />
                    <input id="imageUpload" type="file" name="image" class="hidden" onchange="previewImage(event)" />
                    <div class="absolute inset-0 flex items-center justify-center rounded-full opacity-0 group-hover:opacity-100 transition bg-black/50 text-white text-xs font-bold">
                        تغيير الصورة
                    </div>
                </label>
            </div>
                <!-- الاسم -->
                <div>
                    <x-input-label for="name" :value="('Name')" class="text-purple-400 font-bold" />
                    <x-text-input id="name" name="name" type="text" required autofocus :value="old('name')"
                                  class="w-full mt-1 bg-black/40 border border-purple-700 text-white placeholder-gray-400
                                         focus:border-purple-500 focus:ring-purple-500 focus:ring-1" />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <!-- البريد -->
                <div>
                    <x-input-label for="email" :value="('Email')" class="text-purple-400 font-bold" />
                    <x-text-input id="email" name="email" type="email" required :value="old('email')"
                                  class="w-full mt-1 bg-black/40 border border-purple-700 text-white placeholder-gray-400
                                         focus:border-purple-500 focus:ring-purple-500 focus:ring-1" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- كلمة المرور -->
                <div>
                    <x-input-label for="password" :value="('Password')" class="text-purple-400 font-bold" />
                    <x-text-input id="password" name="password" type="password" required
                                  class="w-full mt-1 bg-black/40 border border-purple-700 text-white placeholder-gray-400
                                         focus:border-purple-500 focus:ring-purple-500 focus:ring-1" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- تأكيد كلمة المرور -->
                <div>
                    <x-input-label for="password_confirmation" :value="('Confirm Password')" class="text-purple-400 font-bold" />
                    <x-text-input id="password_confirmation" name="password_confirmation" type="password" required
                                  class="w-full mt-1 bg-black/40 border border-purple-700 text-white placeholder-gray-400
                                         focus:border-purple-500 focus:ring-purple-500 focus:ring-1" />
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>

                <!-- زر التسجيل -->
                <div class="flex justify-between items-center pt-4">
                    <a href="{{ route('login') }}" class="text-sm text-purple-300 hover:underline">
                        {{ __('Already registered?') }}
                    </a>
                    <x-primary-button class="bg-purple-600 hover:bg-purple-700 transition px-6 py-2 shadow-lg shadow-purple-500/30">
                        {{ __('Register') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
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