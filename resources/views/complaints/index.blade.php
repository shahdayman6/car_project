@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto mt-10 p-6 bg-gray-900 text-white rounded-lg shadow-lg">
    <h2 class="text-2xl font-bold mb-6">Customer Complaints</h2>

    @if($complaints->count() > 0)
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="border-b border-gray-700">
                    <th class="py-2 px-4">User</th>
                    <th class="py-2 px-4">Message</th>
                    <th class="py-2 px-4">Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach($complaints as $complaint)
                    <tr class="border-b border-gray-700">
                        <td class="py-2 px-4">{{ $complaint->user->name }} ({{ $complaint->user->email }})</td>
                        <td class="py-2 px-4">{{ $complaint->message }}</td>
                        <td class="py-2 px-4">{{ $complaint->created_at->format('Y-m-d H:i') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{ $complaints->links() }}
    @else
        <p>No complaints submitted yet.</p>
    @endif
</div>
@endsection
