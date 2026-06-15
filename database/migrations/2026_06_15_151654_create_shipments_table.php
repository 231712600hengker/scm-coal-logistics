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
        Schema::create('shipments', function (Blueprint $table) {
    $table->id();
    $table->string('shipment_number')->unique();
    $table->foreignId('sales_order_id')->constrained('sales_orders')->cascadeOnDelete();
    $table->string('vehicle_number')->nullable();
    $table->string('driver_name')->nullable();
    $table->date('shipment_date');
    $table->string('origin')->nullable();
    $table->string('destination')->nullable();
    $table->enum('status', ['scheduled', 'in_transit', 'delivered', 'cancelled'])->default('scheduled');
    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shipments');
    }
};
