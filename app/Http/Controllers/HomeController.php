<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post; // Import model Post

class HomeController extends Controller
{
    /**
     * Menampilkan halaman beranda.
     */
    public function index()
    {
        // DIUBAH: Ambil HANYA 3 post terbaru yang statusnya "published".
        // Kita tidak lagi membutuhkan logika featuredPost di sini.
        // Ganti paginate() dengan take(3)->get()
        $latestPosts = Post::where('status', 'published')
                            ->latest('published_at')
                            ->take(3) // Ambil hanya 3 post
                            ->get();

        // Kirim data ke view. Nama variabelnya kita samakan saja.
        return view('user.home', ['latestPosts' => $latestPosts]);
    }
}