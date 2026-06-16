@extends('layouts.app')

@section('title', 'Shipment Report')

@section('page-actions')
<div class="no-print flex items-center gap-3">
    <button onclick="window.print()" class="rounded-lg bg-gray-900 px-4 py-2 text-sm font-semibold text-white hover:bg-gray-700">
        Print Report
    </button>
</div>
@endsection

@section('content')
<div class="space-y-6">
    <div class="print-card rounded-2xl border border-gray-200 bg-white p-6 shadow-sm">
        <div class="flex flex-col gap-4 lg:flex-row lg:items-end lg:justify-between">
            <div>
                <h2 class="text-xl font-semibold text-gray-900">Shipment Report</h2>
                <p class="mt-1 text-sm text-gray-500">Generated at {{ now()->format('d M Y H:i') }}</p>
            </div>

            <form method="GET" action="{{ route('reports.shipments') }}" class="no-print flex flex-col gap-3 sm:flex-row sm:items-end">
                <div>
                    <label for="date_from" class="block text-sm font-medium text-gray-700">Date From</label>
                    <input type="date" id="date_from" name="date_from" value="{{ $dateFrom }}" class="mt-1 rounded-lg border border-gray-300 px-3 py-2 text-sm">
                </div>
                <div>
                    <label for="date_to" class="block text-sm font-medium text-gray-700">Date To</label>
                    <input type="date" id="date_to" name="date_to" value="{{ $dateTo }}" class="mt-1 rounded-lg border border-gray-300 px-3 py-2 text-sm">
                </div>
                <button type="submit" class="rounded-lg bg-gray-900 px-4 py-2 text-sm font-semibold text-white hover:bg-gray-700">Filter</button>
                <a href="{{ route('reports.shipments') }}" class="rounded-lg border border-gray-300 px-4 py-2 text-sm font-semibold text-gray-700 hover:bg-gray-50">Reset</a>
            </form>
        </div>
    </div>

    <div class="print-card overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-sm">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 text-sm">
                <thead class="bg-gray-50 text-left text-xs uppercase tracking-wider text-gray-500">
                    <tr>
                        <th class="px-4 py-3">Date</th>
                        <th class="px-4 py-3">Shipment Number</th>
                        <th class="px-4 py-3">SO Number</th>
                        <th class="px-4 py-3">Customer</th>
                        <th class="px-4 py-3">Origin</th>
                        <th class="px-4 py-3">Destination</th>
                        <th class="px-4 py-3">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse ($shipments as $shipment)
                        <tr>
                            <td class="px-4 py-3">{{ $shipment->shipment_date ? \Carbon\Carbon::parse($shipment->shipment_date)->format('d M Y') : '-' }}</td>
                            <td class="px-4 py-3 font-medium text-gray-900">{{ $shipment->shipment_number }}</td>
                            <td class="px-4 py-3">{{ $shipment->salesOrder->so_number ?? '-' }}</td>
                            <td class="px-4 py-3">{{ $shipment->salesOrder->customer->name ?? '-' }}</td>
                            <td class="px-4 py-3">{{ $shipment->origin ?? '-' }}</td>
                            <td class="px-4 py-3">{{ $shipment->destination ?? '-' }}</td>
                            <td class="px-4 py-3">
                                <span class="rounded-full bg-gray-50 px-3 py-1 text-xs font-semibold capitalize text-gray-700 ring-1 ring-gray-200">
                                    {{ str_replace('_', ' ', $shipment->status) }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-4 py-8 text-center text-gray-500">No shipment data available.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="no-print">
        {{ $shipments->links() }}
    </div>
</div>
@endsection
