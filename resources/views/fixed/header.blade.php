<header class="main-header">
    <!-- Logo -->
    <a href="{{ route('profil.desa') }}" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><i class="fa fa-home"></i> Beranda</span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><i class="fa fa-home"></i> Beranda</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">

        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">

                <!-- Control Sidebar Toggle Button -->
{{--                <li><a href="#">Selamat Datang {{ Auth::user()->induk->penduduk->nama }}</a></li>--}}
                <li><a href="{{ route('regulasi.desa') }}">Regulasi Desa</a></li>
                <li><a href="{{ route('logout') }}"><i class="fa fa-sign-out"></i> Keluar</a></li>
            </ul>
        </div>
    </nav>
</header>