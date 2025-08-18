<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Tag;
use Illuminate\Support\Str;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Hapus data lama
        Tag::query()->delete();

        // Data Tags
        $tags = [
            'laravel',
            'php',
            'eloquent',
            'blade',
            'livewire',
            'javascript',
            'vuejs',
            'reactjs',
            'tailwind-css',
            'docker',
            'mysql',
            'machine-learning',
            'tips'
        ];
        
        // Looping dan masukkan data
        foreach ($tags as $tag) {
            Tag::create([
                'name' => $tag,
                'slug' => Str::slug($tag)
            ]);
        }
    }
}