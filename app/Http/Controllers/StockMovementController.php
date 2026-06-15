<?php

namespace App\Http\Controllers;

use App\Models\StockMovement;

class StockMovementController extends Controller
{
    public function index()
    {
        $stockMovements = StockMovement::with('coalProduct')->latest()->paginate(10);
        return view('stock-movements.index', compact('stockMovements'));
    }

    public function show(StockMovement $stockMovement)
    {
        $stockMovement->load('coalProduct');
        return view('stock-movements.show', compact('stockMovement'));
    }
}
