<?php

namespace Database\Seeders;

use App\Models\CoalProduct;
use App\Models\Customer;
use App\Models\PurchaseOrder;
use App\Models\SalesOrder;
use App\Models\Shipment;
use App\Models\StockMovement;
use App\Models\Supplier;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([SupplierSeeder::class, CustomerSeeder::class, CoalProductSeeder::class]);

        $supplier1 = Supplier::where('supplier_code', 'SUP-001')->first();
        $supplier2 = Supplier::where('supplier_code', 'SUP-002')->first();
        $customer1 = Customer::where('customer_code', 'CUS-001')->first();
        $customer2 = Customer::where('customer_code', 'CUS-002')->first();
        $coal1 = CoalProduct::where('product_code', 'COAL-001')->first();
        $coal2 = CoalProduct::where('product_code', 'COAL-002')->first();
        $coal3 = CoalProduct::where('product_code', 'COAL-003')->first();

        $po1 = PurchaseOrder::create(['po_number' => 'PO-2026-001', 'supplier_id' => $supplier1->id, 'coal_product_id' => $coal1->id, 'order_date' => '2026-06-01', 'quantity' => 1500, 'price_per_ton' => 750000, 'total_amount' => 1125000000, 'status' => 'received']);
        $po2 = PurchaseOrder::create(['po_number' => 'PO-2026-002', 'supplier_id' => $supplier2->id, 'coal_product_id' => $coal2->id, 'order_date' => '2026-06-04', 'quantity' => 1000, 'price_per_ton' => 850000, 'total_amount' => 850000000, 'status' => 'approved']);

        $so1 = SalesOrder::create(['so_number' => 'SO-2026-001', 'customer_id' => $customer1->id, 'coal_product_id' => $coal1->id, 'order_date' => '2026-06-07', 'quantity' => 600, 'price_per_ton' => 950000, 'total_amount' => 570000000, 'status' => 'shipped']);
        $so2 = SalesOrder::create(['so_number' => 'SO-2026-002', 'customer_id' => $customer2->id, 'coal_product_id' => $coal3->id, 'order_date' => '2026-06-09', 'quantity' => 250, 'price_per_ton' => 1100000, 'total_amount' => 275000000, 'status' => 'pending']);

        Shipment::create(['shipment_number' => 'SHIP-2026-001', 'sales_order_id' => $so1->id, 'vehicle_number' => 'KT 8123 CL', 'driver_name' => 'Rahmat Hidayat', 'shipment_date' => '2026-06-10', 'origin' => 'Samarinda Stockyard', 'destination' => 'Cilegon Plant', 'status' => 'in_transit']);
        Shipment::create(['shipment_number' => 'SHIP-2026-002', 'sales_order_id' => $so2->id, 'vehicle_number' => 'DA 4451 CA', 'driver_name' => 'Arman Putra', 'shipment_date' => '2026-06-12', 'origin' => 'Banjarmasin Port', 'destination' => 'Gresik Plant', 'status' => 'scheduled']);

        StockMovement::create(['coal_product_id' => $coal1->id, 'type' => 'in', 'quantity' => 1500, 'reference_type' => 'purchase_order', 'reference_id' => $po1->id, 'description' => 'Initial received stock from PO-2026-001']);
        StockMovement::create(['coal_product_id' => $coal1->id, 'type' => 'out', 'quantity' => 600, 'reference_type' => 'sales_order', 'reference_id' => $so1->id, 'description' => 'Initial shipped stock for SO-2026-001']);
    }
}
