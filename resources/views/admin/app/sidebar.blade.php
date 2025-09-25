<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
    <!-- Sidebar Brand -->
    <div class="sidebar-brand">
        <a href="./index.html" class="brand-link">
            <a class="navbar-brand text-white" href="index.html">Blog_<span>Microsystem<i class="fa fa-leaf"></i></span></a>
        </a>
    </div>

    <!-- Sidebar Wrapper -->
    <div class="sidebar-wrapper">
        <nav class="mt-2">
            <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu" data-accordion="false">

                {{-- Dashboard: admins only --}}
                @if(auth()->user()->role === 'admin')
                    <li class="nav-item">
                        <a href="{{ route('admin.home') }}" class="nav-link">
                            <i class="nav-icon bi bi-speedometer2"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>

                    {{-- Admins Management --}}
                    <li class="nav-item">
                        <a href="{{ route('admins.index') }}" class="nav-link">
                            <i class="nav-icon bi bi-person-gear"></i>
                            <p>Admins</p>
                        </a>
                    </li>

                    {{-- Editors Management --}}
                    <li class="nav-item">
                        <a href="{{ route('editors.index') }}" class="nav-link">
                            <i class="nav-icon bi bi-people"></i>
                            <p>Editors</p>
                        </a>
                    </li>
                @endif

                {{-- Posts Management: visible to both admin and editor --}}
                <li class="nav-item">
                    <a href="{{ route('posts.index') }}" class="nav-link">
                        <i class="nav-icon bi bi-file-earmark-text"></i>
                        <p>Posts</p>
                    </a>
                </li>

                {{-- Profile --}}
                <li class="nav-item">
                    <a href="{{ route('profile.edit') }}" class="nav-link">
                        <i class="nav-icon bi bi-person-circle"></i>
                        <p>Profile</p>
                    </a>
                </li>

                 <li class="nav-item menu-items">
            <a class="nav-link" data-bs-toggle="collapse" href="#language" aria-expanded="false"
                aria-controls="language">
                <span class="menu-icon">
                    <i class="mdi mdi-translate"></i>
                </span>
                <span class="menu-title">{{ __('massages.language') }}</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="language">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('change/en') }}">@lang('massages.english') </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('change/ar') }}"> @lang('massages.arabic') </a>
                    </li>
                </ul>
            </div>
        </li>
                {{-- Logout --}}
                <li class="nav-item">
                    <form action="{{ route('logout') }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="nav-link btn btn-link p-0 text-start">
                            <i class="bi bi-box-arrow-right"></i>
                            <p>Logout</p>
                        </button>
                    </form>
                </li>

            </ul>
        </nav>
    </div>
</aside>
