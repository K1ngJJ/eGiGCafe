<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class ReservationStatusNotification extends Notification
{
    use Queueable;

    protected $reservation;
    protected $status;

    public function __construct($reservation, $status)
    {
        $this->reservation = $reservation;
        $this->status = $status;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toArray($notifiable)
    {
        return [
            'reservation_id' => $this->reservation->id,
            'name' => $this->reservation->first_name . ' ' . $this->reservation->last_name,
            'status' => $this->status,
            'date' => $this->reservation->res_date,
        ];
    }
}
