<?php

namespace App\Http\Controllers;
use App\Models\SparePart;
use App\Models\PurchaseRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CarRequestController extends Controller
{
    public function showForm()
    {
        return view('cars.request');
    }

public function handleForm(Request $request)
{
    try {
        // التحقق من البيانات المدخلة
        $validated = $request->validate([
            'brand' => 'required|string',
            'model' => 'required|string',
            'year'  => 'nullable|numeric',
        ]);

        $brand = $validated['brand'];
        $model = $validated['model'];
        $year  = $validated['year'];

        // الاتصال بـ API باستخدام Http Client
      $response = Http::withHeaders([
         'X-RapidAPI-Key' => '03ec61ece9msha1d1044008bffc7p141dc2jsnf6f469c792f7', // المفتاح الجديد
         'X-RapidAPI-Host' => 'cars-by-api-ninjas.p.rapidapi.com',
        ])->get('https://cars-by-api-ninjas.p.rapidapi.com/v1/cars', [
          'brand'  => $brand,
          'model' => $model,
          'year'  => $year,
        ]);


        // التحقق من نجاح الاتصال
        if ($response->successful()) {
            $carData = $response->json();

            // لو مفيش بيانات راجعة
            if (empty($carData)) {
                return view('cars.results', [
                    'data' => [],
                    'message' => 'لا توجد نتائج مطابقة للبحث.',
                ]);
            }

            // عرض البيانات في الصفحة
            return view('cars.results', [
                'data' => $carData,
                'message' => null,
            ]);
        } else {
            // فشل الاتصال بالـ API
            return view('cars.results', [
                'data' => [],
                'message' => 'فشل الاتصال بـ API. تأكد من المفتاح أو حاول لاحقًا.',
            ]);
        }
    } catch (\Illuminate\Validation\ValidationException $e) {
        // مشكلة في التحقق من صحة البيانات
        return redirect()->back()->withErrors($e->validator)->withInput();
    } catch (\Exception $e) {
        // أي خطأ غير متوقع
        return view('cars.results', [
            'data' => [],
            'message' => 'حدث خطأ: ' . $e->getMessage(),
        ]);
    }
}
public function processPurchase(Request $request, $id)
{
    $part = SparePart::findOrFail($id);

    $request->validate([
        'name' => 'required|string|max:255',
        'phone' => 'required|string|max:20',
        'quantity' => 'required|integer|min:1|max:' . $part->quantity,
        'payment_type' => 'nullable|in:cash,installments',
        'message' => 'nullable|string|max:1000',
        'budget_from' => 'nullable|integer|min:0',
        'budget_to' => 'nullable|integer|min:0',
    ]);

    if ($part->quantity < $request->quantity) {
        return redirect()->back()->with('error', 'Not enough quantity available.');
    }

    $part->quantity -= $request->quantity;
    $part->save();

    PurchaseRequest::create([
        'product_id' => $part->id,
        'product_type' => 'spare_part',
        'user_id' => auth()->id(),
        'name' => $request->name,
        'phone' => $request->phone,
        'quantity' => $request->quantity,
        'payment_type' => $request->payment_type ?? 'cash',
        'message' => $request->message,
        'budget_from' => $request->budget_from,
        'budget_to' => $request->budget_to,
    ]);

   return redirect()->route('home')->with('success', 'Purchase successful!');

}
}



