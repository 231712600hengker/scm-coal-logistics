<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'SCM Coal Logistics')</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-gray-100 text-gray-900 antialiased">
    <nav class="border-b border-gray-200 bg-white shadow-sm">
        <div class="mx-auto flex max-w-7xl flex-col gap-4 px-4 py-4 sm:px-6 lg:flex-row lg:items-center lg:justify-between lg:px-8">
            <a href="{{ url('/dashboard') }}" class="text-xl font-bold tracking-tight text-gray-900">
                SCM Coal Logistics
            </a>

            <div class="flex flex-wrap items-center gap-2">
                <a href="{{ url('/dashboard') }}"
                   class="rounded-lg px-3 py-2 text-sm font-medium text-gray-700 transition hover:bg-gray-100 hover:text-gray-950">
                    Dashboard
                </a>
                <a href="{{ url('/suppliers') }}"
                   class="rounded-lg px-3 py-2 text-sm font-medium text-gray-700 transition hover:bg-gray-100 hover:text-gray-950">
                    Suppliers
                </a>
                <a href="{{ url('/customers') }}"
                   class="rounded-lg px-3 py-2 text-sm font-medium text-gray-700 transition hover:bg-gray-100 hover:text-gray-950">
                    Customers
                </a>
                <a href="{{ url('/coal-products') }}"
                   class="rounded-lg px-3 py-2 text-sm font-medium text-gray-700 transition hover:bg-gray-100 hover:text-gray-950">
                    Coal Products
                </a>
            </div>
        </div>
    </nav>

    <main class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">
        <header class="mb-6">
            <h1 class="text-2xl font-semibold text-gray-900">
                @yield('title', 'SCM Coal Logistics')
            </h1>
        </header>

        @if (session('success'))
            <div class="mb-6 rounded-lg border border-green-200 bg-green-50 px-4 py-3 text-sm font-medium text-green-800">
                {{ session('success') }}
            </div>
        @endif

        @yield('content')
    </main>
</body>
</html>
