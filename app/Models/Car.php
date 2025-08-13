<?php

// app/Models/Car.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    protected $fillable = ['brand', 'model', 'year', 'price', 'images', 'user_id','stock'];


    // علشان Laravel يفك تشفير الصور تلقائيًا
    protected $casts = [
        'images' => 'array',
    ];

    public function purchaseRequests()
{
    return $this->morphMany(PurchaseRequest::class, 'product');
}


    
}