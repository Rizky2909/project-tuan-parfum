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
        Schema::create('parfums', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('kategori')->default('Unisex');
            $table->integer('volume')->default(100); // dalam ml
            $table->integer('harga');
            $table->integer('stok')->default(10);
            $table->text('deskripsi')->nullable();
            $table->string('foto')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('parfums');
    }
};
