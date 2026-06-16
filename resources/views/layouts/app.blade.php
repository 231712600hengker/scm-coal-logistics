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

        #sidebar-toggle:checked ~ .app-sidebar { width: 5rem; }
        #sidebar-toggle:checked ~ .app-shell { padding-left: 5rem; }
        #sidebar-toggle:checked ~ .app-sidebar .sidebar-text,
        #sidebar-toggle:checked ~ .app-sidebar .sidebar-section-title,
        #sidebar-toggle:checked ~ .app-sidebar .sidebar-user { display: none; }
        #sidebar-toggle:checked ~ .app-sidebar .sidebar-nav-link { justify-content: center; }

        @media (max-width: 1023px) {
            .app-sidebar { transform: translateX(-100%); }
            #sidebar-toggle:checked ~ .app-sidebar { width: 18rem; transform: translateX(0); }
            #sidebar-toggle:checked ~ .sidebar-backdrop { display: block; }
            #sidebar-toggle:checked ~ .app-sidebar .sidebar-text,
            #sidebar-toggle:checked ~ .app-sidebar .sidebar-section-title,
            #sidebar-toggle:checked ~ .app-sidebar .sidebar-user { display: block; }
            #sidebar-toggle:checked ~ .app-sidebar .sidebar-nav-link { justify-content: flex-start; }
            .app-shell { padding-left: 0 !important; }
        }
    </style>
</head>
<body class="min-h-screen bg-gray-100 text-gray-900 antialiased">
    @php
        $navigation = [
            [
                'title' => 'Main Menu',
                'items' => [
                    ['label' => 'Dashboard', 'short' => 'DB', 'route' => 'dashboard', 'active' => ['dashboard', 'dashboard.alias']],
                    ['label' => 'Suppliers', 'short' => 'SP', 'route' => 'suppliers.index', 'active' => ['suppliers.*']],
                    ['label' => 'Customers', 'short' => 'CS', 'route' => 'customers.index', 'active' => ['customers.*']],
                    ['label' => 'Coal Products', 'short' => 'CP', 'route' => 'coal-products.index', 'active' => ['coal-products.*']],
                    ['label' => 'Purchase Orders', 'short' => 'PO', 'route' => 'purchase-orders.index', 'active' => ['purchase-orders.*']],
                    ['label' => 'Sales Orders', 'short' => 'SO', 'route' => 'sales-orders.index', 'active' => ['sales-orders.*']],
                    ['label' => 'Shipments', 'short' => 'SH', 'route' => 'shipments.index', 'active' => ['shipments.*']],
                    ['label' => 'Stock Movements', 'short' => 'SM', 'route' => 'stock-movements.index', 'active' => ['stock-movements.*']],
                ],
            ],
            [
                'title' => 'Reports',
                'items' => [
                    ['label' => 'Stock Movement Report', 'short' => 'SR', 'route' => 'reports.stock-movements', 'active' => ['reports.stock-movements']],
                    ['label' => 'Shipment Report', 'short' => 'RR', 'route' => 'reports.shipments', 'active' => ['reports.shipments']],
                ],
            ],
        ];
    @endphp

    <input id="sidebar-toggle" type="checkbox" class="peer sr-only">
    <label for="sidebar-toggle" class="sidebar-backdrop no-print fixed inset-0 z-30 hidden bg-gray-950/40 lg:hidden"></label>

    <aside class="app-sidebar no-print fixed inset-y-0 left-0 z-40 flex w-72 flex-col border-r border-gray-200 bg-white shadow-xl transition-all duration-300 lg:translate-x-0 lg:shadow-none">
        <div class="flex h-16 items-center justify-between border-b border-gray-200 px-4">
            <a href="{{ route('dashboard') }}" class="flex min-w-0 items-center gap-3">
                <span class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-gray-900 text-sm font-bold text-white shadow-sm">SC</span>
                <span class="sidebar-text min-w-0">
                    <span class="block truncate text-sm font-bold tracking-tight text-gray-950">SCM Coal</span>
                    <span class="block truncate text-xs font-medium text-gray-500">Logistics System</span>
                </span>
            </a>
            <label for="sidebar-toggle" class="cursor-pointer rounded-lg p-2 text-gray-500 transition hover:bg-gray-100 hover:text-gray-900 lg:hidden" aria-label="Close sidebar">
                X
            </label>
        </div>

        <nav class="flex-1 overflow-y-auto px-3 py-4">
            @foreach ($navigation as $group)
                <div class="mb-6">
                    <p class="sidebar-section-title mb-2 px-3 text-xs font-semibold uppercase tracking-widest text-gray-400">
                        {{ $group['title'] }}
                    </p>

                    <div class="space-y-1">
                        @foreach ($group['items'] as $item)
                            @php
                                $isActive = false;
                                foreach ($item['active'] as $pattern) {
                                    if (request()->routeIs($pattern)) {
                                        $isActive = true;
                                        break;
                                    }
                                }
                            @endphp

                            <a href="{{ route($item['route']) }}"
                               title="{{ $item['label'] }}"
                               class="sidebar-nav-link group flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-semibold transition {{ $isActive ? 'bg-gray-900 text-white shadow-sm' : 'text-gray-600 hover:bg-gray-100 hover:text-gray-950' }}">
                                <span class="flex h-8 w-8 shrink-0 items-center justify-center rounded-lg text-xs font-bold {{ $isActive ? 'bg-white/15 text-white' : 'bg-gray-100 text-gray-600 group-hover:bg-white group-hover:text-gray-950' }}">
                                    {{ $item['short'] }}
                                </span>
                                <span class="sidebar-text truncate">{{ $item['label'] }}</span>
                            </a>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </nav>

        @auth
            <div class="border-t border-gray-200 p-4">
                <div class="sidebar-user mb-3 rounded-xl bg-gray-50 p-3">
                    <p class="text-xs font-medium text-gray-500">Signed in as</p>
                    <p class="truncate text-sm font-semibold text-gray-950">{{ auth()->user()->name }}</p>
                </div>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="flex w-full items-center justify-center rounded-xl border border-gray-300 bg-white px-4 py-2.5 text-sm font-semibold text-gray-700 transition hover:bg-gray-100 hover:text-gray-950">
                        <span class="sidebar-text">Logout</span>
                        <span class="hidden text-xs font-bold lg:inline">OUT</span>
                    </button>
                </form>
            </div>
        @endauth
    </aside>

    <div class="app-shell min-h-screen transition-all duration-300 lg:pl-72">
        <header class="no-print sticky top-0 z-20 border-b border-gray-200 bg-gray-100/90 backdrop-blur">
            <div class="flex h-16 items-center justify-between gap-4 px-4 sm:px-6 lg:px-8">
                <div class="flex min-w-0 items-center gap-3">
                    <label for="sidebar-toggle" class="cursor-pointer rounded-xl border border-gray-300 bg-white p-2 text-gray-600 shadow-sm transition hover:bg-gray-100 hover:text-gray-950" aria-label="Toggle sidebar">
                        <span class="block h-0.5 w-5 bg-current"></span>
                        <span class="mt-1.5 block h-0.5 w-5 bg-current"></span>
                        <span class="mt-1.5 block h-0.5 w-5 bg-current"></span>
                    </label>

                    <div class="min-w-0">
                        <p class="text-xs font-medium uppercase tracking-widest text-gray-400">SCM Coal Logistics</p>
                        <h1 class="truncate text-xl font-bold tracking-tight text-gray-950 sm:text-2xl">@yield('title', 'SCM Coal Logistics')</h1>
                    </div>
                </div>

                <div class="flex shrink-0 items-center gap-3">
                    @yield('page-actions')

                    @auth
                        <div class="hidden text-right sm:block">
                            <p class="text-xs font-medium text-gray-500">Signed in as</p>
                            <p class="max-w-44 truncate text-sm font-semibold text-gray-950">{{ auth()->user()->name }}</p>
                        </div>

                        <form method="POST" action="{{ route('logout') }}" class="hidden sm:block">
                            @csrf
                            <button type="submit" class="rounded-xl bg-gray-900 px-4 py-2 text-sm font-semibold text-white shadow-sm transition hover:bg-gray-700">
                                Logout
                            </button>
                        </form>
                    @endauth
                </div>
            </div>
        </header>

        <main class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="no-print mb-6 rounded-xl border border-gray-200 bg-white px-4 py-3 text-sm font-semibold text-gray-700 shadow-sm">
                    {{ session('success') }}
                </div>
            @endif

            @yield('content')
        </main>
    </div>
</body>
</html>
