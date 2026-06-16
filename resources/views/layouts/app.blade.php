<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'SCM Coal Logistics')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        @media print {
            body { background: #fff !important; }
            .no-print { display: none !important; }
            .print-card { break-inside: avoid; box-shadow: none !important; }
            main { max-width: 100% !important; padding: 0 !important; }
            table { font-size: 11px; }
        }
    </style>
</head>
<body class="min-h-screen bg-gray-100 text-gray-900 antialiased">
    <nav class="no-print border-b border-gray-200 bg-white shadow-sm">
        <div class="mx-auto flex max-w-7xl flex-col gap-4 px-4 py-4 sm:px-6 lg:px-8">
            <div class="flex flex-col gap-3 lg:flex-row lg:items-center lg:justify-between">
                <a href="{{ route('dashboard') }}" class="text-xl font-bold tracking-tight text-gray-900">SCM Coal Logistics</a>
                <div class="flex flex-wrap items-center gap-2">
                    @php
                        $links = [
                            ['label' => 'Dashboard', 'url' => route('dashboard')],
                            ['label' => 'Suppliers', 'url' => route('suppliers.index')],
                            ['label' => 'Customers', 'url' => route('customers.index')],
                            ['label' => 'Coal Products', 'url' => route('coal-products.index')],
                            ['label' => 'Purchase Orders', 'url' => route('purchase-orders.index')],
                            ['label' => 'Sales Orders', 'url' => route('sales-orders.index')],
                            ['label' => 'Shipments', 'url' => route('shipments.index')],
                            ['label' => 'Stock Movements', 'url' => route('stock-movements.index')],
                            ['label' => 'Stock Report', 'url' => route('reports.stock-movements')],
                            ['label' => 'Shipment Report', 'url' => route('reports.shipments')],
                        ];
                    @endphp

                    @foreach ($links as $link)
                        <a href="{{ $link['url'] }}" class="rounded-lg px-3 py-2 text-sm font-medium text-gray-700 transition hover:bg-gray-100 hover:text-gray-950">
                            {{ $link['label'] }}
                        </a>
                    @endforeach
                </div>
                @auth
                    <div class="flex flex-wrap items-center gap-3 text-sm text-gray-600">
                        <span>Signed in as {{ auth()->user()->name }}</span>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="rounded-lg bg-gray-900 px-3 py-2 text-sm font-semibold text-white hover:bg-gray-700">
                                Logout
                            </button>
                        </form>
                    </div>
                @endauth
            </div>
        </div>
    </nav>

    <main class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">
        <header class="mb-6 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <h1 class="text-2xl font-semibold text-gray-900">@yield('title', 'SCM Coal Logistics')</h1>
            @yield('page-actions')
        </header>

        @if (session('success'))
            <div class="no-print mb-6 rounded-lg border border-green-200 bg-green-50 px-4 py-3 text-sm font-medium text-green-800">
                {{ session('success') }}
            </div>
        @endif

        @yield('content')
    </main>
</body>
</html>
