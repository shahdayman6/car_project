<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rental;
use App\Models\RentalRequest;
use Illuminate\Support\Facades\Auth;
class RentalController extends Controller
{
    /**
     * Display a listing of the resource.
     */

public function index(Request $request)
{
    $search = $request->input('search');
    $query = Rental::query()->where('available', true);

    if ($search) {
        $query->where(function($q) use ($search) {
            $q->where('title', 'like', "%{$search}%")
              ->orWhere('description', 'like', "%{$search}%")
              ->orWhere('location', 'like', "%{$search}%");
        });
    }

    $rentals = $query->latest()->paginate(12);

    // فك الـ JSON الخاص بالصور لكل عنصر في الـ collection
    $rentals->getCollection()->transform(function($rental) {
        $rental->images = json_decode($rental->images); // يحول النص لمصفوفة
        return $rental;
    });

    return view('rentals.index', compact('rentals','search'));
}


public function create()
{
    return view('rentals.create'); // form for owner to add a rental
}

public function store(Request $request)
{
    $validated = $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'nullable|string',
        'price_per_day' => 'required|numeric|min:0',
        'location' => 'nullable|string',
        'images.*' => 'nullable|image|max:5120'
    ]);

    $images = [];
    if ($request->hasFile('images')) {
        foreach ($request->file('images') as $img) {
            $name = \Str::uuid() . '.' . $img->getClientOriginalExtension();
            $img->move(public_path('images/rentals'), $name);
            $images[] = 'images/rentals/'.$name;
        }
    }

    $rental = Rental::create([
        'user_id' => auth()->id(),
        'title' => $validated['title'],
        'description' => $validated['description'] ?? null,
        'price_per_day' => $validated['price_per_day'],
        'location' => $validated['location'] ?? null,
        'images' => $images,
        'available' => true,
    ]);

    return redirect()->route('rentals.index')->with('success','Rental listed successfully.');
}

public function show(Rental $rental)
{
    return view('rentals.show', compact('rental'));
}


public function book(Request $request, Rental $rental)
{ 

    $validated = $request->validate([
        'start_date' => 'required|date',
        'end_date' => 'required|date|after_or_equal:start_date',
    ]);

    $days = \Carbon\Carbon::parse($validated['start_date'])->diffInDays(\Carbon\Carbon::parse($validated['end_date'])) + 1;
    $total = $days * $rental->price_per_day;

    RentalRequest::create([
        'rental_id' => $rental->id,
        'user_id' => Auth::id(),
        'start_date' => $validated['start_date'],
        'end_date' => $validated['end_date'],
        'total_price' => $total,
        'payment_type' => 'cash',
        'notes' => null,
        'car_type' => $rental->title,  // هنا بتجيب اسم العربية من جدول rentals
    ]);

    return redirect()->route('profile')->with('success', "Booking done. Total: $" . $total);
}



public function search(Request $request)
{
    $query = $request->input('query');

    $cars = Rental::where('name', 'LIKE', "%{$query}%")
                  ->orWhere('model', 'LIKE', "%{$query}%")
                  ->get();

    return response()->json($cars);
}
 public function showBookingForm(Rental $rental)
{
    return view('rentals.book', compact('rental'));
}

}
