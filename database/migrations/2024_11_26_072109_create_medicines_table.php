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
        Schema::create('medicines', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->string('name', 100); // VARCHAR(100)
            $table->unsignedBigInteger('category_id'); // Foreign key ke tabel categories
            $table->unsignedBigInteger('supplier_id');
            $table->integer('stock'); // INT
            $table->integer('minimum_stock')->default(0); // Batas minimum stok
            $table->integer('price'); // Harga per unit
            $table->boolean('require_prescription')->default(false);
            $table->string('description', 255);
            $table->timestamp('expiry_date');
            $table->string('type', 50); // Tambahkan kolom type
            $table->string('unit', 20); // Contoh: Tablet, Strip, Botol
            $table->string('dosage', 255)->nullable(); // Dosis anjuran
            $table->string('instructions', 255)->nullable(); // Instruksi khusus
            $table->timestamps();

            // Relasi ke tabel categories dan suppliers
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->foreign('supplier_id')->references('id')->on('suppliers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medicines');
    }
};
