<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Rental extends Model
{
    use HasFactory;

    protected $fillable = [
        'car_id',      // رقم العربية
        'user_id',     // رقم المستخدم
        'start_date',  // تاريخ بداية الإيجار
        'end_date',    // تاريخ نهاية الإيجار
        'price',       // سعر الإيجار
        'status',      // حالة الإيجار (نشط، منتهي...)
    ];

    // علاقة بين الإيجار والسيارة
    public function car()
    {
        return $this->belongsTo(Car::class);
    }

    // علاقة بين الإيجار والمستخدم
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}


