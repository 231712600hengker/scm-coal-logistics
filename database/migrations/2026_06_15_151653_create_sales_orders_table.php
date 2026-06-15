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
        Schema::create('sales_orders', function (Blueprint $table) {
    $table->id();
    $table->string('so_number')->unique();
    $table->foreignId('customer_id')->constrained('customers')->cascadeOnDelete();
    $table->foreignId('coal_product_id')->constrained('coal_products')->cascadeOnDelete();
    $table->date('order_date');
    $table->decimal('quantity', 15, 2);
    $table->decimal('price_per_ton', 15, 2);
    $table->decimal('total_amount', 15, 2);
    $table->enum('status', ['pending', 'approved', 'shipped', 'completed', 'cancelled'])->default('pending');
    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales_orders');
    }
};
