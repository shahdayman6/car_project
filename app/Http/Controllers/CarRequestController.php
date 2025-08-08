<?php

namespace App\Http\Controllers;

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

}



