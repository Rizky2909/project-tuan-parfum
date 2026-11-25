<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode_order',
        'user_id',
        'kurir_id',
        'penerima_nama',
        'penerima_hp',
        'alamat_pengiriman',
        'kecamatan',
        'kota',
        'patokan',
        'metode_pengiriman',
        'metode_pembayaran',
        'subtotal',
        'ongkir',
        'total_harga',
        'catatan_pembeli',
        'status',
        'bukti_bayar',
        'catatan_admin',
        'alasan_batal',
        'nomor_resi',
        'bukti_pengiriman',
        'catatan_kurir',
        'dibayar_at',
        'dikirim_at',
        'selesai_at',
    ];

    protected $casts = [
        'subtotal'    => 'integer',
        'ongkir'      => 'integer',
        'total_harga' => 'integer',
        'dibayar_at'  => 'datetime',
        'dikirim_at'  => 'datetime',
        'selesai_at'  => 'datetime',
    ];

    // Relasi
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function kurir(): BelongsTo
    {
        return $this->belongsTo(User::class, 'kurir_id');
    }

    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    public function statusLogs(): HasMany
    {
        return $this->hasMany(OrderStatusLog::class)->orderBy('created_at', 'asc');
    }

    // Accessor Format Rupiah
    public function getSubtotalRupiahAttribute(): string
    {
        return 'Rp ' . number_format($this->subtotal, 0, ',', '.');
    }

    public function getOngkirRupiahAttribute(): string
    {
        return $this->ongkir > 0
            ? 'Rp ' . number_format($this->ongkir, 0, ',', '.')
            : 'Gratis';
    }

    public function getTotalHargaRupiahAttribute(): string
    {
        return 'Rp ' . number_format($this->total_harga, 0, ',', '.');
    }

    // Status Helpers
    public function getStatusLabelAttribute(): string
    {
        return match ($this->status) {
            'menunggu_pembayaran' => 'Menunggu Pembayaran',
            'menunggu_verifikasi' => 'Menunggu Verifikasi',
            'diproses'            => 'Sedang Diproses',
            'dikirim'             => 'Dalam Pengiriman',
            'selesai'             => 'Pesanan Selesai',
            'dibatalkan'          => 'Dibatalkan',
            default               => ucfirst(str_replace('_', ' ', $this->status)),
        };
    }

    public function getStatusBadgeClassAttribute(): string
    {
        return match ($this->status) {
            'menunggu_pembayaran' => 'bg-amber-500/10 border-amber-500/30 text-amber-300',
            'menunggu_verifikasi' => 'bg-indigo-500/10 border-indigo-500/30 text-indigo-300',
            'diproses'            => 'bg-[#C9A227]/10 border-[#C9A227]/30 text-[#C9A227]',
            'dikirim'             => 'bg-sky-500/10 border-sky-500/30 text-sky-300',
            'selesai'             => 'bg-emerald-500/10 border-emerald-500/30 text-emerald-300',
            'dibatalkan'          => 'bg-rose-500/10 border-rose-500/30 text-rose-300',
            default               => 'bg-white/10 border-white/20 text-[#E6E9EF]',
        };
    }

    public function getMetodePengirimanLabelAttribute(): string
    {
        return match ($this->metode_pengiriman) {
            'ambil_di_toko' => 'Ambil di Toko (Sungai Bangek)',
            'kurir_toko'    => 'Kurir Toko (Padang)',
            default         => ucfirst(str_replace('_', ' ', $this->metode_pengiriman)),
        };
    }

    public function getMetodePembayaranLabelAttribute(): string
    {
        return match ($this->metode_pembayaran) {
            'transfer_bank' => 'Transfer Bank Manual (BCA)',
            'cod'           => 'Bayar di Tempat (COD)',
            default         => strtoupper(str_replace('_', ' ', $this->metode_pembayaran)),
        };
    }

    // State Guards
    public function canBeCancelledByCustomer(): bool
    {
        return $this->status === 'menunggu_pembayaran';
    }

    public function canUploadBuktiBayar(): bool
    {
        return in_array($this->status, ['menunggu_pembayaran', 'menunggu_verifikasi'], true)
            && $this->metode_pembayaran === 'transfer_bank';
    }

    public function canBeConfirmedReceived(): bool
    {
        return $this->status === 'dikirim';
    }
}
