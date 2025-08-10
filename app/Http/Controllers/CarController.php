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

        foreach ($cars as $car) {
            if (is_string($car->images)) {
                $car->images = json_decode($car->images);
            }
            $car->name = $car->brand . ' ' . $car->model;
        }

        $carsArray = $cars->map(function ($car) {
            return [
                'id' => $car->id,
                'name' => $car->name,
                'price' => $car->price,
                'year' => $car->year,
                'images' => collect($car->images)->map(function ($img) {
                    return asset('storage/cars/' . $img);
                })->toArray(),
            ];
        });

        return view('cars.Master', ['cars' => $cars, 'carsArray' => $carsArray]);
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

    public function create()
    {
        return view('cars.sellcar');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'brand' => 'required',
            'model' => 'required',
            'year' => 'required|integer',
            'price' => 'required|numeric',
            'images.*' => 'image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $imagePaths = [];

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $filename = uniqid() . '.' . $image->getClientOriginalExtension();
                $image->storeAs('public/cars', $filename);
                $imagePaths[] = $filename;
            }
        }

        $validated['images'] = json_encode($imagePaths);
        $validated['user_id'] = auth()->id(); // صاحب العربية

        Car::create($validated);

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

        PurchaseRequest::create([
            'car_id' => $car->id,
            'user_id' => auth()->id(), // المشتري
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
            'user_id' => auth()->id(), // المشتري
            'name' => $validated['name'],
            'phone' => $validated['phone'],
            'quantity' => $validated['quantity'],
            'payment_type' => $validated['payment_type'],
            'message' => $validated['message'] ?? null,
        ]);

        return redirect()->back()->with('success', 'Your purchase request has been sent successfully!');
    }
    public function edit(Car $car)
{
    // تحقق من أن صاحب السيارة هو المستخدم الحالي (اختياري)
    if ($car->user_id !== auth()->id()) {
        abort(403, 'Unauthorized action.');
    }

    return view('cars.edit', compact('car'));
}

public function update(Request $request, Car $car)
{
    if ($car->user_id !== auth()->id()) {
        abort(403, 'Unauthorized action.');
    }

    $validated = $request->validate([
        'brand' => 'required',
        'model' => 'required',
        'year' => 'required|integer',
        'price' => 'required|numeric',
        'images.*' => 'image|mimes:jpeg,png,jpg|max:2048',
    ]);

    $imagePaths = [];

    if ($request->hasFile('images')) {
        foreach ($request->file('images') as $image) {
            $filename = uniqid() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/cars', $filename);
            $imagePaths[] = $filename;
        }
        $validated['images'] = json_encode($imagePaths);
    } else {
        // لو ما رفعش صور جديدة، احتفظ بالصور القديمة
        $validated['images'] = $car->images;
    }

    $car->update($validated);

    return redirect()->route('profile')->with('success', 'Car updated successfully!');
}

}
