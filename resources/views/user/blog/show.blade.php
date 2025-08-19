@extends('user.layouts.app')

@section('content')
<div class="pt-24 bg-white">
    <div class="max-w-4xl mx-auto px-6 py-12">
        <article>
            <header class="mb-8 text-center">
                <div class="mb-4">
                    <a href="{{ route('blog.index') }}" class="text-sky-600 font-semibold text-sm">&larr; Back to all articles</a>
                </div>
                
                {{-- DIUBAH: Mengambil kategori pertama dari relasi --}}
                <span class="bg-sky-100 text-sky-800 px-3 py-1 rounded-full text-sm font-medium">{{ $post->categories->first()->name ?? 'Uncategorized' }}</span>
                
                <h1 class="text-4xl md:text-5xl font-bold font-poppins text-slate-900 leading-tight mt-4 mb-5">
                    {{ $post->title }}
                </h1>
                
                <div class="flex justify-center items-center space-x-3 text-slate-500">
                    {{-- DIUBAH: Mengambil data dari relasi author --}}
                    <img src="{{ $post->author->avatar ?? 'https://ui-avatars.com/api/?name=' . urlencode($post->author->name) }}" alt="{{ $post->author->name }}" class="w-10 h-10 rounded-full">
                    <span class="font-medium">{{ $post->author->name }}</span>
                    <span>•</span>
                    {{-- DIUBAH: Menggunakan data 'published_at' dan memformatnya --}}
                    <time datetime="{{ $post->published_at->toDateString() }}">{{ $post->published_at->format('F d, Y') }}</time>
                    <span>•</span>
                    <span>{{ $readTime }}</span>
                </div>
            </header>

            <figure class="mb-12">
                {{-- DIUBAH: Menggunakan kolom 'cover_image' dengan helper asset() --}}
                <img src="{{ asset('storage/' . $post->cover_image) }}" alt="{{ $post->title }}" class="w-full rounded-2xl shadow-lg">
            </figure>

            <div class="prose prose-lg lg:prose-xl max-w-none prose-slate">
                {!! $post->content !!}
            </div>
        </article>

<div class="border-t border-b border-slate-200 my-12 py-6">
    <div class="flex flex-col md:flex-row justify-between items-center">
        <div class="flex items-center space-x-3 mb-4 md:mb-0">
            <span class="font-semibold">Share this post:</span>
            
            {{-- DIUBAH: Link share dinamis untuk setiap platform --}}
            
            <a href="https://twitter.com/intent/tweet?url={{ urlencode(route('blog.show', $post)) }}&text={{ urlencode($post->title) }}" 
               target="_blank" rel="noopener noreferrer" 
               class="text-slate-500 hover:text-sky-500" title="Share on Twitter">
               <i class="fab fa-twitter fa-lg"></i>
            </a>

            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(route('blog.show', $post)) }}" 
               target="_blank" rel="noopener noreferrer" 
               class="text-slate-500 hover:text-sky-500" title="Share on Facebook">
               <i class="fab fa-facebook fa-lg"></i>
            </a>

            <a href="https://www.linkedin.com/shareArticle?mini=true&url={{ urlencode(route('blog.show', $post)) }}&title={{ urlencode($post->title) }}&summary={{ urlencode($post->excerpt ?? Str::limit(strip_tags($post->content), 100)) }}"
               target="_blank" rel="noopener noreferrer" 
               class="text-slate-500 hover:text-sky-500" title="Share on LinkedIn">
               <i class="fab fa-linkedin fa-lg"></i>
            </a>

        </div>
        @include('user.components.author-bio')
    </div>
</div>    </div>
</div>
@endsection