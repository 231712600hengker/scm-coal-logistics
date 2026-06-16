<?php

namespace App\Http\Controllers;

use App\Models\SalesOrder;
use App\Models\Shipment;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class ShipmentController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->string('search')->toString();
        $status = $request->string('status')->toString();

        $shipments = Shipment::with('salesOrder.customer', 'salesOrder.coalProduct')
            ->when($search, function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('shipment_number', 'like', "%{$search}%")
                        ->orWhere('vehicle_number', 'like', "%{$search}%")
                        ->orWhere('driver_name', 'like', "%{$search}%")
                        ->orWhere('origin', 'like', "%{$search}%")
                        ->orWhere('destination', 'like', "%{$search}%")
                        ->orWhereHas('salesOrder', fn ($salesOrder) => $salesOrder->where('so_number', 'like', "%{$search}%"))
                        ->orWhereHas('salesOrder.customer', fn ($customer) => $customer->where('name', 'like', "%{$search}%"));
                });
            })
            ->when($status, fn ($query) => $query->where('status', $status))
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('shipments.index', compact('shipments', 'search', 'status'));
    }

    public function create()
    {
        $salesOrders = SalesOrder::with(['customer', 'coalProduct'])->orderBy('so_number')->get();
        return view('shipments.create', compact('salesOrders'));
    }

    public function store(Request $request)
    {
        $validated = $this->validateData($request);
        Shipment::create($validated);
        return redirect()->route('shipments.index')->with('success', 'Shipment has been created successfully.');
    }

    public function show(Shipment $shipment)
    {
        $shipment->load('salesOrder.customer', 'salesOrder.coalProduct');
        return view('shipments.show', compact('shipment'));
    }

    public function edit(Shipment $shipment)
    {
        $salesOrders = SalesOrder::with(['customer', 'coalProduct'])->orderBy('so_number')->get();
        return view('shipments.edit', compact('shipment', 'salesOrders'));
    }

    public function update(Request $request, Shipment $shipment)
    {
        $validated = $this->validateData($request, $shipment->id);
        $this->validateStatusTransition($shipment->status, $validated['status']);
        $shipment->update($validated);
        return redirect()->route('shipments.index')->with('success', 'Shipment has been updated successfully.');
    }

    public function destroy(Shipment $shipment)
    {
        $shipment->delete();
        return redirect()->route('shipments.index')->with('success', 'Shipment has been deleted successfully.');
    }

    private function validateData(Request $request, ?int $id = null): array
    {
        return $request->validate([
            'shipment_number' => 'required|string|max:50|unique:shipments,shipment_number' . ($id ? ',' . $id : ''),
            'sales_order_id' => 'required|exists:sales_orders,id',
            'vehicle_number' => 'nullable|string|max:100',
            'driver_name' => 'nullable|string|max:255',
            'shipment_date' => 'required|date',
            'origin' => 'nullable|string|max:255',
            'destination' => 'nullable|string|max:255',
            'status' => 'required|in:scheduled,in_transit,delivered,cancelled',
        ], [
            'shipment_number.required' => 'Shipment number is required.',
            'shipment_number.unique' => 'This shipment number already exists. Please use a different number.',
            'sales_order_id.required' => 'Please select a sales order.',
            'sales_order_id.exists' => 'The selected sales order is not available.',
            'vehicle_number.max' => 'Vehicle number may not be longer than 100 characters.',
            'driver_name.max' => 'Driver name may not be longer than 255 characters.',
            'shipment_date.required' => 'Shipment date is required.',
            'shipment_date.date' => 'Shipment date must be a valid date.',
            'origin.max' => 'Origin may not be longer than 255 characters.',
            'destination.max' => 'Destination may not be longer than 255 characters.',
            'status.required' => 'Please select a shipment status.',
            'status.in' => 'Shipment status is invalid.',
        ]);
    }

    private function validateStatusTransition(string $currentStatus, string $nextStatus): void
    {
        $allowedTransitions = [
            'scheduled' => ['scheduled', 'in_transit', 'cancelled'],
            'in_transit' => ['in_transit', 'delivered', 'cancelled'],
            'delivered' => ['delivered'],
            'cancelled' => ['cancelled'],
        ];

        if (! in_array($nextStatus, $allowedTransitions[$currentStatus] ?? [], true)) {
            throw ValidationException::withMessages([
                'status' => 'Invalid status transition. Shipment workflow must follow scheduled → in transit → delivered.',
            ]);
        }
    }
}
