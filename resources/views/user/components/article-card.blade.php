{{-- HAPUS baris @props dari file ini jika ada --}}

<article class="bg-white rounded-xl shadow-md overflow-hidden transition-all duration-300 card-hover group">
    {{-- Gunakan variabel $article yang dikirim dari @include --}}
    <a href="{{ $article['link'] ?? '#' }}">
        {{-- Ubah $image menjadi $article['image'] --}}
        <img src="{{ $article['image'] }}" alt="{{ $article['title'] }}" class="w-full h-48 object-cover">
        <div class="p-6">
            {{-- Ubah $category menjadi $article['category'] --}}
            <span class="text-xs font-medium px-3 py-1 rounded-full {{ $article['categoryColor'] ?? 'bg-sky-100 text-sky-800' }}">
                {{ $article['category'] }}
            </span>
            {{-- Ubah $title menjadi $article['title'] --}}
            <h3 class="text-lg font-semibold text-slate-900 leading-tight mt-4 group-hover:text-sky-600 transition-colors">
                {{ $article['title'] }}
            </h3>
        </div>
    </a>
</article>