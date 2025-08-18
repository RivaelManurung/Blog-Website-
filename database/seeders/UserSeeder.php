<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Hapus data user yang ada sebelumnya untuk menghindari duplikat
        DB::table('users')->delete();
        // Buat satu user admin
        User::create([
            'name' => 'Rivael Manurung',
            'email' => 'admin@example.com',
            'email_verified_at' => now(), // Langsung verifikasi email
            'password' => Hash::make('password'), // Passwordnya adalah 'password'
        ]);

        // Anda bisa menambahkan user lain di sini jika perlu
        // User::create([...]);
    }
}
