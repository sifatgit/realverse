<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>{{($setting && $setting->title) ? $setting->title.' Admin' : 'Admin'}} | Dashboard</title>

  @include('backend.admin.partials.styles')
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="{{($setting && $setting->logo) ? URL::to($setting->logo) : ''}}" alt="AdminLTELogo" height="60" width="160">
  </div>

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->
      <li class="nav-item">
        <a class="nav-link" data-widget="navbar-search" href="#" role="button">
          <i class="fas fa-search"></i>
        </a>
        <div class="navbar-search-block">
          <form class="form-inline">
            <div class="input-group input-group-sm">
              <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
              <div class="input-group-append">
                <button class="btn btn-navbar" type="submit">
                  <i class="fas fa-search"></i>
                </button>
                <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>
          </form>
        </div>
      </li>

      <!-- Messages Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-comments"></i>

        </a>

      </li>
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{url('/admin/dashboard')}}" class="brand-link">
      <img src="{{asset('admin/images/Realverse_main_logo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">{{($setting && $setting->title) ? $setting->title : 'Adminlte'}}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{asset('admin/images/profile-1.png')}}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{Auth::guard('admin')->name}}</a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item {{ request()->routeIs( 'admin.dashboard' ) ? 'menu-open' : ''}}">
            <a href="{{route('admin.dashboard')}}" class="nav-link {{ request()->routeIs( 'admin.dashboard' ) ? 'active' : ''}}">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard

              </p>
            </a>
          </li>
         
          <li class="nav-item {{ request()->routeIs('admin.settings') ? 'menu-open' : '' }}">
            <a href="{{route('admin.settings')}}" class="nav-link {{ request()->routeIs('admin.settings') ? 'active' : '' }}">
              <i class="nav-icon fa fa-cog" aria-hidden="true"></i>
              <p>
                Settings
                
              </p>
            </a>
          </li>          
          <li class="nav-item {{request()->routeIs('admin.users') ? 'menu-open' : ''}}">
            <a href="#" class="nav-link {{request()->routeIs('admin.users') ? 'active' : ''}}">
            <i class="nav-icon fas fa-solid fa-users"></i>
              <p>
                Customers
                <i class="fas fa-angle-left right"></i>

              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('admin.users')}}" class="nav-link {{ request()->routeIs('admin.users') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Manage Customers</p>
                </a>
              </li>
            </ul>
          </li>           
          <li class="nav-item {{request()->routeIs('admin.agents') ? 'menu-open' : ''}}">
            <a href="#" class="nav-link {{request()->routeIs('admin.agents') ? 'active' : ''}}">
            <i class="nav-icon fas fa-solid fa-user-tie"></i>
              <p>
                Agents
                <i class="fas fa-angle-left right"></i>

              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('admin.agents')}}" class="nav-link {{ request()->routeIs('admin.agents') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>

                  <p>Manage Agents</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item {{request()->routeIs('admin.sliders') ? 'menu-open' : ''}}">
            <a href="#" class="nav-link {{request()->routeIs('admin.sliders') ? 'active' : ''}}">
              <i class="nav-icon fas fa-sliders-h"></i>

              <p>
                Sliders
                <i class="fas fa-angle-left right"></i>

              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('admin.sliders')}}" class="nav-link {{ request()->routeIs('admin.sliders') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Manage Sliders</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item {{ request()->routeIs('admin.states' , 'admin.cities' , 'admin.areas') ? 'menu-open' : '' }}">
            <a href="#" class="nav-link {{ request()->routeIs('admin.states' , 'admin.cities' , 'admin.areas') ? 'active' : '' }}">
              <i class="nav-icon fas fa-map-marker-alt"></i>

              <p>
                Venues
                <i class="fas fa-angle-left right"></i>

              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('admin.states')}}" class="nav-link {{ request()->routeIs('admin.states') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Manage States</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('admin.cities')}}" class="nav-link {{ request()->routeIs('admin.cities') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Manage Cities</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('admin.areas')}}" class="nav-link {{ request()->routeIs('admin.areas') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Manage Areas</p>
                </a>
              </li>                            
            </ul>
          </li>

<li class="nav-item {{ request()->routeIs('admin.projects', 'admin.floors', 'admin.units') ? 'menu-open' : '' }}">
  <a href="#" class="nav-link {{ request()->routeIs('admin.projects', 'admin.floors', 'admin.units') ? 'active' : '' }}">
    <i class="nav-icon fas fa-solid fa-building"></i>
    <p>
      Projects
      <i class="fas fa-angle-left right"></i>

    </p>
  </a>
  <ul class="nav nav-treeview">
    <li class="nav-item">
      <a href="{{ route('admin.projects') }}" class="nav-link {{ request()->routeIs('admin.projects') ? 'active' : '' }}">
        <i class="far fa-circle nav-icon"></i>
        <p>Manage Projects</p>
      </a>
    </li>
    <li class="nav-item">
      <a href="{{ route('admin.floors') }}" class="nav-link {{ request()->routeIs('admin.floors') ? 'active' : '' }}">
        <i class="far fa-circle nav-icon"></i>
        <p>Manage Floors</p>
      </a>
    </li>
    <li class="nav-item">
      <a href="{{ route('admin.units') }}" class="nav-link {{ request()->routeIs('admin.units') ? 'active' : '' }}">
        <i class="far fa-circle nav-icon"></i>
        <p>Manage Units</p>
      </a>
    </li>
  </ul>
</li>
<li class="nav-item {{ request()->routeIs('admin.userunits') ? 'menu-open' : '' }}">
  <a href="#" class="nav-link {{ request()->routeIs('admin.userunits') ? 'active' : '' }}">
    <i class="nav-icon fas fa-file-alt"></i>

    <p>
      Submitted Units
      <i class="fas fa-angle-left right"></i>

    </p>
  </a>
  <ul class="nav nav-treeview">

    <li class="nav-item">
      <a href="{{ route('admin.userunits') }}" class="nav-link {{ request()->routeIs('admin.userunits') ? 'active' : '' }}">
        <i class="far fa-circle nav-icon"></i>
        <p>Manage submitted Units</p>
      </a>
    </li>
  </ul>
</li>
          <li class="nav-item {{request()->routeIs('admin.blogs') ? 'menu-open' : ''}}">
            <a href="#" class="nav-link {{request()->routeIs('admin.blogs') ? 'active' : ''}}">
              <i class="nav-icon fas fa-blog"></i>

              <p>
                Blogs
                <i class="fas fa-angle-left right"></i>

              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('admin.blogs')}}" class="nav-link {{ request()->routeIs('admin.blogs') ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Manage Blogs</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item {{request()->routeIs('admin.newsletter') ? 'menu-open' : ''}}">
            <a href="{{route('admin.newsletter')}}" class="nav-link {{request()->routeIs('admin.newsletter') ? 'active' : ''}}">
              <i class="nav-icon fas fa-envelope"></i>

              <p>
                Newsletter Subscriptions
              </p>
            </a>

          </li> 
          <li class="nav-item {{request()->routeIs('admin.messages') ? 'menu-open' : ''}}">
            <a href="{{route('admin.messages')}}" class="nav-link {{request()->routeIs('admin.messages') ? 'active' : ''}}">
              <i class="nav-icon fas fa-comment"></i>
              <p>
                Customer Messages
              </p>
            </a>

          </li>
          <li class="nav-item {{request()->routeIs('admin.ratedunits') ? 'menu-open' : ''}}">
            <a href="{{route('admin.ratedunits')}}" class="nav-link {{request()->routeIs('admin.ratedunits') ? 'active' : ''}}">
              <i class="nav-icon fas fa-solid fa-star"></i>
              <p>
                Rated Units
              </p>
            </a>

          </li>
          
          <li class="nav-header">LABELS</li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon far fa-circle text-danger"></i>
              <p class="text">Important</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon far fa-circle text-warning"></i>
              <p>Warning</p>
            </a>
          </li>
        <li class="nav-item">
    <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
    <a href="#" class="nav-link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
        <i class="nav-icon far fa-circle text-warning"></i>
        <p>Logout</p>
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
            <h1 class="m-0">Dashboard</h1>
          </div><!-- /.col -->

        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      @yield('content')
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 3.2.0
    </div>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

@include('backend.admin.partials.scripts')
</body>
</html>
