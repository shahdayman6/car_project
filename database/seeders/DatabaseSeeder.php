<?php

namespace Database\Seeders;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
public function run(): void
{
    // $this->call(CarSeeder::class);

    if (!DB::table('users')->where('email', 'test@example.com')->exists()) {
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
    }

    $this->call(CarSeeder::class);
    $this->call(SparePartsSeeder::class);
}
}
