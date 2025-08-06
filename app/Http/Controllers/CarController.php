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

}