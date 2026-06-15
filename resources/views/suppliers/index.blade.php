<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Suppliers - SCM Coal Logistics</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 text-gray-900">
    <nav class="bg-slate-900 text-white px-8 py-4">
        <div class="flex justify-between items-center">
            <h1 class="text-xl font-bold">SCM Coal Logistics</h1>
            <div class="space-x-4">
                <a href="{{ route('dashboard') }}" class="hover:underline">Dashboard</a>
                <a href="{{ route('suppliers.index') }}" class="hover:underline">Suppliers</a>
                <a href="{{ route('customers.index') }}" class="hover:underline">Customers</a>
                <a href="{{ route('coal-products.index') }}" class="hover:underline">Coal Products</a>
            </div>
        </div>
    </nav>

    <main class="p-8">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold">Supplier Management</h2>

            <a href="{{ route('suppliers.create') }}"
               class="bg-slate-900 text-white px-4 py-2 rounded hover:bg-slate-700">
                Add Supplier
            </a>
        </div>

        @if (session('success'))
            <div class="bg-green-100 border border-green-300 text-green-800 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white rounded-lg shadow overflow-hidden">
            <table class="w-full border-collapse">
                <thead>
                    <tr class="bg-gray-100 text-left">
                        <th class="p-3 border">Code</th>
                        <th class="p-3 border">Name</th>
                        <th class="p-3 border">Contact Person</th>
                        <th class="p-3 border">Phone</th>
                        <th class="p-3 border">Email</th>
                        <th class="p-3 border w-48">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($suppliers as $supplier)
                        <tr>
                            <td class="p-3 border">{{ $supplier->supplier_code }}</td>
                            <td class="p-3 border">{{ $supplier->name }}</td>
                            <td class="p-3 border">{{ $supplier->contact_person ?? '-' }}</td>
                            <td class="p-3 border">{{ $supplier->phone ?? '-' }}</td>
                            <td class="p-3 border">{{ $supplier->email ?? '-' }}</td>
                            <td class="p-3 border">
                                <div class="flex gap-2">
                                    <a href="{{ route('suppliers.show', $supplier) }}"
                                       class="text-blue-600 hover:underline">
                                        View
                                    </a>

                                    <a href="{{ route('suppliers.edit', $supplier) }}"
                                       class="text-yellow-600 hover:underline">
                                        Edit
                                    </a>

                                    <form action="{{ route('suppliers.destroy', $supplier) }}"
                                          method="POST"
                                          onsubmit="return confirm('Hapus supplier ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:underline">
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="p-4 text-center text-gray-500">
                                No supplier data available.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $suppliers->links() }}
        </div>
    </main>
</body>
</html>