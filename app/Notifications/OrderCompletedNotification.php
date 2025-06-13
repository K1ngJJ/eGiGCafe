<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use App\Models\Order;

class OrderCompletedNotification extends Notification
{
    use Queueable;

    protected $order;

    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    public function via($notifiable)
    {
        return ['mail', 'database']; // You can add 'sms' or 'broadcast' if needed
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->subject('Your Order is Completed')
                    ->line('We are happy to inform you that your order #'.$this->order->id.' has been completed.')
                    ->action('View Order', url('https://egigcafe.com/order/'.$this->order->id))
                    ->line('Thank you for your purchase!');
    }

    public function toDatabase($notifiable)
    {
        return [
            'order_id' => $this->order->id,
            'message' => 'Your order #'.$this->order->id.' has been completed.',
            'order_status' => 'completed',
        ];
    }
    
}
