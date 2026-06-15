<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index(Request $request)
    {
        $search = trim($request->string('search')->toString());

        $customers = Customer::when($search, function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('customer_code', 'like', "%{$search}%")
                        ->orWhere('name', 'like', "%{$search}%")
                        ->orWhere('contact_person', 'like', "%{$search}%")
                        ->orWhere('phone', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%");
                });
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('customers.index', compact('customers', 'search'));
    }

    public function create()
    {
        return view('customers.create');
    }

    public function store(Request $request)
    {
        $validated = $this->validateData($request);
        Customer::create($validated);
        return redirect()->route('customers.index')->with('success', 'Customer has been created successfully.');
    }

    public function show(Customer $customer)
    {
        return view('customers.show', compact('customer'));
    }

    public function edit(Customer $customer)
    {
        return view('customers.edit', compact('customer'));
    }

    public function update(Request $request, Customer $customer)
    {
        $validated = $this->validateData($request, $customer->id);
        $customer->update($validated);
        return redirect()->route('customers.index')->with('success', 'Customer has been updated successfully.');
    }

    public function destroy(Customer $customer)
    {
        $customer->delete();
        return redirect()->route('customers.index')->with('success', 'Customer has been deleted successfully.');
    }

    private function validateData(Request $request, ?int $id = null): array
    {
        return $request->validate([
            'customer_code' => 'required|string|max:50|unique:customers,customer_code' . ($id ? ',' . $id : ''),
            'name' => 'required|string|max:255',
            'contact_person' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:50',
            'email' => 'nullable|email|max:255',
            'address' => 'nullable|string',
        ], [
            'customer_code.required' => 'Customer code is required. Use a unique code such as CUST-001.',
            'customer_code.max' => 'Customer code may not be longer than 50 characters.',
            'customer_code.unique' => 'This customer code is already used. Please enter a different customer code.',
            'name.required' => 'Customer name is required.',
            'name.max' => 'Customer name may not be longer than 255 characters.',
            'contact_person.max' => 'Contact person may not be longer than 255 characters.',
            'phone.max' => 'Phone number may not be longer than 50 characters.',
            'email.email' => 'Please enter a valid customer email address.',
            'email.max' => 'Customer email may not be longer than 255 characters.',
        ]);
    }
}
