<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained()->cascadeOnDelete();
            $table->foreignId('parfum_id')->nullable()->constrained('parfums')->nullOnDelete();

            // Product Snapshot
            $table->string('nama_parfum');
            $table->integer('volume');
            $table->unsignedInteger('harga_satuan');
            $table->unsignedInteger('qty');
            $table->unsignedInteger('subtotal');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};
