<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Member') - SIPERPUS</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    @stack('styles')
</head>
<body class="bg-light">
<nav class="navbar navbar-expand-lg navbar-dark bg-success">
    <div class="container">
        <a class="navbar-brand fw-bold" href="{{ route('home') }}"><i class="bi bi-book-half"></i> SIPERPUS</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                <li class="nav-item"><a class="nav-link {{ request()->routeIs('member.dashboard') ? 'active' : '' }}" href="{{ route('member.dashboard') }}">Dashboard</a></li>
                <li class="nav-item"><a class="nav-link {{ request()->routeIs('member.loans.*') ? 'active' : '' }}" href="{{ route('member.loans.index') }}">Peminjaman Saya</a></li>
                <li class="nav-item"><a class="nav-link {{ request()->routeIs('member.eresources.*') ? 'active' : '' }}" href="{{ route('member.eresources.index') }}">E-Resources</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('opac.index') }}">Katalog OPAC</a></li>
            </ul>
            <ul class="navbar-nav">
                <li class="nav-item">
                    <form method="POST" action="{{ route('logout') }}" class="d-inline">
                        @csrf
                        <button type="submit" class="nav-link btn btn-link text-white">Logout ({{ auth()->user()->name }})</button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</nav>
<main class="py-4">
    <div class="container">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show">{{ session('success') }}<button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show">{{ session('error') }}<button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>
        @endif
        @yield('content')
    </div>
</main>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@stack('scripts')
</body>
</html>
