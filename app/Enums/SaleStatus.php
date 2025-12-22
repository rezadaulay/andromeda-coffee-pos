<?php

namespace App\Enums;

enum SaleStatus
{
    case PENDING = 'pending';
    case COMPLETED = 'completed';
    case CANCELED = 'canceled';
}
