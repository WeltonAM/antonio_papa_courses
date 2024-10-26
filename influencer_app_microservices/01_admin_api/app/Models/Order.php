<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class Order extends Model
{
    use HasFactory, Notifiable, HasApiTokens;

    protected $guarded = ['id'];

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function getTotalAttribute()
    {
        return $this->orderItems->sum(function(OrderItem $item) {
            return $item->price * $item->quantity;
        });
    }

    public function getNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }
}
