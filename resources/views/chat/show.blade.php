@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto mt-16 p-8 bg-gradient-to-r from-indigo-900 via-purple-900 to-pink-900 rounded-3xl shadow-2xl flex flex-col h-[700px]">

  {{-- العنوان --}}
  <h2 class="text-4xl font-extrabold mb-8 text-white tracking-wide border-b border-white/30 pb-4">
    Chat with <span class="text-yellow-400">{{ $receiver->name }}</span>
  </h2>

  {{-- صندوق الرسائل --}}
  <div class="flex-1 overflow-y-auto mb-8 p-6 bg-gray-900 rounded-2xl shadow-inner scrollbar-thin scrollbar-thumb-pink-600 scrollbar-track-gray-800">
    @foreach($messages as $message)
      <div 
        class="max-w-[65%] px-6 py-4 mb-4 rounded-3xl shadow-lg
          relative
          {{ $message->sender_id == auth()->id() 
            ? 'bg-gradient-to-tr from-purple-700 to-pink-600 ml-auto text-right text-white animate-fade-slide-right' 
            : 'bg-gradient-to-tr from-gray-700 to-gray-900 text-gray-300 animate-fade-slide-left' }}">
        <p class="whitespace-pre-wrap break-words font-medium leading-relaxed">{{ $message->message }}</p>
        <span class="absolute bottom-2 {{ $message->sender_id == auth()->id() ? 'right-4' : 'left-4' }} text-xs opacity-70 italic font-thin tracking-wider">
          {{ $message->created_at->format('h:i A') }}
        </span>
      </div>
    @endforeach
  </div>

  {{-- نموذج الإرسال --}}
  <form action="{{ route('chat.send', $receiver->id) }}" method="POST" class="flex space-x-5">
    @csrf
    <input 
      type="text" 
      name="message" 
      placeholder="Type your message..." 
      required 
      autocomplete="off"
      class="flex-grow rounded-full px-6 py-4 shadow-lg text-gray-900 font-semibold focus:outline-none focus:ring-4 focus:ring-pink-500 focus:ring-opacity-70 transition"
    >
    <button 
      type="submit" 
      class="bg-pink-600 hover:bg-pink-700 active:bg-pink-800 transition rounded-full px-8 py-4 shadow-lg text-white font-bold uppercase tracking-wide select-none focus:outline-none focus:ring-4 focus:ring-pink-500 focus:ring-opacity-70"
    >
      Send
    </button>
  </form>
</div>

<style>
  /* Simple fade + slide animations */
  @keyframes fadeSlideRight {
    0% {
      opacity: 0;
      transform: translateX(20px);
    }
    100% {
      opacity: 1;
      transform: translateX(0);
    }
  }
  @keyframes fadeSlideLeft {
    0% {
      opacity: 0;
      transform: translateX(-20px);
    }
    100% {
      opacity: 1;
      transform: translateX(0);
    }
  }
  .animate-fade-slide-right {
    animation: fadeSlideRight 0.35s ease forwards;
  }
  .animate-fade-slide-left {
    animation: fadeSlideLeft 0.35s ease forwards;
  }

  /* Scrollbar styling */
  .scrollbar-thin {
    scrollbar-width: thin;
    scrollbar-color: #db2777 #1f2937;
  }
  .scrollbar-thin::-webkit-scrollbar {
    width: 8px;
  }
  .scrollbar-thin::-webkit-scrollbar-track {
    background: #1f2937;
    border-radius: 8px;
  }
  .scrollbar-thin::-webkit-scrollbar-thumb {
    background-color: #db2777;
    border-radius: 8px;
  }
</style>
@endsection
