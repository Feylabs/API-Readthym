<div id="sidebar" class="active">
    <div class="sidebar-wrapper active">
        <div class="sidebar-header">
            <div class="d-flex justify-content-between">
                <div class="logo d-flex">
                    <h1 class="mr-3">Bestari Setia Abadi</h1>
                    <a href="{{ url('/') }}"><img src="{{ asset('frontend/assets/images/logo/logo.png') }}"
                            alt="Logo" srcset="" style="height: 70px !important;"></a>
                </div>
                <div class="toggler">
                    <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                </div>
            </div>
        </div>
        <div class="sidebar-menu">
            <ul class="menu">
                <li class="sidebar-title">Menu</li>

                <li class="sidebar-item
                {{ Request::is('admin') ? 'active' : '' }}
                {{ Request::is('staff') ? 'active' : '' }}
                {{ Request::is('user') ? 'active' : '' }}
                ">
                    <a href="{{ url('/home') }}" class='sidebar-link'>
                        <i class="bi bi-grid-fill"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                <li class="sidebar-item  has-sub {{ Request::is('admin/user/*') ? 'active' : '' }}">
                    <a href="#" class='sidebar-link'>
                        <i class="bi bi-stack"></i>
                        <span>Manajemen User</span>
                    </a>
                    <ul class="submenu  {{ Request::is('admin/user/*') ? 'active' : '' }} ">
                        <li class="submenu-item  {{ Request::is('/admin/user/create') ? 'active' : '' }}">
                            <a href="{{ url('/admin/user/create') }}">Tambah User</a>
                        </li>
                        <li class="submenu-item  {{ Request::is('/admin/user/manage') ? 'active' : '' }}">
                            <a href="{{ url('/admin/user/manage') }}">Manage</a>
                        </li>
                    </ul>
                </li>

                <li class="sidebar-item  has-sub  {{ Request::is('material/*') ? 'active' : '' }}">
                    <a href="#" class='sidebar-link'>
                        <i class="bi bi-stack"></i>
                        <span>Author</span>
                    </a>
                    <ul class="submenu  {{ Request::is('author/*') ? 'active' : '' }} ">
                        <li class="submenu-item   {{ Request::is('author/create') ? 'active' : '' }}">
                            <a href="{{ url('/author/create') }}">Input Author</a>
                        </li>
                        <li class="submenu-item  {{ Request::is('author/manage') ? 'active' : '' }}">
                            <a href="{{ url('/author/manage') }}">Manage Author</a>
                        </li>
                    </ul>
                </li>





                <li class="sidebar-title">Logout</li>
                <li class="sidebar-item  ">

                    <a href="{{ url('/logout') }}" class="sidebar-link">
                        <i class="bi bi-life-preserver"></i>
                        <span>Logout</span>
                    </a>
                </li>


            </ul>
        </div>
        <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
    </div>
</div>
