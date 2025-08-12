<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Car;
use App\Models\User;

class RentalSeeder extends Seeder
{
    public function run(): void
    {
        // جلب أسماء العربيات مع الـ ID من جدول cars كمصفوفة
        $cars = Car::pluck('id')->toArray();

        // جلب كل user ids
        $userIds = User::pluck('id')->toArray();

        // لو مفيش يوزر، أنشئ واحد افتراضي
        if (empty($userIds)) {
            $newUserId = DB::table('users')->insertGetId([
                'name' => 'Seeder User',
                'email' => 'default@example.com',
                'password' => bcrypt('12345678'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            $userIds[] = $newUserId;
        }

        // بيانات الإعلانات
        $seedItems = [
            [
                'title' => 'Toyota',
                'description' => 'Toyota Corolla 2020 is Economical and comfortable car for daily use.',
                'price_per_day' => 500.00,
                'location' => 'Cairo',
                'images' => [
                    'images/rentals/toyota_1.jpg',
                    'images/rentals/toyota_2.jpg',
                ],
            ],
            [
                'title' => 'BMW',
                'description' => 'BMW X5 2022 is Luxury SUV with powerful performance.',
                'price_per_day' => 1200.00,
                'location' => 'Alexandria',
                'images' => [
                    'images/rentals/BMW_1.jpg',
                    'images/rentals/BMW_2.jpg',
                ],
            ],
            [
                'title' => 'Hyundai',
                'description' => 'Hyundai Elantra 2021 is Compact sedan with great fuel efficiency.',
                'price_per_day' => 450.00,
                'location' => 'Giza',
                'images' => [
                    'images/rentals/hyundai_1.jpg',
                    'images/rentals/hyundai_2.jpg',
                ],
            ],
        ];

        $rows = [];
        foreach ($seedItems as $index => $item) {
            $rows[] = [
                'car_id' => $cars[$item['title']] ?? null, // ID العربية أو NULL
                'user_id' => $userIds[$index % count($userIds)], // يوزر تلقائي
                'title' => $item['title'],
                'description' => $item['description'],
                'price_per_day' => $item['price_per_day'],
                'location' => $item['location'],
                'images' => json_encode($item['images']),
                'available' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        DB::table('rentals')->insert($rows);
    }
}

