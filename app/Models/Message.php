<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
  protected $fillable = ['sender_id', 'receiver_id', 'message'];  // شيل car_id لو مش هتستخدمه


    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    public function receiver()
    {
        return $this->belongsTo(User::class, 'receiver_id');
    }

    public function car()
    {
        return $this->belongsTo(Car::class);
    }
    public function sparePart()
{
    return $this->belongsTo(SparePart::class);
}

}
