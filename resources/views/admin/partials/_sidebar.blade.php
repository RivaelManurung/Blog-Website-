<aside class="navbar navbar-vertical navbar-expand-lg">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#sidebar-menu" aria-controls="sidebar-menu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <h1 class="navbar-brand navbar-brand-autodark">
            <a href="{{ route('admin.dashboard') }}">
                AdminPanel
            </a>
        </h1>
        
        <div class="collapse navbar-collapse" id="sidebar-menu">
            <ul class="navbar-nav pt-lg-3">
                <li class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('admin.dashboard') }}">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <i class="ti ti-dashboard icon"></i>
                        </span>
                        <span class="nav-link-title">Dashboard</span>
                    </a>
                </li>
                <li class="nav-item {{ request()->routeIs('admin.posts.*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('admin.posts.index') }}">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                           <i class="ti ti-news icon"></i>
                        </span>
                        <span class="nav-link-title">Posts</span>
                    </a>
                </li>
                <li class="nav-item {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('admin.categories.index') }}">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                           <i class="ti ti-category-2 icon"></i>
                        </span>
                        <span class="nav-link-title">Categories</span>
                    </a>
                </li>
                <li class="nav-item {{ request()->routeIs('admin.tags.*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('admin.tags.index') }}">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                           <i class="ti ti-tags icon"></i>
                        </span>
                        <span class="nav-link-title">Tags</span>
                    </a>
                </li>

                 <li class="nav-item mt-auto">
                    <a class="nav-link" href="{{ route('logout') }}"
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <span class="nav-link-icon d-md-none d-lg-inline-block">
                            <i class="ti ti-logout icon"></i>
                        </span>
                        <span class="nav-link-title">Logout</span>
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </li>
            </ul>
        </div>
    </div>
</aside>