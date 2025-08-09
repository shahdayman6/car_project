<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Car;
use App\Models\PurchaseRequest;
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
            
            // نخزن الصورة في مجلد storage/public/cars
            $image->storeAs('public/cars', $filename);

            // نخزن اسم الملف لعرضه لاحقاً
            $imagePaths[] = $filename;
        }
    }

    $car = new Car();
    $car->brand = $request->brand;
    $car->model = $request->model;
    $car->year = $request->year;
    $car->price = $request->price;
    $car->images = json_encode($imagePaths); // نحفظ الصور كـ JSON
    $car->save();

    return redirect()->route('home')->with('success', 'Car added successfully!');
}
public function submitBuy(Request $request, Car $car)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'phone' => 'required|string|max:20',
        'message' => 'nullable|string',
        'quantity' => 'required|integer|min:1',
        'payment_type' => 'required|in:cash,installments',
    ]);

    // احفظ البيانات أو ابعتها بالبريد أو أي لوجيك إضافي
    // مثلاً:
    PurchaseRequest::create([
        'car_id' => $car->id,
        'user_id' => auth()->id(),
        'name' => $request->name,
        'phone' => $request->phone,
        'message' => $request->message,
        'quantity' => $request->quantity,
        'payment_type' => $request->payment_type,
    ]);

    return redirect()->back()->with('success', 'Your purchase request has been sent successfully!');
}

public function buySubmit(Request $request, $carId)
{
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'phone' => 'required|string|max:255',
        'quantity' => 'required|integer|min:1',
        'payment_type' => 'required|in:cash,installments',
        'message' => 'nullable|string',
    ]);

    PurchaseRequest::create([
        'car_id' => $carId,
        'name' => $validated['name'],
        'phone' => $validated['phone'],
        'quantity' => $validated['quantity'],
        'payment_type' => $validated['payment_type'],
        'message' => $validated['message'] ?? null,
    ]);

    return redirect()->back()->with('success', 'Your purchase request has been sent successfully!');
}
}