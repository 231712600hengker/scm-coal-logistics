<?php

namespace App\Http\Controllers;

use App\Models\CoalProduct;
use App\Models\PurchaseOrder;
use App\Models\StockMovement;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class PurchaseOrderController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->string('search')->toString();
        $status = $request->string('status')->toString();

        $purchaseOrders = PurchaseOrder::with(['supplier', 'coalProduct'])
            ->when($search, function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('po_number', 'like', "%{$search}%")
                        ->orWhereHas('supplier', fn ($supplier) => $supplier->where('name', 'like', "%{$search}%"))
                        ->orWhereHas('coalProduct', fn ($product) => $product->where('name', 'like', "%{$search}%"));
                });
            })
            ->when($status, fn ($query) => $query->where('status', $status))
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('purchase-orders.index', compact('purchaseOrders', 'search', 'status'));
    }

    public function create()
    {
        return view('purchase-orders.create', ['suppliers' => Supplier::orderBy('name')->get(), 'coalProducts' => CoalProduct::orderBy('name')->get()]);
    }

    public function store(Request $request)
    {
        $validated = $this->validateData($request);
        $validated['total_amount'] = $validated['quantity'] * $validated['price_per_ton'];

        DB::transaction(function () use ($validated) {
            $purchaseOrder = PurchaseOrder::create($validated);
            $this->receiveStockIfNeeded($purchaseOrder);
        });

        return redirect()->route('purchase-orders.index')->with('success', 'Purchase order has been created successfully.');
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
        $this->validateStatusTransition($purchaseOrder->status, $validated['status']);
        $validated['total_amount'] = $validated['quantity'] * $validated['price_per_ton'];

        DB::transaction(function () use ($purchaseOrder, $validated) {
            $purchaseOrder->update($validated);
            $this->receiveStockIfNeeded($purchaseOrder->fresh());
        });

        return redirect()->route('purchase-orders.index')->with('success', 'Purchase order has been updated successfully.');
    }

    public function destroy(PurchaseOrder $purchaseOrder)
    {
        $purchaseOrder->delete();
        return redirect()->route('purchase-orders.index')->with('success', 'Purchase order has been deleted successfully.');
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
        ], [
            'po_number.required' => 'PO number is required.',
            'po_number.unique' => 'This PO number already exists. Please use a different number.',
            'supplier_id.required' => 'Please select a supplier.',
            'supplier_id.exists' => 'The selected supplier is not available.',
            'coal_product_id.required' => 'Please select a coal product.',
            'coal_product_id.exists' => 'The selected coal product is not available.',
            'order_date.required' => 'Order date is required.',
            'order_date.date' => 'Order date must be a valid date.',
            'quantity.required' => 'Quantity is required.',
            'quantity.numeric' => 'Quantity must be a valid number.',
            'quantity.min' => 'Quantity must be greater than zero.',
            'price_per_ton.required' => 'Price per ton is required.',
            'price_per_ton.numeric' => 'Price per ton must be a valid number.',
            'price_per_ton.min' => 'Price per ton cannot be negative.',
            'status.required' => 'Please select a purchase order status.',
            'status.in' => 'Purchase order status is invalid.',
        ]);
    }

    private function validateStatusTransition(string $currentStatus, string $nextStatus): void
    {
        $allowedTransitions = [
            'pending' => ['pending', 'approved', 'cancelled'],
            'approved' => ['approved', 'received', 'cancelled'],
            'received' => ['received'],
            'cancelled' => ['cancelled'],
        ];

        if (! in_array($nextStatus, $allowedTransitions[$currentStatus] ?? [], true)) {
            throw ValidationException::withMessages([
                'status' => 'Invalid status transition. Purchase order workflow must follow pending → approved → received.',
            ]);
        }
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
