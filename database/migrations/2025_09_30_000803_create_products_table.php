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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('tipe');
            $table->string('ukuran');
            $table->decimal('harga', 10, 2);
            $table->string('gambar')->nullable();
            $table->text('deskripsi')->nullable();
            $table->string('link_shopee')->nullable();
            $table->string('link_tiktok_shop')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
