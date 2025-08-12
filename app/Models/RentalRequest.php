<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RentalRequest extends Model
{
    use HasFactory;

   protected $fillable = [
    'rental_id',
    'user_id',
    'start_date',
    'end_date',
    'total_price',
    'payment_type',
    'notes',
    'car_type', 
];


    public function rental()
    {
        return $this->belongsTo(Rental::class);
        // app/Models/RentalRequest.php
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

