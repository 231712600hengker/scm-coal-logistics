@extends('layouts.app')

@section('title', 'Add Customer')

@section('content')
<div class="mx-auto max-w-3xl space-y-6">
    <div>
        <h2 class="text-2xl font-bold text-gray-900">Add Customer</h2>
        <p class="mt-1 text-sm text-gray-600">Create a new customer record for coal distribution.</p>
    </div>

    <div class="rounded-xl border border-gray-200 bg-white p-6 shadow-sm">
        <form action="{{ route('customers.store') }}" method="POST" class="space-y-5">
            @csrf

            <div>
                <label for="customer_code" class="block text-sm font-medium text-gray-700">Customer Code <span class="text-red-500">*</span></label>
                <input type="text" name="customer_code" id="customer_code" value="{{ old('customer_code') }}" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-gray-900 focus:ring-gray-900 @error('customer_code') border-red-500 @enderror" placeholder="CUST-001">
                @error('customer_code')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
            </div>

            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Customer Name <span class="text-red-500">*</span></label>
                <input type="text" name="name" id="name" value="{{ old('name') }}" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-gray-900 focus:ring-gray-900 @error('name') border-red-500 @enderror" placeholder="PT Customer Coal Indonesia">
                @error('name')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
            </div>

            <div>
                <label for="contact_person" class="block text-sm font-medium text-gray-700">Contact Person</label>
                <input type="text" name="contact_person" id="contact_person" value="{{ old('contact_person') }}" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-gray-900 focus:ring-gray-900 @error('contact_person') border-red-500 @enderror" placeholder="Person in charge">
                @error('contact_person')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
            </div>

            <div class="grid grid-cols-1 gap-5 md:grid-cols-2">
                <div>
                    <label for="phone" class="block text-sm font-medium text-gray-700">Phone</label>
                    <input type="text" name="phone" id="phone" value="{{ old('phone') }}" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-gray-900 focus:ring-gray-900 @error('phone') border-red-500 @enderror" placeholder="08xxxxxxxxxx">
                    @error('phone')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-gray-900 focus:ring-gray-900 @error('email') border-red-500 @enderror" placeholder="customer@example.com">
                    @error('email')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                </div>
            </div>

            <div>
                <label for="address" class="block text-sm font-medium text-gray-700">Address</label>
                <textarea name="address" id="address" rows="4" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-gray-900 focus:ring-gray-900 @error('address') border-red-500 @enderror" placeholder="Customer address">{{ old('address') }}</textarea>
                @error('address')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
            </div>

            <div class="flex justify-end gap-3 pt-4">
                <a href="{{ route('customers.index') }}" class="inline-flex items-center rounded-lg border border-gray-300 bg-white px-4 py-2 text-xs font-semibold uppercase tracking-widest text-gray-700 shadow-sm transition hover:bg-gray-50">Cancel</a>
                <button type="submit" class="inline-flex items-center rounded-lg bg-gray-900 px-4 py-2 text-xs font-semibold uppercase tracking-widest text-white transition hover:bg-gray-700">Save</button>
            </div>
        </form>
    </div>
</div>
@endsection
