@extends('layouts.app')

@section('title', 'Stock Movements')

@section('content')
<div class="space-y-6">
    <div>
        <h2 class="text-2xl font-bold text-gray-900">Stock Movements</h2>
        <p class="mt-1 text-sm text-gray-600">Review inbound and outbound stock history generated from purchasing and sales activity.</p>
    </div>

    <form method="GET" action="{{ route('stock-movements.index') }}" class="rounded-xl border border-gray-200 bg-white p-4 shadow-sm">
        <div class="grid grid-cols-1 gap-3 md:grid-cols-4">
            <input type="text" name="search" value="{{ $search ?? '' }}" placeholder="Search product, reference, or description" class="md:col-span-2 rounded-lg border-gray-300 shadow-sm focus:border-gray-900 focus:ring-gray-900">
            <select name="type" class="rounded-lg border-gray-300 shadow-sm focus:border-gray-900 focus:ring-gray-900">
                <option value="">All Types</option>
                <option value="in" @selected(($type ?? '') === 'in')>Inbound</option>
                <option value="out" @selected(($type ?? '') === 'out')>Outbound</option>
            </select>
            <div class="flex gap-2">
                <button type="submit" class="flex-1 rounded-lg bg-gray-900 px-4 py-2 text-sm font-semibold text-white hover:bg-gray-700">Filter</button>
                <a href="{{ route('stock-movements.index') }}" class="rounded-lg border border-gray-300 px-4 py-2 text-sm font-semibold text-gray-700 hover:bg-gray-50">Reset</a>
            </div>
        </div>
    </form>

    <div class="overflow-x-auto rounded-xl border border-gray-200 bg-white shadow-sm">
        <table class="min-w-full divide-y divide-gray-200 text-sm">
            <thead class="bg-gray-50 text-left text-xs uppercase tracking-wider text-gray-500">
                <tr>
                    <th class="px-4 py-3">Date</th>
                    <th class="px-4 py-3">Coal Product</th>
                    <th class="px-4 py-3">Type</th>
                    <th class="px-4 py-3">Quantity</th>
                    <th class="px-4 py-3">Reference Type</th>
                    <th class="px-4 py-3">Reference ID</th>
                    <th class="px-4 py-3">Description</th>
                    <th class="px-4 py-3 text-right">Action</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($stockMovements as $movement)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-3">{{ $movement->created_at?->format('Y-m-d H:i') }}</td>
                        <td class="px-4 py-3">{{ $movement->coalProduct->name ?? '-' }}</td>
                        <td class="px-4 py-3">
                            <span class="inline-flex rounded-full px-2.5 py-1 text-xs font-semibold ring-1 ring-inset {{ $movement->type === 'in' ? 'bg-green-100 text-green-800 ring-green-200' : 'bg-red-100 text-red-800 ring-red-200' }}">
                                {{ $movement->type === 'in' ? 'Inbound' : 'Outbound' }}
                            </span>
                        </td>
                        <td class="px-4 py-3">{{ number_format($movement->quantity, 2) }}</td>
                        <td class="px-4 py-3">{{ str_replace('_', ' ', $movement->reference_type) }}</td>
                        <td class="px-4 py-3">{{ $movement->reference_id }}</td>
                        <td class="px-4 py-3">{{ $movement->description ?? '-' }}</td>
                        <td class="px-4 py-3 text-right"><a class="text-blue-600 hover:text-blue-900" href="{{ route('stock-movements.show', $movement) }}">View</a></td>
                    </tr>
                @empty
                    <tr><td colspan="8" class="px-4 py-8 text-center text-gray-500">No stock movements match your filter.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div>{{ $stockMovements->links() }}</div>
</div>
@endsection
