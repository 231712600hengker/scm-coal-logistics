<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use App\Models\Customer;
use App\Models\CoalProduct;
use App\Models\PurchaseOrder;
use App\Models\SalesOrder;
use App\Models\Shipment;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard', [
            'totalSuppliers' => Supplier::count(),
            'totalCustomers' => Customer::count(),
            'totalProducts' => CoalProduct::count(),
            'totalPurchaseOrders' => PurchaseOrder::count(),
            'totalSalesOrders' => SalesOrder::count(),
            'totalShipments' => Shipment::count(),
            'lowStockProducts' => CoalProduct::where('stock_qty', '<=', 1000)->get(),
            'products' => CoalProduct::latest()->take(5)->get(),
        ]);
    }
}