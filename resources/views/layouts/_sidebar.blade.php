<aside id="sidebar-wrapper">
    <div class="sidebar-brand">
        <a href="{{ route('dashboard') }}">
            <img src="{{ asset('assets/img/logo-bcp-reckitt.png') }}" height="32" alt="">
        </a>
    </div>
    <div class="sidebar-brand sidebar-brand-sm">
        <a href="{{ route('dashboard') }}">BR</a>
    </div>
    <ul class="sidebar-menu">

        <li class="menu-header">Dashboard</li>
        <li class="{{ Request::is('/') ? 'active' : '' }}"><a class="nav-link" href="{{ route('dashboard') }}"><i class="fas fa-home"></i> <span>Beranda</span></a></li>

        <li class="menu-header">Feature</li>
        {{-- <li class="dropdown active"> --}}
            <li class="dropdown {{ Request::is('template*') ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-database"></i> <span>Template</span></a>
                <ul class="dropdown-menu">
                    {{-- <li class="{{ Request::is('*master/customer*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('master.customer.index') }}">Customer</a></li>
                    <li class="{{ Request::is('*master/salesman*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('master.salesman.index') }}">Salesman</a></li> --}}
                    <li class="{{ Request::is('*template/datatable*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('template.datatable') }}">Datatables</a></li>
                    {{-- <li class="{{ Request::is('*template/form*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('template.form') }}">Form</a></li> --}}
                </ul>
            </li>
            <li class="dropdown {{ Request::is('transaction*') ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-project-diagram"></i> <span>Template</span></a>
                <ul class="dropdown-menu">
                    {{-- <li class="{{ Request::is('*transaction/invoice*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('transaction.invoice.index') }}">Invoice</a></li>
                    <li class="{{ Request::is('*transaction/credit-note-tolakan*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('transaction.credit-note-tolakan.index') }}">Credit Note Tolakan</a></li>
                    <li class="{{ Request::is('*transaction/credit-note-return*') ? 'active' : '' }}"><a class="nav-link" href="{{ route('transaction.credit-note-return.index') }}">Credit Note Return</a></li> --}}
                </ul>
            </li>
        </li>
    </ul>
</aside>