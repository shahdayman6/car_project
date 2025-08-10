<x-guest-layout>
    <div class="max-w-lg mx-auto p-10 mt-16 bg-white/10 backdrop-blur-xl border border-white/20 text-white rounded-3xl shadow-2xl">

        {{-- العنوان --}}
        <h2 class="text-3xl font-extrabold mb-6 text-center bg-clip-text text-transparent bg-gradient-to-r from-purple-300 via-blue-300 to-pink-300 drop-shadow-lg tracking-wide">
            🔑 Forgot Your Password?
        </h2>

        <p class="mb-6 text-sm text-gray-300 text-center">
            No problem! Just enter your email address, and we’ll send you a password reset link.
        </p>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('password.email') }}" class="space-y-6">
            @csrf

            <!-- Email Address -->
            <div>
                <x-input-label for="email" :value="__('Email')" class="text-purple-300 font-semibold" />
                <input 
                    id="email" 
                    type="email" 
                    name="email" 
                    value="{{ old('email') }}" 
                    required 
                    autofocus
                    class="w-full pl-4 p-3 rounded-xl bg-gray-900/60 text-white border border-purple-500 focus:outline-none focus:ring-2 focus:ring-pink-500 transition duration-300"
                    placeholder="Enter your email"
                />
                <x-input-error :messages="$errors->get('email')" class="mt-2 text-pink-400" />
            </div>

            <!-- Submit Button -->
            <div class="text-center">
                <button 
                    type="submit" 
                    class="w-full bg-gradient-to-r from-purple-600 via-blue-500 to-pink-500 hover:from-pink-500 hover:via-purple-500 hover:to-blue-500 hover:scale-105 transform transition-all duration-300 px-6 py-3 rounded-xl text-white font-bold text-lg shadow-lg tracking-wide"
                >
                    Email Password Reset Link
                </button>
            </div>
        </form>
    </div>
</x-guest-layout>
