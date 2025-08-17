<nav class="fixed top-0 left-0 right-0 z-50 backdrop-filter backdrop-blur-lg bg-white/80 border-b border-slate-200/80">
    <div class="max-w-5xl mx-auto px-6">
        <div class="flex justify-between items-center h-16">
            <a href="{{ route('home') }}" class="text-xl font-bold font-poppins text-slate-900">Personal Blog</a>
            <div class="hidden md:flex items-baseline space-x-8">
                <a href="{{ route('home') }}" class="text-slate-700 hover:text-sky-500 text-sm font-medium transition-colors">Home</a>
                <a href="{{ route('blog.index') }}" class="text-slate-700 hover:text-sky-500 text-sm font-medium transition-colors">Blog</a>
            </div>
        </div>
    </div>
</nav>