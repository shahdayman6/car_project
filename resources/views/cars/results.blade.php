@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h2 class="mb-4">Search Results</h2>

    @if($message)
        <div class="alert alert-warning">{{ $message }}</div>
    @endif

    <div class="row">
        @foreach ($data as $car)
            @php
                $imageUrl = "https://loremflickr.com/600/400/" . urlencode($car['make'] . '-' . $car['model']) . ",car";
            @endphp

            <div class="col-md-6 col-lg-4 mb-4">
                <div class="card shadow-sm h-100">
                    <img src="{{ $imageUrl }}" class="card-img-top" alt="Car Image"
                         onerror="this.onerror=null; this.src='https://via.placeholder.com/600x400?text=Image+Unavailable';">
                    <div class="card-body">
                        <h5 class="card-title text-capitalize">
                            {{ $car['make'] }} {{ $car['model'] }} ({{ $car['year'] ?? 'Unknown' }})
                        </h5>
                        <ul class="list-unstyled">
                            <li><strong>Fuel:</strong> {{ $car['fuel_type'] ?? 'N/A' }}</li>
                            <li><strong>Cylinders:</strong> {{ $car['cylinders'] ?? 'N/A' }}</li>

                            @if (!str_contains($car['city_mpg'] ?? '', 'premium'))
                                <li><strong>MPG (City/Highway):</strong> {{ $car['city_mpg'] }} / {{ $car['highway_mpg'] ?? '-' }}</li>
                            @endif

                            <li><strong>Displacement:</strong> {{ $car['displacement'] ?? '-' }}L</li>
                            <li><strong>Class:</strong> {{ $car['class'] ?? 'N/A' }}</li>
                            <li><strong>Drive:</strong> {{ $car['drive'] ?? 'N/A' }}</li>
                            <li><strong>Transmission:</strong> {{ $car['transmission'] ?? 'N/A' }}</li>
                        </ul>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection








