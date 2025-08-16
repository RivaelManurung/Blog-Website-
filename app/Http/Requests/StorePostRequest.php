<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
{
    public function authorize(): bool
    {
        // Set ke true agar semua user yang terotentikasi bisa membuat post.
        // Anda bisa menambahkan logika role/permission di sini.
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'status' => 'required|in:published,draft,pending_review',
            'categories' => 'required|array',
            'categories.*' => 'exists:categories,id', // Memastikan setiap id kategori ada di DB
            'tags' => 'nullable|array',
            'tags.*' => 'exists:tags,id', // Memastikan setiap id tag ada di DB
        ];
    }
}