<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use Illuminate\Support\Str;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Hapus data post lama untuk menghindari duplikat
        Post::query()->delete();

        // 1. Ambil user pertama sebagai penulis
        $author = User::first();
        if (!$author) {
            $author = User::factory()->create([
                'name' => 'Admin User',
                'email' => 'admin@example.com',
            ]);
        }

        // 2. Ambil SEMUA kategori yang ada untuk variasi yang lebih baik
        $categories = Category::all();
        if ($categories->isEmpty()) {
            $categories = Category::factory()->count(5)->create();
        }

        // 3. Data untuk 15 post
        $posts = [
            // Featured Posts
            ['title' => 'Exploring the Depths of Laravel 11', 'is_featured' => true],
            ['title' => 'A Comprehensive Guide to Modern CSS with Tailwind', 'is_featured' => true],
            ['title' => 'Getting Started with Artificial Intelligence in PHP', 'is_featured' => true],

            // Regular Posts
            ['title' => 'Understanding Asynchronous JavaScript for Backend Developers'],
            ['title' => 'Introduction to Vue.js 3 for Beginners'],
            ['title' => 'Database Design Best Practices for Scalable Applications'],
            ['title' => 'My Top 10 Productivity Hacks for Developers in 2025'],
            ['title' => 'The Core Principles of Clean UI/UX Design'],
            ['title' => 'Building a RESTful API with Laravel Sanctum'],
            ['title' => 'Advanced Eloquent ORM Techniques You Should Know'],
            ['title' => 'PHP 8.3: What\'s New and Why It Matters'],
            ['title' => 'Optimizing Your Web Applications for Peak Performance'],
            ['title' => 'A Deep Dive into Machine Learning Models'],
            ['title' => 'How to Structure a Large-Scale Laravel Project'],
            ['title' => 'From Figma to Code: A UI/UX Implementation Guide'],
        ];

        // Looping dan buat post
        foreach ($posts as $postData) {
            $title = $postData['title'];

            // Konten dinamis berdasarkan judul
            $content = "
                <p>This is a detailed article about <strong>{$title}</strong>. In this post, we will explore the fundamental concepts, best practices, and advanced techniques related to this topic. Whether you are a beginner or an expert, you will find valuable insights here.</p>
                <p>We will cover several key areas, including initial setup, core features, and real-world implementation examples. We'll also look at common pitfalls and how to avoid them. Join us as we take a deep dive into the fascinating world of {$title} and unlock its full potential for your projects.</p>
                <h3>Key Takeaways</h3>
                <ul>
                    <li>Understanding the core principles of {$title}.</li>
                    <li>Step-by-step guide for implementation.</li>
                    <li>Advanced tips for optimization and scalability.</li>
                </ul>
            ";

            $post = Post::create([
                'title' => $title,
                'slug' => Str::slug($title),
                'content' => $content,
                'excerpt' => Str::limit(strip_tags($content), 150),
                'user_id' => $author->id,
                'status' => 'published',
                'is_featured' => $postData['is_featured'] ?? false, // Default is_featured ke false jika tidak di-set
                'published_at' => now()->subDays(rand(1, 30)), // Publikasi dalam 30 hari terakhir
                'cover_image' => 'posts_covers/default.jpg'
            ]);

            // Lampirkan 1 sampai 3 kategori secara acak ke setiap post
            $post->categories()->attach(
                $categories->random(rand(1, 3))->pluck('id')->toArray()
            );
        }
    }
}