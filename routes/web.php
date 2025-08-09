<?php

use App\Http\Controllers\CarController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CarRequestController;
use App\Models\Car;
 
// بيع سيارة → لازم تسجيل دخول
Route::middleware(['auth'])->group(function () {
    Route::get('/sell', [CarController::class, 'create'])->name('cars.create');
    Route::post('/cars', [CarController::class, 'store'])->name('cars.store');
  
    // صفحة الشراء محمية ب login
    Route::get('/cars/{id}/buy', [CarController::class, 'buyPage'])->name('cars.buy');

    Route::post('/cars/{id}/buy', [CarController::class, 'buy'])->name('cars.buy.submit');
    Route::get('/buy-car', [CarRequestController::class, 'showForm'])->name('cars.request.form');
    Route::post('/buy-car', [CarRequestController::class, 'handleForm'])->name('cars.request.submit');
    Route::post('/cars/{id}/buy', [CarController::class, 'buySubmit'])->name('cars.buy.submit');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('/cars/{id}', [CarController::class, 'show'])->name('cars.show');

// الصفحة الرئيسية
Route::get('/', function () {
    $cars = Car::whereIn('year', [date('Y'), date('Y') - 1])->get();

    foreach ($cars as $car) {
        $car->images = is_string($car->images) ? json_decode($car->images) : $car->images;
        $car->name = $car->brand . ' ' . $car->model;
    }

    return view('cars.Master', compact('cars'));
});

// صفحة الماستر
Route::get('/master', [CarController::class, 'masterPage'])->name('home');

require __DIR__.'/auth.php';
