<?php

namespace App\Enums;

enum PackageStatus: string
{
    case Available = 'Available';
    case Unavailable = 'Unavailable';
}
