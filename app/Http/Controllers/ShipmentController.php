<?php

namespace App\Http\Controllers;

use App\Models\SalesOrder;
use App\Models\Shipment;
use Illuminate\Http\Request;

class ShipmentController extends Controller
{
    public function index()
    {
        $shipments = Shipment::with('salesOrder.customer', 'salesOrder.coalProduct')->latest()->paginate(10);
        return view('shipments.index', compact('shipments'));
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
        return redirect()->route('shipments.index')->with('success', 'Shipment berhasil ditambahkan.');
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
        $shipment->update($validated);
        return redirect()->route('shipments.index')->with('success', 'Shipment berhasil diperbarui.');
    }

    public function destroy(Shipment $shipment)
    {
        $shipment->delete();
        return redirect()->route('shipments.index')->with('success', 'Shipment berhasil dihapus.');
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
        ]);
    }
}
