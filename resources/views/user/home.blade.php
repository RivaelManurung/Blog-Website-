@extends('user.layouts.app')

@section('content')
    {{-- Bagian Hero tetap menjadi elemen utama Beranda --}}
    @include('user.partials.hero')

    {{-- Bagian Blog di Beranda kini menjadi "cuplikan" --}}
    <div class="bg-slate-50 py-20">
        <div class="max-w-5xl mx-auto px-6">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-4xl font-bold font-poppins text-slate-900">Recent Posts</h2>
                <p class="text-lg text-slate-600 mt-2">Check out the latest articles from our blog.</p>
            </div>

            {{-- DIHAPUS: Bagian Featured Post dihilangkan dari Beranda agar lebih ringkas --}}

            {{-- Menampilkan 3 Artikel Terbaru --}}
            <section>
                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @forelse ($latestPosts as $post)
                        {{-- Komponen card tetap bisa digunakan --}}
                        @include('user.components.article-card-blog', ['article' => $post])
                    @empty
                        <p class="col-span-3 text-center text-slate-500">No articles available at the moment.</p>
                    @endforelse
                </div>

                {{-- PENTING: Paginasi diganti dengan tombol "Call to Action" ke halaman blog utama --}}
                <div class="text-center mt-16">
                    <a href="{{ route('blog.index') }}" class="bg-sky-500 text-white px-8 py-3 rounded-lg font-semibold hover:bg-sky-600 transition-colors text-lg">
                        View All Articles
                    </a>
                </div>
            </section>
        </div>
    </div>
    
    {{-- Bagian "About" atau section lainnya tetap di sini --}}
    @include('user.partials.about')
@endsection