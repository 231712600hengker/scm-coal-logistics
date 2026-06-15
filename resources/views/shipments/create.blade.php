@extends('layouts.app')
@section('title','Add Shipment')
@section('content')
<form method="POST" action="{{ route('shipments.store') }}" class="rounded-xl border bg-white p-6 shadow-sm">
@csrf
<div class="grid gap-4 md:grid-cols-2">
<div><label>Shipment Number</label><input name="shipment_number" value="{{ old('shipment_number') }}" class="w-full rounded border-gray-300">@error('shipment_number')<p class="text-sm text-red-600">{{ $message }}</p>@enderror</div>
<div><label>Sales Order</label><select name="sales_order_id" class="w-full rounded border-gray-300"><option value="">Choose sales order</option>@foreach($salesOrders as $order)<option value="{{ $order->id }}">{{ $order->so_number }}</option>@endforeach</select>@error('sales_order_id')<p class="text-sm text-red-600">{{ $message }}</p>@enderror</div>
<div><label>Vehicle Number</label><input name="vehicle_number" value="{{ old('vehicle_number') }}" class="w-full rounded border-gray-300"></div>
<div><label>Driver Name</label><input name="driver_name" value="{{ old('driver_name') }}" class="w-full rounded border-gray-300"></div>
<div><label>Shipment Date</label><input type="date" name="shipment_date" value="{{ old('shipment_date') }}" class="w-full rounded border-gray-300">@error('shipment_date')<p class="text-sm text-red-600">{{ $message }}</p>@enderror</div>
<div><label>Origin</label><input name="origin" value="{{ old('origin') }}" class="w-full rounded border-gray-300"></div>
<div><label>Destination</label><input name="destination" value="{{ old('destination') }}" class="w-full rounded border-gray-300"></div>
<div><label>Status</label><select name="status" class="w-full rounded border-gray-300"><option value="scheduled">Scheduled</option><option value="in_transit">In Transit</option><option value="delivered">Delivered</option><option value="cancelled">Cancelled</option></select>@error('status')<p class="text-sm text-red-600">{{ $message }}</p>@enderror</div>
</div>
<div class="mt-6 flex gap-2"><button class="rounded bg-gray-900 px-4 py-2 text-white">Save</button><a href="{{ route('shipments.index') }}" class="rounded border px-4 py-2">Cancel</a></div>
</form>
@endsection
