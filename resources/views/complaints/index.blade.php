@extends('layouts.app')

@section('content')
<div 
    class="max-w-6xl mx-auto mt-16 p-10 bg-white/10 backdrop-blur-xl border border-white/20 text-white rounded-3xl shadow-2xl"
>
    <h2 class="text-4xl font-extrabold mb-12 text-center bg-clip-text text-transparent bg-gradient-to-r from-purple-300 via-blue-300 to-pink-300 drop-shadow-lg tracking-wide">
        Customer Complaints
    </h2>

    @if($complaints->count() > 0)
        <div class="overflow-x-auto rounded-xl border border-purple-500/50 shadow-lg">
            <table class="min-w-full divide-y divide-purple-700">
                <thead class="bg-gradient-to-r from-purple-800 to-pink-800 text-white">
                    <tr>
                        <th class="py-3 px-6 text-left text-sm font-semibold tracking-wide uppercase">User</th>
                        <th class="py-3 px-6 text-left text-sm font-semibold tracking-wide uppercase">Message</th>
                        <th class="py-3 px-6 text-left text-sm font-semibold tracking-wide uppercase">Date</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-purple-700 bg-gray-900/60">
                    @foreach($complaints as $complaint)
                        <tr class="hover:bg-purple-800/50 transition-colors duration-300">
                            <td class="py-4 px-6 whitespace-nowrap font-semibold">
                                {{ $complaint->user->name }}<br>
                                <span class="text-purple-300 text-xs font-normal">{{ $complaint->user->email }}</span>
                            </td>
                            <td class="py-4 px-6">{{ $complaint->message }}</td>
                            <td class="py-4 px-6 whitespace-nowrap text-sm text-purple-300">{{ $complaint->created_at->format('Y-m-d H:i') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-8 flex justify-center">
            {{ $complaints->links() }}
        </div>
    @else
        <p class="text-center text-purple-300 italic">No complaints submitted yet.</p>
    @endif
</div>
@endsection
