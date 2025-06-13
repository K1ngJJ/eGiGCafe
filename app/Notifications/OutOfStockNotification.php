<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\DatabaseMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Mail;
use App\Mail\InventoryNotification;

class OutOfStockNotification extends Notification
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
        return [
            'name' => $this->inventory->name,
            'message' => "The supplies of {$this->inventory->name} is out of stock."
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
