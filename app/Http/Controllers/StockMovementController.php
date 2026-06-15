<?php

namespace App\Http\Controllers;

use App\Models\StockMovement;
use Illuminate\Http\Request;

class StockMovementController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->string('search')->toString();
        $type = $request->string('type')->toString();

        $query = StockMovement::with('coalProduct');

        if ($search !== '') {
            $query->where('reference_type', 'like', "%{$search}%")
                ->orWhere('description', 'like', "%{$search}%");
        }

        if ($type !== '') {
            $query->where('type', $type);
        }

        $stockMovements = $query->latest()->paginate(10)->withQueryString();

        return view('stock-movements.index', compact('stockMovements', 'search', 'type'));
    }

    public function show(StockMovement $stockMovement)
    {
        $stockMovement->load('coalProduct');
        return view('stock-movements.show', compact('stockMovement'));
    }
}
