<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'name',
        'price',
        'quantity',
        'initial_stock', // Include the initial_stock field
        'status',
    ];
    
    /**
     * Relationship with Reservation.
     */
    public function reservations()
    {
        return $this->belongsTo(Reservation::class);
    }

    /**
     * Check if the stock is low.
     *
     * @return bool
     */
    public function isLowStock()
    {
        return $this->quantity <= (0.3 * $this->initial_stock);
    }

    /**
     * Check if the stock is out.
     *
     * @return bool
     */
    public function isOutOfStock()
    {
        return $this->quantity <= 0;
    }
    
}
