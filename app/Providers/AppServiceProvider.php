<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
use App\Models\CartItem;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
{
    // Load pagination views with Bootstrap
    Paginator::useBootstrap();

    View::composer('*', function ($view) {
        $cartCount = 0;
        if (Auth::check()) {
            $userId = Auth::id();

            // Get all order IDs that have been paid (exist in the transactions table)
            $paidOrderIds = Transaction::where('user_id', $userId)
                ->pluck('order_id')
                ->toArray();

            // Get the count of unique cart items for the authenticated user
            $cartCount = CartItem::where('user_id', $userId)
                ->whereNull('order_id') // Items not yet checked out
                ->where('fulfilled', 0) // Only unfulfilled items
                ->distinct('menu_id')   // Ensure only unique menu items are counted
                ->count('menu_id');     // Count unique items
        }

        $view->with('cartCount', $cartCount);
    });
}

    
}
