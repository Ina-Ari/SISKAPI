<aside class="main-sidebar sidebar-light-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
        <img src="{{ asset('image/logo pnb.png') }}" alt="PNB Logo" class="brand-image img-circle elevation-3"
            style="opacity: .8">
        <span class="brand-text" style="font-size: 20px; font-color: #4A505C;">Politeknik Negeri Bali</span>
    </a>

    <div class="sidebar">
        {{-- <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">Admin</a>
            </div>
        </div> --}}
        <nav class="mt-4">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">

                <!-- Dashboard -->
                <li class="nav-item">
                    <a href="{{ route('baak.dashboard') }}"
                       class="nav-link {{ Route::currentRouteName() == 'baak.dashboard' ? 'active' : '' }}"
                       style="{{ Route::currentRouteName() == 'baak.dashboard' ? 'background-color: #E9F5FE; color: #5B91EF;' : '' }}">
                        <i class="nav-icon fas fa-home"></i>
                        <p style="font-size: 18px;">Dashboard</p>
                    </a>
                </li>

                {{-- <li class="nav-item">
                    <a href="" class="nav-link">
                        <i class="nav-icon fas fa-pen-square" ></i>
                        <p style="font-size: 18px; font-color: #4A505C;">
                            Formulir SKPI
                        </p>
                    </a>
                </li> --}}

                <li class="nav-item">
                    <a href="{{ route('baak.skpi.mahasiswa') }}"
                       class="nav-link {{ Route::currentRouteName() == 'baak.skpi.mahasiswa' ? 'active' : '' }}"
                       style="{{ Route::currentRouteName() == 'baak.skpi.mahasiswa' ? 'background-color: #E9F5FE; color: #5B91EF;' : '' }}">
                        <i class="nav-icon fas fa-users"></i>
                        <p style="font-size: 18px;">SKPI  Mahasiswa</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="" class="nav-link">
                        <i class="nav-icon fas fa-comment-dots" ></i>
                        <p style="font-size: 18px; font-color: #4A505C;">
                            Notifikasi
                            <span class="badge badge-info right" style="color: #4A505C">2</span>
                        </p>
                    </a>
                </li>

                {{-- <li class="nav-item {{ Request::is('jenisKegiatan*') || Request::is('tingkatKegiatan*') || Request::is('posisi*') || Request::is('poin*')? 'menu-open' : '' }}">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-chart-pie"></i>
                        <p>
                            Data
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('jenisKegiatan.index') }}" class="nav-link {{ Route::currentRouteName() == 'jenisKegiatan.index' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Jenis Kegiatan</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('tingkatKegiatan.index') }}" class="nav-link {{ Route::currentRouteName() == 'tingkatKegiatan.index' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Tingkat Kegiatan</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('posisi.index') }}" class="nav-link {{ Route::currentRouteName() == 'posisi.index' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Posisi</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('poin.index') }}" class="nav-link {{ Route::currentRouteName() == 'poin.index' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Poin</p>
                            </a>
                        </li>
                    </ul>
                </li> --}}

                {{-- <li class="nav-item {{ Request::is('kegiatan') || Request::is('kegiatan/not-verified*') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fa fa-check-circle"></i>
                        <p>
                            Verifikasi Kegiatan
                            <i class="right fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('kegiatan.index') }}" class="nav-link {{ Route::currentRouteName() == 'kegiatan.index' ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Terverifikasi</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('kegiatan_not_verified') }}" class="nav-link {{ Route::currentRouteName() == 'kegiatan_not_verified' ? 'active' : '' }}">
                                <!-- Link baru untuk kegiatan belum terverifikasi -->
                                <i class="far fa-circle nav-icon"></i>
                                <p>Belum Terverifikasi</p>
                            </a>
                        </li>
                    </ul>
                </li> --}}
                {{-- <li class="nav-item">
                    <a href="{{ route('logout') }}" class="nav-link">
                        <i class="nav-icon fas fa-arrow-alt-circle-left"></i>
                        <p>
                            Logout
                        </p>
                    </a>
                </li> --}}
            </ul>
        </nav>
    </div>
</aside>
