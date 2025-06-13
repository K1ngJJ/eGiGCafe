<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NotifReservation extends Mailable
{
    use Queueable, SerializesModels;

    protected $status;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($status)
    {
        $this->status = $status;
    }

    /**
     * Build the message.
     *
     * @return $this
     */

     public function build()
     {
         $customerEmail = auth()->user()->email;
     
         if ($this->status === 'Fulfilled') {
             return $this->fulfilledMessage($customerEmail);
         } elseif ($this->status === 'Declined') {
             return $this->declinedMessage($customerEmail);
         } elseif ($this->status === 'Approved') {
             return $this->approvedMessage($customerEmail);
         } elseif ($this->status === 'Pending') {
             return $this->pendingMessage($customerEmail);
         } elseif ($this->status === 'In Progress') {
             return $this->inprogressMessage($customerEmail);
         }
         // Default message if status is not recognized
         return $this->defaultMessage($customerEmail);
     }
     
     protected function fulfilledMessage($customerEmail)
     {
         return $this->subject('Your reservation was Fulfilled')
                     ->to($customerEmail)
                     ->markdown('emails.reservationFulfilled');
     }
     
     protected function declinedMessage($customerEmail)
     {
         return $this->subject('Your reservation was declined')
                     ->to($customerEmail)
                     ->markdown('emails.reservationDeclined');
     }
     
     protected function approvedMessage($customerEmail)
     {
         return $this->subject('Your reservation was approved')
                     ->to($customerEmail)
                     ->markdown('emails.reservationApproved');
     }
     
     protected function pendingMessage($customerEmail)
     {
         return $this->subject('Your reservation was pending')
                     ->to($customerEmail)
                     ->markdown('emails.reservationPending');
     }
     
     protected function inprogressMessage($customerEmail)
     {
         return $this->subject('Your reservation was in progress')
                     ->to($customerEmail)
                     ->markdown('emails.reservationInprogress');
     }
     
     protected function defaultMessage($customerEmail)
     {
         return $this->subject('Your reservation status')
                     ->to($customerEmail)
                     ->markdown('emails.reservationDefault');
     }
     
     
}
