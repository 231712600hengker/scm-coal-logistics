@extends('layouts.app')
@section('title', 'Coal Product Detail')
@section('content')
<div class="rounded-xl border bg-white p-6 shadow-sm">
<div class="grid gap-4 md:grid-cols-2">
@foreach(['Product Code'=>$coalProduct->product_code,'Name'=>$coalProduct->name,'Grade'=>$coalProduct->grade,'Calorific Value'=>$coalProduct->calorific_value,'Sulfur Content'=>$coalProduct->sulfur_content,'Ash Content'=>$coalProduct->ash_content,'Stock Qty'=>number_format($coalProduct->stock_qty,2),'Unit'=>$coalProduct->unit] as $label=>$value)
<div><p class="text-sm text-gray-500">{{ $label }}</p><p class="font-semibold">{{ $value ?? '-' }}</p></div>
@endforeach
</div><div class="mt-6 flex gap-2"><a href="{{ route('coal-products.edit', $coalProduct) }}" class="rounded bg-gray-900 px-4 py-2 text-white">Edit</a><a href="{{ route('coal-products.index') }}" class="rounded border px-4 py-2">Back</a></div></div>
@endsection
