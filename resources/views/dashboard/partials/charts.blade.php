@php
    $movementMax = max((float) $totalInbound, (float) $totalOutbound, 1);
    $shipmentMax = max((int) ($shipmentStatuses->max('total') ?? 0), 1);
@endphp

<div class="grid grid-cols-1 gap-6 lg:grid-cols-3">
    <div class="print-card rounded-2xl border border-gray-200 bg-white p-6 shadow-sm lg:col-span-2">
        <h3 class="text-lg font-semibold text-gray-900">Inbound vs Outbound Movement</h3>
        <p class="mb-5 text-sm text-gray-500">Stock movement comparison based on recorded inventory transactions.</p>

        <div class="space-y-5">
            <div>
                <div class="mb-2 flex items-center justify-between text-sm">
                    <span class="font-semibold text-gray-700">Inbound</span>
                    <span class="text-gray-500">{{ number_format($totalInbound, 2) }}</span>
                </div>
                <progress class="h-4 w-full accent-gray-900" value="{{ $totalInbound }}" max="{{ $movementMax }}"></progress>
            </div>

            <div>
                <div class="mb-2 flex items-center justify-between text-sm">
                    <span class="font-semibold text-gray-700">Outbound</span>
                    <span class="text-gray-500">{{ number_format($totalOutbound, 2) }}</span>
                </div>
                <progress class="h-4 w-full accent-gray-700" value="{{ $totalOutbound }}" max="{{ $movementMax }}"></progress>
            </div>
        </div>
    </div>

    <div class="print-card rounded-2xl border border-gray-200 bg-white p-6 shadow-sm">
        <h3 class="text-lg font-semibold text-gray-900">Performance Indicators</h3>
        <p class="mb-5 text-sm text-gray-500">Stock availability and order fulfillment percentages.</p>

        <div class="space-y-5">
            <div>
                <div class="mb-2 flex items-center justify-between text-sm">
                    <span class="font-semibold text-gray-700">Stock availability</span>
                    <span class="text-gray-500">{{ number_format($stockAvailability, 2) }}%</span>
                </div>
                <progress class="h-3 w-full accent-gray-900" value="{{ $stockAvailability }}" max="100"></progress>
            </div>

            <div>
                <div class="mb-2 flex items-center justify-between text-sm">
                    <span class="font-semibold text-gray-700">Order fulfillment</span>
                    <span class="text-gray-500">{{ number_format($orderFulfillment, 2) }}%</span>
                </div>
                <progress class="h-3 w-full accent-gray-700" value="{{ $orderFulfillment }}" max="100"></progress>
            </div>
        </div>
    </div>
</div>

<div class="print-card rounded-2xl border border-gray-200 bg-white p-6 shadow-sm">
    <h3 class="text-lg font-semibold text-gray-900">Shipment Status Chart</h3>
    <p class="mb-5 text-sm text-gray-500">Delivery pipeline distribution by shipment status.</p>

    <div class="space-y-4">
        @forelse ($shipmentStatuses as $item)
            <div>
                <div class="mb-2 flex items-center justify-between text-sm">
                    <span class="font-medium capitalize text-gray-700">{{ str_replace('_', ' ', $item->status) }}</span>
                    <span class="rounded-full bg-gray-50 px-3 py-1 text-xs font-bold text-gray-900 ring-1 ring-gray-200">{{ $item->total }}</span>
                </div>
                <progress class="h-3 w-full accent-gray-900" value="{{ $item->total }}" max="{{ $shipmentMax }}"></progress>
            </div>
        @empty
            <p class="text-sm text-gray-500">No shipment data available.</p>
        @endforelse
    </div>
</div>
