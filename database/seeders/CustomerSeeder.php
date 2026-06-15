<?php

namespace Database\Seeders;

use App\Models\Customer;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    public function run(): void
    {
        Customer::create(['customer_code' => 'CUS-001', 'name' => 'PT Industri Baja Nasional', 'contact_person' => 'Rina Wijaya', 'phone' => '081234567101', 'email' => 'customer1@example.com', 'address' => 'Cilegon, Banten']);
        Customer::create(['customer_code' => 'CUS-002', 'name' => 'PT Pembangkit Energi Mandiri', 'contact_person' => 'Dedi Kurniawan', 'phone' => '081234567102', 'email' => 'customer2@example.com', 'address' => 'Gresik, Jawa Timur']);
        Customer::create(['customer_code' => 'CUS-003', 'name' => 'PT Semen Nusantara Energi', 'contact_person' => 'Maya Anggraini', 'phone' => '081234567103', 'email' => 'customer3@example.com', 'address' => 'Tuban, Jawa Timur']);
    }
}
