<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Car;
use App\Models\PurchaseRequest;
use App\Models\SparePart;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // العربيات
        $carsSold = Car::where('user_id', $user->id)->get();
        $carsBought = PurchaseRequest::with('car')
            ->where('user_id', $user->id)
            ->get();

        // قطع الغيار اللي باعها
        $sparePartsSold = SparePart::where('user_id', $user->id)->get();

        // قطع الغيار اللي اشتراها (لو عندك جدول مشتريات قطع غيار)
        // هنا افتراض إنك هتعملي جدول جديد اسمه spare_part_purchases
        $sparePartsBought = []; // حطيه فاضي مؤقتاً أو اربطيه بالموديل الجديد لو عملتيه

        return view('profile.index', compact(
            'carsSold',
            'carsBought',
            'sparePartsSold',
            'sparePartsBought'
        ));
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

    public function destroySparePart(SparePart $sparePart)
    {
        if ($sparePart->user_id === Auth::id()) {
            $sparePart->delete();
            return back()->with('success', 'Spare part deleted successfully');
        }
        return back()->with('error', 'Not authorized');
    }

}
