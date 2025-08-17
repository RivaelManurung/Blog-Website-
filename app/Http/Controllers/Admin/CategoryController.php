<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index()
    {
        // Gunakan withCount untuk query yang lebih efisien
        $categories = Category::withCount('posts')->latest()->paginate(15);
        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Tampilkan form untuk membuat kategori baru.
     */
    public function create()
    {
        // 1. Ambil semua kategori untuk pilihan parent
        $parentCategories = Category::all();
        
        // 2. Kirim variabel tersebut ke view
        return view('admin.categories.create', compact('parentCategories'));
    }

    public function store(StoreCategoryRequest $request)
    {
        // Logika store Anda sudah bagus
        Category::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'description' => $request->description,
            'parent_id' => $request->parent_id,
        ]);
        return redirect()->route('admin.categories.index')->with('success', 'Kategori berhasil dibuat.');
    }
    
    /**
     * Tampilkan form untuk mengedit kategori.
     */
    public function edit(Category $category)
    {
        // 1. Ambil semua kategori KECUALI kategori yang sedang diedit
        //    (Sebuah kategori tidak bisa menjadi parent untuk dirinya sendiri)
        $parentCategories = Category::where('id', '!=', $category->id)->get();
        
        // 2. Kirim variabel kategori yang akan diedit DAN daftar parent ke view
        return view('admin.categories.edit', compact('category', 'parentCategories'));
    }

    public function update(UpdateCategoryRequest $request, Category $category)
    {
        // Logika update Anda sudah bagus
        $category->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'description' => $request->description,
            'parent_id' => $request->parent_id,
        ]);
        return redirect()->route('admin.categories.index')->with('success', 'Kategori berhasil diperbarui.');
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('admin.categories.index')->with('success', 'Kategori berhasil dihapus.');
    }
}