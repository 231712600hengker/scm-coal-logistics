<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Supplier - SCM Coal Logistics</title>
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
            <h2 class="text-2xl font-bold mb-6">Add Supplier</h2>

            @if ($errors->any())
                <div class="bg-red-100 border border-red-300 text-red-800 px-4 py-3 rounded mb-4">
                    <ul class="list-disc ml-5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('suppliers.store') }}" method="POST" class="space-y-4">
                @csrf

                <div>
                    <label class="block mb-1 font-medium">Supplier Code</label>
                    <input type="text" name="supplier_code" value="{{ old('supplier_code') }}"
                           class="w-full border rounded px-3 py-2" placeholder="SUP-001" required>
                </div>

                <div>
                    <label class="block mb-1 font-medium">Supplier Name</label>
                    <input type="text" name="name" value="{{ old('name') }}"
                           class="w-full border rounded px-3 py-2" placeholder="PT Bara Energi Nusantara" required>
                </div>

                <div>
                    <label class="block mb-1 font-medium">Contact Person</label>
                    <input type="text" name="contact_person" value="{{ old('contact_person') }}"
                           class="w-full border rounded px-3 py-2">
                </div>

                <div>
                    <label class="block mb-1 font-medium">Phone</label>
                    <input type="text" name="phone" value="{{ old('phone') }}"
                           class="w-full border rounded px-3 py-2">
                </div>

                <div>
                    <label class="block mb-1 font-medium">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}"
                           class="w-full border rounded px-3 py-2">
                </div>

                <div>
                    <label class="block mb-1 font-medium">Address</label>
                    <textarea name="address" rows="3"
                              class="w-full border rounded px-3 py-2">{{ old('address') }}</textarea>
                </div>

                <div class="flex gap-2">
                    <button type="submit"
                            class="bg-slate-900 text-white px-4 py-2 rounded hover:bg-slate-700">
                        Save
                    </button>

                    <a href="{{ route('suppliers.index') }}"
                       class="bg-gray-300 text-gray-900 px-4 py-2 rounded hover:bg-gray-400">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </main>
</body>
</html>