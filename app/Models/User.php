<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Package;
use App\Enums\PackageStatus;
use Illuminate\Support\Facades\Auth;


class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'username',
        'email',
        'status',
        'mobile_number',
        'password',
        'role', // Either "customer" , "kitchenStaff" or "admin"
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function cartItems() {
        return $this->hasMany(CartItem::class);
    }

    public function orders() {
        return $this->hasMany(Order::class);
    }

    public function packages()
    {
        return $this->hasMany(Package::class);
    }
    
    public function availablePackages()
    {
        return $this->hasMany(Package::class)
            ->where('status', PackageStatus::Available)
            ->where('user_id', Auth::id());
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
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

 


}
