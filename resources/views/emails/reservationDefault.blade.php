<!-- resources/views/emails/reservationDefault.blade.php -->

@component('mail::message')
# Reservation Status Update

There has been an update to your reservation status. Please see below for more details:

@component('mail::button', ['url' => 'https://egigcafe.com/reservation/latest'])
View Reservation Details
@endcomponent

Thank you for choosing GiGCafe. We hope to see you soon!

Best regards,  
**GiGCafe Team**
@endcomponent
