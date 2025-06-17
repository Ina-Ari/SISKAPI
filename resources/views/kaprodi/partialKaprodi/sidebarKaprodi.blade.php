<aside class="main-sidebar sidebar-light-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link">
        <img src="{{ asset('image/logo pnb.png') }}" alt="PNB Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text" style="font-size: 20px; color: #4A505C;">Politeknik Negeri Bali</span>
    </a>

    <div class="sidebar">
        <nav class="mt-4">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                <!-- Dashboard -->
                <li class="nav-item">
                    <a href="{{ route('KaprodiController.index') }}"
                       class="nav-link {{ Route::currentRouteName() == 'KaprodiController.index' ? 'active' : '' }}"
                       style="{{ Route::currentRouteName() == 'KaprodiController.index' ? 'background-color: #E9F5FE; color: #5B91EF;' : '' }}">
                        <i class="nav-icon fas fa-home"></i>
                        <p style="font-size: 18px;">Dashboard</p>
                    </a>
                </li>

                <!-- Formulir SKPI -->
                <li class="nav-item">
                    <a href="{{ route('formKaprodi') }}"
                       class="nav-link {{ Route::currentRouteName() == 'formKaprodi' ? 'active' : '' }}"
                       style="{{ Route::currentRouteName() == 'formKaprodi' ? 'background-color: #E9F5FE; color: #5B91EF;' : '' }}">
                        <i class="nav-icon fas fa-pen-square"></i>
                        <p style="font-size: 18px;">Formulir SKPI</p>
                    </a>
                </li>

                <!-- SKPI Mahasiswa -->
                {{-- <li class="nav-item">
                    <a href="{{ route('skpiMahasiswa.index') }}"
                       class="nav-link {{ Route::currentRouteName() == 'skpiMahasiswa.index' ? 'active' : '' }}"
                       style="{{ Route::currentRouteName() == 'skpiMahasiswa.index' ? 'background-color: #E9F5FE; color: #5B91EF;' : '' }}">
                        <i class="nav-icon fas fa-users"></i>
                        <p style="font-size: 18px;">SKPI  Mahasiswa</p>
                    </a>
                </li> --}}

                <!-- Notifikasi -->
                {{-- <li class="nav-item">
                    <a href="{{ route('notifikasi.index') }}"
                       class="nav-link {{ Route::currentRouteName() == 'notifikasi.index' ? 'active' : '' }}"
                       style="{{ Route::currentRouteName() == 'notifikasi.index' ? 'background-color: #E9F5FE; color: #5B91EF;' : '' }}">
                        <i class="nav-icon fas fa-comment-dots"></i>
                        <p style="font-size: 18px;">
                            Notifikasi
                            <span class="badge badge-info right" style="color: #4A505C">2</span>
                        </p>
                    </a>
                </li> --}}

            </ul>
        </nav>
    </div>
</aside>
