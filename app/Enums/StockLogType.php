<?php

namespace App\Enums;

enum StockLogType: string
{
    case INCREMENT = 'increment';
    case DECREMENT = 'decrement';
}
