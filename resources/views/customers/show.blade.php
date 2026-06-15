@extends('layouts.app')

@section('title', 'Customer Details')

@section('content')
<div class="mx-auto max-w-4xl space-y-6">
    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h2 class="text-2xl font-bold text-gray-900">Customer Details</h2>
            <p class="mt-1 text-sm text-gray-600">View complete customer information.</p>
        </div>

        <div class="flex gap-3">
            <a href="{{ route('customers.index') }}" class="inline-flex items-center rounded-lg border border-gray-300 bg-white px-4 py-2 text-xs font-semibold uppercase tracking-widest text-gray-700 shadow-sm transition hover:bg-gray-50">Back</a>
            <a href="{{ route('customers.edit', $customer) }}" class="inline-flex items-center rounded-lg bg-yellow-500 px-4 py-2 text-xs font-semibold uppercase tracking-widest text-white transition hover:bg-yellow-600">Edit</a>
        </div>
    </div>

    <div class="overflow-hidden rounded-xl border border-gray-200 bg-white shadow-sm">
        <div class="border-b border-gray-200 px-6 py-5">
            <h3 class="text-lg font-semibold text-gray-900">{{ $customer->name }}</h3>
            <p class="mt-1 text-sm text-gray-500">{{ $customer->customer_code }}</p>
        </div>

        <dl class="divide-y divide-gray-200">
            <div class="grid grid-cols-1 gap-2 px-6 py-4 sm:grid-cols-3">
                <dt class="text-sm font-medium text-gray-500">Customer Code</dt>
                <dd class="text-sm text-gray-900 sm:col-span-2">{{ $customer->customer_code }}</dd>
            </div>
            <div class="grid grid-cols-1 gap-2 px-6 py-4 sm:grid-cols-3">
                <dt class="text-sm font-medium text-gray-500">Customer Name</dt>
                <dd class="text-sm text-gray-900 sm:col-span-2">{{ $customer->name }}</dd>
            </div>
            <div class="grid grid-cols-1 gap-2 px-6 py-4 sm:grid-cols-3">
                <dt class="text-sm font-medium text-gray-500">Contact Person</dt>
                <dd class="text-sm text-gray-900 sm:col-span-2">{{ $customer->contact_person ?? '-' }}</dd>
            </div>
            <div class="grid grid-cols-1 gap-2 px-6 py-4 sm:grid-cols-3">
                <dt class="text-sm font-medium text-gray-500">Phone</dt>
                <dd class="text-sm text-gray-900 sm:col-span-2">{{ $customer->phone ?? '-' }}</dd>
            </div>
            <div class="grid grid-cols-1 gap-2 px-6 py-4 sm:grid-cols-3">
                <dt class="text-sm font-medium text-gray-500">Email</dt>
                <dd class="text-sm text-gray-900 sm:col-span-2">{{ $customer->email ?? '-' }}</dd>
            </div>
            <div class="grid grid-cols-1 gap-2 px-6 py-4 sm:grid-cols-3">
                <dt class="text-sm font-medium text-gray-500">Address</dt>
                <dd class="whitespace-pre-line text-sm text-gray-900 sm:col-span-2">{{ $customer->address ?? '-' }}</dd>
            </div>
        </dl>
    </div>
</div>
@endsection
