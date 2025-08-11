<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SparePart extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'description', 'price', 'condition', 'images', 'quantity', 'user_id'
    ];

    protected $casts = [
        'images' => 'array',
        'price' => 'decimal:2',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
 
    public function purchaseRequests()
{
    return $this->morphMany(PurchaseRequest::class, 'product');
}

}