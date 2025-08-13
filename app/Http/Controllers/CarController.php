<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Car;
use App\Models\PurchaseRequest;
use Illuminate\Support\Str;

class CarController extends Controller
{
    // صفحة العربيات الرئيسية
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

    // صفحة عرض العربية
    public function show($id)
    {
        $car = Car::findOrFail($id);

        if (is_string($car->images)) {
            $car->images = json_decode($car->images);
        }

        $car->name = $car->brand . ' ' . $car->model;

        return view('cars.show', compact('car'));
    }

    // صفحة شراء العربية
    public function buyPage($id)
    {
        $car = Car::findOrFail($id);
        return view('cars.buy', compact('car'));
    }

    // صفحة إضافة عربية جديدة
    public function create()
    {
        return view('cars.sellcar');
    }

    // تخزين العربية الجديدة
    public function store(Request $request)
    {
        $validated = $request->validate([
            'brand' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'year' => 'required|integer',
            'price' => 'required|numeric',
            'quantity' => 'required|integer|min:1', // عدد العربيات
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg|max:5120', // 5MB max
        ]);

        $imagesArray = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $filename = Str::uuid()->toString() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('images/cars'), $filename);
                $imagesArray[] = 'images/cars/' . $filename;
            }
        }

        Car::create([
            'brand' => $validated['brand'],
            'model' => $validated['model'],
            'year' => $validated['year'],
            'price' => $validated['price'],
            'stock' => $validated['quantity'], // حفظ الكمية
            'images' => $imagesArray,
            'user_id' => auth()->id(),
            'status' => 'available',
        ]);

        return redirect()->route('home')->with('success', 'Car added successfully!');
    }

    // عملية شراء العربية
    public function buySubmit(Request $request, $carId)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'quantity' => 'required|integer|min:1',
            'payment_type' => 'required|in:cash,installments',
            'message' => 'nullable|string',
        ]);

        $car = Car::findOrFail($carId);

        if ($validated['quantity'] > $car->stock) {
            return redirect()->back()->with('error', 'Not enough cars in stock.');
        }

        // إنشاء طلب الشراء
        PurchaseRequest::create([
            'product_id' => $car->id,
            'product_type' => 'car',
            'user_id' => auth()->id(),
            'name' => $validated['name'],
            'phone' => $validated['phone'],
            'quantity' => $validated['quantity'],
            'payment_type' => $validated['payment_type'],
            'message' => $validated['message'] ?? null,
        ]);

        // تقليل المخزون
        $car->stock -= $validated['quantity'];

        // تحديث الحالة لو المخزون وصل صفر
        if ($car->stock <= 0) {
            $car->status = 'sold';
        }

        $car->save();

        return redirect()->back()->with('success', 'Your purchase request has been sent successfully!');
    }

    // صفحة تعديل العربية
    public function edit(Car $car)
    {
        if ($car->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        return view('cars.edit', compact('car'));
    }

    // تحديث بيانات العربية
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
            'quantity' => 'required|integer|min:1', // تعديل المخزون
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg|max:5120',
        ]);

        $imagesArray = $car->images; // الصور القديمة
        if ($request->hasFile('images')) {
            $imagesArray = [];
            foreach ($request->file('images') as $image) {
                $filename = Str::uuid()->toString() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('images/cars'), $filename);
                $imagesArray[] = 'images/cars/' . $filename;
            }
        }

        $car->update([
            'brand' => $validated['brand'],
            'model' => $validated['model'],
            'year' => $validated['year'],
            'price' => $validated['price'],
            'stock' => $validated['quantity'], // تحديث المخزون
            'images' => $imagesArray,
        ]);

        return redirect()->route('profile')->with('success', 'Car updated successfully!');
    }
}
