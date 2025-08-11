<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PurchaseRequest extends Model
{
    protected $fillable = [
        'car_id',
        'user_id',       // لو عندك حقل مرتبط بالمستخدم
        'name',
        'phone',
        'quantity',
        'payment_type',
        'message',
    ];

    // تعريف العلاقة مع موديل Car
    public function car()
    {
        return $this->belongsTo(Car::class);
    }
}
