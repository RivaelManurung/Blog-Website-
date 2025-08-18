<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // Panggil seeder UserSeeder untuk mengisi data user
        $this->call([
            UserSeeder::class,
            CategorySeeder::class, // Pastikan Anda punya ini jika belum
            TagSeeder::class,      // Pastikan Anda punya ini jika belum
            PostSeeder::class,     // <-- Tambahkan ini
        ]);
    }
}
