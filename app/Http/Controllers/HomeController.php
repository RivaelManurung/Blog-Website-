<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Data artikel untuk ditampilkan di halaman utama
        $articles = [
            [
                'image' => 'https://picsum.photos/seed/tech1/600/400',
                'category' => 'Technology',
                'title' => 'The Future of Web Development',
                'link' => '/blog/the-future-of-web-development',
                'categoryColor' => 'bg-sky-100 text-sky-800'
            ],
            [
                'image' => 'https://picsum.photos/seed/ai2/600/400',
                'category' => 'AI & ML',
                'title' => 'A Beginner\'s Guide to Machine Learning',
                'link' => '#',
                'categoryColor' => 'bg-sky-100 text-sky-800'
            ],
            [
                'image' => 'https://picsum.photos/seed/design3/600/400',
                'category' => 'Design',
                'title' => 'Modern UI/UX Principles',
                'link' => '#',
                'categoryColor' => 'bg-sky-100 text-sky-800'
            ],
        ];

        return view('user.home', ['articles' => $articles]);
    }
}