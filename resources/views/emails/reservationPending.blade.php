@component('mail::message')
# Reservation Pending

Your reservation is currently pending. We are reviewing the details and will notify you once the status is updated.

@component('mail::button', ['url' => 'https://egigcafe.com/reservation/latest'])
View Reservation Details
@endcomponent

Thank you for choosing GiGCafe. We appreciate your patience!

Best regards,  
**GiGCafe Team**
@endcomponent
