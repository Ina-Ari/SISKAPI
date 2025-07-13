<aside class="main-sidebar sidebar-light-primary elevation-4">
    <a href="{{ route('mahasiswa.dashboard') }}" class="brand-link">
      <img src="{{ asset('image/logo pnb.png') }}" alt="PNB Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Politeknik Negeri Bali</span>
    </a>

    <div class="sidebar">
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          {{-- Pastikan variabel $user tersedia di view ini, lihat penjelasan sebelumnya --}}
          <img class="img-circle" src="{{  $user->picture ? '../storage/'. $user->picture : asset('../storage/fotoprofil/user.jpeg') }}">
        </div>
        <div class="info">
          {{-- Pastikan variabel $user tersedia di view ini, lihat penjelasan sebelumnya --}}
          <a href="#" style="font-size: 85%" class="d-block">{{ $user->nama }}</a>
        </div>
      </div>

      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          {{-- Dashboard --}}
          <li class="nav-item">
            <a href="{{ route('mahasiswa.dashboard') }}" class="nav-link {{ Route::currentRouteName() == 'mahasiswa.dashboard' ? 'active' : '' }}" style="{{ Route::currentRouteName() == 'mahasiswa.dashboard' ? 'background-color: #E9F5FE; color: #5B91EF;' : '' }}">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>Dashboard</p>
            </a>
          </li>
          {{-- Profile --}}
          <li class="nav-item">
            <a href="{{ route('mahasiswa.profile') }}" class="nav-link {{ request()->routeIs('mahasiswa.profile') ? 'active' : '' }}" style="{{ Route::currentRouteName() == 'mahasiswa.profile' ? 'background-color: #E9F5FE; color: #5B91EF;' : '' }}">
              <i class="nav-icon fas fa-user-alt"></i>
              <p>Profile</p>
            </a>
          </li>
          {{-- Notifikasi
          <li class="nav-item">
            <a href="{{ route('mahasiswa.pagenotif') }}" class="nav-link {{ request()->routeIs('mahasiswa.pagenotif') ? 'active' : '' }}" style="{{ Route::currentRouteName() == 'mahasiswa.pagenotif' ? 'background-color: #E9F5FE; color: #5B91EF;' : '' }}">
              <i class="nav-icon fas fa-bell"></i> {{-- Mengubah icon dari user-alt menjadi bell untuk notifikasi --}}
              
          {{-- Notifikasi --}}
          <li class="nav-item">
            <a href="{{ route('mahasiswa.pagenotif') }}" class="nav-link {{ request()->routeIs('mahasiswa.pagenotif') ? 'active' : '' }}" style="{{ Route::currentRouteName() == 'mahasiswa.pagenotif' ? 'background-color: #E9F5FE; color: #5B91EF;' : '' }}">
              <i class="nav-icon fas fa-bell"></i>
              <p>
                Notifikasi
                @if ($jumlahNotif > 0)
                  <span class="badge badge-danger right">{{ $jumlahNotif }}</span>
                @endif
              </p>
            </a>
          </li>

          {{-- Logout --}}
          <li class="nav-item">
            <a href="{{ route('logout') }}" class="nav-link ">
              <i class="nav-icon fas fa-arrow-alt-circle-left"></i>
              <p>Logout</p>
            </a>
          </li>
        </ul>
      </nav>
      </div>
    </aside>
