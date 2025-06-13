@component('mail::message')

# Your Reservation Has Been Approved

We are pleased to inform you that your reservation has been approved.  
Here are some details about your reservation:

@component('mail::button', ['url' => 'https://egigcafe.com/reservation/latest'])
View More Details
@endcomponent

Thank you for choosing GiGCafe. We look forward to serving you.

Best regards,  
**GiGCafe Team**

@endcomponent
