@extends('layouts.app')

@section('content')
<div 
    class="max-w-5xl mx-auto p-10 mt-16 bg-white/10 backdrop-blur-xl border border-white/20 text-white rounded-3xl shadow-2xl"
>
    <h2 class="text-4xl font-extrabold mb-12 text-center bg-clip-text text-transparent bg-gradient-to-r from-purple-300 via-blue-300 to-pink-300 drop-shadow-lg tracking-wide">
        👤 My Profile
    </h2>

    {{-- Cars I Sold --}}
    <section class="mb-16">
        <h3 class="text-3xl font-semibold mb-6 text-purple-300">Cars I Sold</h3>
        <div class="overflow-x-auto rounded-xl border border-purple-500/50 shadow-lg">
            <table class="min-w-full divide-y divide-purple-700">
                <thead class="bg-gradient-to-r from-purple-800 to-pink-800 text-white">
                    <tr>
                        @foreach (['Brand', 'Model', 'Year', 'Price', 'Actions'] as $header)
                            <th scope="col" class="px-6 py-3 text-left text-sm font-semibold tracking-wide">{{ $header }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody class="divide-y divide-purple-700 bg-gray-900/60">
                    @forelse($carsSold as $car)
                        <tr class="hover:bg-purple-800/50 transition">
                            <td class="px-6 py-4 whitespace-nowrap">{{ $car->brand }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $car->model }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $car->year }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $car->price }} $</td>
                            <td class="px-6 py-4 whitespace-nowrap space-x-2">
                                <a href="{{ route('cars.edit', $car->id) }}" class="inline-block px-3 py-1 bg-yellow-500 rounded-lg text-black font-semibold hover:bg-yellow-600 transition">Edit</a>
                                <form action="{{ route('profile.cars.delete', $car->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Are you sure?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="px-3 py-1 bg-red-600 rounded-lg font-semibold hover:bg-red-700 transition">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-4 text-center text-gray-400 italic">No cars sold yet.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>

    {{-- Cars I Bought --}}
    <section>
        <h3 class="text-3xl font-semibold mb-6 text-purple-300">Cars I Bought</h3>
        <div class="overflow-x-auto rounded-xl border border-purple-500/50 shadow-lg">
            <table class="min-w-full divide-y divide-purple-700">
                <thead class="bg-gradient-to-r from-purple-800 to-pink-800 text-white">
                    <tr>
                        @foreach (['Car', 'Quantity', 'Payment Type', 'Actions'] as $header)
                            <th scope="col" class="px-6 py-3 text-left text-sm font-semibold tracking-wide">{{ $header }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody class="divide-y divide-purple-700 bg-gray-900/60">
                    @forelse($carsBought as $purchase)
                        <tr class="hover:bg-purple-800/50 transition">
                            <td class="px-6 py-4 whitespace-nowrap">{{ $purchase->car->brand ?? '' }} {{ $purchase->car->model ?? '' }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $purchase->quantity }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $purchase->payment_type }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <form action="{{ route('profile.purchases.delete', $purchase->id) }}" method="POST" onsubmit="return confirm('Are you sure?')" class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="px-3 py-1 bg-red-600 rounded-lg font-semibold hover:bg-red-700 transition">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-4 text-center text-gray-400 italic">No purchases yet.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>
    {{-- Spare Parts I Sold --}}
<section class="mt-16">
    <h3 class="text-3xl font-semibold mb-6 text-purple-300">Spare Parts I Sold</h3>
    <div class="overflow-x-auto rounded-xl border border-purple-500/50 shadow-lg">
        <table class="min-w-full divide-y divide-purple-700">
            <thead class="bg-gradient-to-r from-purple-800 to-pink-800 text-white">
                <tr>
                    @foreach (['Name', 'Condition', 'Price', 'Quantity', 'Actions'] as $header)
                        <th scope="col" class="px-6 py-3 text-left text-sm font-semibold tracking-wide">{{ $header }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody class="divide-y divide-purple-700 bg-gray-900/60">
                @forelse($sparePartsSold as $part)
                    <tr class="hover:bg-purple-800/50 transition">
                        <td class="px-6 py-4 whitespace-nowrap">{{ $part->name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ ucfirst($part->condition) }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $part->price ?? 'N/A' }} $</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $part->quantity }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <form action="{{ route('profile.spare-parts.delete', $part->id) }}" method="POST" onsubmit="return confirm('Are you sure?')" class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="px-3 py-1 bg-red-600 rounded-lg font-semibold hover:bg-red-700 transition">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-4 text-center text-gray-400 italic">No spare parts sold yet.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</section>

</div>
@endsection
