<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SalesOrder extends Model
{
    protected $fillable = [
        'so_number',
        'customer_id',
        'coal_product_id',
        'order_date',
        'quantity',
        'price_per_ton',
        'total_amount',
        'status',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function coalProduct()
    {
        return $this->belongsTo(CoalProduct::class);
    }

    public function shipment()
    {
        return $this->hasOne(Shipment::class);
    }
}