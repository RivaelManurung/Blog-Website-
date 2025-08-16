@extends('user.layouts.app')
@section('content')
    @include('user.partials.hero')
    <section id="articles" class="py-20 bg-slate-50">
        <div class="max-w-5xl mx-auto px-6">
            <h2 class="text-3xl font-bold font-poppins text-slate-900 text-center mb-12">Latest Articles</h2>
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach ($articles as $article)
                    @include('user.components.article-card', ['article' => $article])
                @endforeach
            </div>
        </div>
    </section>
    @include('user.partials.about')
@endsection