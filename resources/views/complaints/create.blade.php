@extends('layouts.app')

@section('content')
<div class="max-w-md mx-auto mt-10 p-6 bg-gray-800 text-white rounded-lg shadow-lg">
    <h2 class="text-xl font-bold mb-4">Submit a Complaint</h2>

    @if(session('success'))
        <div class="bg-green-600 p-2 mb-4 rounded">{{ session('success') }}</div>
    @endif

    <form action="{{ route('complaints.store') }}" method="POST">
        @csrf
        <textarea name="message" rows="5" required placeholder="Write your complaint here..." class="w-full p-3 rounded bg-gray-700 text-white"></textarea>

        @error('message')
            <p class="text-red-500 mt-2">{{ $message }}</p>
        @enderror

        <button type="submit" class="mt-4 bg-purple-600 px-6 py-2 rounded hover:bg-purple-700 transition">Submit</button>
    </form>
</div>
@endsection
