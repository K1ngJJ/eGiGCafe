<?php

namespace App\Enums;

enum PaymentStatus: string
{
   // case FullyPaid = 'Fully Paid';
   // case HalfPaid = 'Half Paid';
    case FullPayment = 'Full Payment';
    case DownPayment = 'Down Payment';
    case PayinRestaurant = 'Cash on Delivery';
    case PayOnline = 'Pay Online';
}
