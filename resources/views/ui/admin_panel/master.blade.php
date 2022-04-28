@php
  // $prefix = Request::route()->getPrefix();
  $route = Route::current()->getName();
@endphp

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Rent-@yield('title')</title>
  <link rel="icon" type="image/x-icon" href="{{ asset('ui/login_assets/images/favicon.png') }}">
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="{{ asset('ui/admin_assets/plugins/fontawesome-free/css/all.min.css') }}">
  <!-- IonIcons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('ui/admin_assets/dist/css/adminlte.min.css') }}">
  {{-- bootstart css --}}
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  {{-- custom css --}}
  <link rel="stylesheet" href="{{ asset('ui/admin_assets/dist/css/style.css') }}">
  @yield('style')
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <!-- Navbar -->
  <div class="top-header">
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>
      @php
      if(Session::has('loginId'))
        {
            $userName = App\Models\Registration::select('last_name')->where('id',session('loginId'))->first();
        }
      @endphp
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <li class="dropdown nav-item mr-3">
        <div class="dropdown logout_btn">
          <a class="dropdown-toggle" href="#"  id="dropdownMenu2" data-bs-toggle="dropdown" aria-expanded="false">
            <svg xmlns="http://www.w3.org/2000/svg"  width="30" height="30" fill="currentColor" class="bi bi-person-fill" viewBox="0 0 16 16">
              <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
            </svg>
            @if(Session::has('loginId'))
            {{ $userName->last_name }}
            @endif
          </a>
          <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenu2">
            <li><a class="dropdown-item" href="/logout" type="button">Log Out</a></li>
          </ul>
        </div>
      </li>
    </ul>
  </nav>
</div>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index.html" class="brand-link">
      <img src="{{ asset('ui/admin_assets/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Rent</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
     
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="{{ route('dashboard') }}" class="nav-link {{($route == "dashboard" )? ' active' : ''}}">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>        
          </li>
          
          <li class="nav-header">PROPERTIES</li>
          
          <li class="nav-item">
            <a href="{{ route('addProperty') }}" class="nav-link {{($route == "addProperty" )? ' active' : ''}}">
              <i class="nav-icon fas fa-calendar-alt"></i>
              <p>
                Add Property
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('propertyList') }}" class="nav-link {{($route == "propertyList" )? ' active' : ''}}">
              <i class="nav-icon fas fa-table"></i>
              <p>
                Property List
              </p>
            </a>
          </li>          
          
          <li class="nav-header">RENT PROPERTY</li>
          <li class="nav-item">
            <a href="{{ route('propertyContract') }}" class="nav-link {{($route == "propertyContract" )? ' active' : ''}}">
              <i class="nav-icon fas fa-edit"></i>
              <p>
                Property Contract
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('rentList') }}" class="nav-link {{($route == "rentList" )? ' active' : ''}}">
              <i class="nav-icon fas fa-columns"></i>
              <p>
                Rent List
              </p>
            </a>
          </li> 

          <li class="nav-header">Rent Bill</li>
          <li class="nav-item">
            <a href="{{ route('billCollection') }}" class="nav-link {{($route == "billCollection" )? ' active' : ''}}">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Bill Genarate
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">
              @yield('content_title')
            </h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->    
    <div class="container-fluid">
      <div class="content">
        @yield('main_content')
      </div>
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <strong>Copyright &copy; 2022 <a href="http://qsoft.net/">Q-Soft Precise Assistance</a>.</strong>
    All rights reserved.
    {{-- <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 3.2.0
    </div> --}}
  </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="{{ asset('ui/admin_assets/plugins/jquery/jquery.min.js') }}"></script>
<!-- AdminLTE -->
<script src="{{ asset('ui/admin_assets/dist/js/adminlte.js') }}"></script>
{{-- bootstarp js --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

@yield('script')
</body>
</html>
