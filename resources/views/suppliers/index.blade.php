@extends('layouts.app')

@section('title', 'Suppliers')

@section('content')
<div class="space-y-6">
    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h2 class="text-2xl font-bold text-gray-900">Suppliers</h2>
            <p class="mt-1 text-sm text-gray-600">Manage coal suppliers used in purchase and logistics processes.</p>
        </div>

        <a href="{{ route('suppliers.create') }}" class="inline-flex items-center justify-center rounded-lg bg-gray-900 px-4 py-2 text-sm font-semibold text-white shadow-sm transition hover:bg-gray-700">
            Add Supplier
        </a>
    </div>

    <form method="GET" action="{{ route('suppliers.index') }}" class="rounded-xl border border-gray-200 bg-white p-4 shadow-sm">
        <div class="grid grid-cols-1 gap-3 md:grid-cols-4">
            <input type="text" name="search" value="{{ $search ?? '' }}" placeholder="Search code, name, PIC, phone, or email" class="md:col-span-3 rounded-lg border-gray-300 shadow-sm focus:border-gray-900 focus:ring-gray-900">
            <div class="flex gap-2">
                <button type="submit" class="flex-1 rounded-lg bg-gray-900 px-4 py-2 text-sm font-semibold text-white hover:bg-gray-700">Search</button>
                <a href="{{ route('suppliers.index') }}" class="rounded-lg border border-gray-300 px-4 py-2 text-sm font-semibold text-gray-700 hover:bg-gray-50">Reset</a>
            </div>
        </div>
    </form>

    <div class="overflow-hidden rounded-xl border border-gray-200 bg-white shadow-sm">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">Supplier Code</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">Name</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">Contact Person</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">Phone</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">Email</th>
                        <th class="px-6 py-3 text-right text-xs font-semibold uppercase tracking-wider text-gray-500">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 bg-white">
                    @forelse ($suppliers as $supplier)
                        <tr class="hover:bg-gray-50">
                            <td class="whitespace-nowrap px-6 py-4 text-sm font-medium text-gray-900">{{ $supplier->supplier_code }}</td>
                            <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-700">{{ $supplier->name }}</td>
                            <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-700">{{ $supplier->contact_person ?? '-' }}</td>
                            <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-700">{{ $supplier->phone ?? '-' }}</td>
                            <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-700">{{ $supplier->email ?? '-' }}</td>
                            <td class="whitespace-nowrap px-6 py-4 text-right text-sm font-medium">
                                <div class="flex justify-end gap-3">
                                    <a href="{{ route('suppliers.show', $supplier) }}" class="text-blue-600 hover:text-blue-900">View</a>
                                    <a href="{{ route('suppliers.edit', $supplier) }}" class="text-yellow-600 hover:text-yellow-900">Edit</a>
                                    <form action="{{ route('suppliers.destroy', $supplier) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this supplier?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-10 text-center text-sm text-gray-500">No supplier data matches your search.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="border-t border-gray-200 px-6 py-4">
            {{ $suppliers->links() }}
        </div>
    </div>
</div>
@endsection
