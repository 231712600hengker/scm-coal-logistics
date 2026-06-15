<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\CoalProductController;
use App\Http\Controllers\PurchaseOrderController;
use App\Http\Controllers\SalesOrderController;
use App\Http\Controllers\ShipmentController;
use App\Http\Controllers\StockMovementController;

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.alias');

Route::resource('suppliers', SupplierController::class);
Route::resource('customers', CustomerController::class);
Route::resource('coal-products', CoalProductController::class);
Route::resource('purchase-orders', PurchaseOrderController::class);
Route::resource('sales-orders', SalesOrderController::class);
Route::resource('shipments', ShipmentController::class);
Route::resource('stock-movements', StockMovementController::class)->only(['index', 'show']);
