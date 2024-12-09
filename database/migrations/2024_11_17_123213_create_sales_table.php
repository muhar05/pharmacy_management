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
        Schema::create('sales', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->unsignedBigInteger('customer_id')->nullable(); // Foreign key to customers table
            $table->unsignedBigInteger('user_id')->nullable(); // Foreign key to employees table
            $table->string('doctor_name')->nullable();  
            $table->string('doctor_phone')->nullable(); 
            $table->date('sale_date'); // Date of sale
            $table->integer('total_amount'); // 
            $table->enum('payment_status', ['Paid', 'Unpaid'])->default('Unpaid'); // Payment status
            $table->timestamps(); // created_at, updated_at

            // Foreign key constraints
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('set null');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales');
    }
};