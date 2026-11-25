<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Parfum extends Model
{
    use HasFactory;

    protected $table = 'parfums';

    protected $fillable = [
        'nama',
        'kategori',
        'volume',
        'harga',
        'stok',
        'deskripsi',
        'foto',
    ];

    protected $casts = [
        'volume' => 'integer',
        'harga'  => 'integer',
        'stok'   => 'integer',
    ];

    public function cartItems(): HasMany
    {
        return $this->hasMany(CartItem::class);
    }

    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    public function getHargaRupiahAttribute(): string
    {
        return 'Rp ' . number_format($this->harga, 0, ',', '.');
    }

    public function getIsLowStockAttribute(): bool
    {
        return $this->stok <= 5;
    }
}
