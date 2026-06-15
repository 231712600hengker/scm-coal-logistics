<?php

namespace App\Http\Controllers;

use App\Models\StockMovement;
use Illuminate\Http\Request;

class StockMovementController extends Controller
{
    public function index(Request $request)
    {
        $search = trim($request->string('search')->toString());
        $type = $request->string('type')->toString();

        $stockMovements = StockMovement::with('coalProduct')
            ->when($search, function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('reference_type', 'like', "%{$search}%")
                        ->orWhere('reference_id', 'like', "%{$search}%")
                        ->orWhere('description', 'like', "%{$search}%")
                        ->orWhereHas('coalProduct', fn ($product) => $product->where('name', 'like', "%{$search}%"));
                });
            })
            ->when($type, fn ($query) => $query->where('type', $type))
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('stock-movements.index', compact('stockMovements', 'search', 'type'));
    }

    public function show(StockMovement $stockMovement)
    {
        $stockMovement->load('coalProduct');
        return view('stock-movements.show', compact('stockMovement'));
    }
}
