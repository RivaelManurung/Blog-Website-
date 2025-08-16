<aside class="w-64 bg-white shadow-md flex-shrink-0">
    <div class="p-6">
        <a href="{{ route('admin.dashboard') }}" class="text-2xl font-bold font-poppins text-slate-900">AdminPanel</a>
    </div>
    <nav class="mt-6">
        {{-- Gunakan request()->routeIs() untuk menandai link aktif --}}
        <a href="{{ route('admin.dashboard') }}" class="flex items-center px-6 py-3 text-slate-700 hover:bg-sky-50 hover:text-sky-600 transition-colors {{ request()->routeIs('admin.dashboard') ? 'bg-sky-50 text-sky-600 font-semibold' : '' }}">
            <i class="fas fa-tachometer-alt w-6"></i>
            <span class="ml-3">Dashboard</span>
        </a>
        <a href="{{ route('admin.posts.index') }}" class="flex items-center px-6 py-3 text-slate-700 hover:bg-sky-50 hover:text-sky-600 transition-colors {{ request()->routeIs('admin.posts.*') ? 'bg-sky-50 text-sky-600 font-semibold' : '' }}">
            <i class="fas fa-newspaper w-6"></i>
            <span class="ml-3">Posts</span>
        </a>
        <a href="{{ route('admin.categories.index') }}" class="flex items-center px-6 py-3 text-slate-700 hover:bg-sky-50 hover:text-sky-600 transition-colors {{ request()->routeIs('admin.categories.*') ? 'bg-sky-50 text-sky-600 font-semibold' : '' }}">
            <i class="fas fa-tags w-6"></i>
            <span class="ml-3">Categories</span>
        </a>
        <a href="{{ route('admin.tags.index') }}" class="flex items-center px-6 py-3 text-slate-700 hover:bg-sky-50 hover:text-sky-600 transition-colors {{ request()->routeIs('admin.tags.*') ? 'bg-sky-50 text-sky-600 font-semibold' : '' }}">
            <i class="fas fa-hashtag w-6"></i>
            <span class="ml-3">Tags</span>
        </a>
        
        {{-- Link untuk Logout --}}
        <div class="absolute bottom-0 w-64">
             <a href="{{ route('logout') }}"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                class="flex items-center px-6 py-4 text-slate-700 hover:bg-rose-50 hover:text-rose-600 transition-colors">
                <i class="fas fa-sign-out-alt w-6"></i>
                <span class="ml-3">Logout</span>
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                @csrf
            </form>
        </div>
    </nav>
</aside>