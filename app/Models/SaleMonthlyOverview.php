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
}
