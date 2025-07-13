<aside class="main-sidebar sidebar-light-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <img src="{{ asset('image/logo pnb.png') }}" alt="PNB Logo" class="brand-image img-circle elevation-3"
            style="opacity: .8">
        <span class="brand-text font-weight-light">Politeknik Negeri Bali</span>
    </a>

    <div class="sidebar">
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{  Auth::user()->picture ? '../storage/'. Auth::user()->picture : asset('../storage/fotoprofil/user.jpeg') }}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block"> {{ Auth::user()->nama }}</a>
            </div>
        </div>
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <li class="nav-item">
                    <a href="{{ route('upapkk.dashboard') }}" class="nav-link {{ Route::currentRouteName() == 'upapkk.dashboard' ? 'active' : '' }}" style="{{ Route::currentRouteName() == 'upapkk.dashboard' ? 'background-color: #E9F5FE; color: #5B91EF;' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('upapkk.daftarMhs') }}" class="nav-link {{ Request::is('upapkk/daftarMahasiswa') || Request::is('upapkk/*/daftarKegiatan') ? 'active' : '' }}" style="{{ Route::currentRouteName() == 'upapkk.daftarMhs' || Route::currentRouteName() == 'upapkk.daftarKegiatan'? 'background-color: #E9F5FE; color: #5B91EF;' : '' }}">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            Mahasiswa
                        </p>
                    </a>
                </li>

                <li class="nav-item {{ Request::is('upapkk/jenisKegiatan*') || Request::is('upapkk/tingkatKegiatan*') || Request::is('upapkk/posisi*') || Request::is('upapkk/poin*')? 'menu-open' : '' }}">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-chart-pie"></i>
                        <p>
                            Data
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('upapkk.jenisKegiatan') }}" class="nav-link {{ Route::currentRouteName() == 'upapkk.jenisKegiatan' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Jenis Kegiatan</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('upapkk.tingkatKegiatan') }}" class="nav-link {{ Route::currentRouteName() == 'upapkk.tingkatKegiatan' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Tingkat Kegiatan</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('upapkk.posisi') }}" class="nav-link {{ Route::currentRouteName() == 'upapkk.posisi' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Posisi</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('upapkk.poin') }}" class="nav-link {{ Route::currentRouteName() == 'upapkk.poin' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Poin</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item {{ Request::is('upapkk/verifKegiatan') || Request::is('upapkk/unverifKegiatan') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fa fa-check-circle"></i>
                        <p>
                            Verifikasi Kegiatan
                            <i class="right fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('upapkk.verifKegiatan') }}" class="nav-link {{ Route::currentRouteName() == 'upapkk.verifKegiatan' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Terverifikasi</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('upapkk.unverifKegiatan') }}" class="nav-link {{ Route::currentRouteName() == 'upapkk.unverifKegiatan' ? 'active' : '' }}">
                                <!-- Link baru untuk kegiatan belum terverifikasi -->
                                <i class="far fa-circle nav-icon"></i>
                                <p>Belum Terverifikasi</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="{{ route('logout') }}" class="nav-link">
                        <i class="nav-icon fas fa-arrow-alt-circle-left"></i>
                        <p>
                            Logout
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>
