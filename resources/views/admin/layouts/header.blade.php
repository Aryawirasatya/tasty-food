<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Dashboard')</title>

    <!-- Custom fonts for this template-->
    <link href="{{ asset('assets/admin/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('assets/admin/css/sb-admin-2.min.css') }}" rel="stylesheet">
</head>
<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('admin.dashboard') }}">
        <div class="sidebar-brand-text mx-3">Tasty Food Admin</div>
    </a>

    <hr class="sidebar-divider my-0">

    <!-- Dashboard -->
    <li class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <hr class="sidebar-divider">

    <!-- Fitur Khusus Superadmin -->
    @if(auth()->user()?->isSuperAdmin())
        <li class="nav-item {{ request()->is('admin/roles*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('admin.roles.index') }}">
                <i class="fas fa-user-shield"></i>
                <span>Manajemen Role</span>
            </a>
        </li>
        <li class="nav-item {{ request()->is('admin/users*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('admin.users.index') }}">
                <i class="fas fa-users-cog"></i>
                <span>Manajemen User</span>
            </a>
        </li>
    @endif

    <!-- Tentang Kami -->
    @if(auth()->user()?->canAkses('akses_tentang'))
    <li class="nav-item {{ request()->routeIs('admin.tentang.*') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.tentang.index') }}">
            <i class="fas fa-info-circle"></i>
            <span>Tentang Kami</span>
        </a>
    </li>
    @endif


    <!-- Galeri -->
    @if(auth()->user()?->canAkses('akses_galeri'))
        <li class="nav-item {{ request()->is('admin/galeri*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('admin.galeri.index') }}">
                <i class="fas fa-images"></i>
                <span>Galeri</span>
            </a>
        </li>
    @endif

    <!-- Berita -->
    @if(auth()->user()?->canAkses('akses_berita'))
        <li class="nav-item {{ request()->is('admin/berita*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('admin.berita.index') }}">
                <i class="fas fa-newspaper"></i>
                <span>Berita</span>
            </a>
        </li>
    @endif

    <!-- Informasi Kontak -->
    @if(auth()->user()?->canAkses('akses_kontak'))
        <li class="nav-item {{ request()->is('admin/kontak') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('admin.kontak.index') }}">
                <i class="fas fa-address-card"></i>
                <span>Informasi Kontak</span>
            </a>
        </li>
    @endif

    <!-- Pesan Kontak -->
    @if(auth()->user()?->canAkses('akses_pesan'))

        <li class="nav-item {{ request()->is('admin/kontak-pesan*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('admin.kontak-pesan.index') }}">
                <i class="fas fa-envelope"></i>
                <span>Pesan Kontak</span>
            </a>
        </li>
    @endif

    

    <hr class="sidebar-divider">

    <!-- Sidebar Toggler -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>


        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto align-items-center">

                        <ul class="navbar-nav ml-auto align-items-center">
                            @auth
                            <li class="nav-item dropdown no-arrow">
                                <a class="nav-link dropdown-toggle btn btn-light text-dark text-lg px-4 py-2 rounded-lg shadow-md transition-all duration-300 ease-in-out hover:shadow-xl" 
                                    href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    {{ auth()->user()->name }}
                                </a>
                                <div class="dropdown-menu dropdown-menu-right shadow-lg rounded-lg p-3 animated--grow-in" aria-labelledby="userDropdown">
                                    <span class="dropdown-item-text text-lg font-semibold">
                                        <strong>Role:</strong> 
                                        @if(auth()->user()->isSuperAdmin()) 
                                            Superadmin 
                                        @else 
                                            {{ auth()->user()->role->name ?? '-' }} 
                                        @endif
                                    </span>
                                    <span class="dropdown-item-text text-lg">
                                        <strong>Superadmin:</strong> {{ auth()->user()->isSuperAdmin() ? 'Ya' : 'Tidak' }}
                                    </span>
                                    <div class="dropdown-divider"></div>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="dropdown-item text-danger text-lg font-semibold px-4 py-2 rounded-lg transition-all duration-300 ease-in-out hover:bg-red-100">
                                            <i class="fas fa-sign-out-alt fa-lg fa-fw mr-2 text-gray-500"></i> Logout
                                        </button>
                                    </form>
                                </div>
                            </li>
                            @endauth
                        </ul>

                </nav>
                <!-- End of Topbar -->

                <div class="container-fluid">
