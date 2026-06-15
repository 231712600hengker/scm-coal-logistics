<?php

namespace Database\Seeders;

use App\Models\CoalProduct;
use Illuminate\Database\Seeder;

class CoalProductSeeder extends Seeder
{
    public function run(): void
    {
        CoalProduct::create([
            'product_code' => 'COAL-001',
            'name' => 'Thermal Coal GAR 4200',
            'grade' => 'GAR 4200',
            'calorific_value' => 4200,
            'sulfur_content' => 0.35,
            'ash_content' => 6.50,
            'stock_qty' => 5000,
            'unit' => 'ton',
        ]);

        CoalProduct::create([
            'product_code' => 'COAL-002',
            'name' => 'Thermal Coal GAR 5000',
            'grade' => 'GAR 5000',
            'calorific_value' => 5000,
            'sulfur_content' => 0.45,
            'ash_content' => 7.20,
            'stock_qty' => 3500,
            'unit' => 'ton',
        ]);
    }
}