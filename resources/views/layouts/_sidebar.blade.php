<aside id="sidebar-wrapper">
    <div class="sidebar-brand">
        <a href="{{ route('index') }}">
            <img src="{{ asset('img/logo-one-grosir.webp') }}" alt="" height="70px">
        </a>
    </div>
    <div class="sidebar-brand sidebar-brand-sm">
        <a href="{{ route('index') }}">ONE</a>
    </div>
    <ul class="sidebar-menu">

        <li class="menu-header">Dashboard</li>
        <li class="{{ Request::is('/') ? 'active' : '' }}"><a class="nav-link" href="{{ route('index') }}"><i class="fas fa-home"></i> <span>Beranda</span></a></li>

        <li class="menu-header">Pengguna</li>
        <li class="{{ Request::is('*pengguna*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('admin.user.index') }}"><i class="fas fa-user"></i> <span>Pengguna</span></a></li>

        <li class="menu-header">Feature</li>
        {{-- <li class="dropdown active"> --}}
            <li class="{{ Request::is('*template/datatable*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('template.datatable') }}"><i class="fas fa-database"></i> <span>Item Promo</span></a></li>
            <li class="{{ Request::is('*template/datatable*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('template.datatable') }}"><i class="fas fa-database"></i> <span>Blog & Artikel</span></a></li>
            
            {{-- <li class="dropdown {{ Request::is('template*') ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-database"></i> <span>Manajemen Content</span></a>
                <ul class="dropdown-menu">
                </ul>
            </li> --}}
        </li>
    </ul>
</aside>