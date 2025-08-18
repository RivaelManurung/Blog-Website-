@extends('admin.layouts.admin')

@section('header')
<form action="{{ route('admin.posts.update', $post) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <div class="page-pretitle">Posts</div>
                    <h2 class="page-title">Edit Post</h2>
                </div>
                <div class="col-auto ms-auto d-print-none">
                    <div class="btn-list">
                        <a href="{{ route('admin.posts.index') }}" class="btn btn-white">Cancel</a>
                        <button type="submit" class="btn btn-primary">
                           <i class="ti ti-device-floppy icon"></i> Update Post
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('content')
    <div class="row">
        {{-- Kolom Kiri --}}
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label required">Title</label>
                        <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title', $post->title) }}">
                        @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    <div>
                        <label class="form-label">Content</label>
                        <textarea id="tinymce-editor" name="content">{{ old('content', $post->content) }}</textarea>
                    </div>
                </div>
            </div>
        </div>

        {{-- Kolom Kanan --}}
        <div class="col-md-4">
            <div class="row g-3">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header"><h3 class="card-title">Publishing</h3></div>
                        <div class="card-body">
                            <select name="status" class="form-select">
                                <option value="draft" @if(old('status', $post->status) == 'draft') selected @endif>Draft</option>
                                <option value="published" @if(old('status', $post->status) == 'published') selected @endif>Published</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="card">
                        <div class="card-header"><h3 class="card-title">Organization</h3></div>
                        <div class="card-body">
                             @php
                                $selectedCategories = old('categories', $post->categories->pluck('id')->toArray());
                                $selectedTags = old('tags', $post->tags->pluck('id')->toArray());
                            @endphp
                            <div class="mb-3">
                                <label class="form-label">Categories</label>
                                <select id="select-categories" name="categories[]" class="form-select" multiple>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}" @if(in_array($category->id, $selectedCategories)) selected @endif>{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label class="form-label">Tags</label>
                                <select id="select-tags" name="tags[]" class="form-select" multiple>
                                    @foreach ($tags as $tag)
                                        <option value="{{ $tag->id }}" @if(in_array($tag->id, $selectedTags)) selected @endif>{{ $tag->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                 <div class="col-12">
                     <div class="card">
                        <div class="card-header"><h3 class="card-title">Featured Image</h3></div>
                        <div class="card-body">
                             <input type="file" name="cover_image" class="form-control mb-2">
                             @if ($post->cover_image)
                                <img src="{{ asset('storage/' . $post->cover_image) }}" alt="Current Image" class="img-fluid rounded">
                             @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection

@push('scripts')
{{-- Script sama seperti create.blade.php --}}
<script>
document.addEventListener("DOMContentLoaded", function () {
    new TomSelect('#select-tags',{ create: true, persist: false });
    new TomSelect('#select-categories',{ create: false, persist: false });
    
    tinymce.init({
        selector: '#tinymce-editor',
        plugins: 'preview importcss searchreplace autolink autosave save directionality code visualblocks visualchars fullscreen image link media codesample table charmap pagebreak nonbreaking anchor insertdatetime advlist lists wordcount help charmap quickbars emoticons',
        menubar: 'file edit view insert format tools table help',
        toolbar: 'undo redo | bold italic underline strikethrough | fontfamily fontsize blocks | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist | forecolor backcolor removeformat | pagebreak | charmap emoticons | fullscreen  preview save print | insertfile image media link anchor codesample | ltr rtl',
        height: 400,
    });
});
</script>
@endpush