<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PurchaseRequest extends Model
{
    protected $fillable = [
    'car_id',
    'name',
    'phone',
    'quantity',
    'payment_type',
    'message',
];
}
