<?php

namespace Database\Seeders;

use App\Models\Supplier;
use Illuminate\Database\Seeder;

class SupplierSeeder extends Seeder
{
    public function run(): void
    {
        Supplier::create([
            'supplier_code' => 'SUP-001',
            'name' => 'PT Bara Energi Nusantara',
            'contact_person' => 'Andi Pratama',
            'phone' => '081234567001',
            'email' => 'supplier1@example.com',
            'address' => 'Samarinda, Kalimantan Timur',
        ]);

        Supplier::create([
            'supplier_code' => 'SUP-002',
            'name' => 'PT Tambang Makmur Jaya',
            'contact_person' => 'Budi Santoso',
            'phone' => '081234567002',
            'email' => 'supplier2@example.com',
            'address' => 'Banjarmasin, Kalimantan Selatan',
        ]);
    }
}