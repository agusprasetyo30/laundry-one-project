<ul class="navbar-nav mr-auto">
    <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
</ul>
<ul class="navbar-nav navbar-right">
    <li class="d-flex align-items-center">
        <div style="
    display: flex;
    align-items: center;
    color: black;
    padding: 0px 10px;
    background: white;
    border-radius: 5px;"> Cabang: <b class="ml-1">Nama Cabang</b>
</div>
{{-- border-radius: 5px;"> Cabang: <b class="ml-1">{{ session('user_login')['CabangName'] }}</b> --}}
    </li>
    <li class="dropdown"><a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
        <img src="{{ asset("assets/img/avatar/avatar-1.png") }}" alt="profile avatar" class="rounded-circle mr-1">
        {{-- <div class="d-sm-none d-lg-inline-block">Hi, {{ strtoupper(session('user_login')['Nama']) }}</div></a> --}}
        <div class="d-sm-none d-lg-inline-block">Hi, Nama User</div></a>
        <div class="dropdown-menu dropdown-menu-right">
            {{-- <div class="dropdown-title">{{ session('user_login')['Jabatan'] ?? 'Position does not exist' }}</div> --}}
            <div class="dropdown-title">Nama Jabatan</div>
            <div class="dropdown-divider"></div>
            <a type="button" class="dropdown-item has-icon text-danger" onclick="logoutconfirmation()">
                <i class="fas fa-sign-out-alt"></i> Logout
            </a>
        </div>
    </li>
</ul>