<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin') - SIPERPUS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body { display: flex; min-height: 100vh; }
        .sidebar { width: 250px; min-height: 100vh; background: #1a1a2e; color: #fff; flex-shrink: 0; }
        .sidebar .nav-link { color: #adb5bd; padding: .5rem 1rem; border-radius: .25rem; margin: 2px 8px; }
        .sidebar .nav-link:hover, .sidebar .nav-link.active { background: #0d6efd; color: #fff; }
        .sidebar .nav-link i { margin-right: 8px; }
        .main-content { flex: 1; background: #f8f9fa; overflow-x: hidden; }
        .top-bar { background: #fff; border-bottom: 1px solid #dee2e6; padding: .75rem 1.5rem; }
    </style>
    @stack('styles')
</head>
<body>
<div class="sidebar d-flex flex-column">
    <div class="p-3 border-bottom border-secondary">
        <h5 class="mb-0 text-white"><i class="bi bi-book-half"></i> SIPERPUS</h5>
        <small class="text-muted">Admin Panel</small>
    </div>
    <nav class="flex-grow-1 py-3">
        <ul class="nav flex-column">
            <li class="nav-item"><a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}"><i class="bi bi-speedometer2"></i> Dashboard</a></li>
            <li class="nav-item"><a class="nav-link {{ request()->routeIs('admin.books.*') ? 'active' : '' }}" href="{{ route('admin.books.index') }}"><i class="bi bi-book"></i> Buku</a></li>
            <li class="nav-item"><a class="nav-link {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}" href="{{ route('admin.categories.index') }}"><i class="bi bi-tags"></i> Kategori</a></li>
            <li class="nav-item"><a class="nav-link {{ request()->routeIs('admin.members.*') ? 'active' : '' }}" href="{{ route('admin.members.index') }}"><i class="bi bi-people"></i> Anggota</a></li>
            <li class="nav-item"><a class="nav-link {{ request()->routeIs('admin.loans.*') ? 'active' : '' }}" href="{{ route('admin.loans.index') }}"><i class="bi bi-arrow-left-right"></i> Peminjaman</a></li>
            <li class="nav-item"><a class="nav-link {{ request()->routeIs('admin.eresources.*') ? 'active' : '' }}" href="{{ route('admin.eresources.index') }}"><i class="bi bi-file-earmark-richtext"></i> E-Resources</a></li>
        </ul>
    </nav>
    <div class="p-3 border-top border-secondary">
        <div class="text-muted small mb-2">{{ auth()->user()->name }}</div>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn btn-sm btn-outline-secondary w-100"><i class="bi bi-box-arrow-right"></i> Logout</button>
        </form>
    </div>
</div>
<div class="main-content d-flex flex-column">
    <div class="top-bar d-flex align-items-center justify-content-between">
        <h6 class="mb-0 text-muted">@yield('page-title', 'Dashboard')</h6>
        <span class="text-muted small"><i class="bi bi-person-circle"></i> {{ auth()->user()->name }}</span>
    </div>
    <div class="p-4 flex-grow-1">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show">{{ session('success') }}<button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show">{{ session('error') }}<button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>
        @endif
        @if($errors->any())
            <div class="alert alert-danger alert-dismissible fade show">
                <ul class="mb-0">@foreach($errors->all() as $err)<li>{{ $err }}</li>@endforeach</ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
        @yield('content')
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@stack('scripts')
</body>
</html>
