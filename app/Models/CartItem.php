<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'menu_id',
        'order_id',
        'quantity',
        'fulfilled',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function menu() {
        return $this->belongsTo(Menu::class);
    }

    public function order() {
        return $this->belongsTo(Order::class);
    }

     // Assuming a CartItem can have many ratings (via MenuRating)
     public function ratings()
     {
         return $this->hasMany(MenuRating::class, 'menu_id', 'menu_id'); // Adjust the foreign key relationship
     }

     
}
