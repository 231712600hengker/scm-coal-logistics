<?php

namespace Database\Seeders;

use App\Models\CoalProduct;
use Illuminate\Database\Seeder;

class CoalProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            ['product_code' => 'COAL-001', 'name' => 'Thermal Coal GAR 4200', 'grade' => 'GAR 4200', 'calorific_value' => 4200, 'sulfur_content' => 0.35, 'ash_content' => 6.50, 'stock_qty' => 5000, 'unit' => 'ton'],
            ['product_code' => 'COAL-002', 'name' => 'Thermal Coal GAR 5000', 'grade' => 'GAR 5000', 'calorific_value' => 5000, 'sulfur_content' => 0.45, 'ash_content' => 7.20, 'stock_qty' => 3500, 'unit' => 'ton'],
            ['product_code' => 'COAL-003', 'name' => 'Low Sulfur Coal GAR 5800', 'grade' => 'GAR 5800', 'calorific_value' => 5800, 'sulfur_content' => 0.25, 'ash_content' => 5.80, 'stock_qty' => 950, 'unit' => 'ton'],
            ['product_code' => 'COAL-004', 'name' => 'High Ash Coal GAR 3800', 'grade' => 'GAR 3800', 'calorific_value' => 3800, 'sulfur_content' => 0.55, 'ash_content' => 11.20, 'stock_qty' => 7200, 'unit' => 'ton'],
            ['product_code' => 'COAL-005', 'name' => 'Premium Coal GAR 6200', 'grade' => 'GAR 6200', 'calorific_value' => 6200, 'sulfur_content' => 0.20, 'ash_content' => 4.90, 'stock_qty' => 800, 'unit' => 'ton'],
        ];

        foreach ($products as $product) {
            CoalProduct::create($product);
        }
    }
}
