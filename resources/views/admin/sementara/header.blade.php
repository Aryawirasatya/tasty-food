<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>@yield('title', 'Dashboard')</title>

  {{-- Plugin CSS --}}
  <link rel="stylesheet" href="{{ asset('assets/admin/vendors/feather/feather.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/admin/vendors/ti-icons/css/themify-icons.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/admin/vendors/css/vendor.bundle.base.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/admin/vendors/font-awesome/css/font-awesome.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/admin/vendors/mdi/css/materialdesignicons.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/admin/css/style.css') }}">
  <link rel="shortcut icon" href="{{ asset('assets/admin/images/favicon.png') }}" />
</head>

<body>
<div class="container-scroller">

  {{-- Navbar --}}
  <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
    <div class="navbar-brand-wrapper d-flex align-items-center">
      <a class="navbar-brand brand-logo me-5" href="{{ route('admin.dashboard') }}">
        <img src="{{ asset('assets/admin/images/logo.svg') }}" alt="logo">
      </a>
      <a class="navbar-brand brand-logo-mini" href="{{ route('admin.dashboard') }}">
        <img src="{{ asset('assets/admin/images/logo-mini.svg') }}" alt="logo">
      </a>
    </div>
    <div class="navbar-menu-wrapper d-flex justify-content-end align-items-center">
      @auth
      <div class="dropdown">
        <button class="btn btn-light dropdown-toggle" type="button" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
          {{ auth()->user()->name }}
        </button>
        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
          <li class="dropdown-item-text">
            Role:
            @if(auth()->user()->isSuperAdmin())
              Superadmin
            @else
              {{ auth()->user()->role->name ?? '-' }}
            @endif
          </li>
          <li class="dropdown-item-text">Superadmin: {{ auth()->user()->isSuperAdmin() ? 'Ya' : 'Tidak' }}</li>
          <li>
            <form method="POST" action="{{ route('logout') }}">
              @csrf
              <button type="submit" class="dropdown-item text-danger">Logout</button>
            </form>
          </li>
        </ul>
      </div>
      @endauth
    </div>
  </nav>

  {{-- Sidebar --}}
  <div class="container-fluid page-body-wrapper">
    <nav class="sidebar sidebar-offcanvas" id="sidebar">
      <ul class="nav">
        {{-- Dashboard --}}
        <li class="nav-item">
          <a class="nav-link" href="{{ route('admin.dashboard') }}">
            <i class="icon-grid menu-icon"></i>
            <span class="menu-title">Dashboard</span>
          </a>
        </li>

        {{-- Hanya untuk Superadmin --}}
        @if(auth()->user()?->isSuperAdmin())
        <li class="nav-item">
          <a class="nav-link" href="{{ route('admin.roles.index') }}">
            <i class="icon-columns menu-icon"></i>
            <span class="menu-title">Manajemen Role</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('admin.users.index') }}">
            <i class="icon-head menu-icon"></i>
            <span class="menu-title">Manajemen User</span>
          </a>
        </li>
        @endif

        {{-- Tentang --}}
        @if(auth()->user()?->can('edit_tentang') || auth()->user()?->isSuperAdmin())
        <li class="nav-item">
          <a class="nav-link" href="{{ route('admin.tentang.index') }}">
            <i class="icon-paper menu-icon"></i>
            <span class="menu-title">Tentang Kami</span>
          </a>
        </li>
        @endif

        {{-- Galeri --}}
        @if(auth()->user()?->can('lihat_galeri') || auth()->user()?->isSuperAdmin())
        <li class="nav-item">
          <a class="nav-link" href="{{ route('admin.galeri.index') }}">
            <i class="icon-image menu-icon"></i>
            <span class="menu-title">Galeri</span>
          </a>
        </li>
        @endif

        {{-- Berita --}}
        @if(auth()->user()?->can('lihat_berita') || auth()->user()?->isSuperAdmin())
        <li class="nav-item">
          <a class="nav-link" href="{{ route('admin.berita.index') }}">
            <i class="icon-book menu-icon"></i>
            <span class="menu-title">Berita</span>
          </a>
        </li>
        @endif

        {{-- Kontak --}}
        @if(auth()->user()?->can('lihat_kontak') || auth()->user()?->isSuperAdmin())
        <li class="nav-item">
          <a class="nav-link" href="{{ route('admin.kontak.index') }}">
            <i class="icon-phone menu-icon"></i>
            <span class="menu-title">Kontak</span>
          </a>
        </li>
        @endif

        {{-- Pesan --}}
        @if(auth()->user()?->can('lihat_pesan') || auth()->user()?->isSuperAdmin())
        <li class="nav-item">
          <a class="nav-link" href="{{ route('admin.pesan.index') }}">
            <i class="icon-envelope menu-icon"></i>
            <span class="menu-title">Pesan Masuk</span>
          </a>
        </li>
        @endif
      </ul>
    </nav>

    {{-- Awal konten utama --}}
    <div class="main-panel">
      <div class="content-wrapper">
