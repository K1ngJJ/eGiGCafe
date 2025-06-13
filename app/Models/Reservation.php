<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Inventory;


class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'tel_number',
        'email',
        'package_id',
        'service_id',
        'cateringoption_id',
        'status',
        'payment_status',
        'payment_selection',
        'receipt_image',
        'res_date',
        'guest_number',
        'user_id',
        'role',
        'supply_details',
        'supply_total', 
        'venue_address',
    ];

    protected $dates = [
        'res_date',
        'deleted_at',
    ];

    public function package()
    {
        return $this->belongsTo(Package::class);
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function cateringoption()
    {
        return $this->belongsTo(CateringOptions::class);
    }

    // In Reservation.php model
    public function supplies()
    {
        return $this->hasMany(ReservationSupply::class);
    }

    public function inventory()
    {
        return $this->belongsTo(Inventory::class);
    }

    public function getInventorySupplies()
    {
        // Load inventory supplies if they are not already loaded
        if (!$this->relationLoaded('inventory_supplies')) {
            $this->load('inventory_supplies');
        }

        // Return the loaded inventory supplies
        return $this->inventory_supplies;
    }

    public function payment() 
    {
        return $this->hasOne(Payment::class);
    }

    public function rating()
    {
        return $this->hasOne(Rating::class, 'reserv_id');
    }
    public function ratings()
{
    return $this->hasMany(Rating::class, 'reserv_id');
}


}
