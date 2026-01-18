<?php

namespace App\Models;

use App\Enums\SaleStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Auth;

class Sale extends Model
{
    /**
     * The "booted" method of the model.
     */
    protected static function booted(): void
    {
        static::creating(function (Sale $sale) {
            $sale->sale_number = $sale->generateSaleNumber();
            $sale->user_id = Auth::id();
        });
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'user_id',
        'payment_method_id',
        'sale_number',
        'total',
        'status',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'user_id' => 'integer',
            'payment_method_id' => 'integer',
            'total' => 'decimal:2',
            'status' => SaleStatus::class,
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function paymentMethod(): BelongsTo
    {
        return $this->belongsTo(PaymentMethod::class);
    }

    public function detailSales(): HasMany
    {
        return $this->hasMany(DetailSale::class);
    }

    private function generateSaleNumber (): string
    {
        return 'INV-' . (self::count() + 1) . '-' . now()->format('Ymd');
    }
}
