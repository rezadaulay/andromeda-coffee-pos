<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\PaymentMethod;

class payment extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       PaymentMethod::create([
        "name" => "qris",
       "description" => "membayar dengan scan qr",
       ]);

       PaymentMethod::create([
        "name" => "cash",
       "description" => "membayar dengan uang tunai",
       ]);
    }
}
