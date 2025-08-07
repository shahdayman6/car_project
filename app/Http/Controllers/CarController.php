<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Car;

class CarController extends Controller
{
    public function masterPage()
    {
        $cars = Car::all();

        // لو ما عملتيش casts في الموديل، فكي تشفير الصور هنا
        foreach ($cars as $car) {
            // لو images ما زالت string (JSON) ففكي التشفير
            if (is_string($car->images)) {
                $car->images = json_decode($car->images);
            }

            // دمج الاسم
            $car->name = $car->brand . ' ' . $car->model;
        }

        return view('cars.Master', compact('cars'));
    }

public function show($id)
{
    $car = Car::findOrFail($id);

    if (is_string($car->images)) {
        $car->images = json_decode($car->images);
    }

    $car->name = $car->brand . ' ' . $car->model;

    return view('cars.show', compact('car'));
}

public function buyPage($id)
{
    $car = Car::findOrFail($id);
    return view('cars.buy', compact('car'));
}

public function buy(Request $request, $id)
{
    // هنا يتم تنفيذ الشراء (ممكن تخزين الطلب في جدول جديد مثلاً)

    return redirect()->route('cars.show', $id)->with('success', 'Your request has been sent!');
}

public function create()
{
    return view('cars.sellcar'); // <-- يشير إلى resources/views/cars/sell.blade.php
}


public function store(Request $request)
{
    $request->validate([
        'brand' => 'required',
        'model' => 'required',
        'year' => 'required|integer',
        'price' => 'required|numeric',
        'images.*' => 'image|mimes:jpeg,png,jpg|max:2048',
    ]);

    $imagePaths = [];

    if ($request->hasFile('images')) {
        foreach ($request->file('images') as $image) {
            $filename = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/cars', $filename);
            $imagePaths[] = $filename;
        }
    }

    $car = new Car();
    $car->brand = $request->brand;
    $car->model = $request->model;
    $car->year = $request->year;
    $car->price = $request->price;
    $car->images = json_encode($imagePaths); // احفظ الصور كـ JSON
    $car->save();

    return redirect()->route('home')->with('success', 'Car added successfully!');
}
}