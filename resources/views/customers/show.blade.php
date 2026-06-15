@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Detail Customer</h1>
            <p class="mt-1 text-sm text-gray-600">Informasi lengkap pelanggan.</p>
        </div>

        <div class="flex items-center gap-3">
            <a href="{{ route('customers.edit', $customer) }}" class="inline-flex items-center px-4 py-2 bg-yellow-500 border border-transparent rounded-lg font-semibold text-xs text-white uppercase tracking-widest hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-offset-2 transition">Edit</a>
            <a href="{{ route('customers.index') }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-lg font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition">Kembali</a>
        </div>
    </div>

    <div class="bg-white shadow-sm rounded-xl border border-gray-200 overflow-hidden">
        <div class="px-6 py-5 border-b border-gray-200">
            <h2 class="text-lg font-semibold text-gray-900">{{ $customer->name }}</h2>
            <p class="mt-1 text-sm text-gray-500">{{ $customer->customer_code }}</p>
        </div>

        <dl class="divide-y divide-gray-200">
            <div class="px-6 py-4 grid grid-cols-1 sm:grid-cols-3 gap-2">
                <dt class="text-sm font-medium text-gray-500">Kode Customer</dt>
                <dd class="sm:col-span-2 text-sm text-gray-900">{{ $customer->customer_code }}</dd>
            </div>

            <div class="px-6 py-4 grid grid-cols-1 sm:grid-cols-3 gap-2">
                <dt class="text-sm font-medium text-gray-500">Nama Customer</dt>
                <dd class="sm:col-span-2 text-sm text-gray-900">{{ $customer->name }}</dd>
            </div>

            <div class="px-6 py-4 grid grid-cols-1 sm:grid-cols-3 gap-2">
                <dt class="text-sm font-medium text-gray-500">Contact Person</dt>
                <dd class="sm:col-span-2 text-sm text-gray-900">{{ $customer->contact_person ?? '-' }}</dd>
            </div>

            <div class="px-6 py-4 grid grid-cols-1 sm:grid-cols-3 gap-2">
                <dt class="text-sm font-medium text-gray-500">Telepon</dt>
                <dd class="sm:col-span-2 text-sm text-gray-900">{{ $customer->phone ?? '-' }}</dd>
            </div>

            <div class="px-6 py-4 grid grid-cols-1 sm:grid-cols-3 gap-2">
                <dt class="text-sm font-medium text-gray-500">Email</dt>
                <dd class="sm:col-span-2 text-sm text-gray-900">{{ $customer->email ?? '-' }}</dd>
            </div>

            <div class="px-6 py-4 grid grid-cols-1 sm:grid-cols-3 gap-2">
                <dt class="text-sm font-medium text-gray-500">Alamat</dt>
                <dd class="sm:col-span-2 text-sm text-gray-900 whitespace-pre-line">{{ $customer->address ?? '-' }}</dd>
            </div>
        </dl>
    </div>
</div>
@endsection
