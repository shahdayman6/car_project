<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\SparePart;
use App\Models\PurchaseRequest;
use Illuminate\Support\Facades\Auth;

class SparePartController extends Controller
{
    // عرض نموذج إضافة قطعة جديدة للبيع
    public function create()
    {
        return view('spare_parts.create_sell');
    }

    // حفظ قطعة جديدة
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
            'status' => 'available', // نضيف الحالة افتراضيًا
        ]);

        return redirect()->route('spare-parts.create')->with('success', 'The piece has been uploaded successfully.');
    }

    // عرض قائمة القطع المتاحة للشراء
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

    // عرض صفحة شراء قطعة معينة
    public function purchase($id)
    {
        $part = SparePart::findOrFail($id);
        return view('spare_parts.purchase', compact('part'));
    }

    // معالجة عملية شراء قطعة
    public function processPurchase(Request $request, $id)
{
    // التحقق من صحة البيانات المدخلة
    $request->validate([
        'name' => 'required|string|max:255',
        'phone' => 'required|string|max:20',
        'address' => 'required|string',
        'quantity' => 'required|integer|min:1',
    ]);

    // جلب القطعة المطلوبة
    $part = SparePart::findOrFail($id);
    $qtyToBuy = (int) $request->input('quantity');

    // التحقق من وجود كمية كافية
    if ($part->quantity < $qtyToBuy) {
        return redirect()->route('spare-parts.purchase', $id)
                         ->with('error', 'Not enough stock available.');
    }

    // خصم الكمية المشتراة فقط
    $part->quantity -= $qtyToBuy;

    // التأكد أن الكمية لا تصبح أقل من صفر
    if ($part->quantity < 0) {
        $part->quantity = 0;
    }

    $part->save();

    // حفظ طلب الشراء
    PurchaseRequest::create([
        'product_id' => $part->id,
        'product_type' => 'spare_part',
        'user_id' => auth()->id(),
        'name' => $request->name,
        'phone' => $request->phone,
        'quantity' => $qtyToBuy,
        'message' => $request->address, // حفظ العنوان أو رسالة
    ]);

    return redirect()->route('spare-parts.buy')->with('success', 'Purchase successful!');
}


    // حذف طلب شراء واسترجاع المخزون
   public function destroyPurchase(PurchaseRequest $purchase)
{
    // التأكد أن المستخدم الحالي هو صاحب الطلب
    if ($purchase->user_id === auth()->id()) {

        // تحديد المنتج بناءً على نوعه
        if ($purchase->product_type === 'spare_part') {
            $product = SparePart::find($purchase->product_id);
        } elseif ($purchase->product_type === 'car') {
            $product = Car::find($purchase->product_id);
        } else {
            $product = null;
        }

        // استرجاع الكمية فقط دون تعديل عمود غير موجود
        if ($product) {
            $product->quantity += $purchase->quantity; // استرجاع الكمية
            $product->save();
        }

        // حذف طلب الشراء
        $purchase->delete();

        return back()->with('success', 'Purchase request deleted and stock restored!');
    }

    return back()->with('error', 'Not authorized');
}
}
