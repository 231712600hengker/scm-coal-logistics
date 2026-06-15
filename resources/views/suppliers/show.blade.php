<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Supplier Detail - SCM Coal Logistics</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 text-gray-900">
    <nav class="bg-slate-900 text-white px-8 py-4">
        <div class="flex justify-between items-center">
            <h1 class="text-xl font-bold">SCM Coal Logistics</h1>
            <div class="space-x-4">
                <a href="{{ route('dashboard') }}" class="hover:underline">Dashboard</a>
                <a href="{{ route('suppliers.index') }}" class="hover:underline">Suppliers</a>
            </div>
        </div>
    </nav>

    <main class="p-8">
        <div class="max-w-3xl mx-auto bg-white rounded-lg shadow p-6">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-bold">Supplier Detail</h2>

                <a href="{{ route('suppliers.edit', $supplier) }}"
                   class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600">
                    Edit
                </a>
            </div>

            <div class="space-y-4">
                <div>
                    <p class="text-sm text-gray-500">Supplier Code</p>
                    <p class="font-medium">{{ $supplier->supplier_code }}</p>
                </div>

                <div>
                    <p class="text-sm text-gray-500">Supplier Name</p>
                    <p class="font-medium">{{ $supplier->name }}</p>
                </div>

                <div>
                    <p class="text-sm text-gray-500">Contact Person</p>
                    <p class="font-medium">{{ $supplier->contact_person ?? '-' }}</p>
                </div>

                <div>
                    <p class="text-sm text-gray-500">Phone</p>
                    <p class="font-medium">{{ $supplier->phone ?? '-' }}</p>
                </div>

                <div>
                    <p class="text-sm text-gray-500">Email</p>
                    <p class="font-medium">{{ $supplier->email ?? '-' }}</p>
                </div>

                <div>
                    <p class="text-sm text-gray-500">Address</p>
                    <p class="font-medium">{{ $supplier->address ?? '-' }}</p>
                </div>
            </div>

            <div class="mt-6">
                <a href="{{ route('suppliers.index') }}"
                   class="bg-gray-300 text-gray-900 px-4 py-2 rounded hover:bg-gray-400">
                    Back
                </a>
            </div>
        </div>
    </main>
</body>
</html>