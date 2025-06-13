<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'type',
        'name',
        'description',
        'price',
        'image',
        'size',
        'allergic',
        'vegetarian',
        'vegan'
    ];

    public function cartItems() {
        return $this->hasMany(CartItem::class);
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

        // Accessor to calculate the average rating
    public function getAverageRatingAttribute()
    {
        return $this->ratings()->avg('rating') ?? 0; // Default to 0 if no ratings
    }

    // Accessor for the count of customers who rated this menu
    public function getCustomerCountAttribute()
    {
        return $this->ratings()->distinct('user_id')->count('user_id');
    }
    
    // Accessor to count the number of comments (non-null)
    public function getCommentCountAttribute()
    {
        return $this->ratings()->whereNotNull('comment')->count();
    }
    

     
}
