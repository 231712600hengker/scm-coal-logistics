<?php

namespace Database\Seeders;

use App\Models\Supplier;
use Illuminate\Database\Seeder;

class SupplierSeeder extends Seeder
{
    public function run(): void
    {
        $suppliers = [
            ['supplier_code' => 'SUP-001', 'name' => 'PT Bara Energi Nusantara', 'contact_person' => 'Andi Pratama', 'phone' => '081234567001', 'email' => 'supplier1@example.com', 'address' => 'Samarinda, Kalimantan Timur'],
            ['supplier_code' => 'SUP-002', 'name' => 'PT Tambang Makmur Jaya', 'contact_person' => 'Budi Santoso', 'phone' => '081234567002', 'email' => 'supplier2@example.com', 'address' => 'Banjarmasin, Kalimantan Selatan'],
            ['supplier_code' => 'SUP-003', 'name' => 'PT Coalindo Prima Logistik', 'contact_person' => 'Citra Lestari', 'phone' => '081234567003', 'email' => 'supplier3@example.com', 'address' => 'Muara Enim, Sumatera Selatan'],
        ];

        foreach ($suppliers as $supplier) {
            Supplier::create($supplier);
        }
    }
}
