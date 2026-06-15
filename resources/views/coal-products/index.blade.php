@extends('layouts.app')

@section('title', 'Coal Products')

@section('content')
<div class="space-y-6">
    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h2 class="text-2xl font-bold text-gray-900">Coal Products</h2>
            <p class="mt-1 text-sm text-gray-600">Manage coal specifications, quality values, and stock availability.</p>
        </div>
        <a href="{{ route('coal-products.create') }}" class="rounded-lg bg-gray-900 px-4 py-2 text-sm font-semibold text-white hover:bg-gray-700">Add Coal Product</a>
    </div>

    <form method="GET" action="{{ route('coal-products.index') }}" class="rounded-xl border border-gray-200 bg-white p-4 shadow-sm">
        <div class="grid grid-cols-1 gap-3 md:grid-cols-4">
            <input type="text" name="search" value="{{ $search ?? '' }}" placeholder="Search product code, name, grade, or unit" class="md:col-span-2 rounded-lg border-gray-300 shadow-sm focus:border-gray-900 focus:ring-gray-900">
            <select name="stock" class="rounded-lg border-gray-300 shadow-sm focus:border-gray-900 focus:ring-gray-900">
                <option value="">All Stock</option>
                <option value="available" @selected(($stock ?? '') === 'available')>Available Stock</option>
                <option value="low" @selected(($stock ?? '') === 'low')>Low Stock (<= 1000)</option>
                <option value="empty" @selected(($stock ?? '') === 'empty')>Empty Stock</option>
            </select>
            <div class="flex gap-2">
                <button type="submit" class="flex-1 rounded-lg bg-gray-900 px-4 py-2 text-sm font-semibold text-white hover:bg-gray-700">Filter</button>
                <a href="{{ route('coal-products.index') }}" class="rounded-lg border border-gray-300 px-4 py-2 text-sm font-semibold text-gray-700 hover:bg-gray-50">Reset</a>
            </div>
        </div>
    </form>

    <div class="overflow-x-auto rounded-xl border border-gray-200 bg-white shadow-sm">
        <table class="min-w-full divide-y divide-gray-200 text-sm">
            <thead class="bg-gray-50 text-left text-xs uppercase tracking-wider text-gray-500">
                <tr>
                    <th class="px-4 py-3">Product Code</th>
                    <th class="px-4 py-3">Name</th>
                    <th class="px-4 py-3">Grade</th>
                    <th class="px-4 py-3">Calorific Value</th>
                    <th class="px-4 py-3">Sulfur Content</th>
                    <th class="px-4 py-3">Ash Content</th>
                    <th class="px-4 py-3">Stock Qty</th>
                    <th class="px-4 py-3">Unit</th>
                    <th class="px-4 py-3 text-right">Action</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($coalProducts as $product)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-3 font-medium text-gray-900">{{ $product->product_code }}</td>
                        <td class="px-4 py-3">{{ $product->name }}</td>
                        <td class="px-4 py-3">{{ $product->grade ?? '-' }}</td>
                        <td class="px-4 py-3">{{ $product->calorific_value ?? '-' }}</td>
                        <td class="px-4 py-3">{{ $product->sulfur_content ?? '-' }}</td>
                        <td class="px-4 py-3">{{ $product->ash_content ?? '-' }}</td>
                        <td class="px-4 py-3">
                            <span class="inline-flex rounded-full px-2.5 py-1 text-xs font-semibold ring-1 ring-inset {{ $product->stock_qty <= 0 ? 'bg-red-100 text-red-800 ring-red-200' : ($product->stock_qty <= 1000 ? 'bg-yellow-100 text-yellow-800 ring-yellow-200' : 'bg-green-100 text-green-800 ring-green-200') }}">
                                {{ number_format($product->stock_qty, 2) }}
                            </span>
                        </td>
                        <td class="px-4 py-3">{{ $product->unit }}</td>
                        <td class="px-4 py-3 text-right">
                            <div class="flex justify-end gap-2">
                                <a class="text-blue-600 hover:text-blue-900" href="{{ route('coal-products.show', $product) }}">View</a>
                                <a class="text-yellow-600 hover:text-yellow-900" href="{{ route('coal-products.edit', $product) }}">Edit</a>
                                <form method="POST" action="{{ route('coal-products.destroy', $product) }}" onsubmit="return confirm('Delete this coal product?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="text-red-600 hover:text-red-900">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="9" class="px-4 py-8 text-center text-gray-500">No coal products match your filter.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div>{{ $coalProducts->links() }}</div>
</div>
@endsection
