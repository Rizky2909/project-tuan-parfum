<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrderItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'parfum_id',
        'nama_parfum',
        'volume',
        'harga_satuan',
        'qty',
        'subtotal',
    ];

    protected $casts = [
        'volume'       => 'integer',
        'harga_satuan' => 'integer',
        'qty'          => 'integer',
        'subtotal'     => 'integer',
    ];

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    public function parfum(): BelongsTo
    {
        return $this->belongsTo(Parfum::class);
    }

    public function getHargaSatuanRupiahAttribute(): string
    {
        return 'Rp ' . number_format($this->harga_satuan, 0, ',', '.');
    }

    public function getSubtotalRupiahAttribute(): string
    {
        return 'Rp ' . number_format($this->subtotal, 0, ',', '.');
    }
}
