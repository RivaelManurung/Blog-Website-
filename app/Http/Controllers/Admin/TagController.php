<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use App\Http\Requests\StoreTagRequest; // Kita akan buat ini
use App\Http\Requests\UpdateTagRequest; // Kita akan buat ini
use Illuminate\Support\Str;

class TagController extends Controller
{
    public function index()
    {
        // Mengambil semua tag dengan jumlah post terkait (efisien)
        $tags = Tag::withCount('posts')->latest()->paginate(15);
        return view('admin.tags.index', compact('tags'));
    }

    public function create()
    {
        // Hanya menampilkan form
        return view('admin.tags.create');
    }

    public function store(StoreTagRequest $request)
    {
        // Validasi dilakukan oleh StoreTagRequest
        Tag::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name), // Slug dibuat otomatis
        ]);
        return redirect()->route('admin.tags.index')->with('success', 'Tag berhasil dibuat.');
    }

    public function edit(Tag $tag)
    {
        // Mengirim data tag yang akan diedit ke view
        return view('admin.tags.edit', compact('tag'));
    }

    public function update(UpdateTagRequest $request, Tag $tag)
    {
        // Validasi dilakukan oleh UpdateTagRequest
        $tag->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
        ]);
        return redirect()->route('admin.tags.index')->with('success', 'Tag berhasil diperbarui.');
    }

    public function destroy(Tag $tag)
    {
        // Hapus tag dari database
        $tag->delete();
        return redirect()->route('admin.tags.index')->with('success', 'Tag berhasil dihapus.');
    }
}
