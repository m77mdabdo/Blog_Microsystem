<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
    <!--begin::Sidebar Brand-->
    <div class="sidebar-brand">
        <!--begin::Brand Link-->
        <a href="./index.html" class="brand-link">
            <!--begin::Brand Image-->

            {{-- <img src="{{ asset('admin/AdminLTE/dist/assets/img/coach-2.jpeg') }}" alt="AdminLTE Logo" class="brand-image opacity-75 shadow"> --}}

            <!--end::Brand Image-->
            <!--begin::Brand Text-->
            <a class="navbar-brand text-white" href="index.html">Blog_<span>Microsystem<i
                        class="fa fa-leaf"></i></span></a>

            <!--end::Brand Text-->
        </a>
        <!--end::Brand Link-->
    </div>
    <!--end::Sidebar Brand-->
    <!--begin::Sidebar Wrapper-->
    <div class="sidebar-wrapper">
        <nav class="mt-2">
            <!--begin::Sidebar Menu-->
            <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu" data-accordion="false">

                {{-- Dashboard --}}
                <li class="nav-item">
                    <a href="{{ route('admin.home') }}" class="nav-link">
                        <i class="nav-icon bi bi-speedometer2"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                {{-- Users Management --}}
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon bi bi-people"></i>
                        <p>
                            Users
                            <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('users.index') }}" class="nav-link">
                                <i class="bi bi-list"></i>
                                <p>All Users</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('users.create') }}" class="nav-link">
                                <i class="bi bi-person-plus"></i>
                                <p>Add User</p>
                            </a>
                        </li>
                    </ul>
                </li>

                {{-- Posts Management --}}
                {{-- <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon bi bi-file-earmark-text"></i>
                        <p>
                            Posts
                            <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('posts.index') }}" class="nav-link">
                                <i class="bi bi-list-task"></i>
                                <p>All Posts</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('posts.create') }}" class="nav-link">
                                <i class="bi bi-plus-square"></i>
                                <p>Add Post</p>
                            </a>
                        </li>
                    </ul>
                </li> --}}

                {{-- Payments --}}
                {{-- <li class="nav-item">
                    <a href="{{ route('payments.index') }}" class="nav-link">
                        <i class="nav-icon bi bi-credit-card"></i>
                        <p>Payments</p>
                    </a>
                </li> --}}

                {{-- Profile --}}
                {{-- <li class="nav-item">
                    <a href="{{ route('profile.edit') }}" class="nav-link">
                        <i class="nav-icon bi bi-person-circle"></i>
                        <p>Profile</p>
                    </a>
                </li> --}}

                {{-- Auth --}}
                {{-- <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon bi bi-shield-lock"></i>
                        <p>
                            Authentication
                            <i class="nav-arrow bi bi-chevron-right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('login') }}" class="nav-link">
                                <i class="bi bi-box-arrow-in-right"></i>
                                <p>Login</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('register') }}" class="nav-link">
                                <i class="bi bi-person-plus"></i>
                                <p>Register</p>
                            </a>
                        </li>
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
                </li> --}}

                {{-- Settings --}}
                {{-- <li class="nav-item">
                    <a href="{{ route('settings') }}" class="nav-link">
                        <i class="nav-icon bi bi-gear"></i>
                        <p>Settings</p>
                    </a>
                </li> --}}

                {{-- Help --}}
                {{-- <li class="nav-item">
                    <a href="{{ route('help') }}" class="nav-link">
                        <i class="nav-icon bi bi-info-circle"></i>
                        <p>Help</p>
                    </a>
                </li> --}}
            </ul>

            <!--end::Sidebar Menu-->
        </nav>
    </div>
    <!--end::Sidebar Wrapper-->
</aside>
