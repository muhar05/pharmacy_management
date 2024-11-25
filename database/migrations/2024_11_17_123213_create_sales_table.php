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
            $table->unsignedBigInteger('employee_id'); // Foreign key to employees table
            $table->date('sale_date'); // Date of sale
            $table->decimal('total_amount', 10, 2); // Total amount of the sale
            $table->enum('payment_status', ['Paid', 'Unpaid'])->default('Unpaid'); // Payment status
            $table->timestamps(); // created_at, updated_at

            // Foreign key constraints
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('set null');
            $table->foreign('employee_id')->references('id')->on('employees')->onDelete('cascade');
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
