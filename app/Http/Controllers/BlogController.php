<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
// use App\Models\Post; // Nantinya akan menggunakan ini

class BlogController extends Controller
{
    public function index()
    {
        // Di aplikasi nyata, data ini akan diambil dari database
        // Contoh: $featuredPost = Post::where('is_featured', true)->first();
        //         $latestPosts = Post::where('is_featured', false)->latest()->paginate(6);

        // Data palsu untuk Artikel Unggulan (Featured Post)
        $featuredPost = (object) [
            'image' => 'https://picsum.photos/seed/featured/800/600',
            'category' => 'Technology',
            'title' => 'The Future of Web Development: Trends in 2025',
            'excerpt' => 'Explore the cutting-edge technologies and methodologies that are shaping the future of web development, from AI assistants to edge computing.',
            'link' => '/blog/the-future-of-web-development'
        ];

        // Data palsu untuk Daftar Artikel Terbaru
        $latestPosts = [
            (object) [
                'image' => 'https://picsum.photos/seed/ai2/600/400', 
                'category' => 'AI & ML', 
                'title' => 'A Beginner\'s Guide to Machine Learning', 
                'link' => '#',
                'categoryColor' => 'bg-sky-100 text-sky-800'
            ],
            (object) [
                'image' => 'https://picsum.photos/seed/design3/600/400', 
                'category' => 'Design', 
                'title' => 'Modern UI/UX Principles for Better Experiences', 
                'link' => '#',
                'categoryColor' => 'bg-sky-100 text-sky-800'
            ],
            (object) [
                'image' => 'https://picsum.photos/seed/life4/600/400', 
                'category' => 'Productivity', 
                'title' => 'My Top 5 Productivity Hacks for Developers', 
                'link' => '#',
                'categoryColor' => 'bg-green-100 text-green-800'
            ],
        ];

        // Kirim kedua variabel ke view
        return view('user.blog.index', [
            'featuredPost' => $featuredPost,
            'latestPosts'  => $latestPosts
            
        ]);
    }

    // public function show(Post $post) // Nantinya akan menggunakan ini
   public function show($slug)
    {
        // Di aplikasi nyata, Anda akan mencari data dari database berdasarkan slug
        // $post = Post::where('slug', $slug)->firstOrFail();

        // Untuk sekarang, kita buat data artikel palsu
        $post = (object) [
            'title' => 'The Future of Web Development: Trends in 2025',
            'category' => 'Technology',
            'author_name' => 'Rivael Manurung',
            'author_image' => 'https://i.pravatar.cc/150?u=a042581f4e29026704d',
            'published_date' => '16 Agustus 2025',
            'read_time' => '6 min read',
            'featured_image' => 'https://picsum.photos/seed/featured/1200/600',
            'content' => '
                <p>The landscape of web development is constantly evolving, with new technologies, frameworks, and methodologies emerging at an unprecedented pace. As we navigate through 2025, developers and businesses alike must stay ahead of the curve to remain competitive and deliver exceptional user experiences.</p>
                <h2>Key Trends Shaping the Future</h2>
                <p>In this comprehensive guide, we\'ll explore the most significant trends that are reshaping how we approach web development, from the rise of AI-powered development tools to the increasing importance of performance optimization and accessibility.</p>
                <blockquote>"The future of web development lies in the seamless integration of performance, accessibility, and user experience."</blockquote>
                <h3>1. AI-Assisted Development</h3>
                <p>Artificial Intelligence is revolutionizing the development process, offering intelligent code completion, automated testing, and even entire feature generation. Tools like GitHub Copilot and ChatGPT are becoming essential parts of the modern developer\'s toolkit.</p>
                <h2>Conclusion</h2>
                <p>By staying informed about these trends, you can build applications that are not only cutting-edge but also sustainable and user-centric.</p>
            ',
            'comments' => [
                (object) ['name' => 'Alex Thompson', 'avatar' => 'https://i.pravatar.cc/150?u=alex', 'time' => '2 hours ago', 'body' => 'Great article! The insights about WebAssembly are particularly interesting.'],
                (object) ['name' => 'Maria Rodriguez', 'avatar' => 'https://i.pravatar.cc/150?u=maria', 'time' => '5 hours ago', 'body' => 'This is exactly what I needed to read! Thank you for sharing!'],
            ]
        ];

        // Kirim object $post ke view 'user.blog.show'
        return view('user.blog.show', ['post' => $post]);
    }
}