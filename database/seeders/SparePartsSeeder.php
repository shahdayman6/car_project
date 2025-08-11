<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class SparePartsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
           DB::table('spare_parts')->insert([
            [
                'name' => 'Turbocharger',
                'price' => 3500.00,
                'description' => 'High-performance turbocharger to boost engine power and acceleration',
                'images' => json_encode(['Turbocharger.png']),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Car Battery',
                'price' => 600.00,
                'description' => '12V car battery with long life',
                'images' => json_encode(['Car Battery.png']),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Oil Filter',
                'price' => 50.00,
                'description' => 'Premium oil filter for engine protection',
                'images' => json_encode(['Oil Filter.png']),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}

