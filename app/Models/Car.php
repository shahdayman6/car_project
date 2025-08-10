<?php

// app/Models/Car.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    protected $fillable = ['brand', 'model', 'year', 'price', 'images', 'user_id'];


    // علشان Laravel يفك تشفير الصور تلقائيًا
    protected $casts = [
        'images' => 'array',
    ];

    
}