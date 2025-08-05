<?php

use App\Http\Controllers\CarController;
use Illuminate\Support\Facades\Route;
use App\Models\Car;

Route::get('/', function () {
    $cars = Car::whereIn('year', [date('Y'), date('Y') - 1])->get();
    return view('cars/Master', compact('cars'));
});


Route::get('/', [CarController::class, 'index']);
Route::get('/register', function () {
    return view('cars.register');
})->name('register');

Route::get('/login', function () {
    return view('cars.login');
})->name('login');

