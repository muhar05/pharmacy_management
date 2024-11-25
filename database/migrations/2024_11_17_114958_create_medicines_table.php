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
            $table->string('category', 50); // VARCHAR(50)
            $table->integer('stock'); // INT
            $table->integer('price'); // INT
            $table->string('supplier_name', 100); // VARCHAR(100)
            $table->string('description', 255);
            $table->timestamp('expiry_date');
            $table->string('type', 50); // Tambahkan kolom type
            $table->timestamps();
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
