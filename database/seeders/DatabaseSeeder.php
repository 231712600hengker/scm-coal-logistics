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

        $suppliers = Supplier::orderBy('id')->get();
        $customers = Customer::orderBy('id')->get();
        $products = CoalProduct::orderBy('id')->get();

        $purchaseStatuses = ['received', 'approved', 'pending', 'received', 'cancelled'];
        $salesStatuses = ['completed', 'shipped', 'approved', 'pending', 'cancelled'];
        $shipmentStatuses = ['delivered', 'in_transit', 'scheduled', 'delivered', 'cancelled'];

        $receivedPurchaseOrders = [];
        $fulfilledSalesOrders = [];
        $salesOrdersForShipment = [];

        for ($i = 1; $i <= 20; $i++) {
            $product = $products[($i - 1) % $products->count()];
            $supplier = $suppliers[($i - 1) % $suppliers->count()];
            $quantity = 500 + ($i * 75);
            $pricePerTon = 650000 + ($i * 12500);
            $status = $purchaseStatuses[($i - 1) % count($purchaseStatuses)];

            $purchaseOrder = PurchaseOrder::create([
                'po_number' => sprintf('PO-2026-%03d', $i),
                'supplier_id' => $supplier->id,
                'coal_product_id' => $product->id,
                'order_date' => now()->subDays(45 - $i)->toDateString(),
                'quantity' => $quantity,
                'price_per_ton' => $pricePerTon,
                'total_amount' => $quantity * $pricePerTon,
                'status' => $status,
            ]);

            if ($status === 'received') {
                $product->increment('stock_qty', $quantity);
                $receivedPurchaseOrders[] = [$purchaseOrder, $product, $quantity];
            }
        }

        for ($i = 1; $i <= 20; $i++) {
            $product = $products[($i - 1) % $products->count()];
            $customer = $customers[($i - 1) % $customers->count()];
            $quantity = 120 + ($i * 18);
            $pricePerTon = 850000 + ($i * 15000);
            $status = $salesStatuses[($i - 1) % count($salesStatuses)];

            $salesOrder = SalesOrder::create([
                'so_number' => sprintf('SO-2026-%03d', $i),
                'customer_id' => $customer->id,
                'coal_product_id' => $product->id,
                'order_date' => now()->subDays(30 - $i)->toDateString(),
                'quantity' => $quantity,
                'price_per_ton' => $pricePerTon,
                'total_amount' => $quantity * $pricePerTon,
                'status' => $status,
            ]);

            if (in_array($status, ['shipped', 'completed'], true)) {
                $product->decrement('stock_qty', $quantity);
                $fulfilledSalesOrders[] = [$salesOrder, $product, $quantity];
            }

            if ($status !== 'cancelled') {
                $salesOrdersForShipment[] = $salesOrder;
            }
        }

        foreach ($salesOrdersForShipment as $index => $salesOrder) {
            Shipment::create([
                'shipment_number' => sprintf('SHIP-2026-%03d', $index + 1),
                'sales_order_id' => $salesOrder->id,
                'vehicle_number' => 'TRK ' . str_pad((string) (8100 + $index), 4, '0', STR_PAD_LEFT) . ' CL',
                'driver_name' => ['Rahmat Hidayat', 'Arman Putra', 'Doni Saputra', 'Fahri Akbar', 'Rizky Maulana'][$index % 5],
                'shipment_date' => now()->subDays(18 - $index)->toDateString(),
                'origin' => ['Samarinda Stockyard', 'Banjarmasin Port', 'Balikpapan Hub', 'Muara Enim Yard', 'Berau Terminal'][$index % 5],
                'destination' => ['Cilegon Plant', 'Gresik Plant', 'Tuban Factory', 'Suralaya Power Plant', 'Morowali Smelter'][$index % 5],
                'status' => $shipmentStatuses[$index % count($shipmentStatuses)],
            ]);
        }

        foreach ($receivedPurchaseOrders as [$purchaseOrder, $product, $quantity]) {
            StockMovement::create([
                'coal_product_id' => $product->id,
                'type' => 'in',
                'quantity' => $quantity,
                'reference_type' => 'purchase_order',
                'reference_id' => $purchaseOrder->id,
                'description' => 'Received stock from ' . $purchaseOrder->po_number,
            ]);
        }

        foreach ($fulfilledSalesOrders as [$salesOrder, $product, $quantity]) {
            StockMovement::create([
                'coal_product_id' => $product->id,
                'type' => 'out',
                'quantity' => $quantity,
                'reference_type' => 'sales_order',
                'reference_id' => $salesOrder->id,
                'description' => 'Issued stock for ' . $salesOrder->so_number,
            ]);
        }
    }
}
