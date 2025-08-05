
<?php

use App\Http\Controllers\CarController;
use Illuminate\Support\Facades\Route;
use App\Models\Car;

Route::get('/', function () {
    $cars = Car::whereIn('year', [date('Y'), date('Y') - 1])->get();
    return view('cars/Master', compact('cars'));
});


Route::get('/', [CarController::class, 'index']);

require __DIR__.'/auth.php';