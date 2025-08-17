@extends('user.layouts.app')

@section('content')
<div class="pt-24 bg-white">
    <div class="max-w-4xl mx-auto px-6 py-12">
        <article>
            <header class="mb-8 text-center">
                <div class="mb-4">
                    <a href="{{ route('blog.index') }}" class="text-sky-600 font-semibold text-sm">&larr; Back to all articles</a>
                </div>
                <span class="bg-sky-100 text-sky-800 px-3 py-1 rounded-full text-sm font-medium">{{ $post->category }}</span>
                <h1 class="text-4xl md:text-5xl font-bold font-poppins text-slate-900 leading-tight mt-4 mb-5">
                    {{ $post->title }}
                </h1>
                <div class="flex justify-center items-center space-x-3 text-slate-500">
                    <img src="{{ $post->author_image }}" alt="Author" class="w-10 h-10 rounded-full">
                    <span class="font-medium">{{ $post->author_name }}</span>
                    <span>•</span>
                    <time datetime="2025-08-16">{{ $post->published_date }}</time>
                    <span>•</span>
                    <span>{{ $post->read_time }}</span>
                </div>
            </header>

            <figure class="mb-12">
                <img src="{{ $post->featured_image }}" alt="{{ $post->title }}" class="w-full rounded-2xl shadow-lg">
            </figure>

            {{-- Menggunakan {!! !!} untuk merender HTML dari controller dengan aman --}}
            <div class="prose prose-lg lg:prose-xl max-w-none prose-slate">
                {!! $post->content !!}
            </div>
        </article>

        <div class="border-t border-b border-slate-200 my-12 py-6">
            <div class="flex flex-col md:flex-row justify-between items-center">
                <div class="flex items-center space-x-3 mb-4 md:mb-0">
                    <span class="font-semibold">Share this post:</span>
                    <a href="#" class="text-slate-500 hover:text-sky-500"><i class="fab fa-twitter fa-lg"></i></a>
                    <a href="#" class="text-slate-500 hover:text-sky-500"><i class="fab fa-facebook fa-lg"></i></a>
                    <a href="#" class="text-slate-500 hover:text-sky-500"><i class="fab fa-linkedin fa-lg"></i></a>
                </div>
                @include('user.components.author-bio')
            </div>
        </div>

        <section id="comments">
            <h2 class="text-2xl font-bold font-poppins text-slate-900 mb-6">Comments ({{ count($post->comments) }})</h2>
            <div class="bg-slate-50 rounded-xl p-6 mb-8">
                {{-- Form komentar tetap statis untuk saat ini --}}
            </div>

            <div class="space-y-6">
                @foreach ($post->comments as $comment)
                <div class="flex space-x-4">
                    <img src="{{ $comment->avatar }}" alt="{{ $comment->name }}" class="w-12 h-12 rounded-full">
                    <div>
                        <div class="flex items-center space-x-3">
                            <h4 class="font-semibold">{{ $comment->name }}</h4>
                            <span class="text-sm text-slate-500">{{ $comment->time }}</span>
                        </div>
                        <p class="text-slate-700 mt-1">{{ $comment->body }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </section>
    </div>
</div>
@endsection