@extends('layouts.app')

@section('title', 'SCOR Dashboard')

@section('content')
<div class="space-y-8">
    <div class="rounded-2xl border border-gray-200 bg-white p-6 shadow-sm">
        <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
            <div>
                <p class="text-xs font-semibold uppercase tracking-widest text-gray-500">Supply Chain Operations Reference</p>
                <h2 class="mt-2 text-3xl font-bold text-gray-900">SCM Coal Logistics Dashboard</h2>
                <p class="mt-2 max-w-3xl text-sm text-gray-600">A compact operational view for inbound purchasing, outbound sales, shipment execution, stock availability, and order fulfillment performance.</p>
            </div>
            <div class="grid grid-cols-2 gap-3 text-sm sm:grid-cols-4 lg:w-[520px]">
                <a href="{{ route('purchase-orders.index') }}" class="rounded-xl bg-orange-50 p-4 text-center font-semibold text-orange-800 ring-1 ring-orange-100 hover:bg-orange-100">Inbound</a>
                <a href="{{ route('sales-orders.index') }}" class="rounded-xl bg-blue-50 p-4 text-center font-semibold text-blue-800 ring-1 ring-blue-100 hover:bg-blue-100">Outbound</a>
                <a href="{{ route('shipments.index') }}" class="rounded-xl bg-purple-50 p-4 text-center font-semibold text-purple-800 ring-1 ring-purple-100 hover:bg-purple-100">Shipments</a>
                <a href="{{ route('stock-movements.index') }}" class="rounded-xl bg-green-50 p-4 text-center font-semibold text-green-800 ring-1 ring-green-100 hover:bg-green-100">Inventory</a>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 gap-6 md:grid-cols-2 xl:grid-cols-6">
        <div class="rounded-2xl border border-gray-200 bg-white p-5 shadow-sm xl:col-span-1">
            <p class="text-xs font-semibold uppercase tracking-wider text-gray-500">Total Inbound</p>
            <p class="mt-3 text-3xl font-bold text-green-700">{{ number_format($totalInbound, 2) }}</p>
            <p class="mt-1 text-xs text-gray-500">Stock received from purchase orders</p>
        </div>
        <div class="rounded-2xl border border-gray-200 bg-white p-5 shadow-sm xl:col-span-1">
            <p class="text-xs font-semibold uppercase tracking-wider text-gray-500">Total Outbound</p>
            <p class="mt-3 text-3xl font-bold text-red-700">{{ number_format($totalOutbound, 2) }}</p>
            <p class="mt-1 text-xs text-gray-500">Stock released to sales orders</p>
        </div>
        <div class="rounded-2xl border border-gray-200 bg-white p-5 shadow-sm xl:col-span-1">
            <p class="text-xs font-semibold uppercase tracking-wider text-gray-500">Active Shipment</p>
            <p class="mt-3 text-3xl font-bold text-purple-700">{{ number_format($activeShipments) }}</p>
            <p class="mt-1 text-xs text-gray-500">Scheduled and in transit</p>
        </div>
        <div class="rounded-2xl border border-gray-200 bg-white p-5 shadow-sm xl:col-span-1">
            <p class="text-xs font-semibold uppercase tracking-wider text-gray-500">Delivered Shipment</p>
            <p class="mt-3 text-3xl font-bold text-green-700">{{ number_format($deliveredShipments) }}</p>
            <p class="mt-1 text-xs text-gray-500">Delivered shipment records</p>
        </div>
        <div class="rounded-2xl border border-gray-200 bg-white p-5 shadow-sm xl:col-span-1">
            <p class="text-xs font-semibold uppercase tracking-wider text-gray-500">Stock Availability</p>
            <p class="mt-3 text-3xl font-bold text-blue-700">{{ number_format($stockAvailability, 2) }}%</p>
            <p class="mt-1 text-xs text-gray-500">Products with positive stock</p>
        </div>
        <div class="rounded-2xl border border-gray-200 bg-white p-5 shadow-sm xl:col-span-1">
            <p class="text-xs font-semibold uppercase tracking-wider text-gray-500">Order Fulfillment</p>
            <p class="mt-3 text-3xl font-bold text-gray-900">{{ number_format($orderFulfillment, 2) }}%</p>
            <p class="mt-1 text-xs text-gray-500">Shipped or completed SO</p>
        </div>
    </div>

    <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">
        <div class="rounded-2xl border border-gray-200 bg-white p-6 shadow-sm lg:col-span-2">
            <div class="mb-5 flex items-center justify-between">
                <div>
                    <h3 class="text-lg font-semibold text-gray-900">Operational Summary</h3>
                    <p class="text-sm text-gray-500">Core SCM objects currently stored in the system.</p>
                </div>
            </div>
            <div class="grid grid-cols-2 gap-4 md:grid-cols-4">
                <div class="rounded-xl border border-gray-100 bg-gray-50 p-4"><p class="text-xs text-gray-500">Suppliers</p><p class="mt-2 text-2xl font-bold">{{ number_format($totalSuppliers) }}</p></div>
                <div class="rounded-xl border border-gray-100 bg-gray-50 p-4"><p class="text-xs text-gray-500">Customers</p><p class="mt-2 text-2xl font-bold">{{ number_format($totalCustomers) }}</p></div>
                <div class="rounded-xl border border-gray-100 bg-gray-50 p-4"><p class="text-xs text-gray-500">Products</p><p class="mt-2 text-2xl font-bold">{{ number_format($totalProducts) }}</p></div>
                <div class="rounded-xl border border-gray-100 bg-gray-50 p-4"><p class="text-xs text-gray-500">Total Stock</p><p class="mt-2 text-2xl font-bold">{{ number_format($totalStockCapacity, 2) }}</p></div>
                <div class="rounded-xl border border-gray-100 bg-gray-50 p-4"><p class="text-xs text-gray-500">Purchase Orders</p><p class="mt-2 text-2xl font-bold">{{ number_format($totalPurchaseOrders) }}</p></div>
                <div class="rounded-xl border border-gray-100 bg-gray-50 p-4"><p class="text-xs text-gray-500">Sales Orders</p><p class="mt-2 text-2xl font-bold">{{ number_format($totalSalesOrders) }}</p></div>
                <div class="rounded-xl border border-gray-100 bg-gray-50 p-4"><p class="text-xs text-gray-500">Shipments</p><p class="mt-2 text-2xl font-bold">{{ number_format($totalShipments) }}</p></div>
                <div class="rounded-xl border border-gray-100 bg-gray-50 p-4"><p class="text-xs text-gray-500">Stock Movements</p><p class="mt-2 text-2xl font-bold">{{ number_format($totalStockMovements) }}</p></div>
            </div>
        </div>

        <div class="rounded-2xl border border-gray-200 bg-white p-6 shadow-sm">
            <h3 class="text-lg font-semibold text-gray-900">Shipment Status</h3>
            <p class="mb-4 text-sm text-gray-500">Delivery pipeline by status.</p>
            <div class="space-y-3">
                @forelse ($shipmentStatuses as $item)
                    <div class="flex items-center justify-between rounded-xl border border-gray-100 bg-gray-50 px-4 py-3">
                        <span class="text-sm font-medium capitalize text-gray-700">{{ str_replace('_', ' ', $item->status) }}</span>
                        <span class="rounded-full bg-white px-3 py-1 text-sm font-bold text-gray-900 ring-1 ring-gray-200">{{ $item->total }}</span>
                    </div>
                @empty
                    <p class="text-sm text-gray-500">No shipment data available.</p>
                @endforelse
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 gap-6 lg:grid-cols-2">
        <div class="rounded-2xl border border-gray-200 bg-white p-6 shadow-sm">
            <h3 class="mb-4 text-lg font-semibold text-gray-900">Latest Coal Products</h3>
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

        <div class="rounded-2xl border border-gray-200 bg-white p-6 shadow-sm">
            <h3 class="mb-4 text-lg font-semibold text-gray-900">Low Stock Alert</h3>
            <div class="space-y-3">
                @forelse ($lowStockProducts as $product)
                    <div class="rounded-xl border border-red-200 bg-red-50 p-4 text-sm">
                        <p class="font-semibold text-red-800">{{ $product->name }} <span class="font-normal text-red-600">({{ $product->product_code }})</span></p>
                        <p class="mt-1 text-red-700">Current stock: {{ number_format($product->stock_qty, 2) }} {{ $product->unit }}</p>
                    </div>
                @empty
                    <p class="text-sm text-gray-500">No low stock products.</p>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection
