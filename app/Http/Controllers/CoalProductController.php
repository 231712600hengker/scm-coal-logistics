<?php

namespace App\Http\Controllers;

use App\Models\CoalProduct;
use Illuminate\Http\Request;

class CoalProductController extends Controller
{
    public function index(Request $request)
    {
        $search = trim($request->string('search')->toString());
        $stock = $request->string('stock')->toString();

        $coalProducts = CoalProduct::when($search, function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('product_code', 'like', "%{$search}%")
                        ->orWhere('name', 'like', "%{$search}%")
                        ->orWhere('grade', 'like', "%{$search}%")
                        ->orWhere('unit', 'like', "%{$search}%");
                });
            })
            ->when($stock === 'low', fn ($query) => $query->where('stock_qty', '<=', 1000))
            ->when($stock === 'available', fn ($query) => $query->where('stock_qty', '>', 0))
            ->when($stock === 'empty', fn ($query) => $query->where('stock_qty', '<=', 0))
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('coal-products.index', compact('coalProducts', 'search', 'stock'));
    }

    public function create()
    {
        return view('coal-products.create');
    }

    public function store(Request $request)
    {
        $validated = $this->validateData($request);
        CoalProduct::create($validated);
        return redirect()->route('coal-products.index')->with('success', 'Coal product has been created successfully.');
    }

    public function show(CoalProduct $coalProduct)
    {
        return view('coal-products.show', compact('coalProduct'));
    }

    public function edit(CoalProduct $coalProduct)
    {
        return view('coal-products.edit', compact('coalProduct'));
    }

    public function update(Request $request, CoalProduct $coalProduct)
    {
        $validated = $this->validateData($request, $coalProduct->id);
        $coalProduct->update($validated);
        return redirect()->route('coal-products.index')->with('success', 'Coal product has been updated successfully.');
    }

    public function destroy(CoalProduct $coalProduct)
    {
        $coalProduct->delete();
        return redirect()->route('coal-products.index')->with('success', 'Coal product has been deleted successfully.');
    }

    private function validateData(Request $request, ?int $id = null): array
    {
        return $request->validate([
            'product_code' => 'required|string|max:50|unique:coal_products,product_code' . ($id ? ',' . $id : ''),
            'name' => 'required|string|max:255',
            'grade' => 'nullable|string|max:100',
            'calorific_value' => 'nullable|numeric|min:0',
            'sulfur_content' => 'nullable|numeric|min:0',
            'ash_content' => 'nullable|numeric|min:0',
            'stock_qty' => 'required|numeric|min:0',
            'unit' => 'required|string|max:50',
        ], [
            'product_code.required' => 'Product code is required. Use a unique code such as COAL-001.',
            'product_code.unique' => 'This product code is already used. Please enter a different product code.',
            'name.required' => 'Coal product name is required.',
            'calorific_value.numeric' => 'Calorific value must be a valid number.',
            'calorific_value.min' => 'Calorific value cannot be negative.',
            'sulfur_content.numeric' => 'Sulfur content must be a valid number.',
            'sulfur_content.min' => 'Sulfur content cannot be negative.',
            'ash_content.numeric' => 'Ash content must be a valid number.',
            'ash_content.min' => 'Ash content cannot be negative.',
            'stock_qty.required' => 'Stock quantity is required.',
            'stock_qty.numeric' => 'Stock quantity must be a valid number.',
            'stock_qty.min' => 'Stock quantity cannot be negative.',
            'unit.required' => 'Unit is required, for example MT or Ton.',
        ]);
    }
}
