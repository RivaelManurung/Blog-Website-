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

class PostController extends Controller
{
    public function index()
    {
        // Eager loading ('user', 'categories') untuk menghindari N+1 problem
        $posts = Post::with('user', 'categories')->latest()->paginate(15);
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
        $validated = $request->validated();

        // Handle file upload
        $imagePath = null;
        if ($request->hasFile('cover_image')) {
            $imagePath = $request->file('cover_image')->store('posts_covers', 'public');
        }

        // Buat post baru
        $post = auth()->user()->posts()->create([
            'title' => $validated['title'],
            'slug' => Str::slug($validated['title']),
            'content' => $validated['content'],
            'status' => $validated['status'],
            'cover_image' => $imagePath,
            'published_at' => ($validated['status'] == 'published') ? now() : null,
        ]);

        // Attach relasi many-to-many
        $post->categories()->attach($validated['categories']);
        if (!empty($validated['tags'])) {
            $post->tags()->attach($validated['tags']);
        }

        return redirect()->route('admin.posts.index')->with('success', 'Post berhasil dibuat.');
    }

    public function show(Post $post)
    {
        // Menampilkan detail post
        return view('admin.posts.show', compact('post'));
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
            // Hapus gambar lama jika ada
            if ($post->cover_image) {
                Storage::disk('public')->delete($post->cover_image);
            }
            $imagePath = $request->file('cover_image')->store('posts_covers', 'public');
        }

        $post->update([
            'title' => $validated['title'],
            'slug' => Str::slug($validated['title']),
            'content' => $validated['content'],
            'status' => $validated['status'],
            'cover_image' => $imagePath,
            'published_at' => ($validated['status'] == 'published' && !$post->published_at) ? now() : $post->published_at,
        ]);

        // Sync relasi (sync lebih cocok untuk update)
        $post->categories()->sync($validated['categories']);
        $post->tags()->sync($validated['tags'] ?? []);

        return redirect()->route('admin.posts.index')->with('success', 'Post berhasil diperbarui.');
    }

    public function destroy(Post $post)
    {
        // Hapus gambar dari storage
        if ($post->cover_image) {
            Storage::disk('public')->delete($post->cover_image);
        }
        
        $post->delete(); // Ini akan melakukan soft delete jika model menggunakan trait SoftDeletes
        return redirect()->route('admin.posts.index')->with('success', 'Post berhasil dihapus.');
    }
}