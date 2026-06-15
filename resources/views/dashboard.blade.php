<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>SCM Coal Logistics</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100 text-gray-900">
    <div class="min-h-screen">
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
            <h2 class="text-2xl font-bold mb-6">Dashboard Overview</h2>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div class="bg-white p-6 rounded-lg shadow">
                    <p class="text-sm text-gray-500">Total Suppliers</p>
                    <h3 class="text-3xl font-bold">{{ $totalSuppliers }}</h3>
                </div>

                <div class="bg-white p-6 rounded-lg shadow">
                    <p class="text-sm text-gray-500">Total Customers</p>
                    <h3 class="text-3xl font-bold">{{ $totalCustomers }}</h3>
                </div>

                <div class="bg-white p-6 rounded-lg shadow">
                    <p class="text-sm text-gray-500">Coal Products</p>
                    <h3 class="text-3xl font-bold">{{ $totalProducts }}</h3>
                </div>

                <div class="bg-white p-6 rounded-lg shadow">
                    <p class="text-sm text-gray-500">Purchase Orders</p>
                    <h3 class="text-3xl font-bold">{{ $totalPurchaseOrders }}</h3>
                </div>

                <div class="bg-white p-6 rounded-lg shadow">
                    <p class="text-sm text-gray-500">Sales Orders</p>
                    <h3 class="text-3xl font-bold">{{ $totalSalesOrders }}</h3>
                </div>

                <div class="bg-white p-6 rounded-lg shadow">
                    <p class="text-sm text-gray-500">Shipments</p>
                    <h3 class="text-3xl font-bold">{{ $totalShipments }}</h3>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow p-6 mb-8">
                <h3 class="text-lg font-bold mb-4">Recent Coal Products</h3>

                <table class="w-full border-collapse">
                    <thead>
                        <tr class="bg-gray-100 text-left">
                            <th class="p-3 border">Code</th>
                            <th class="p-3 border">Name</th>
                            <th class="p-3 border">Grade</th>
                            <th class="p-3 border">Stock</th>
                            <th class="p-3 border">Unit</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($products as $product)
                        <tr>
                            <td class="p-3 border">{{ $product->product_code }}</td>
                            <td class="p-3 border">{{ $product->name }}</td>
                            <td class="p-3 border">{{ $product->grade }}</td>
                            <td class="p-3 border">{{ number_format($product->stock_qty, 2) }}</td>
                            <td class="p-3 border">{{ $product->unit }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="p-3 border text-center text-gray-500">
                                No product data available.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="bg-white rounded-lg shadow p-6">
                <h3 class="text-lg font-bold mb-4">Low Stock Alert</h3>

                @forelse ($lowStockProducts as $product)
                <div class="p-3 border rounded mb-2">
                    <strong>{{ $product->name }}</strong>
                    <span class="text-gray-600">
                        — {{ number_format($product->stock_qty, 2) }} {{ $product->unit }}
                    </span>
                </div>
                @empty
                <p class="text-gray-500">No low stock products.</p>
                @endforelse
            </div>
        </main>
    </div>
</body>

</html>