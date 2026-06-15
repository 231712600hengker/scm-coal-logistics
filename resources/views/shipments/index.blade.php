@extends('layouts.app')

@section('title', 'Shipments')

@section('content')
@php
    $statusClasses = [
        'scheduled' => 'bg-blue-100 text-blue-800 ring-blue-200',
        'in_transit' => 'bg-purple-100 text-purple-800 ring-purple-200',
        'delivered' => 'bg-green-100 text-green-800 ring-green-200',
        'cancelled' => 'bg-red-100 text-red-800 ring-red-200',
    ];
@endphp

<div class="space-y-6">
    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h2 class="text-2xl font-bold text-gray-900">Shipments</h2>
            <p class="mt-1 text-sm text-gray-600">Track shipment execution, active deliveries, vehicles, drivers, and destination routes.</p>
        </div>
        <a href="{{ route('shipments.create') }}" class="rounded-lg bg-gray-900 px-4 py-2 text-sm font-semibold text-white hover:bg-gray-700">Add Shipment</a>
    </div>

    <form method="GET" action="{{ route('shipments.index') }}" class="rounded-xl border border-gray-200 bg-white p-4 shadow-sm">
        <div class="grid grid-cols-1 gap-3 md:grid-cols-4">
            <input type="text" name="search" value="{{ $search ?? '' }}" placeholder="Search shipment, SO, customer, vehicle, driver, or route" class="md:col-span-2 rounded-lg border-gray-300 shadow-sm focus:border-gray-900 focus:ring-gray-900">
            <select name="status" class="rounded-lg border-gray-300 shadow-sm focus:border-gray-900 focus:ring-gray-900">
                <option value="">All Statuses</option>
                @foreach(['scheduled' => 'Scheduled', 'in_transit' => 'In Transit', 'delivered' => 'Delivered', 'cancelled' => 'Cancelled'] as $value => $label)
                    <option value="{{ $value }}" @selected(($status ?? '') === $value)>{{ $label }}</option>
                @endforeach
            </select>
            <div class="flex gap-2">
                <button type="submit" class="flex-1 rounded-lg bg-gray-900 px-4 py-2 text-sm font-semibold text-white hover:bg-gray-700">Filter</button>
                <a href="{{ route('shipments.index') }}" class="rounded-lg border border-gray-300 px-4 py-2 text-sm font-semibold text-gray-700 hover:bg-gray-50">Reset</a>
            </div>
        </div>
    </form>

    <div class="overflow-x-auto rounded-xl border border-gray-200 bg-white shadow-sm">
        <table class="min-w-full divide-y divide-gray-200 text-sm">
            <thead class="bg-gray-50 text-left text-xs uppercase tracking-wider text-gray-500">
                <tr>
                    <th class="px-4 py-3">Shipment Number</th>
                    <th class="px-4 py-3">Sales Order</th>
                    <th class="px-4 py-3">Customer</th>
                    <th class="px-4 py-3">Vehicle</th>
                    <th class="px-4 py-3">Driver</th>
                    <th class="px-4 py-3">Shipment Date</th>
                    <th class="px-4 py-3">Origin</th>
                    <th class="px-4 py-3">Destination</th>
                    <th class="px-4 py-3">Status</th>
                    <th class="px-4 py-3 text-right">Action</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($shipments as $shipment)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-3 font-medium text-gray-900">{{ $shipment->shipment_number }}</td>
                        <td class="px-4 py-3">{{ $shipment->salesOrder->so_number ?? '-' }}</td>
                        <td class="px-4 py-3">{{ $shipment->salesOrder->customer->name ?? '-' }}</td>
                        <td class="px-4 py-3">{{ $shipment->vehicle_number ?? '-' }}</td>
                        <td class="px-4 py-3">{{ $shipment->driver_name ?? '-' }}</td>
                        <td class="px-4 py-3">{{ $shipment->shipment_date }}</td>
                        <td class="px-4 py-3">{{ $shipment->origin ?? '-' }}</td>
                        <td class="px-4 py-3">{{ $shipment->destination ?? '-' }}</td>
                        <td class="px-4 py-3">
                            <span class="inline-flex rounded-full px-2.5 py-1 text-xs font-semibold capitalize ring-1 ring-inset {{ $statusClasses[$shipment->status] ?? 'bg-gray-100 text-gray-800 ring-gray-200' }}">
                                {{ str_replace('_', ' ', $shipment->status) }}
                            </span>
                        </td>
                        <td class="px-4 py-3 text-right">
                            <div class="flex justify-end gap-2">
                                <a class="text-blue-600 hover:text-blue-900" href="{{ route('shipments.show', $shipment) }}">View</a>
                                <a class="text-yellow-600 hover:text-yellow-900" href="{{ route('shipments.edit', $shipment) }}">Edit</a>
                                <form method="POST" action="{{ route('shipments.destroy', $shipment) }}" onsubmit="return confirm('Delete this shipment?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="text-red-600 hover:text-red-900">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="10" class="px-4 py-8 text-center text-gray-500">No shipments match your filter.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div>{{ $shipments->links() }}</div>
</div>
@endsection
