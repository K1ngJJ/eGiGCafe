@component('mail::message')
# Reservation In Progress

Your reservation is currently in progress. We are processing the details and will notify you once it is confirmed or if further information is required.

@component('mail::button', ['url' => 'https://egigcafe.com/reservation/latest'])
View Reservation Details
@endcomponent

Thank you for choosing GiGCafe. We appreciate your patience!

Best regards,  
**GiGCafe Team**
@endcomponent
