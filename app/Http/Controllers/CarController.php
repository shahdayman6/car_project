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

        $cars->transform(function ($car) {
            if (is_string($car->images)) {
                $car->images = json_decode($car->images);
            }
            $car->name = $car->brand . ' ' . $car->model;
            return $car;
        });

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
            'brand' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'year' => 'required|integer',
            'price' => 'required|numeric',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg|max:5120', // 5MB max
        ]);

        $imagesArray = [];

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $filename = \Illuminate\Support\Str::uuid()->toString() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('images/cars'), $filename);
                $imagesArray[] = 'images/cars/' . $filename;
            }
        }

        Car::create([
            'brand' => $validated['brand'],
            'model' => $validated['model'],
            'year' => $validated['year'],
            'price' => $validated['price'],
            'images' => $imagesArray,
            'user_id' => auth()->id(),
        ]);

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

    if ($request->quantity > $car->quantity) {
        return redirect()->back()->with('error', 'Not enough cars in stock.');
    }

    PurchaseRequest::create([
        'product_id' => $car->id,
        'product_type' => 'car',
        'user_id' => auth()->id(),
        'name' => $request->name,
        'phone' => $request->phone,
        'message' => $request->message,
        'quantity' => $request->quantity,
        'payment_type' => $request->payment_type,
    ]);

    $car->quantity -= $request->quantity;
    $car->save();

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

    $car = Car::findOrFail($carId);

    // التحقق أن الكمية المطلوبة أقل أو تساوي المتاحة
    if ($validated['quantity'] > $car->quantity) {
        return redirect()->back()->with('error', 'Not enough cars in stock.');
    }

    // إنشاء طلب الشراء
    PurchaseRequest::create([
        'product_id' => $carId,
        'product_type' => 'car',
        'user_id' => auth()->id(),
        'name' => $validated['name'],
        'phone' => $validated['phone'],
        'quantity' => $validated['quantity'],
        'payment_type' => $validated['payment_type'],
        'message' => $validated['message'] ?? null,
    ]);

    // تقليل الكمية في جدول السيارات
    $car->quantity -= $validated['quantity'];
    $car->save();

    return redirect()->back()->with('success', 'Your purchase request has been sent successfully!');
}

    public function edit(Car $car)
    {
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
            'brand' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'year' => 'required|integer',
            'price' => 'required|numeric',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg|max:5120',
        ]);

        $imagesArray = $car->images; // الصور القديمة

        if ($request->hasFile('images')) {
            $imagesArray = [];
            foreach ($request->file('images') as $image) {
                $filename = \Illuminate\Support\Str::uuid()->toString() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('images/cars'), $filename);
                $imagesArray[] = 'images/cars/' . $filename;
            }
        }

        $car->update([
            'brand' => $validated['brand'],
            'model' => $validated['model'],
            'year' => $validated['year'],
            'price' => $validated['price'],
            'images' => $imagesArray,
        ]);

        return redirect()->route('profile')->with('success', 'Car updated successfully!');
    }
}
