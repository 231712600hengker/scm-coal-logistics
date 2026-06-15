@extends('layouts.app')

@section('title', 'Customers')

@section('content')
<div class="space-y-6">
    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h2 class="text-2xl font-bold text-gray-900">Customers</h2>
            <p class="mt-1 text-sm text-gray-600">Manage customer records for coal distribution and sales orders.</p>
        </div>

        <a href="{{ route('customers.create') }}" class="inline-flex items-center justify-center rounded-lg bg-gray-900 px-4 py-2 text-sm font-semibold text-white shadow-sm transition hover:bg-gray-700">
            Add Customer
        </a>
    </div>

    <div class="overflow-hidden rounded-xl border border-gray-200 bg-white shadow-sm">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">Customer Code</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">Name</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">Contact Person</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">Phone</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">Email</th>
                        <th class="px-6 py-3 text-right text-xs font-semibold uppercase tracking-wider text-gray-500">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 bg-white">
                    @forelse ($customers as $customer)
                        <tr class="hover:bg-gray-50">
                            <td class="whitespace-nowrap px-6 py-4 text-sm font-medium text-gray-900">{{ $customer->customer_code }}</td>
                            <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-700">{{ $customer->name }}</td>
                            <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-700">{{ $customer->contact_person ?? '-' }}</td>
                            <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-700">{{ $customer->phone ?? '-' }}</td>
                            <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-700">{{ $customer->email ?? '-' }}</td>
                            <td class="whitespace-nowrap px-6 py-4 text-right text-sm font-medium">
                                <div class="flex justify-end gap-3">
                                    <a href="{{ route('customers.show', $customer) }}" class="text-blue-600 hover:text-blue-900">View</a>
                                    <a href="{{ route('customers.edit', $customer) }}" class="text-yellow-600 hover:text-yellow-900">Edit</a>
                                    <form action="{{ route('customers.destroy', $customer) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this customer?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-10 text-center text-sm text-gray-500">No customer data available.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="border-t border-gray-200 px-6 py-4">
            {{ $customers->links() }}
        </div>
    </div>
</div>
@endsection
