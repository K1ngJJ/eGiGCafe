<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class InventoryNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $inventory;
    public $type;

    /**
     * Create a new message instance.
     *
     * @param $inventory
     * @param $type
     */
    public function __construct($inventory, $type, $role)
    {
        $this->inventory = $inventory;
        $this->type = $type;
        $this->role = $role;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $subject = $this->type === 'out_of_stock'
            ? "Out of Stock: {$this->inventory->name}"
            : "Low Stock Alert: {$this->inventory->name}";

        return $this->subject($subject)
                    ->markdown('emails.inventory')
                    ->with([
                        'inventoryName' => $this->inventory->name,
                        'quantity' => $this->inventory->quantity,
                        'initialStock' => $this->inventory->initial_stock,
                        'type' => $this->type,
                        'role' => $this->role,
                    ]);
    }
}
