<?php

namespace App\Http\Controllers;

use App\Models\CoalProduct;
use App\Models\Customer;
use App\Models\SalesOrder;
use App\Models\StockMovement;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class SalesOrderController extends Controller
{
    public function index()
    {
        $salesOrders = SalesOrder::with(['customer', 'coalProduct'])->latest()->paginate(10);
        return view('sales-orders.index', compact('salesOrders'));
    }

    public function create()
    {
        return view('sales-orders.create', ['customers' => Customer::orderBy('name')->get(), 'coalProducts' => CoalProduct::orderBy('name')->get()]);
    }

    public function store(Request $request)
    {
        $validated = $this->validateData($request);
        $validated['total_amount'] = $validated['quantity'] * $validated['price_per_ton'];
        $this->ensureStockAvailable($validated);
        $salesOrder = SalesOrder::create($validated);
        $this->releaseStockIfNeeded($salesOrder);
        return redirect()->route('sales-orders.index')->with('success', 'Sales order berhasil ditambahkan.');
    }

    public function show(SalesOrder $salesOrder)
    {
        $salesOrder->load(['customer', 'coalProduct', 'shipment']);
        return view('sales-orders.show', compact('salesOrder'));
    }

    public function edit(SalesOrder $salesOrder)
    {
        return view('sales-orders.edit', ['salesOrder' => $salesOrder, 'customers' => Customer::orderBy('name')->get(), 'coalProducts' => CoalProduct::orderBy('name')->get()]);
    }

    public function update(Request $request, SalesOrder $salesOrder)
    {
        $validated = $this->validateData($request, $salesOrder->id);
        $validated['total_amount'] = $validated['quantity'] * $validated['price_per_ton'];
        $hasMovement = StockMovement::where('reference_type', 'sales_order')->where('reference_id', $salesOrder->id)->exists();
        if (! $hasMovement) $this->ensureStockAvailable($validated);
        $salesOrder->update($validated);
        $this->releaseStockIfNeeded($salesOrder->fresh());
        return redirect()->route('sales-orders.index')->with('success', 'Sales order berhasil diperbarui.');
    }

    public function destroy(SalesOrder $salesOrder)
    {
        $salesOrder->delete();
        return redirect()->route('sales-orders.index')->with('success', 'Sales order berhasil dihapus.');
    }

    private function validateData(Request $request, ?int $id = null): array
    {
        return $request->validate([
            'so_number' => 'required|string|max:50|unique:sales_orders,so_number' . ($id ? ',' . $id : ''),
            'customer_id' => 'required|exists:customers,id',
            'coal_product_id' => 'required|exists:coal_products,id',
            'order_date' => 'required|date',
            'quantity' => 'required|numeric|min:0.01',
            'price_per_ton' => 'required|numeric|min:0',
            'status' => 'required|in:pending,approved,shipped,completed,cancelled',
        ]);
    }

    private function ensureStockAvailable(array $data): void
    {
        if (! in_array($data['status'], ['shipped', 'completed'])) return;
        $product = CoalProduct::findOrFail($data['coal_product_id']);
        if ($data['quantity'] > $product->stock_qty) {
            throw ValidationException::withMessages(['quantity' => 'Quantity melebihi stok tersedia.']);
        }
    }

    private function releaseStockIfNeeded(SalesOrder $salesOrder): void
    {
        if (! in_array($salesOrder->status, ['shipped', 'completed'])) return;
        if (StockMovement::where('reference_type', 'sales_order')->where('reference_id', $salesOrder->id)->exists()) return;
        $product = $salesOrder->coalProduct;
        $product->decrement('stock_qty', $salesOrder->quantity);
        StockMovement::create(['coal_product_id' => $product->id, 'type' => 'out', 'quantity' => $salesOrder->quantity, 'reference_type' => 'sales_order', 'reference_id' => $salesOrder->id, 'description' => 'Stock released for SO ' . $salesOrder->so_number]);
    }
}
