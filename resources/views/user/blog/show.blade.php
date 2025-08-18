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

        {{-- ... bagian share post bisa dibiarkan ... --}}

        <section id="comments" class="mt-12 pt-8 border-t">
            {{-- DIUBAH: Menggunakan method count() dari collection --}}
            <h2 class="text-2xl font-bold font-poppins text-slate-900 mb-6">Comments ({{ $post->comments->count() }})</h2>
            
            <div class="bg-slate-50 rounded-xl p-6 mb-8">
                {{-- Form untuk menambahkan komentar baru (bisa dikembangkan nanti) --}}
                <form action="#" method="POST">
                    <textarea class="w-full p-3 border rounded-md" rows="3" placeholder="Write a comment..."></textarea>
                    <button type="submit" class="mt-3 bg-sky-500 text-white px-4 py-2 rounded-md font-semibold hover:bg-sky-600">Post Comment</button>
                </form>
            </div>

            <div class="space-y-6">
                {{-- DIUBAH: Menggunakan @forelse dan data dari relasi comment --}}
                @forelse ($post->comments as $comment)
                <div class="flex space-x-4">
                    <img src="{{ $comment->author->avatar ?? 'https://ui-avatars.com/api/?name=' . urlencode($comment->author->name) }}" alt="{{ $comment->author->name }}" class="w-12 h-12 rounded-full">
                    <div>
                        <div class="flex items-center space-x-3">
                            <h4 class="font-semibold">{{ $comment->author->name }}</h4>
                            <span class="text-sm text-slate-500">{{ $comment->created_at->diffForHumans() }}</span>
                        </div>
                        <p class="text-slate-700 mt-1">{{ $comment->content }}</p>
                    </div>
                </div>
                @empty
                <p class="text-slate-500">Be the first to comment on this post.</p>
                @endforelse
            </div>
        </section>
    </div>
</div>
@endsection