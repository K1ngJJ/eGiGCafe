@component('mail::message')
# Reservation Declined

We regret to inform you that your reservation has been declined. Please review the details of your reservation below.

@component('mail::button', ['url' => 'https://egigcafe.com/reservation/latest'])
View Reservation Details
@endcomponent

We apologize for any inconvenience this may have caused. If you have any questions or need assistance, please don't hesitate to contact us.

Thank you,  
**GiGCafe Team**
@endcomponent
