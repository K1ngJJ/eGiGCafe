@component('mail::message')
# Reservation Successfully Fulfilled

We are pleased to inform you that your reservation has been successfully fulfilled. Below are the details regarding your reservation.

@component('mail::button', ['url' => 'https://egigcafe.com/reservation/history'])
View Reservation Details
@endcomponent

Thank you for choosing GiGCafe. We hope you had a great experience!

Best regards,  
**GiGCafe Team**
@endcomponent
