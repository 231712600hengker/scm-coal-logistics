<?php

namespace Database\Seeders;

use App\Models\Supplier;
use Illuminate\Database\Seeder;

class SupplierSeeder extends Seeder
{
    public function run(): void
    {
        $suppliers = [
            ['supplier_code' => 'SUP-001', 'name' => 'PT Bara Energi Nusantara', 'contact_person' => 'Andi Pratama', 'phone' => '081234567001', 'email' => 'supplier1@example.com', 'address' => 'Samarinda, East Kalimantan'],
            ['supplier_code' => 'SUP-002', 'name' => 'PT Tambang Makmur Jaya', 'contact_person' => 'Budi Santoso', 'phone' => '081234567002', 'email' => 'supplier2@example.com', 'address' => 'Banjarmasin, South Kalimantan'],
            ['supplier_code' => 'SUP-003', 'name' => 'PT Coalindo Prima Logistik', 'contact_person' => 'Citra Lestari', 'phone' => '081234567003', 'email' => 'supplier3@example.com', 'address' => 'Muara Enim, South Sumatra'],
            ['supplier_code' => 'SUP-004', 'name' => 'PT Kaltim Mineral Resources', 'contact_person' => 'Dimas Saputra', 'phone' => '081234567004', 'email' => 'supplier4@example.com', 'address' => 'Balikpapan, East Kalimantan'],
            ['supplier_code' => 'SUP-005', 'name' => 'PT Borneo Coal Supply', 'contact_person' => 'Eka Putri', 'phone' => '081234567005', 'email' => 'supplier5@example.com', 'address' => 'Kutai Kartanegara, East Kalimantan'],
            ['supplier_code' => 'SUP-006', 'name' => 'PT Energi Bara Sejahtera', 'contact_person' => 'Fajar Nugroho', 'phone' => '081234567006', 'email' => 'supplier6@example.com', 'address' => 'Berau, East Kalimantan'],
            ['supplier_code' => 'SUP-007', 'name' => 'PT Nusantara Mining Partner', 'contact_person' => 'Gita Amelia', 'phone' => '081234567007', 'email' => 'supplier7@example.com', 'address' => 'Tanah Bumbu, South Kalimantan'],
            ['supplier_code' => 'SUP-008', 'name' => 'PT Prima Bara Sentosa', 'contact_person' => 'Hendra Wijaya', 'phone' => '081234567008', 'email' => 'supplier8@example.com', 'address' => 'Lahat, South Sumatra'],
            ['supplier_code' => 'SUP-009', 'name' => 'PT Mahakam Coal Trading', 'contact_person' => 'Intan Permata', 'phone' => '081234567009', 'email' => 'supplier9@example.com', 'address' => 'Samarinda, East Kalimantan'],
            ['supplier_code' => 'SUP-010', 'name' => 'PT Barito Energy Logistics', 'contact_person' => 'Joko Hartono', 'phone' => '081234567010', 'email' => 'supplier10@example.com', 'address' => 'Barito Kuala, South Kalimantan'],
            ['supplier_code' => 'SUP-011', 'name' => 'PT Adaro Mitra Distribusi', 'contact_person' => 'Kartika Sari', 'phone' => '081234567011', 'email' => 'supplier11@example.com', 'address' => 'Tabalong, South Kalimantan'],
            ['supplier_code' => 'SUP-012', 'name' => 'PT Bukit Asam Supply Chain', 'contact_person' => 'Lukman Hakim', 'phone' => '081234567012', 'email' => 'supplier12@example.com', 'address' => 'Tanjung Enim, South Sumatra'],
            ['supplier_code' => 'SUP-013', 'name' => 'PT Kalimantan Coal Mandiri', 'contact_person' => 'Mega Pratiwi', 'phone' => '081234567013', 'email' => 'supplier13@example.com', 'address' => 'Paser, East Kalimantan'],
            ['supplier_code' => 'SUP-014', 'name' => 'PT Indo Coal Resources', 'contact_person' => 'Nanda Prakoso', 'phone' => '081234567014', 'email' => 'supplier14@example.com', 'address' => 'Palembang, South Sumatra'],
            ['supplier_code' => 'SUP-015', 'name' => 'PT Sentra Bara Abadi', 'contact_person' => 'Olivia Maharani', 'phone' => '081234567015', 'email' => 'supplier15@example.com', 'address' => 'Bengkulu, Bengkulu'],
            ['supplier_code' => 'SUP-016', 'name' => 'PT Arutmin Logistics Partner', 'contact_person' => 'Prasetyo Wibowo', 'phone' => '081234567016', 'email' => 'supplier16@example.com', 'address' => 'Kotabaru, South Kalimantan'],
            ['supplier_code' => 'SUP-017', 'name' => 'PT Mega Coal Transport', 'contact_person' => 'Qori Ramadhan', 'phone' => '081234567017', 'email' => 'supplier17@example.com', 'address' => 'Pontianak, West Kalimantan'],
            ['supplier_code' => 'SUP-018', 'name' => 'PT Delta Bara Kencana', 'contact_person' => 'Rangga Maulana', 'phone' => '081234567018', 'email' => 'supplier18@example.com', 'address' => 'Jambi, Jambi'],
            ['supplier_code' => 'SUP-019', 'name' => 'PT Mitra Tambang Energi', 'contact_person' => 'Salsa Fitriani', 'phone' => '081234567019', 'email' => 'supplier19@example.com', 'address' => 'Pekanbaru, Riau'],
            ['supplier_code' => 'SUP-020', 'name' => 'PT Global Coal Indonesia', 'contact_person' => 'Teguh Santoso', 'phone' => '081234567020', 'email' => 'supplier20@example.com', 'address' => 'Jakarta, DKI Jakarta'],
        ];

        foreach ($suppliers as $supplier) {
            Supplier::create($supplier);
        }
    }
}
