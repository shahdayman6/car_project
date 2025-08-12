<?php

use App\Http\Controllers\CarController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CarRequestController;
use App\Http\Controllers\SparePartController;
use App\Http\Controllers\RentalController;
use App\Models\Car;

// بيع سيارة → لازم تسجيل دخول
Route::middleware(['auth'])->group(function () {
    Route::get('/sell', [CarController::class, 'create'])->name('cars.create');
    Route::post('/cars', [CarController::class, 'store'])->name('cars.store');

    // صفحة الشراء محمية ب login
    Route::get('/cars/{id}/buy', [CarController::class, 'buyPage'])->name('cars.buy');
    Route::post('/cars/{id}/buy', [CarController::class, 'buysubmit'])->name('cars.buy.submit');

    // فورم طلب شراء سيارة
    Route::get('/buy-car', [CarRequestController::class, 'showForm'])->name('cars.request.form');
    Route::post('/buy-car', [CarRequestController::class, 'handleForm'])->name('cars.request.submit');

    // تأكيد الشراء (مسار منفصل عن buy)
    Route::post('/cars/{id}/buy/confirm', [CarController::class, 'buySubmit'])->name('cars.buy.confirm');
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

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::delete('/cars/{car}', [ProfileController::class, 'destroyCar'])->name('profile.cars.delete');
    Route::delete('/purchases/{purchase}', [ProfileController::class, 'destroyPurchase'])->name('profile.purchases.delete');
    // الحذف لقطع الغيار
    Route::delete('/spare-parts/{sparePart}', [ProfileController::class, 'destroySparePart'])->name('profile.spare-parts.delete');
});

Route::get('/spare-parts/{id}/purchase', [SparePartController::class, 'purchase'])->name('spare-parts.purchase');
Route::post('/spare-parts/{id}/purchase', [SparePartController::class, 'processPurchase'])->name('spare-parts.processPurchase');

Route::middleware('auth')->group(function () {
    Route::get('/cars/{car}/edit', [CarController::class, 'edit'])->name('cars.edit');
    Route::put('/cars/{car}', [CarController::class, 'update'])->name('cars.update');
    Route::get('/spare-parts/create', [SparePartController::class, 'create'])->name('spare-parts.create');
    Route::post('/spare-parts', [SparePartController::class, 'store'])->name('spare-parts.store');
     // صفحة عرض قطع الغيار للشراء
    Route::get('/spare-parts/buy', [SparePartController::class, 'buyList'])->name('spare-parts.buy');
    // عملية شراء القطعة (هنعملها لاحقاً)
    Route::post('/spare-parts/buy/{id}', [SparePartController::class, 'buy'])->name('spare-parts.buyNow');
  
    Route::get('/rentals', [RentalController::class, 'index'])
    ->name('rentals.index')
    ->middleware('auth');
    Route::post('/rentals/{rental}/book', [RentalController::class, 'book'])->name('rentals.book');
    Route::get('/rentals/search', [RentalController::class, 'search']);
     // صفحة عرض الفورم للحجز
    Route::get('/rentals/{rental}/book', [RentalController::class, 'showBookingForm'])->name('rentals.showBookingForm');
    // مسار معالجة الحجز POST (موجود عندك)
    Route::post('/rentals/{rental}/book', [RentalController::class, 'book'])->name('rentals.book');  
    Route::delete('/profile/rentals/{id}', [App\Http\Controllers\ProfileController::class, 'destroyRentalRequest'])->name('profile.rentals.delete');

});


// صفحة الماستر
Route::get('/master', [CarController::class, 'masterPage'])->name('home');

require __DIR__.'/auth.php';