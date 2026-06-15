@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-4">
    <div class="rounded-xl border border-gray-200 bg-white p-6 shadow-sm"><p class="text-sm text-gray-500">Total Suppliers</p><p class="mt-2 text-3xl font-bold">{{ number_format($totalSuppliers) }}</p></div>
    <div class="rounded-xl border border-gray-200 bg-white p-6 shadow-sm"><p class="text-sm text-gray-500">Total Customers</p><p class="mt-2 text-3xl font-bold">{{ number_format($totalCustomers) }}</p></div>
    <div class="rounded-xl border border-gray-200 bg-white p-6 shadow-sm"><p class="text-sm text-gray-500">Coal Products</p><p class="mt-2 text-3xl font-bold">{{ number_format($totalProducts) }}</p></div>
    <div class="rounded-xl border border-gray-200 bg-white p-6 shadow-sm"><p class="text-sm text-gray-500">Purchase Orders</p><p class="mt-2 text-3xl font-bold">{{ number_format($totalPurchaseOrders) }}</p></div>
    <div class="rounded-xl border border-gray-200 bg-white p-6 shadow-sm"><p class="text-sm text-gray-500">Sales Orders</p><p class="mt-2 text-3xl font-bold">{{ number_format($totalSalesOrders) }}</p></div>
    <div class="rounded-xl border border-gray-200 bg-white p-6 shadow-sm"><p class="text-sm text-gray-500">Shipments</p><p class="mt-2 text-3xl font-bold">{{ number_format($totalShipments) }}</p></div>
    <div class="rounded-xl border border-gray-200 bg-white p-6 shadow-sm"><p class="text-sm text-gray-500">Stock Movements</p><p class="mt-2 text-3xl font-bold">{{ number_format($totalStockMovements) }}</p></div>
</div>

<div class="mt-8 grid grid-cols-1 gap-6 lg:grid-cols-2">
    <div class="rounded-xl border border-gray-200 bg-white p-6 shadow-sm">
        <h2 class="mb-4 text-lg font-semibold">5 Latest Coal Products</h2>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 text-sm">
                <thead class="bg-gray-50 text-left text-xs uppercase text-gray-500"><tr><th class="px-4 py-3">Code</th><th class="px-4 py-3">Name</th><th class="px-4 py-3">Grade</th><th class="px-4 py-3 text-right">Stock</th></tr></thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse ($products as $product)
                        <tr><td class="px-4 py-3 font-medium">{{ $product->product_code }}</td><td class="px-4 py-3">{{ $product->name }}</td><td class="px-4 py-3">{{ $product->grade ?? '-' }}</td><td class="px-4 py-3 text-right">{{ number_format($product->stock_qty, 2) }} {{ $product->unit }}</td></tr>
                    @empty
                        <tr><td colspan="4" class="px-4 py-6 text-center text-gray-500">No product data available.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="rounded-xl border border-gray-200 bg-white p-6 shadow-sm">
        <h2 class="mb-4 text-lg font-semibold">Low Stock Alert</h2>
        @forelse ($lowStockProducts as $product)
            <div class="mb-3 rounded-lg border border-red-200 bg-red-50 p-4 text-sm"><p class="font-semibold text-red-800">{{ $product->name }}</p><p class="text-red-700">Current stock: {{ number_format($product->stock_qty, 2) }} {{ $product->unit }}</p></div>
        @empty
            <p class="text-sm text-gray-500">No low stock products.</p>
        @endforelse
    </div>
</div>

<div class="mt-8 rounded-xl border border-gray-200 bg-white p-6 shadow-sm">
    <h2 class="mb-4 text-lg font-semibold">Shipment Status Summary</h2>
    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4">
        @forelse ($shipmentStatuses as $item)
            <div class="rounded-lg border border-gray-200 p-4"><p class="text-sm font-medium capitalize text-gray-500">{{ str_replace('_', ' ', $item->status) }}</p><p class="mt-2 text-2xl font-bold">{{ $item->total }}</p></div>
        @empty
            <p class="text-sm text-gray-500">No shipment data available.</p>
        @endforelse
    </div>
</div>
@endsection
