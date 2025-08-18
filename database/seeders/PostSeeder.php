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
        // 1. Ambil user pertama sebagai penulis
        $author = User::first();
        if (!$author) {
            // Jika tidak ada user, buat satu
            $author = User::factory()->create([
                'name' => 'Admin User',
                'email' => 'admin@example.com',
            ]);
        }

        // 2. Ambil beberapa kategori untuk dilampirkan ke post
        $categories = Category::take(3)->get();
        if ($categories->isEmpty()) {
            // Jika tidak ada kategori, buat beberapa
            $categories = Category::factory()->count(3)->create();
        }

        // 3. Buat beberapa contoh post
        $posts = [
            [
                'title' => 'Exploring the Depths of Laravel 11',
                'content' => '<p>Laravel 11 comes with a plethora of new features designed to enhance developer productivity and application performance. In this article, we will take a deep dive into some of the most exciting updates, including the new application structure, streamlined configuration, and the powerful additions to the Artisan console.</p><p>We will explore real-world examples to demonstrate how these changes can be leveraged in your projects. From building APIs with new health checks to understanding the revamped scheduler, this guide has you covered.</p>',
                'is_featured' => true,
            ],
            [
                'title' => 'A Guide to Modern CSS with Tailwind',
                'content' => '<p>Tailwind CSS has revolutionized the way we write CSS. By providing utility-first classes, it allows for rapid UI development without ever leaving your HTML. This guide will walk you through the fundamentals of Tailwind, from setting it up in a Laravel project to building complex, responsive components.</p><p>Forget writing custom CSS files for every little thing. Learn how to leverage the power of utilities to create beautiful and consistent designs efficiently.</p>',
                'is_featured' => false,
            ],
            [
                'title' => 'Understanding Asynchronous JavaScript',
                'content' => '<p>JavaScript is single-threaded, but its asynchronous nature is what makes it powerful for web applications. This post breaks down the concepts of callbacks, Promises, and async/await.</p><p>We will look at practical examples to understand how to handle asynchronous operations gracefully, avoiding common pitfalls like "callback hell" and making your code cleaner and more readable.</p>',
                'is_featured' => false,
            ],
            [
                'title' => 'Introduction to Vue.js for Beginners',
                'content' => '<p>Vue.js is a progressive JavaScript framework that is approachable, versatile, and performant. If you are new to frontend frameworks, Vue is an excellent place to start. This tutorial covers the core concepts, including the Vue instance, template syntax, computed properties, and event handling.</p>',
                'is_featured' => false,
            ],
            [
                'title' => 'Database Design Best Practices',
                'content' => '<p>A well-designed database is the backbone of any robust application. This article discusses key principles of database design, including normalization, choosing the right data types, and indexing strategies.</p><p>Learn how to plan your schema to ensure data integrity, scalability, and performance from the get-go.</p>',
                'is_featured' => false,
            ]
        ];

        foreach ($posts as $postData) {
            $post = Post::create([
                'title' => $postData['title'],
                'slug' => Str::slug($postData['title']),
                'content' => $postData['content'],
                'excerpt' => Str::limit(strip_tags($postData['content']), 150),
                'user_id' => $author->id,
                'status' => 'published',
                'is_featured' => $postData['is_featured'],
                'published_at' => now(),
                'cover_image' => 'posts_covers/default.jpg' // Pastikan Anda punya gambar default di storage/app/public/posts_covers/
            ]);

            // 4. Lampirkan kategori ke setiap post yang dibuat
            $post->categories()->attach($categories->random(rand(1, 2))->pluck('id')->toArray());
        }
    }
}