<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'dateTime',
        'type',
        'user_id',
        'complete',
    ];

    public function getOrderDate() {
        $dateTime = $this->dateTime;
        return substr($dateTime, 0, 10);
    }
    
    public function getOrderTime() {
        $dateTime = $this->dateTime;
        return substr($dateTime, 11, 16);
    }

    public function getSubtotal() {
        $totalPrice = 0;
        foreach($this->cartItems as $item) 
            $totalPrice += $item->menu->price * $item->quantity;
        return $this->currencyFormat($totalPrice);
    }

    public function getDiscount($subtotal) {
        // change the percentage according to discount code
        if ($this->transaction != null && $this->transaction->discount!= null) {
            $discount = $this->transaction->discount->percentage;
            if (($subtotal * $discount/100) < ($this->transaction->discount->cap)) {
                return $this->currencyFormat($subtotal * $discount/100);
            } else {
                return $this->transaction->discount->cap;
            }
        } else {
            return 0;
        }
    }

//    public function getTax($subtotal, $discount) {
//        return $this->currencyFormat(($subtotal - $discount) * 0.06);
//    }

//    public function getTotal($subtotal, $discount, $tax) {
//        return $this->currencyFormat($subtotal - $discount + $tax);
//    }
    public function getTotal($subtotal, $discount) {
        return $this->currencyFormat($subtotal - $discount);
    }

    public function getTotalFromScratch() {
        $subtotal = $this->getSubtotal();
        $discount = $this->getDiscount($subtotal);
//        $tax = $this->getTax($subtotal, $discount);
//        return $this->currencyFormat($subtotal - $discount + $tax);
        return $this->currencyFormat($subtotal - $discount);
    }

    public function getTotalCost() {
        $totalCost = 0;
        foreach ($this->cartItems as $item) {
            $totalCost += floatval($item->menu->estCost) * floatval($item->quantity);
        }
        return $this->currencyFormat($totalCost);
    }

    public function currencyFormat($number) {
        return number_format((float)$number, 2, '.', '');
    }
  
    // RELATIONSHIPS
    public function user() {
        return $this->belongsTo(User::class);
    }

    public function cartItems() {
        return $this->hasMany(CartItem::class);
    }

    public function transaction() {
        return $this->hasOne(Transaction::class);
    }
     // Define the relationship between Menu and MenuRating
     public function ratings()
     {
         return $this->hasMany(MenuRating::class);
     }
 
     // Optional: If you want to calculate the average rating of a menu item
     public function averageRating()
     {
         return $this->ratings()->avg('rating');
     }

      // Check if all items in the order are rated
    public function isRated()
    {
        return $this->cartItems->every(function ($item) {
            return $item->ratings()->exists(); // Assuming ratings() is the relationship to MenuRating
        });
    }
}
