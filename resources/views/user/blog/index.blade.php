@extends('user.layouts.app')

@section('content')
<div class="pt-24 bg-slate-50">
    <div class="max-w-5xl mx-auto px-6 py-12">
        <div class="text-center mb-12">
            <h1 class="text-4xl md:text-5xl font-bold font-poppins text-slate-900">The Blog</h1>
            <p class="text-lg text-slate-600 mt-2">My thoughts, stories, and ideas from the world of tech and beyond.</p>
        </div>

        {{-- Bagian Featured Post tidak berubah --}}
        @if ($featuredPost)
        <section class="mb-16">
            <h2 class="text-2xl font-bold font-poppins text-slate-900 mb-6">Featured Post</h2>
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

        <section>
            <div class="flex flex-col md:flex-row justify-between items-center mb-6">
                <h2 class="text-2xl font-bold font-poppins text-slate-900">Latest Articles</h2>
                
                {{-- DIHAPUS: Bagian tombol filter statis dihilangkan untuk tampilan yang lebih bersih --}}
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                {{-- DIUBAH: Menggunakan @forelse untuk penanganan kasus kosong dan perbaikan @include --}}
                @forelse ($latestPosts as $post)
                    @include('user.components.article-card-blog', ['article' => $post])
                @empty
                    <p class="col-span-3 text-center text-slate-500">No articles available at the moment.</p>
                @endforelse
            </div>

            {{-- DIUBAH: Mengganti tombol statis dengan link paginasi dinamis Laravel --}}
            <div class="mt-12">
                {{ $latestPosts->links() }}
            </div>
        </section>
    </div>
</div>
@endsection