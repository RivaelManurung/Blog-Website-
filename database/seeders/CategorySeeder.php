<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Hapus data lama untuk menghindari duplikat saat seeding ulang
        Category::query()->delete();

        // Data Kategori
        $categories = [
            [
                'name' => 'Web Development',
                'description' => 'Semua tentang pengembangan web, dari front-end hingga back-end.'
            ],
            [
                'name' => 'Artificial Intelligence',
                'description' => 'Artikel mengenai kecerdasan buatan, machine learning, dan data science.'
            ],
            [
                'name' => 'Productivity',
                'description' => 'Tips dan trik untuk meningkatkan produktivitas sebagai developer.'
            ],
            [
                'name' => 'UI/UX Design',
                'description' => 'Prinsip dan praktik terbaik dalam desain antarmuka dan pengalaman pengguna.'
            ],
            [
                'name' => 'Laravel',
                'description' => 'Tutorial, tips, dan berita seputar framework Laravel.'
            ],
            [
                'name' => 'PHP',
                'description' => 'Pembahasan mendalam mengenai bahasa pemrograman PHP.'
            ]
        ];

        // Looping dan masukkan data ke database
        foreach ($categories as $category) {
            Category::create([
                'name' => $category['name'],
                'slug' => Str::slug($category['name']),
                'description' => $category['description']
            ]);
        }
    }
}