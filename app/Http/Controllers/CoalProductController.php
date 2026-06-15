<?php

namespace App\Http\Controllers;

use App\Models\CoalProduct;
use Illuminate\Http\Request;

class CoalProductController extends Controller
{
    public function index()
    {
        $coalProducts = CoalProduct::latest()->paginate(10);
        return view('coal-products.index', compact('coalProducts'));
    }

    public function create()
    {
        return view('coal-products.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_code' => 'required|string|max:50|unique:coal_products,product_code',
            'name' => 'required|string|max:255',
            'grade' => 'nullable|string|max:100',
            'calorific_value' => 'nullable|numeric',
            'sulfur_content' => 'nullable|numeric',
            'ash_content' => 'nullable|numeric',
            'stock_qty' => 'required|numeric|min:0',
            'unit' => 'required|string|max:50',
        ]);

        CoalProduct::create($validated);
        return redirect()->route('coal-products.index')->with('success', 'Coal product berhasil ditambahkan.');
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
        $validated = $request->validate([
            'product_code' => 'required|string|max:50|unique:coal_products,product_code,' . $coalProduct->id,
            'name' => 'required|string|max:255',
            'grade' => 'nullable|string|max:100',
            'calorific_value' => 'nullable|numeric',
            'sulfur_content' => 'nullable|numeric',
            'ash_content' => 'nullable|numeric',
            'stock_qty' => 'required|numeric|min:0',
            'unit' => 'required|string|max:50',
        ]);

        $coalProduct->update($validated);
        return redirect()->route('coal-products.index')->with('success', 'Coal product berhasil diperbarui.');
    }

    public function destroy(CoalProduct $coalProduct)
    {
        $coalProduct->delete();
        return redirect()->route('coal-products.index')->with('success', 'Coal product berhasil dihapus.');
    }
}
