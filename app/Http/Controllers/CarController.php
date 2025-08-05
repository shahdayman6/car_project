<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CarController extends Controller
{
    public function index()
    {
        $cars = [
            [
                'name' => 'Toyota Corolla 2025',
                'price' => '$22,000',
                'images' => ['toyota_1.jpg', 'toyota_2.jpg']
            ],
            [
                'name' => 'BMW X5 2024',
                'price' => '$48,000',
                'images' => ['BMW_1.jpg', 'BMW_2.jpg']
            ],
             [
                'name' => 'Hyundai Elantra 2024',
                'price' => '$48,000',
                'images' => ['hyundai_1.jpg', 'hyundai_2.jpg']
            ],
             [
                'name' => 'Jaguar XF s 2024',
                'price' => '$120,000',
                'images' => ['jaguar_1.jpg', 'jaguar_2.jpg', 'jaguar_3.jpg']
            ],
            [
                'name' => 'Mercedes benz 2025',
                'price' => '$78,000',
                'images' => ['mercedes_1.jpg', 'mercedes_2.jpg','mercedes_3.jpg','mercedes_4.jpg']
            ],
             [
                'name' => 'Porsche gt3 rs 2024',
                'price' => '$90,000',
                'images' => ['porsche_1.jpg', 'porsche_2.jpg', 'porsche_3.jpg']
            ],
             [
                'name' => 'Ferrari car aesthetic 2025',
                'price' => '$110,000',
                'images' => ['ferrari_1.jpg', 'ferrari_2.jpg', 'ferrari_3.jpg']
            ],
            [
                'name' => 'KIA sportage 2023',
                'price' => '$98,000',
                'images' => ['kia_1.jpg', 'kia_2.jpg','kia_3.jpg', 'kia_4.jpg']
            ],
             
        ];

        return view('cars/Master', compact('cars'));
    }
    
}