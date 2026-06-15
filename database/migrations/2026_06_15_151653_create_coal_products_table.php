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
        Schema::create('coal_products', function (Blueprint $table) {
    $table->id();
    $table->string('product_code')->unique();
    $table->string('name');
    $table->string('grade')->nullable();
    $table->decimal('calorific_value', 10, 2)->nullable();
    $table->decimal('sulfur_content', 10, 2)->nullable();
    $table->decimal('ash_content', 10, 2)->nullable();
    $table->decimal('stock_qty', 15, 2)->default(0);
    $table->string('unit')->default('ton');
    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('coal_products');
    }
};
