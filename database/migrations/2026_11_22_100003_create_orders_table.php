<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('kode_order')->unique();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('kurir_id')->nullable()->constrained('users')->nullOnDelete();

            // Address Snapshot
            $table->string('penerima_nama');
            $table->string('penerima_hp');
            $table->text('alamat_pengiriman');
            $table->string('kecamatan');
            $table->string('kota')->default('Padang');
            $table->string('patokan')->nullable();

            // Pengiriman & Pembayaran
            $table->string('metode_pengiriman'); // kurir_toko, ambil_di_toko
            $table->string('metode_pembayaran'); // transfer_bank, cod
            $table->unsignedInteger('subtotal');
            $table->unsignedInteger('ongkir')->default(0);
            $table->unsignedInteger('total_harga');
            $table->text('catatan_pembeli')->nullable();

            // Bukti & Status
            $table->string('status')->default('menunggu_pembayaran');
            $table->string('bukti_bayar')->nullable();
            $table->text('catatan_admin')->nullable();
            $table->text('alasan_batal')->nullable();
            $table->string('nomor_resi')->nullable();
            $table->string('bukti_pengiriman')->nullable();
            $table->text('catatan_kurir')->nullable();

            $table->timestamp('dibayar_at')->nullable();
            $table->timestamp('dikirim_at')->nullable();
            $table->timestamp('selesai_at')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
