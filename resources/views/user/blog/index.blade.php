@extends('user.layouts.app')

@section('content')
<div class="pt-24 bg-slate-50">
    <div class="max-w-5xl mx-auto px-6 py-12">
        <div class="text-center mb-12">
            <h1 class="text-4xl md:text-5xl font-bold font-poppins text-slate-900">The Blog</h1>
            <p class="text-lg text-slate-600 mt-2">My thoughts, stories, and ideas from the world of tech and beyond.</p>
        </div>

        {{-- Menampilkan data Artikel Unggulan secara dinamis --}}
        @if ($featuredPost)
        <section class="mb-16">
            <h2 class="text-2xl font-bold font-poppins text-slate-900 mb-6">Featured Post</h2>
            {{-- Karena sudah di dalam @if, kode di bawah ini dijamin aman --}}
            <a href="{{ route('blog.show', $featuredPost) }}" class="block bg-white rounded-xl shadow-lg overflow-hidden transition-all duration-300 card-hover group grid md:grid-cols-2 items-center">
                <img src="{{ asset('storage/' . $featuredPost->cover_image) }}" alt="{{ $featuredPost->title }}" class="w-full h-64 md:h-full object-cover">
                <div class="p-8">
                    <span class="bg-sky-100 text-sky-800 px-3 py-1 rounded-full text-xs font-medium">{{ $featuredPost->categories->first()->name ?? 'Uncategorized' }}</span>
                    <h3 class="text-2xl lg:text-3xl font-semibold text-slate-900 leading-tight mt-4 mb-3 group-hover:text-sky-600 transition-colors">
                        {{ $featuredPost->title }}
                    </h3>
                    <p class="text-slate-600 mb-4">
                        {{ $featuredPost->excerpt ?? Str::limit(strip_tags($featuredPost->content), 150) }}
                    </p>
                    <span class="font-semibold text-sky-600">Read Full Story →</span>
                </div>
            </a>
        </section>
        @endif

        {{-- Menampilkan data Artikel Terbaru dengan looping --}}
        <section>
            <div class="flex flex-col md:flex-row justify-between items-center mb-6">
                <h2 class="text-2xl font-bold font-poppins text-slate-900">Latest Articles</h2>
                <div class="flex space-x-2 mt-4 md:mt-0">
                    <button class="px-4 py-1 text-sm font-medium bg-sky-500 text-white rounded-full">All</button>
                    {{-- Tombol filter lainnya tetap statis untuk saat ini --}}
                </div>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach ($latestPosts as $post)
                    @include('user.components.article-card-blog', [
                        'image' => $post->image,
                        'category' => $post->category,
                        'title' => $post->title,
                        'link' => $post->link,
                        'article' => $post,
                        'categoryColor' => $post->categoryColor
                    ])
                @endforeach
            </div>

            <div class="text-center mt-12">
                <button class="bg-white border border-slate-300 text-slate-700 px-6 py-3 rounded-lg font-semibold hover:bg-slate-100 transition-colors">
                    Load More Articles
                </button>
            </div>
        </section>
    </div>
</div>
@endsection