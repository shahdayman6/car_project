
<?php

use App\Http\Controllers\CarController;
use Illuminate\Support\Facades\Route;
use App\Models\Car;


Route::get('/sell', [CarController::class, 'create'])->name('cars.create');
Route::post('/cars', [CarController::class, 'store'])->name('cars.store');

Route::get('/dashboard', function () {
    return view('dashboard'); // تأكدي إن فيه ملف اسمه dashboard.blade.php
})->name('dashboard');
Route::get('/cars/{id}', [CarController::class, 'show'])->name('cars.show');

// صفحة الشراء محمية ب login
Route::middleware(['auth'])->group(function () {
    Route::get('/cars/{id}/buy', [CarController::class, 'buyPage'])->name('cars.buy');
    Route::post('/cars/{id}/buy', [CarController::class, 'buySubmit'])->name('cars.buy.submit');
});

Route::get('/', function () {
    $cars = Car::whereIn('year', [date('Y'), date('Y') - 1])->get();

    foreach ($cars as $car) {
        $car->images = is_string($car->images) ? json_decode($car->images) : $car->images;
        $car->name = $car->brand . ' ' . $car->model;
    }

    return view('cars.Master', compact('cars'));
});

Route::get('/master', [CarController::class, 'masterPage'])->name('home');

require __DIR__.'/auth.php';