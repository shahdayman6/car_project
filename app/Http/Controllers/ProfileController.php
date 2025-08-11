<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Car;
use App\Models\PurchaseRequest;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $carsSold = Car::where('user_id', $user->id)->get(); // العربيات اللي باعها
        $carsBought = PurchaseRequest::with('car')
            ->where('user_id', $user->id) // العربيات اللي اشتراها
            ->get();

        return view('profile.index', compact('carsSold', 'carsBought'));
    }

    public function destroyCar(Car $car)
    {
        if ($car->user_id === Auth::id()) {
            $car->delete();
            return back()->with('success', 'Car deleted successfully');
        }
        return back()->with('error', 'Not authorized');
    }

    public function destroyPurchase(PurchaseRequest $purchase)
    {
        if ($purchase->user_id === Auth::id()) {
            $purchase->delete();
            return back()->with('success', 'Purchase request deleted successfully');
        }
        return back()->with('error', 'Not authorized');
    }
}
