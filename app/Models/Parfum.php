<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Parfum extends Model
{
    use HasFactory;

    /**
     * Nama tabel di database
     */
    protected $table = 'parfums';

    /**
     * Kolom yang dapat diisi secara mass-assignment
     */
    protected $fillable = [
        'nama',
        'kategori',
        'volume',
        'harga',
        'stok',
        'deskripsi',
        'foto',
    ];

    /**
     * Helper format rupiah untuk tampilan rapi
     */
    public function getHargaRupiahAttribute(): string
    {
        return 'Rp ' . number_format($this->harga, 0, ',', '.');
    }
}
