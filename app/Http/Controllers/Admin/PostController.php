<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log; // 1. Tambahkan use statement untuk Log

class PostController extends Controller
{
    public function index()
    {
        // DIUBAH: Memuat relasi 'categories' (jamak)
        $posts = Post::with('author', 'categories')->latest()->paginate(15);
        return view('admin.posts.index', compact('posts'));
    }

    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('admin.posts.create', compact('categories', 'tags'));
    }

    public function store(StorePostRequest $request)
    {
        // 2. Gunakan try-catch untuk menangkap semua kemungkinan error
        try {
            $validated = $request->validated();
            Log::info('Data validasi diterima:', $validated);

            $imagePath = null;
            if ($request->hasFile('cover_image')) {
                $imagePath = $request->file('cover_image')->store('posts_covers', 'public');
            }

            // DIHAPUS: 'category_id' tidak lagi disimpan di tabel posts
            $post = auth()->user()->posts()->create([
                'title' => $validated['title'],
                'slug' => Str::slug($validated['title']),
                'content' => $validated['content'],
                'status' => $validated['status'],
                'cover_image' => $imagePath,
                'published_at' => ($validated['status'] == 'published') ? now() : null,
            ]);

            // DITAMBAHKAN: Simpan relasi ke tabel pivot 'category_post'
            if (!empty($validated['categories'])) {
                $post->categories()->attach($validated['categories']);
            }
            if (!empty($validated['tags'])) {
                $post->tags()->attach($validated['tags']);
            }
            
            Log::info('Post berhasil dibuat dengan ID: ' . $post->id);
            return redirect()->route('admin.posts.index')->with('success', 'Post berhasil dibuat.');

        } catch (\Exception $e) {
            // 3. Catat error di log jika terjadi kegagalan
            Log::error('Gagal membuat post: ' . $e->getMessage());
            return back()->with('error', 'Terjadi kesalahan saat menyimpan post. Silakan periksa log.');
        }
    }

    public function edit(Post $post)
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('admin.posts.edit', compact('post', 'categories', 'tags'));
    }

    public function update(UpdatePostRequest $request, Post $post)
    {
        $validated = $request->validated();
        $imagePath = $post->cover_image;

        if ($request->hasFile('cover_image')) {
            if ($post->cover_image) {
                Storage::disk('public')->delete($post->cover_image);
            }
            $imagePath = $request->file('cover_image')->store('posts_covers', 'public');
        }

        // DIHAPUS: 'category_id' tidak diupdate di sini
        $post->update([
            'title' => $validated['title'],
            'slug' => Str::slug($validated['title']),
            'content' => $validated['content'],
            'status' => $validated['status'],
            'cover_image' => $imagePath,
            'published_at' => ($validated['status'] == 'published' && !$post->published_at) ? now() : $post->published_at,
        ]);

        // DIUBAH: Gunakan sync() untuk update relasi categories dan tags
        $post->categories()->sync($validated['categories'] ?? []);
        $post->tags()->sync($validated['tags'] ?? []);

        return redirect()->route('admin.posts.index')->with('success', 'Post berhasil diperbarui.');
    }

    public function destroy(Post $post)
    {
        if ($post->cover_image) {
            Storage::disk('public')->delete($post->cover_image);
        }
        $post->delete();
        return redirect()->route('admin.posts.index')->with('success', 'Post berhasil dihapus.');
    }
}