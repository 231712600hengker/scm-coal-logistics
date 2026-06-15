<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PurchaseOrder extends Model
{
    protected $fillable = [
        'po_number',
        'supplier_id',
        'coal_product_id',
        'order_date',
        'quantity',
        'price_per_ton',
        'total_amount',
        'status',
    ];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function coalProduct()
    {
        return $this->belongsTo(CoalProduct::class);
    }
}