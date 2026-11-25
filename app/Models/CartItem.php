<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CartItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'parfum_id',
        'qty',
    ];

    protected $casts = [
        'qty' => 'integer',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function parfum(): BelongsTo
    {
        return $this->belongsTo(Parfum::class);
    }

    public function getSubtotalAttribute(): int
    {
        return (int) ($this->qty * ($this->parfum->harga ?? 0));
    }

    public function getSubtotalRupiahAttribute(): string
    {
        return 'Rp ' . number_format($this->subtotal, 0, ',', '.');
    }
}
