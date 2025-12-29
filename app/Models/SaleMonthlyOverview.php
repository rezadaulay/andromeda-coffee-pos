<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SaleMonthlyOverview extends Model
{
    protected $fillable = [
        'bulan',
        'tahun',
        'sales_summary',
        'total_sales',
    ];

    protected $casts = [
        'sales_summary' => 'decimal:2',
        'total_sales' => 'integer',
    ];
}
