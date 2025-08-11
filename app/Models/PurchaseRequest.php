<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Car;
use App\Models\SparePart;
use App\Models\User;

class PurchaseRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'product_type',
        'user_id',
        'name',
        'phone',
        'quantity',
        'payment_type',
        'message',
        'budget_from',
        'budget_to',
    ];

    // علاقات اختيارية على حسب النوع
   public function car()
{
    return $this->belongsTo(Car::class, 'product_id');
}

public function sparePart()
{
    return $this->belongsTo(SparePart::class, 'product_id');
}

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
