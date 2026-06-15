<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StockMovement extends Model
{
    protected $fillable = [
        'coal_product_id',
        'type',
        'quantity',
        'reference_type',
        'reference_id',
        'description',
    ];

    public function coalProduct()
    {
        return $this->belongsTo(CoalProduct::class);
    }
}