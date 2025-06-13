<?php

namespace App\Listeners;

use App\Events\InventoryStockUpdated;
use App\Models\User;
use App\Notifications\OutOfStockNotification;
use App\Notifications\LowStockNotification;

class SendInventoryStockNotification
{
    public function handle(InventoryStockUpdated $event)
    {
        $inventory = $event->inventory;

        // Fetch users with roles 'admin' or 'kitchenStaff'
        $users = User::whereIn('role', ['admin', 'kitchenStaff'])->get();

        // Send notification if stock is out of stock
        if ($inventory->quantity <= 0) {
            foreach ($users as $user) {
                $user->notify(new OutOfStockNotification($inventory, 'out_of_stock'));
            }
        } 
        // Send notification if stock is low (less than 30% of initial stock)
        elseif ($inventory->quantity <= ($inventory->initial_stock * 0.3)) {
            foreach ($users as $user) {
                $user->notify(new LowStockNotification($inventory, 'low_stock'));
            }
        }
    }
}
