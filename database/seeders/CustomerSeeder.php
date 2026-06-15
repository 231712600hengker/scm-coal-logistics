<?php

namespace Database\Seeders;

use App\Models\Customer;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    public function run(): void
    {
        $customers = [
            ['customer_code' => 'CUS-001', 'name' => 'PT Industri Baja Nasional', 'contact_person' => 'Rina Wijaya', 'phone' => '081234567101', 'email' => 'customer1@example.com', 'address' => 'Cilegon, Banten'],
            ['customer_code' => 'CUS-002', 'name' => 'PT Pembangkit Energi Mandiri', 'contact_person' => 'Dedi Kurniawan', 'phone' => '081234567102', 'email' => 'customer2@example.com', 'address' => 'Gresik, East Java'],
            ['customer_code' => 'CUS-003', 'name' => 'PT Semen Nusantara Energi', 'contact_person' => 'Maya Anggraini', 'phone' => '081234567103', 'email' => 'customer3@example.com', 'address' => 'Tuban, East Java'],
            ['customer_code' => 'CUS-004', 'name' => 'PT Power Plant Indonesia', 'contact_person' => 'Arif Maulana', 'phone' => '081234567104', 'email' => 'customer4@example.com', 'address' => 'Suralaya, Banten'],
            ['customer_code' => 'CUS-005', 'name' => 'PT Krakatau Energy Steel', 'contact_person' => 'Bella Kartika', 'phone' => '081234567105', 'email' => 'customer5@example.com', 'address' => 'Cilegon, Banten'],
            ['customer_code' => 'CUS-006', 'name' => 'PT Java Cement Industry', 'contact_person' => 'Chandra Kusuma', 'phone' => '081234567106', 'email' => 'customer6@example.com', 'address' => 'Rembang, Central Java'],
            ['customer_code' => 'CUS-007', 'name' => 'PT Surabaya Manufacturing Group', 'contact_person' => 'Dian Puspita', 'phone' => '081234567107', 'email' => 'customer7@example.com', 'address' => 'Surabaya, East Java'],
            ['customer_code' => 'CUS-008', 'name' => 'PT Central Java Power', 'contact_person' => 'Eko Prasetyo', 'phone' => '081234567108', 'email' => 'customer8@example.com', 'address' => 'Batang, Central Java'],
            ['customer_code' => 'CUS-009', 'name' => 'PT Sumatra Industrial Energy', 'contact_person' => 'Farah Nabila', 'phone' => '081234567109', 'email' => 'customer9@example.com', 'address' => 'Medan, North Sumatra'],
            ['customer_code' => 'CUS-010', 'name' => 'PT Pupuk Energi Nusantara', 'contact_person' => 'Galih Ramadhan', 'phone' => '081234567110', 'email' => 'customer10@example.com', 'address' => 'Bontang, East Kalimantan'],
            ['customer_code' => 'CUS-011', 'name' => 'PT West Java Textile Energy', 'contact_person' => 'Hana Salsabila', 'phone' => '081234567111', 'email' => 'customer11@example.com', 'address' => 'Bandung, West Java'],
            ['customer_code' => 'CUS-012', 'name' => 'PT Makassar Industrial Port', 'contact_person' => 'Iqbal Fadillah', 'phone' => '081234567112', 'email' => 'customer12@example.com', 'address' => 'Makassar, South Sulawesi'],
            ['customer_code' => 'CUS-013', 'name' => 'PT Bali Utility Energy', 'contact_person' => 'Jasmine Putri', 'phone' => '081234567113', 'email' => 'customer13@example.com', 'address' => 'Denpasar, Bali'],
            ['customer_code' => 'CUS-014', 'name' => 'PT Lampung Sugar Refinery', 'contact_person' => 'Kevin Hartono', 'phone' => '081234567114', 'email' => 'customer14@example.com', 'address' => 'Lampung, Lampung'],
            ['customer_code' => 'CUS-015', 'name' => 'PT Kalimantan Alumina Plant', 'contact_person' => 'Laras Ayuningtyas', 'phone' => '081234567115', 'email' => 'customer15@example.com', 'address' => 'Ketapang, West Kalimantan'],
            ['customer_code' => 'CUS-016', 'name' => 'PT Sulawesi Nickel Smelter', 'contact_person' => 'Miko Saputra', 'phone' => '081234567116', 'email' => 'customer16@example.com', 'address' => 'Morowali, Central Sulawesi'],
            ['customer_code' => 'CUS-017', 'name' => 'PT Jakarta Industrial Utility', 'contact_person' => 'Nadia Paramita', 'phone' => '081234567117', 'email' => 'customer17@example.com', 'address' => 'Jakarta, DKI Jakarta'],
            ['customer_code' => 'CUS-018', 'name' => 'PT Banten Petrochemical Energy', 'contact_person' => 'Oscar Fernando', 'phone' => '081234567118', 'email' => 'customer18@example.com', 'address' => 'Serang, Banten'],
            ['customer_code' => 'CUS-019', 'name' => 'PT East Java Paper Mill', 'contact_person' => 'Putri Maharani', 'phone' => '081234567119', 'email' => 'customer19@example.com', 'address' => 'Mojokerto, East Java'],
            ['customer_code' => 'CUS-020', 'name' => 'PT National Mining Customer', 'contact_person' => 'Rafi Anugrah', 'phone' => '081234567120', 'email' => 'customer20@example.com', 'address' => 'Jakarta, DKI Jakarta'],
        ];

        foreach ($customers as $customer) {
            Customer::create($customer);
        }
    }
}
