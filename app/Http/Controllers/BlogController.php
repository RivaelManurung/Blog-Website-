<?php

namespace App\Http\Controllers;

use App\Models\Post; // <-- Menggunakan Model Post yang asli
use Illuminate\Http\Request;
use Illuminate\Support\Str; // <-- Untuk membantu manipulasi teks

class BlogController extends Controller
{
    /**
     * Menampilkan halaman utama blog.
     */
    public function index()
    {
        // Ambil 1 post terbaru yang ditandai sebagai "featured" dan sudah "published"
        $featuredPost = Post::where('is_featured', true)
            ->where('status', 'published')
            ->with('categories', 'author') // Mengambil relasi untuk efisiensi
            ->latest('published_at')
            ->first();

        // Ambil semua post lain yang sudah "published"
        $query = Post::where('status', 'published')->with('categories', 'author');

        // Jika ada featured post, jangan tampilkan lagi di daftar post terbaru
        if ($featuredPost) {
            $query->where('id', '!=', $featuredPost->id);
        }

        $latestPosts = $query->latest('published_at')->paginate(6); // Paginasi 6 post per halaman

        // Kirim data yang sudah diambil dari database ke view
        return view('user.blog.index', compact('featuredPost', 'latestPosts'));
    }

    /**
     * Menampilkan detail satu post berdasarkan slug-nya.
     */
    public function show(Post $post) // Menggunakan Route-Model Binding
    {
        // Tolak akses jika post belum di-"publish"
        if ($post->status !== 'published') {
            abort(404);
        }

        // Ambil relasi yang dibutuhkan
        $post->load('author', 'categories', 'tags');

        // Hitung perkiraan waktu baca
        $wordCount = Str::wordCount(strip_tags($post->content));
        $readTime = ceil($wordCount / 200) . ' min read';

        // Kirim data post dan waktu baca ke view
        return view('user.blog.show', compact('post', 'readTime'));
    }
}
