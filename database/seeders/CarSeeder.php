<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Car;

class CarSeeder extends Seeder
{
    public function run(): void
    {
        Car::create([
            'brand' => 'Toyota',
            'model' => 'Corolla',
            'year' => 2025,
            'price' => 22000,
            'images' => json_encode(['toyota_1.jpg', 'toyota_2.jpg']),
        ]);

        Car::create([
            'brand' => 'BMW',
            'model' => 'X5',
            'year' => 2024,
            'price' => 40000,
            'images' => json_encode(['BMW_1.jpg', 'BMW_2.jpg']),
        ]);

        Car::create([
            'brand' => 'Kia',
            'model' => 'Sportage',
            'year' => 2023,
            'price' => 30000 ,
            'images' => json_encode(['kia_1.jpg', 'kia_2.jpg']),
        ]);

        Car::create([
            'brand' => 'Hyundai',
            'model' => 'Elantra',
            'year' => 2024,
            'price' => 48000 ,
            'images' => json_encode(['hyundai_1.jpg', 'hyundai_2.jpg']),
        ]);

        Car::create([
            'brand' => 'Jaguar',
            'model' => ' XF s',
            'year' => 2024,
            'price' => 120000 ,
            'images' => json_encode(['jaguar_1.jpg', 'jaguar_2.jpg', 'jaguar_3.jpg']),
        ]);

        Car::create([
            'brand' => 'Mercedes',
            'model' => ' benz ',
            'year' => 2025,
            'price' => 78000 ,
            'images' => json_encode(['mercedes_1.jpg', 'mercedes_2.jpg','mercedes_3.jpg','mercedes_4.jpg']),
        ]);

        Car::create([
            'brand' => 'Porsche',
            'model' => ' gt3 rs',
            'year' => 2024,
            'price' => 90000 ,
            'images' => json_encode(['porsche_1.jpg', 'porsche_2.jpg', 'porsche_3.jpg']),
        ]);

        Car::create([
            'brand' => 'Ferrari',
            'model' => 'car aesthetic',
            'year' => 2025,
            'price' => 110000 ,
            'images' => json_encode(['ferrari_1.jpg', 'ferrari_2.jpg', 'ferrari_3.jpg']),
        ]);

        Car::create([
            'brand' => 'KIA',
            'model' => 'sportage ',
            'year' => 2023,
            'price' => 91000 ,
            'images' => json_encode(['kia_1.jpg', 'kia_2.jpg','kia_3.jpg', 'kia_4.jpg']),
        ]);


    }
}