@extends('admin.layouts.admin')

@section('content')
<div class="flex justify-between items-center mb-6">
    <h1 class="text-3xl font-bold font-poppins text-slate-900">Create New Post</h1>
    <a href="{{ route('admin.posts.index') }}" class="text-slate-600 hover:text-sky-600 font-semibold">
        &larr; Back to Posts
    </a>
</div>

<div class="bg-white rounded-xl shadow-md p-8">
    <form action="{{ route('admin.posts.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="grid md:grid-cols-3 gap-8">
            {{-- Kolom Kiri (Konten Utama) --}}
            <div class="md:col-span-2 space-y-6">
                {{-- Judul --}}
                <div>
                    <label for="title" class="block font-semibold mb-1">Title</label>
                    <input type="text" id="title" name="title" value="{{ old('title') }}"
                        class="w-full p-2 border rounded @error('title') border-rose-500 @enderror" required>
                    @error('title')
                    <p class="text-rose-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Konten --}}
                <div>
                    <label for="content" class="block font-semibold mb-1">Content</label>
                    <textarea id="content" name="content" rows="12"
                        class="w-full p-2 border rounded @error('content') border-rose-500 @enderror">{{ old('content') }}</textarea>
                    @error('content')
                    <p class="text-rose-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            {{-- Kolom Kanan (Metadata) --}}
            <div class="space-y-6">
                {{-- Status --}}
                <div>
                    <label for="status" class="block font-semibold mb-1">Status</label>
                    <select id="status" name="status" class="w-full p-2 border rounded">
                        <option value="draft" @if(old('status')=='draft' ) selected @endif>Draft</option>
                        <option value="published" @if(old('status')=='published' ) selected @endif>Published</option>
                    </select>
                </div>

                {{-- Kategori --}}
                <div>
                    <label for="category_id" class="block font-semibold mb-1">Category</label>

                    {{-- Pastikan name="category_id" (bukan array) & TIDAK ada atribut 'multiple' --}}
                    <select id="category_id" name="category_id" class="w-full p-2 border rounded @error('category_id') border-rose-500 @enderror">
                        <option value="">Select a category</option>
                        @foreach ($categories as $category)
                        <option value="{{ $category->id }}" @if(old('category_id')==$category->id) selected @endif>
                            {{ $category->name }}
                        </option>
                        @endforeach
                    </select>

                    @error('category_id')
                    <p class="text-rose-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Tags --}}
                <div>
                    <label for="tags" class="block font-semibold mb-1">Tags</label>
                    <select id="tags" name="tags[]" class="w-full p-2 border rounded" multiple>
                        @foreach ($tags as $tag)
                        {{-- Cek apakah tag ini ada di input lama --}}
                        <option value="{{ $tag->id }}" @if(in_array($tag->id, old('tags', []))) selected @endif>
                            {{ $tag->name }}
                        </option>
                        @endforeach
                    </select>
                </div>

                {{-- Gambar --}}
                <div>
                    <label for="cover_image" class="block font-semibold mb-1">Featured Image</label>
                    <input type="file" id="cover_image" name="cover_image" class="w-full p-2 border rounded">
                    @error('cover_image')
                    <p class="text-rose-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Tombol Simpan --}}
                <div class="pt-4">
                    <button type="submit" class="w-full bg-sky-500 text-white px-6 py-3 rounded-lg font-semibold hover:bg-sky-600">
                        Save Post
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script>
    // Script untuk membuat slug otomatis dari title
    const titleInput = document.getElementById('title');
    const slugInput = document.getElementById('slug'); // Slug input is now hidden

    titleInput.addEventListener('keyup', function() {
        const title = this.value;
        const slug = title.toLowerCase()
            .replace(/[^a-z0-9\s-]/g, '') // Hapus karakter non-alfanumerik
            .trim()
            .replace(/\s+/g, '-'); // Ganti spasi dengan strip

        // You might not have a slug input field visible anymore,
        // but if you do, this will update it.
        // If not, the slug is generated in the controller anyway.
        // This is good for immediate user feedback if the slug field is visible.
    });
</script>
@endpush