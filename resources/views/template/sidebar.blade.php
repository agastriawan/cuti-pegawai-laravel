<div class="app-sidebar-menu">
    <div class="h-100" data-simplebar>

        <div id="sidebar-menu">
            <div class="logo-box">
                <a href="{{ url('/') }}" class="logo logo-light">
                    <span class="logo-sm">
                        <img src="{{ asset('assets/images/logo-2.png') }}" alt="" height="48">
                    </span>
                    <span class="logo-lg">
                        <img src="{{ asset('assets/images/logo-2.png') }}" alt="" height="50">
                    </span>
                </a>
                <a href="{{ url('/') }}" class="logo logo-dark">
                    <span class="logo-sm">
                        <img src="{{ asset('assets/images/logo-2.png') }}" alt="" height="48">
                    </span>
                    <span class="logo-lg">
                        <img src="{{ asset('assets/images/logo-2.png') }}" alt="" height="50">
                    </span>
                </a>
            </div>

            <ul id="side-menu">
                <li class="menu-title"></li>

                 <li>
                    <a href="{{ url('/profile') }}" class="tp-link">
                        <i data-feather="user"></i>
                        <span> Profile </span>
                    </a>
                </li>

                <li>
                    <a href="{{ url('/admin') }}" class="tp-link">
                        <i data-feather="users"></i>
                        <span> Kelola Admin </span>
                    </a>
                </li>

                <li>
                    <a href="{{ url('/employee') }}" class="tp-link">
                        <i data-feather="table"></i>
                        <span> Kelola Pegawai </span>
                    </a>
                </li>

                <li>
                    <a href="{{ url('/leave') }}" class="tp-link">
                        <i data-feather="package"></i>
                        <span> Kelola Cuti </span>
                    </a>
                </li>

                <li>
                    <a href="{{ url('/leave/rekap_cuti') }}" class="tp-link">
                        <i data-feather="user"></i>
                        <span> Rekap Cuti Pegawai </span>
                    </a>
                </li>

                
            </ul>

        </div>
        <div class="clearfix"></div>
    </div>
</div>
