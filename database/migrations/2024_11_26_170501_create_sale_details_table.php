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
        Schema::create('sale_details', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->foreignId('sale_id')->constrained()->onDelete('cascade'); // Relasi ke tabel sales
            $table->foreignId('medicine_id')->constrained()->onDelete('cascade'); // Relasi ke tabel medicines
            $table->integer('quantity'); // Jumlah
            $table->decimal('price', 10, 2); // Harga per unit
            $table->decimal('total_price', 10, 2); // Total harga
            $table->timestamps(); // created_at, updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sale_details');
    }
};
