<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('sale_monthly_overviews', function (Blueprint $table) {
            $table->id();
            $table->string('month', 2);
            $table->string('year', 4);
            $table->float('sales_summary'); // total nilai seluruh penjualan
            $table->integer('total_sales'); // total jumlah penjualan ada berapa kali
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sale_monthly_overviews');
    }
};
