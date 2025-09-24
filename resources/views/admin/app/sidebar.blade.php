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


                {{-- Posts Management --}}
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

            <!--end::Sidebar Menu-->
        </nav>
    </div>
    <!--end::Sidebar Wrapper-->
</aside>
