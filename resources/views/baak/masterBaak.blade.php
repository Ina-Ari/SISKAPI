<!DOCTYPE html>
<html lang="en">
<head>
    <title>@yield('title')</title>
    @include('./partial.head')
</head>
<body class="hold-transition sidebar-mini layout-fixed" style="background-color: #F3F3F3">
<div class="wrapper">

  <!-- Navbar -->
  @include('baak.partialBaak.navbarBaak')
  <!-- /.navbar -->

  <!-- Sidebar-->
  @include('baak.partialBaak.sidebarBaak')

  <!-- Content -->
  <div class="content-wrapper">
    @yield('content')
  </div>
</div>

<!-- Script -->
    @include('./partial.script')
    @stack('scripts')
</body>
</html>
