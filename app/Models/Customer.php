<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = [
        'customer_code',
        'name',
        'contact_person',
        'phone',
        'email',
        'address',
    ];

    public function salesOrders()
    {
        return $this->hasMany(SalesOrder::class);
    }
}