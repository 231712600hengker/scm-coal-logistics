<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\CoalProductController;

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

Route::resource('suppliers', SupplierController::class);
Route::resource('customers', CustomerController::class);
Route::resource('coal-products', CoalProductController::class);