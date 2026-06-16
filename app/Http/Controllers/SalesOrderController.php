<?php

namespace App\Http\Controllers;

use App\Models\CoalProduct;
use App\Models\Customer;
use App\Models\SalesOrder;
use App\Models\StockMovement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class SalesOrderController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->string('search')->toString();
        $status = $request->string('status')->toString();

        $salesOrders = SalesOrder::with(['customer', 'coalProduct'])
            ->when($search, function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('so_number', 'like', "%{$search}%")
                        ->orWhereHas('customer', fn ($customer) => $customer->where('name', 'like', "%{$search}%"))
                        ->orWhereHas('coalProduct', fn ($product) => $product->where('name', 'like', "%{$search}%"));
                });
            })
            ->when($status, fn ($query) => $query->where('status', $status))
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('sales-orders.index', compact('salesOrders', 'search', 'status'));
    }

    public function create()
    {
        return view('sales-orders.create', ['customers' => Customer::orderBy('name')->get(), 'coalProducts' => CoalProduct::orderBy('name')->get()]);
    }

    public function store(Request $request)
    {
        $validated = $this->validateData($request);
        $validated['total_amount'] = $validated['quantity'] * $validated['price_per_ton'];

        DB::transaction(function () use ($validated) {
            $this->ensureStockAvailable($validated);
            $salesOrder = SalesOrder::create($validated);
            $this->releaseStockIfNeeded($salesOrder);
        });

        return redirect()->route('sales-orders.index')->with('success', 'Sales order has been created successfully.');
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
        $this->validateStatusTransition($salesOrder->status, $validated['status']);
        $validated['total_amount'] = $validated['quantity'] * $validated['price_per_ton'];

        DB::transaction(function () use ($salesOrder, $validated) {
            $hasMovement = StockMovement::where('reference_type', 'sales_order')->where('reference_id', $salesOrder->id)->exists();
            if (! $hasMovement) $this->ensureStockAvailable($validated);
            $salesOrder->update($validated);
            $this->releaseStockIfNeeded($salesOrder->fresh());
        });

        return redirect()->route('sales-orders.index')->with('success', 'Sales order has been updated successfully.');
    }

    public function destroy(SalesOrder $salesOrder)
    {
        $salesOrder->delete();
        return redirect()->route('sales-orders.index')->with('success', 'Sales order has been deleted successfully.');
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
        ], [
            'so_number.required' => 'SO number is required.',
            'so_number.unique' => 'This SO number already exists. Please use a different number.',
            'customer_id.required' => 'Please select a customer.',
            'customer_id.exists' => 'The selected customer is not available.',
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
            'status.required' => 'Please select a sales order status.',
            'status.in' => 'Sales order status is invalid.',
        ]);
    }

    private function validateStatusTransition(string $currentStatus, string $nextStatus): void
    {
        $allowedTransitions = [
            'pending' => ['pending', 'approved', 'cancelled'],
            'approved' => ['approved', 'shipped', 'cancelled'],
            'shipped' => ['shipped', 'completed'],
            'completed' => ['completed'],
            'cancelled' => ['cancelled'],
        ];

        if (! in_array($nextStatus, $allowedTransitions[$currentStatus] ?? [], true)) {
            throw ValidationException::withMessages([
                'status' => 'Invalid status transition. Sales order workflow must follow pending → approved → shipped → completed.',
            ]);
        }
    }

    private function ensureStockAvailable(array $data): void
    {
        if (! in_array($data['status'], ['shipped', 'completed'], true)) return;
        $product = CoalProduct::findOrFail($data['coal_product_id']);
        if ($data['quantity'] > $product->stock_qty) {
            throw ValidationException::withMessages(['quantity' => 'Insufficient stock. Available stock for ' . $product->name . ' is ' . number_format($product->stock_qty, 2) . ' ' . $product->unit . '.']);
        }
    }

    private function releaseStockIfNeeded(SalesOrder $salesOrder): void
    {
        if (! in_array($salesOrder->status, ['shipped', 'completed'], true)) return;
        if (StockMovement::where('reference_type', 'sales_order')->where('reference_id', $salesOrder->id)->exists()) return;
        $product = $salesOrder->coalProduct;
        $product->decrement('stock_qty', $salesOrder->quantity);
        StockMovement::create(['coal_product_id' => $product->id, 'type' => 'out', 'quantity' => $salesOrder->quantity, 'reference_type' => 'sales_order', 'reference_id' => $salesOrder->id, 'description' => 'Stock released for SO ' . $salesOrder->so_number]);
    }
}
