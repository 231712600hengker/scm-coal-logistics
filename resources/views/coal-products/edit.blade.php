@extends('layouts.app')
@section('title', 'Edit Coal Product')
@section('content')
<form method="POST" action="{{ route('coal-products.update', $coalProduct) }}" class="rounded-xl border bg-white p-6 shadow-sm">
@csrf @method('PUT')
<div class="grid gap-4 md:grid-cols-2">
<div><label class="block text-sm font-medium">Product Code</label><input name="product_code" value="{{ old('product_code', $coalProduct->product_code) }}" class="w-full rounded border-gray-300">@error('product_code')<p class="text-sm text-red-600">{{ $message }}</p>@enderror</div>
<div><label class="block text-sm font-medium">Name</label><input name="name" value="{{ old('name', $coalProduct->name) }}" class="w-full rounded border-gray-300">@error('name')<p class="text-sm text-red-600">{{ $message }}</p>@enderror</div>
<div><label class="block text-sm font-medium">Grade</label><input name="grade" value="{{ old('grade', $coalProduct->grade) }}" class="w-full rounded border-gray-300">@error('grade')<p class="text-sm text-red-600">{{ $message }}</p>@enderror</div>
<div><label class="block text-sm font-medium">Calorific Value</label><input type="number" step="0.01" name="calorific_value" value="{{ old('calorific_value', $coalProduct->calorific_value) }}" class="w-full rounded border-gray-300">@error('calorific_value')<p class="text-sm text-red-600">{{ $message }}</p>@enderror</div>
<div><label class="block text-sm font-medium">Sulfur Content</label><input type="number" step="0.01" name="sulfur_content" value="{{ old('sulfur_content', $coalProduct->sulfur_content) }}" class="w-full rounded border-gray-300">@error('sulfur_content')<p class="text-sm text-red-600">{{ $message }}</p>@enderror</div>
<div><label class="block text-sm font-medium">Ash Content</label><input type="number" step="0.01" name="ash_content" value="{{ old('ash_content', $coalProduct->ash_content) }}" class="w-full rounded border-gray-300">@error('ash_content')<p class="text-sm text-red-600">{{ $message }}</p>@enderror</div>
<div><label class="block text-sm font-medium">Stock Qty</label><input type="number" step="0.01" name="stock_qty" value="{{ old('stock_qty', $coalProduct->stock_qty) }}" class="w-full rounded border-gray-300">@error('stock_qty')<p class="text-sm text-red-600">{{ $message }}</p>@enderror</div>
<div><label class="block text-sm font-medium">Unit</label><input name="unit" value="{{ old('unit', $coalProduct->unit) }}" class="w-full rounded border-gray-300">@error('unit')<p class="text-sm text-red-600">{{ $message }}</p>@enderror</div>
</div><div class="mt-6 flex gap-2"><button class="rounded bg-gray-900 px-4 py-2 text-white">Update</button><a href="{{ route('coal-products.index') }}" class="rounded border px-4 py-2">Cancel</a></div>
</form>
@endsection
