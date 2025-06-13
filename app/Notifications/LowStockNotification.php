<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Mail;
use App\Mail\InventoryNotification;

class LowStockNotification extends Notification
{
    use Queueable;

    public $inventory;
    public $type;

     /**
     * Create a new notification instance.
     *
     * @param $inventory
     * @param $type
     */
    public function __construct($inventory, $type)
    {
        $this->inventory = $inventory;
        $this->type = $type;

        // Trigger email notification
        $this->sendEmail();
    }

    /**
     * Get the notification's delivery channels.
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the array representation of the notification.
     */
    public function toArray($notifiable)
    {
        // Calculate the percentage of remaining stock
        $percentage = round(($this->inventory->quantity / $this->inventory->initial_stock) * 100);
        
        return [
            'name' => $this->inventory->name,
            'message' => "The supplies of {$this->inventory->name} are running low. Only {$percentage}% remains (exactly {$this->inventory->quantity} units left).",
        ];
    }

     /**
     * Send email notification.
     */
    protected function sendEmail()
    {
        // Get all kitchen staff emails
        $staffEmails = \App\Models\User::where('role', 'kitchenStaff')->pluck('email')->toArray();
    
        // Add the admin email
        $emails = array_merge($staffEmails, ['gigcafe026@gmail.com']);
    
        foreach ($emails as $email) {
            // Determine role for the greeting
            $role = $email === 'gigcafe026@gmail.com' ? 'admin' : 'staff';
    
            // Send the email
            Mail::to($email)->send(new InventoryNotification($this->inventory, $this->type, $role));
        }
    }
}
