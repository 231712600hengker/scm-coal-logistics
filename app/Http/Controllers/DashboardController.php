<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use App\Models\Customer;
use App\Models\CoalProduct;
use App\Models\PurchaseOrder;
use App\Models\SalesOrder;
use App\Models\Shipment;
use App\Models\StockMovement;

class DashboardController extends Controller
{
    public function index()
    {
        $totalSalesOrders = SalesOrder::count();
        $fulfilledOrders = SalesOrder::whereIn('status', ['shipped', 'completed'])->count();
        $totalStockCapacity = CoalProduct::sum('stock_qty');
        $availableProducts = CoalProduct::where('stock_qty', '>', 0)->count();
        $totalProducts = CoalProduct::count();

        return view('dashboard', [
            'totalSuppliers' => Supplier::count(),
            'totalCustomers' => Customer::count(),
            'totalProducts' => $totalProducts,
            'totalPurchaseOrders' => PurchaseOrder::count(),
            'totalSalesOrders' => $totalSalesOrders,
            'totalShipments' => Shipment::count(),
            'totalStockMovements' => StockMovement::count(),
            'lowStockProducts' => CoalProduct::where('stock_qty', '<=', 1000)->latest()->get(),
            'products' => CoalProduct::latest()->take(5)->get(),
            'shipmentStatuses' => Shipment::selectRaw('status, COUNT(*) as total')->groupBy('status')->orderBy('status')->get(),
            'totalInbound' => StockMovement::where('type', 'in')->sum('quantity'),
            'totalOutbound' => StockMovement::where('type', 'out')->sum('quantity'),
            'activeShipments' => Shipment::whereIn('status', ['scheduled', 'in_transit'])->count(),
            'deliveredShipments' => Shipment::where('status', 'delivered')->count(),
            'stockAvailability' => $totalProducts > 0 ? round(($availableProducts / $totalProducts) * 100, 2) : 0,
            'totalStockCapacity' => $totalStockCapacity,
            'orderFulfillment' => $totalSalesOrders > 0 ? round(($fulfilledOrders / $totalSalesOrders) * 100, 2) : 0,
        ]);
    }
}
