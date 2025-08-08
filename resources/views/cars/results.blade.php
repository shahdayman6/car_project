<!-- resources/views/cars/results.blade.php -->

@extends('layouts.app') {{-- أو حسب اسم الـ layout عندك --}}

@section('content')

    {{-- عرض رسالة الخطأ من السيشن --}}
    @if(session('error'))
        <div style="color: red; font-weight: bold; margin-bottom: 10px;">
            {{ session('error') }}
        </div>
    @endif

    {{-- عرض رسالة مخصصة --}}
    @if(!empty($message))
        <div style="color: orange; font-weight: bold; margin-bottom: 10px;">
            {{ $message }}
        </div>
    @endif

    {{-- عرض بيانات السيارات --}}
    @if(!empty($data) && is_array($data) && count($data) > 0)
        @foreach($data as $car)
            <div style="margin-bottom: 20px; padding: 15px; border: 1px solid #ccc; border-radius: 5px;">
                <p><strong>Brand:</strong> {{ $car['brand'] ?? 'N/A' }}</p>
                <p><strong>Model:</strong> {{ $car['model'] ?? 'N/A' }}</p>
                <p><strong>Year:</strong> {{ $car['year'] ?? 'N/A' }}</p>
                <p><strong>Class:</strong> {{ $car['class'] ?? 'N/A' }}</p>
                <p><strong>Cylinders:</strong> {{ $car['cylinders'] ?? 'N/A' }}</p>
                <p><strong>Drive:</strong> {{ $car['drive'] ?? 'N/A' }}</p>
                <p><strong>Transmission:</strong> {{ $car['transmission'] ?? 'N/A' }}</p>
                <p><strong>Fuel Type:</strong> {{ $car['fuel_type'] ?? 'N/A' }}</p>
            </div>
        @endforeach
    @else
        <p style="font-style: italic;">No data found for this car.</p>
    @endif

@endsection




