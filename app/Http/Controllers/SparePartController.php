<?php

namespace App\Http\Controllers;

use App\Models\SparePart;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Purchase; // لو عامل موديل للمشتريات
use Illuminate\Support\Facades\Storage;

class SparePartController extends Controller
{
    // إن شاء الله ستضيفي middleware('auth') على الراوت لو رغبتِ

    public function create()
    {
        return view('spare_parts.create_sell');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'nullable|numeric|min:0',
            'condition' => 'required|in:new,used',
            'quantity' => 'required|integer|min:1',
            'images.*' => 'nullable|image|max:5120', // max 5MB each
        ]);

     $imagesArray = [];
if ($request->hasFile('images')) {
    foreach ($request->file('images') as $image) {
        $filename = Str::uuid()->toString() . '.' . $image->getClientOriginalExtension();
        // الحفظ مباشرة داخل public/images/spare_parts
        $image->move(public_path('images/spare_parts'), $filename);
        // نخزن المسار النسبي لعرضه بسهولة
        $imagesArray[] = 'images/spare_parts/' . $filename;
    }
}


        $spare = SparePart::create([
            'name' => $validated['name'],
            'description' => $validated['description'] ?? null,
            'price' => $validated['price'] ?? null,
            'condition' => $validated['condition'],
            'quantity' => $validated['quantity'],
            'images' => $imagesArray,
            'user_id' => auth()->id() ?? null,
        ]);

        return redirect()->route('spare-parts.create')->with('success', 'The piece has uploaded succes' );
    }

    // عرض صفحة شراء قطع الغيار
public function buyList(Request $request)
{
    // البحث
    $search = $request->input('search');

    $spareParts = SparePart::when($search, function($query) use ($search) {
        $query->where('name', 'like', "%{$search}%")
              ->orWhere('description', 'like', "%{$search}%");
    })->get();

    return view('spare_parts.buy_list', compact('spareParts', 'search'));
}

// عملية شراء القطعة (Placeholder)
public function buy($id)
{
    $sparePart = SparePart::findOrFail($id);

    // هنا تقدر تعمل منطق الشراء (خصم الكمية، تسجيل العملية... إلخ)
    if ($sparePart->quantity > 0) {
        $sparePart->quantity -= 1;
        $sparePart->save();

        return redirect()->back()->with('success', 'You bought the spare part successfully!');
    }

    return redirect()->back()->with('error', 'Sorry, this spare part is out of stock.');
}
public function purchase($id)
{
    $part = SparePart::findOrFail($id);
    return view('spare_parts.purchase', compact('part'));
}

public function processPurchase(Request $request, $id)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'phone' => 'required|string|max:20',
        'address' => 'required|string',
        'quantity' => 'required|integer|min:1',
    ]);

    $part = SparePart::findOrFail($id);

    $qtyToBuy = (int) $request->input('quantity');

    if ($part->quantity < $qtyToBuy) {
        return redirect()->route('spare-parts.purchase', $id)->with('error', 'Not enough stock available.');
    }

    // خصم الكمية
    $part->quantity -= $qtyToBuy;
    $part->save();

    // حفظ بيانات الطلب
    Purchase::create([
        'spare_part_id' => $id,
        'user_name' => $request->input('name'),
        'user_phone' => $request->input('phone'),
        'shipping_address' => $request->input('address'),
        'quantity' => $qtyToBuy,
    ]);

    return redirect()->route('spare-parts.buy')->with('success', 'Purchase successful!');
}
}