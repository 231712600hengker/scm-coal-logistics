@extends('layouts.app')
@section('title', 'Add Purchase Order')
@section('content')
<form method="POST" action="{{ route('purchase-orders.store') }}" class="rounded-xl border bg-white p-6 shadow-sm">@csrf
<div class="grid gap-4 md:grid-cols-2">
<div><label class="block text-sm font-medium">PO Number</label><input name="po_number" value="{{ old('po_number') }}" class="w-full rounded border-gray-300">@error('po_number')<p class="text-sm text-red-600">{{ $message }}</p>@enderror</div>
<div><label class="block text-sm font-medium">Supplier</label><select name="supplier_id" class="w-full rounded border-gray-300"><option value="">Choose supplier</option>@foreach($suppliers as $supplier)<option value="{{ $supplier->id }}">{{ $supplier->name }}</option>@endforeach</select>@error('supplier_id')<p class="text-sm text-red-600">{{ $message }}</p>@enderror</div>
<div><label class="block text-sm font-medium">Coal Product</label><select name="coal_product_id" class="w-full rounded border-gray-300"><option value="">Choose product</option>@foreach($coalProducts as $product)<option value="{{ $product->id }}">{{ $product->product_code }} - {{ $product->name }}</option>@endforeach</select>@error('coal_product_id')<p class="text-sm text-red-600">{{ $message }}</p>@enderror</div>
<div><label class="block text-sm font-medium">Order Date</label><input type="date" name="order_date" value="{{ old('order_date') }}" class="w-full rounded border-gray-300">@error('order_date')<p class="text-sm text-red-600">{{ $message }}</p>@enderror</div>
<div><label class="block text-sm font-medium">Quantity</label><input type="number" step="0.01" name="quantity" value="{{ old('quantity') }}" class="w-full rounded border-gray-300">@error('quantity')<p class="text-sm text-red-600">{{ $message }}</p>@enderror</div>
<div><label class="block text-sm font-medium">Price Per Ton</label><input type="number" step="0.01" name="price_per_ton" value="{{ old('price_per_ton') }}" class="w-full rounded border-gray-300">@error('price_per_ton')<p class="text-sm text-red-600">{{ $message }}</p>@enderror</div>
<div><label class="block text-sm font-medium">Status</label><select name="status" class="w-full rounded border-gray-300"><option value="pending">Pending</option><option value="approved">Approved</option><option value="received">Received</option><option value="cancelled">Cancelled</option></select>@error('status')<p class="text-sm text-red-600">{{ $message }}</p>@enderror</div>
</div><div class="mt-6 flex gap-2"><button class="rounded bg-gray-900 px-4 py-2 text-white">Save</button><a href="{{ route('purchase-orders.index') }}" class="rounded border px-4 py-2">Cancel</a></div></form>
@endsection
