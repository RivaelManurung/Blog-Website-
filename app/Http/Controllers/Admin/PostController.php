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
use Illuminate\Support\Facades\Log; // Penting untuk logging

class PostController extends Controller
{
    public function index()
    {
        // Pastikan eager loading menggunakan nama relasi yang benar ('categories')
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
        try {
            $validated = $request->validated();
            Log::info('Data validasi untuk store post diterima:', $validated);

            $imagePath = null;
            if ($request->hasFile('cover_image')) {
                $imagePath = $request->file('cover_image')->store('posts_covers', 'public');
            }

            // 1. Buat post TANPA category_id
            $post = auth()->user()->posts()->create([
                'title' => $validated['title'],
                'slug' => Str::slug($validated['title']),
                'content' => $validated['content'],
                'status' => $validated['status'],
                'cover_image' => $imagePath,
                'published_at' => ($validated['status'] == 'published') ? now() : null,
            ]);

            // 2. Lampirkan (attach) relasi ke tabel pivot
            if (!empty($validated['categories'])) {
                $post->categories()->attach($validated['categories']);
            }
            if (!empty($validated['tags'])) {
                $post->tags()->attach($validated['tags']);
            }
            
            Log::info('Post berhasil dibuat dengan ID: ' . $post->id);
            return redirect()->route('admin.posts.index')->with('success', 'Post berhasil dibuat.');

        } catch (\Exception $e) {
            // Jika terjadi error, catat di log dan kembalikan ke user dengan pesan error
            Log::error('Gagal membuat post: ' . $e->getMessage());
            return back()->with('error', 'Gagal menyimpan post. Silakan periksa log untuk detail.')->withInput();
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
        try {
            $validated = $request->validated();
            $imagePath = $post->cover_image;

            if ($request->hasFile('cover_image')) {
                if ($post->cover_image) {
                    Storage::disk('public')->delete($post->cover_image);
                }
                $imagePath = $request->file('cover_image')->store('posts_covers', 'public');
            }

            // 1. Update data utama post
            $post->update([
                'title' => $validated['title'],
                'slug' => Str::slug($validated['title']),
                'content' => $validated['content'],
                'status' => $validated['status'],
                'cover_image' => $imagePath,
                'published_at' => ($validated['status'] == 'published' && !$post->published_at) ? now() : $post->published_at,
            ]);

            // 2. Sinkronkan (sync) relasi di tabel pivot. Ini akan menghapus yang lama dan menambah yang baru.
            $post->categories()->sync($validated['categories'] ?? []);
            $post->tags()->sync($validated['tags'] ?? []);

            return redirect()->route('admin.posts.index')->with('success', 'Post berhasil diperbarui.');
        } catch (\Exception $e) {
            Log::error('Gagal update post: ' . $e->getMessage());
            return back()->with('error', 'Gagal memperbarui post. Silakan periksa log untuk detail.')->withInput();
        }
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