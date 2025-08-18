<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // Izinkan semua user yang sudah login untuk membuat post
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255|unique:posts,title',
            'content' => 'required|string',
            'status' => 'required|in:published,draft',
            'categories' => 'required|array', // DIUBAH: Wajib ada dan harus berupa array
            'categories.*' => 'exists:categories,id', // Validasi setiap item di dalam array
            'tags' => 'nullable|array',
            'tags.*' => 'exists:tags,id',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ];
    }
}
