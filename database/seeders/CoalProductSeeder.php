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
            ['product_code' => 'COAL-006', 'name' => 'Thermal Coal GAR 4500', 'grade' => 'GAR 4500', 'calorific_value' => 4500, 'sulfur_content' => 0.38, 'ash_content' => 6.90, 'stock_qty' => 4200, 'unit' => 'ton'],
            ['product_code' => 'COAL-007', 'name' => 'Thermal Coal GAR 4700', 'grade' => 'GAR 4700', 'calorific_value' => 4700, 'sulfur_content' => 0.40, 'ash_content' => 7.00, 'stock_qty' => 6100, 'unit' => 'ton'],
            ['product_code' => 'COAL-008', 'name' => 'Industrial Coal GAR 3900', 'grade' => 'GAR 3900', 'calorific_value' => 3900, 'sulfur_content' => 0.60, 'ash_content' => 12.10, 'stock_qty' => 1300, 'unit' => 'ton'],
            ['product_code' => 'COAL-009', 'name' => 'Export Coal GAR 5500', 'grade' => 'GAR 5500', 'calorific_value' => 5500, 'sulfur_content' => 0.30, 'ash_content' => 5.90, 'stock_qty' => 2900, 'unit' => 'ton'],
            ['product_code' => 'COAL-010', 'name' => 'Low Moisture Coal GAR 6000', 'grade' => 'GAR 6000', 'calorific_value' => 6000, 'sulfur_content' => 0.22, 'ash_content' => 5.20, 'stock_qty' => 1700, 'unit' => 'ton'],
            ['product_code' => 'COAL-011', 'name' => 'Power Plant Coal GAR 4100', 'grade' => 'GAR 4100', 'calorific_value' => 4100, 'sulfur_content' => 0.48, 'ash_content' => 8.40, 'stock_qty' => 3600, 'unit' => 'ton'],
            ['product_code' => 'COAL-012', 'name' => 'Cement Grade Coal GAR 4300', 'grade' => 'GAR 4300', 'calorific_value' => 4300, 'sulfur_content' => 0.52, 'ash_content' => 9.30, 'stock_qty' => 2200, 'unit' => 'ton'],
            ['product_code' => 'COAL-013', 'name' => 'Utility Coal GAR 5200', 'grade' => 'GAR 5200', 'calorific_value' => 5200, 'sulfur_content' => 0.37, 'ash_content' => 6.60, 'stock_qty' => 4800, 'unit' => 'ton'],
            ['product_code' => 'COAL-014', 'name' => 'Medium Ash Coal GAR 4800', 'grade' => 'GAR 4800', 'calorific_value' => 4800, 'sulfur_content' => 0.44, 'ash_content' => 8.10, 'stock_qty' => 2600, 'unit' => 'ton'],
            ['product_code' => 'COAL-015', 'name' => 'Premium Export Coal GAR 6400', 'grade' => 'GAR 6400', 'calorific_value' => 6400, 'sulfur_content' => 0.18, 'ash_content' => 4.70, 'stock_qty' => 1200, 'unit' => 'ton'],
            ['product_code' => 'COAL-016', 'name' => 'Domestic Coal GAR 3600', 'grade' => 'GAR 3600', 'calorific_value' => 3600, 'sulfur_content' => 0.65, 'ash_content' => 13.50, 'stock_qty' => 5400, 'unit' => 'ton'],
            ['product_code' => 'COAL-017', 'name' => 'Blended Coal GAR 5100', 'grade' => 'GAR 5100', 'calorific_value' => 5100, 'sulfur_content' => 0.36, 'ash_content' => 6.80, 'stock_qty' => 3100, 'unit' => 'ton'],
            ['product_code' => 'COAL-018', 'name' => 'High CV Coal GAR 5900', 'grade' => 'GAR 5900', 'calorific_value' => 5900, 'sulfur_content' => 0.24, 'ash_content' => 5.60, 'stock_qty' => 900, 'unit' => 'ton'],
            ['product_code' => 'COAL-019', 'name' => 'Bulk Coal GAR 4400', 'grade' => 'GAR 4400', 'calorific_value' => 4400, 'sulfur_content' => 0.46, 'ash_content' => 7.80, 'stock_qty' => 3900, 'unit' => 'ton'],
            ['product_code' => 'COAL-020', 'name' => 'Clean Coal GAR 6100', 'grade' => 'GAR 6100', 'calorific_value' => 6100, 'sulfur_content' => 0.19, 'ash_content' => 4.80, 'stock_qty' => 1500, 'unit' => 'ton'],
        ];

        foreach ($products as $product) {
            CoalProduct::create($product);
        }
    }
}
