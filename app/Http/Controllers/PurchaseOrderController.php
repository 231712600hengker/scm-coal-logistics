<?php

namespace App\Http\Controllers;

use App\Models\CoalProduct;
use App\Models\PurchaseOrder;
use App\Models\StockMovement;
use App\Models\Supplier;
use Illuminate\Http\Request;

class PurchaseOrderController extends Controller
{
    public function index()
    {
        $purchaseOrders = PurchaseOrder::with(['supplier', 'coalProduct'])->latest()->paginate(10);
        return view('purchase-orders.index', compact('purchaseOrders'));
    }

    public function create()
    {
        return view('purchase-orders.create', ['suppliers' => Supplier::orderBy('name')->get(), 'coalProducts' => CoalProduct::orderBy('name')->get()]);
    }

    public function store(Request $request)
    {
        $validated = $this->validateData($request);
        $validated['total_amount'] = $validated['quantity'] * $validated['price_per_ton'];
        $purchaseOrder = PurchaseOrder::create($validated);
        $this->receiveStockIfNeeded($purchaseOrder);
        return redirect()->route('purchase-orders.index')->with('success', 'Purchase order berhasil ditambahkan.');
    }

    public function show(PurchaseOrder $purchaseOrder)
    {
        $purchaseOrder->load(['supplier', 'coalProduct']);
        return view('purchase-orders.show', compact('purchaseOrder'));
    }

    public function edit(PurchaseOrder $purchaseOrder)
    {
        return view('purchase-orders.edit', ['purchaseOrder' => $purchaseOrder, 'suppliers' => Supplier::orderBy('name')->get(), 'coalProducts' => CoalProduct::orderBy('name')->get()]);
    }

    public function update(Request $request, PurchaseOrder $purchaseOrder)
    {
        $validated = $this->validateData($request, $purchaseOrder->id);
        $validated['total_amount'] = $validated['quantity'] * $validated['price_per_ton'];
        $purchaseOrder->update($validated);
        $this->receiveStockIfNeeded($purchaseOrder->fresh());
        return redirect()->route('purchase-orders.index')->with('success', 'Purchase order berhasil diperbarui.');
    }

    public function destroy(PurchaseOrder $purchaseOrder)
    {
        $purchaseOrder->delete();
        return redirect()->route('purchase-orders.index')->with('success', 'Purchase order berhasil dihapus.');
    }

    private function validateData(Request $request, ?int $id = null): array
    {
        return $request->validate([
            'po_number' => 'required|string|max:50|unique:purchase_orders,po_number' . ($id ? ',' . $id : ''),
            'supplier_id' => 'required|exists:suppliers,id',
            'coal_product_id' => 'required|exists:coal_products,id',
            'order_date' => 'required|date',
            'quantity' => 'required|numeric|min:0.01',
            'price_per_ton' => 'required|numeric|min:0',
            'status' => 'required|in:pending,approved,received,cancelled',
        ]);
    }

    private function receiveStockIfNeeded(PurchaseOrder $purchaseOrder): void
    {
        if ($purchaseOrder->status !== 'received') return;
        if (StockMovement::where('reference_type', 'purchase_order')->where('reference_id', $purchaseOrder->id)->exists()) return;
        $product = $purchaseOrder->coalProduct;
        $product->increment('stock_qty', $purchaseOrder->quantity);
        StockMovement::create(['coal_product_id' => $product->id, 'type' => 'in', 'quantity' => $purchaseOrder->quantity, 'reference_type' => 'purchase_order', 'reference_id' => $purchaseOrder->id, 'description' => 'Stock received from PO ' . $purchaseOrder->po_number]);
    }
}
