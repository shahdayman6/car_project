<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Car;
use App\Models\PurchaseRequest;
use App\Models\SparePart;
use Illuminate\Support\Facades\Auth;
use App\Models\RentalRequest;

class ProfileController extends Controller
{
   public function index()
{
    $user = Auth::user();

    $carsSold = Car::where('user_id', $user->id)->get();

    $carsBought = PurchaseRequest::with('car')
        ->where('user_id', $user->id)
        ->where('product_type', 'car')
        ->get();

    $sparePartsSold = SparePart::where('user_id', $user->id)->get();

    $sparePartsBought = PurchaseRequest::with('sparePart')
        ->where('user_id', $user->id)
        ->where('product_type', 'spare_part')
        ->get();

    $rentalRequests = RentalRequest::with('rental')->where('user_id', $user->id)->get();

    return view('profile.index', compact(
        'carsSold',
        'carsBought',
        'sparePartsSold',
        'sparePartsBought',
        'rentalRequests'
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

    public function destroyRentalRequest($id)
{
    $request = RentalRequest::where('user_id', auth()->id())->findOrFail($id);
    $request->delete();

    return redirect()->route('profile')->with('success', 'Rental request deleted successfully.');
}

}

