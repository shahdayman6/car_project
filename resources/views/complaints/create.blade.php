@extends('layouts.app')

@section('content')
<div class="max-w-lg mx-auto mt-16 p-8 bg-gradient-to-r from-purple-900 via-indigo-900 to-blue-900 rounded-2xl shadow-2xl text-white">
    <h2 class="text-3xl font-extrabold mb-6 text-center tracking-wide drop-shadow-lg">
        Submit a Complaint
    </h2>

    @if(session('success'))
        <div class="bg-green-500 bg-opacity-90 p-3 rounded mb-6 text-center font-semibold shadow-md">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('complaints.store') }}" method="POST" class="space-y-6">
        @csrf
        <textarea
            name="message"
            rows="6"
            required
            placeholder="Write your complaint here..."
            class="w-full resize-none rounded-lg bg-gray-800 bg-opacity-70 p-4 placeholder-gray-400 text-white shadow-inner focus:outline-none focus:ring-4 focus:ring-purple-500 transition"
        ></textarea>

        @error('message')
            <p class="text-red-400 text-sm font-medium">{{ $message }}</p>
        @enderror

        <button
            type="submit"
            class="w-full py-3 bg-gradient-to-r from-purple-600 to-purple-700 hover:from-purple-700 hover:to-purple-800 active:scale-95 rounded-lg text-lg font-semibold shadow-lg focus:outline-none focus:ring-4 focus:ring-purple-400 transition-transform transform hover:scale-105"
        >
            Submit
        </button>
    </form>
</div>
@endsection
