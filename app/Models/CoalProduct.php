<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CoalProduct extends Model
{
    protected $fillable = [
        'product_code',
        'name',
        'grade',
        'calorific_value',
        'sulfur_content',
        'ash_content',
        'stock_qty',
        'unit',
    ];

    public function purchaseOrders()
    {
        return $this->hasMany(PurchaseOrder::class);
    }

    public function salesOrders()
    {
        return $this->hasMany(SalesOrder::class);
    }

    public function stockMovements()
    {
        return $this->hasMany(StockMovement::class);
    }
}