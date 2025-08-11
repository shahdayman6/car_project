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

        // السيارات التي قام بنشرها بواسطته (بيع)
        $carsSold = Car::where('user_id', $user->id)->get();

        // مشتريات السيارات (من جدول purchase_requests) — نفلتر على product_type = 'car'
        $carsBought = PurchaseRequest::with('car')
            ->where('user_id', $user->id)
            ->where('product_type', 'car')
            ->get();

        // قطع الغيار التي قام بنشرها بواسطته (بيع)
        $sparePartsSold = SparePart::where('user_id', $user->id)->get();

        // مشتريات قطع الغيار — من جدول purchase_requests مع فلترة product_type = 'spare_part'
        $sparePartsBought = PurchaseRequest::with('sparePart')
            ->where('user_id', $user->id)
            ->where('product_type', 'spare_part')
            ->get();

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

