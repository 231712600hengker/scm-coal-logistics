@extends('layouts.app')

@section('title', 'Purchase Orders')

@section('content')
@php
    $statusClasses = [
        'pending' => 'bg-yellow-100 text-yellow-800 ring-yellow-200',
        'approved' => 'bg-blue-100 text-blue-800 ring-blue-200',
        'received' => 'bg-green-100 text-green-800 ring-green-200',
        'cancelled' => 'bg-red-100 text-red-800 ring-red-200',
    ];
@endphp

<div class="space-y-6">
    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h2 class="text-2xl font-bold text-gray-900">Purchase Orders</h2>
            <p class="mt-1 text-sm text-gray-600">Track inbound coal procurement from suppliers.</p>
        </div>
        <a href="{{ route('purchase-orders.create') }}" class="rounded-lg bg-gray-900 px-4 py-2 text-sm font-semibold text-white hover:bg-gray-700">Add Purchase Order</a>
    </div>

    <form method="GET" action="{{ route('purchase-orders.index') }}" class="rounded-xl border border-gray-200 bg-white p-4 shadow-sm">
        <div class="grid grid-cols-1 gap-3 md:grid-cols-4">
            <input type="text" name="search" value="{{ $search ?? '' }}" placeholder="Search PO, supplier, or product" class="md:col-span-2 rounded-lg border-gray-300 shadow-sm focus:border-gray-900 focus:ring-gray-900">
            <select name="status" class="rounded-lg border-gray-300 shadow-sm focus:border-gray-900 focus:ring-gray-900">
                <option value="">All Statuses</option>
                @foreach(['pending' => 'Pending', 'approved' => 'Approved', 'received' => 'Received', 'cancelled' => 'Cancelled'] as $value => $label)
                    <option value="{{ $value }}" @selected(($status ?? '') === $value)>{{ $label }}</option>
                @endforeach
            </select>
            <div class="flex gap-2">
                <button type="submit" class="flex-1 rounded-lg bg-gray-900 px-4 py-2 text-sm font-semibold text-white hover:bg-gray-700">Filter</button>
                <a href="{{ route('purchase-orders.index') }}" class="rounded-lg border border-gray-300 px-4 py-2 text-sm font-semibold text-gray-700 hover:bg-gray-50">Reset</a>
            </div>
        </div>
    </form>

    <div class="overflow-x-auto rounded-xl border border-gray-200 bg-white shadow-sm">
        <table class="min-w-full divide-y divide-gray-200 text-sm">
            <thead class="bg-gray-50 text-left text-xs uppercase tracking-wider text-gray-500">
                <tr>
                    <th class="px-4 py-3">PO Number</th><th class="px-4 py-3">Supplier</th><th class="px-4 py-3">Coal Product</th><th class="px-4 py-3">Order Date</th><th class="px-4 py-3">Quantity</th><th class="px-4 py-3">Price Per Ton</th><th class="px-4 py-3">Total Amount</th><th class="px-4 py-3">Status</th><th class="px-4 py-3 text-right">Action</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($purchaseOrders as $order)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-3 font-medium text-gray-900">{{ $order->po_number }}</td>
                        <td class="px-4 py-3">{{ $order->supplier->name ?? '-' }}</td>
                        <td class="px-4 py-3">{{ $order->coalProduct->name ?? '-' }}</td>
                        <td class="px-4 py-3">{{ $order->order_date }}</td>
                        <td class="px-4 py-3">{{ number_format($order->quantity, 2) }}</td>
                        <td class="px-4 py-3">{{ number_format($order->price_per_ton, 2) }}</td>
                        <td class="px-4 py-3">{{ number_format($order->total_amount, 2) }}</td>
                        <td class="px-4 py-3"><span class="inline-flex rounded-full px-2.5 py-1 text-xs font-semibold capitalize ring-1 ring-inset {{ $statusClasses[$order->status] ?? 'bg-gray-100 text-gray-800 ring-gray-200' }}">{{ str_replace('_', ' ', $order->status) }}</span></td>
                        <td class="px-4 py-3 text-right"><div class="flex justify-end gap-2"><a class="text-blue-600" href="{{ route('purchase-orders.show', $order) }}">View</a><a class="text-yellow-600" href="{{ route('purchase-orders.edit', $order) }}">Edit</a><form method="POST" action="{{ route('purchase-orders.destroy', $order) }}" onsubmit="return confirm('Delete this purchase order?')">@csrf @method('DELETE')<button class="text-red-600">Delete</button></form></div></td>
                    </tr>
                @empty
                    <tr><td colspan="9" class="px-4 py-8 text-center text-gray-500">No purchase orders match your filter.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div>{{ $purchaseOrders->links() }}</div>
</div>
@endsection
