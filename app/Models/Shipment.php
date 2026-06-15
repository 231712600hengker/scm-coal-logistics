<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shipment extends Model
{
    protected $fillable = [
        'shipment_number',
        'sales_order_id',
        'vehicle_number',
        'driver_name',
        'shipment_date',
        'origin',
        'destination',
        'status',
    ];

    public function salesOrder()
    {
        return $this->belongsTo(SalesOrder::class);
    }
}