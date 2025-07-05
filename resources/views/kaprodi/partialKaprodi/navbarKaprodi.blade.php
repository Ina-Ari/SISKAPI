<nav class="main-header navbar navbar-expand navbar-white navbar-light sticky-top">
  <!-- Menu Icon -->
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" href="#" role="button">
        <i class="fas fa-bars"></i>
      </a>
    </li>
  </ul>

    <ul class="navbar-nav mx-auto">
    <li class="nav-item">
        <span class="nav-link font-weight-bold" style="color:black; margin-left: 12vw">SKPI PNB</span>
    </li>
    </ul>

   <!---Profile -->
  <ul class="navbar-nav ml-auto">
    <li class="nav-item dropdown">
      <a class="nav-link d-flex align-items-center" data-toggle="dropdown" href="#" role="button">
         <img src="{{ '../storage/'. Auth::user()->picture }}" alt="User Image" class="img-circle elevation-2" width="30" height="30">
        <i class="fas fa-angle-down ml-2"></i>
      </a>
      <div class="dropdown-menu dropdown-menu-right">
        <a href="{{ route('logout') }}" class="dropdown-item">Logout</a>
      </div>
    </li>
  </ul>
</nav>
