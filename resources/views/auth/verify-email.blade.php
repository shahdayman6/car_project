<x-guest-layout>
    <div class="max-w-lg mx-auto p-10 mt-16 bg-white/10 backdrop-blur-xl border border-white/20 text-white rounded-3xl shadow-2xl">

        {{-- العنوان --}}
        <h2 class="text-3xl font-extrabold mb-6 text-center bg-clip-text text-transparent bg-gradient-to-r from-purple-300 via-blue-300 to-pink-300 drop-shadow-lg tracking-wide">
            📧 Verify Your Email
        </h2>

        {{-- رسالة الترحيب --}}
        <p class="mb-4 text-sm text-gray-300 leading-relaxed">
            {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
        </p>

        {{-- تنبيه نجاح إرسال الرابط --}}
        @if (session('status') == 'verification-link-sent')
            <div class="mb-4 font-medium text-sm text-green-400 bg-green-900/30 border border-green-500 p-3 rounded-xl">
                {{ __('A new verification link has been sent to the email address you provided during registration.') }}
            </div>
        @endif

        <div class="mt-6 flex items-center justify-between space-x-4">
            {{-- زر إعادة إرسال رابط التحقق --}}
            <form method="POST" action="{{ route('verification.send') }}" class="flex-1">
                @csrf
                <button 
                    type="submit" 
                    class="w-full bg-gradient-to-r from-purple-600 via-blue-500 to-pink-500 hover:from-pink-500 hover:via-purple-500 hover:to-blue-500 hover:scale-105 transform transition-all duration-300 px-6 py-3 rounded-xl text-white font-bold shadow-lg tracking-wide"
                >
                    {{ __('Resend Verification Email') }}
                </button>
            </form>

            {{-- زر تسجيل الخروج --}}
            <form method="POST" action="{{ route('logout') }}" class="flex-1">
                @csrf
                <button 
                    type="submit" 
                    class="w-full bg-gray-800 hover:bg-gray-700 px-6 py-3 rounded-xl text-white font-bold transition-all duration-300 shadow-lg tracking-wide"
                >
                    {{ __('Log Out') }}
                </button>
            </form>
        </div>
    </div>
</x-guest-layout>
