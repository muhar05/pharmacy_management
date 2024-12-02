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
        Schema::create('restocks', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->unsignedBigInteger('medicine_id'); // INT NOT NULL
            $table->integer('quantity'); // INT NOT NULL
            $table->date('restock_date'); // DATE NOT NULL

            // Foreign key constraint
            $table->foreign('medicine_id')->references('id')->on('medicines')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('restocks');
    }
};