<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->string('search')->toString();
        $suppliers = Supplier::when($search, function ($query) use ($search) {
                $query->where('supplier_code', 'like', "%{$search}%")
                    ->orWhere('name', 'like', "%{$search}%")
                    ->orWhere('contact_person', 'like', "%{$search}%")
                    ->orWhere('phone', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('suppliers.index', compact('suppliers', 'search'));
    }

    public function create()
    {
        return view('suppliers.create');
    }

    public function store(Request $request)
    {
        $validated = $this->validateData($request);
        Supplier::create($validated);
        return redirect()->route('suppliers.index')->with('success', 'Supplier has been created successfully.');
    }

    public function show(Supplier $supplier)
    {
        return view('suppliers.show', compact('supplier'));
    }

    public function edit(Supplier $supplier)
    {
        return view('suppliers.edit', compact('supplier'));
    }

    public function update(Request $request, Supplier $supplier)
    {
        $validated = $this->validateData($request, $supplier->id);
        $supplier->update($validated);
        return redirect()->route('suppliers.index')->with('success', 'Supplier has been updated successfully.');
    }

    public function destroy(Supplier $supplier)
    {
        $supplier->delete();
        return redirect()->route('suppliers.index')->with('success', 'Supplier has been deleted successfully.');
    }

    private function validateData(Request $request, ?int $id = null): array
    {
        return $request->validate([
            'supplier_code' => 'required|string|max:50|unique:suppliers,supplier_code' . ($id ? ',' . $id : ''),
            'name' => 'required|string|max:255',
            'contact_person' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:50',
            'email' => 'nullable|email|max:255',
            'address' => 'nullable|string',
        ], [
            'supplier_code.required' => 'Supplier code is required.',
            'supplier_code.unique' => 'This supplier code already exists.',
            'name.required' => 'Supplier name is required.',
            'email.email' => 'Please enter a valid supplier email address.',
        ]);
    }
}
