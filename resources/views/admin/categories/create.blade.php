@extends('admin.layouts.admin')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold font-poppins text-slate-900">Create New Category</h1>
        <a href="{{ route('admin.categories.index') }}" class="text-slate-600 hover:text-sky-600 font-semibold">
            &larr; Kembali ke Daftar Kategori
        </a>
    </div>

    <div class="bg-white rounded-xl shadow-md p-8">
        <form action="{{ route('admin.categories.store') }}" method="POST">
            @csrf
            <div class="space-y-6">
                <div>
                    <label for="name" class="block font-semibold mb-1">Category Name</label>
                    <input type="text" id="name" name="name" value="{{ old('name') }}" class="w-full p-2 border rounded @error('name') border-rose-500 @enderror" required>
                    @error('name')<p class="text-rose-500 text-sm mt-1">{{ $message }}</p>@enderror
                </div>
                <div>
                    <label for="slug" class="block font-semibold mb-1">Slug</label>
                    <input type="text" id="slug" name="slug" value="{{ old('slug') }}" class="w-full p-2 border rounded bg-slate-100" placeholder="Akan dibuat otomatis jika kosong">
                </div>
                 <div>
                    <label for="description" class="block font-semibold mb-1">Description</label>
                    <textarea id="description" name="description" rows="4" class="w-full p-2 border rounded">{{ old('description') }}</textarea>
                </div>
                <div>
                    <label for="parent_id" class="block font-semibold mb-1">Parent Category</label>
                    <select id="parent_id" name="parent_id" class="w-full p-2 border rounded">
                        <option value="">None</option>
                        {{-- Data $parentCategories dikirim dari controller --}}
                        @foreach ($parentCategories as $parent)
                            <option value="{{ $parent->id }}">{{ $parent->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="text-right">
                    <button type="submit" class="bg-sky-500 text-white px-6 py-2 rounded-lg font-semibold hover:bg-sky-600">Save Category</button>
                </div>
            </div>
        </form>
    </div>
@endsection