<?php

namespace App\Http\Controllers;

use App\Models\Shipment;
use App\Models\StockMovement;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function stockMovements(Request $request)
    {
        $dateFrom = $request->string('date_from')->toString();
        $dateTo = $request->string('date_to')->toString();

        $stockMovements = StockMovement::with('coalProduct')
            ->when($dateFrom, fn ($query) => $query->whereDate('created_at', '>=', $dateFrom))
            ->when($dateTo, fn ($query) => $query->whereDate('created_at', '<=', $dateTo))
            ->latest()
            ->paginate(20)
            ->withQueryString();

        return view('reports.stock-movements', compact('stockMovements', 'dateFrom', 'dateTo'));
    }

    public function shipments(Request $request)
    {
        $dateFrom = $request->string('date_from')->toString();
        $dateTo = $request->string('date_to')->toString();

        $shipments = Shipment::with('salesOrder.customer')
            ->when($dateFrom, fn ($query) => $query->whereDate('shipment_date', '>=', $dateFrom))
            ->when($dateTo, fn ($query) => $query->whereDate('shipment_date', '<=', $dateTo))
            ->latest()
            ->paginate(20)
            ->withQueryString();

        return view('reports.shipments', compact('shipments', 'dateFrom', 'dateTo'));
    }
}
