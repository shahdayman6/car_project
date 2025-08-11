<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\PurchaseRequest;
use App\Models\SparePart;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SparePartController extends Controller
{
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
            'images.*' => 'nullable|image|max:5120',
        ]);

        $imagesArray = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $filename = Str::uuid()->toString() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('images/spare_parts'), $filename);
                $imagesArray[] = 'images/spare_parts/' . $filename;
            }
        }

        SparePart::create([
            'name' => $validated['name'],
            'description' => $validated['description'] ?? null,
            'price' => $validated['price'] ?? null,
            'condition' => $validated['condition'],
            'quantity' => $validated['quantity'],
            'images' => $imagesArray,
            'user_id' => auth()->id() ?? null,
        ]);

        return redirect()->route('spare-parts.create')->with('success', 'The piece has been uploaded successfully.');
    }

    public function buyList(Request $request)
    {
        $search = $request->input('search');

        $spareParts = SparePart::when($search, function ($query) use ($search) {
                $query->where('name', 'like', "%{$search}%")
                      ->orWhere('description', 'like', "%{$search}%");
            })
            ->where('quantity', '>', 0)
            ->get();

        return view('spare_parts.buy_list', compact('spareParts', 'search'));
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
            return redirect()->route('spare-parts.purchase', $id)
                             ->with('error', 'Not enough stock available.');
        }

        // خصم الكمية أو حذف القطعة لو وصلت صفر
        $part->quantity -= $qtyToBuy;
        if ($part->quantity <= 0) {
            $part->delete();
        } else {
            $part->save();
        }

        // حفظ بيانات الطلب في purchase_requests
     $productType = $part instanceof SparePart ? 'spare_part' : 'car';

    PurchaseRequest::create([
    'product_id' => $part->id,
    'product_type' => $productType,
    'user_id' => auth()->id(),
    'name' => $request->name,
    'phone' => $request->phone,
    'quantity' => $request->quantity,
    'message' => $request->address, // استخدمي address هنا بدل message لو عايزة تحفظ العنوان
    ]);


        return redirect()->route('spare-parts.buy')->with('success', 'Purchase successful!');
    }
}
