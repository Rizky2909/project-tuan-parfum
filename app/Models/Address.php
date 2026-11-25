<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Address extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'label',
        'nama_penerima',
        'no_hp',
        'alamat_lengkap',
        'kecamatan',
        'kota',
        'kode_pos',
        'patokan',
        'is_default',
    ];

    protected $casts = [
        'is_default' => 'boolean',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function getFormattedFullAttribute(): string
    {
        $parts = [
            $this->alamat_lengkap,
            $this->patokan ? 'Patokan: ' . $this->patokan : null,
            'Kec. ' . $this->kecamatan,
            $this->kota,
            $this->kode_pos,
        ];

        return implode(', ', array_filter($parts));
    }
}
