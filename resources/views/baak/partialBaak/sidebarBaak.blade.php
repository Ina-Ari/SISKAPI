<aside class="main-sidebar sidebar-light-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
        <img src="{{ asset('image/logo pnb.png') }}" alt="PNB Logo" class="brand-image img-circle elevation-3"
            style="opacity: .8">
        <span class="brand-text" style="font-size: 20px; font-color: #4A505C;">Politeknik Negeri Bali</span>
    </a>

    <div class="sidebar">
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
                <li class="nav-item">
                    <a href="{{ route('baak.skpi.mahasiswa') }}"
                       class="nav-link {{ Route::currentRouteName() == 'baak.skpi.mahasiswa' ? 'active' : '' }}"
                       style="{{ Route::currentRouteName() == 'baak.skpi.mahasiswa' ? 'background-color: #E9F5FE; color: #5B91EF;' : '' }}">
                        <i class="nav-icon fas fa-users"></i>
                        <p style="font-size: 18px;">SKPI  Mahasiswa</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('baak.notifikasi') }}" class="nav-link">
                        <i class="nav-icon fas fa-comment-dots"></i>
                        <p style="font-size: 18px;">
                            Notifikasi
                            @if ($jumlahNotif > 0)
                                <span class="badge badge-info right" style="color: #4A505C">{{ $jumlahNotif }}</span>
                            @endif
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>
