<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="icon" type="image/svg+xml" href="/favicon.svg">
    <!-- Laracom/Bootstrap style -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Poppins:400,600,700|Montserrat:600,700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:wght@400;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --elbes-primary: #1ecbe1;
            --elbes-accent: #0e7c7b;
            --elbes-bg: #e6f2ff;
            --elbes-dark: #1a2a33;
            --elbes-light: #f7fafc;
        }
        body {
            font-family: 'Poppins', Arial, sans-serif;
            background: var(--elbes-bg) !important;
            color: var(--elbes-dark) !important;
        }
        .navbar, footer {
            background: var(--elbes-accent) !important;
            color: #fff !important;
        }
        .navbar .navbar-brand, .navbar .nav-link, .navbar .nav-link.active, .navbar .nav-link:focus, .navbar .nav-link:hover {
            color: #fff !important;
        }
        .main-content, .table, .form-control {
            background: var(--elbes-bg) !important;
            color: var(--elbes-dark) !important;
        }
        .card, .modal-content {
            background: var(--elbes-light) !important;
            color: var(--elbes-dark) !important;
            border: 2px solid var(--elbes-primary) !important;
            box-shadow: 0 2px 8px 0 rgba(30,203,225,0.13), 0 1.5px 4px 0 rgba(14,124,123,0.10) !important;
        }
        .btn, .btn-primary, .btn-dark, .btn-danger, .btn-success, .btn-secondary {
            background: var(--elbes-primary) !important;
            color: #fff !important;
            border: none !important;
            border-radius: 8px !important;
            font-weight: 600;
            letter-spacing: 1px;
            transition: background 0.2s;
        }
        .btn:hover, .btn-primary:hover {
            background: var(--elbes-accent) !important;
        }
        .btn-outline-primary {
            background: transparent !important;
            color: var(--elbes-primary) !important;
            border: 2px solid var(--elbes-primary) !important;
            border-radius: 8px !important;
        }
        .btn-outline-primary:hover {
            background: var(--elbes-primary) !important;
            color: #fff !important;
        }
        input, textarea, select {
            background: var(--elbes-light) !important;
            color: var(--elbes-dark) !important;
            border: 1.5px solid var(--elbes-primary) !important;
            border-radius: 6px !important;
        }
        input:focus, textarea:focus, select:focus {
            border-color: var(--elbes-accent) !important;
            box-shadow: 0 0 0 2px var(--elbes-primary) !important;
        }
        .bg-dark, .bg-primary, .bg-secondary, .bg-success, .bg-warning, .bg-info, .bg-danger {
            background: var(--elbes-accent) !important;
            color: #fff !important;
        }
        .text-dark, .text-primary, .text-secondary, .text-success, .text-warning, .text-info, .text-danger {
            color: var(--elbes-dark) !important;
        }
        .text-white, .navbar-dark .navbar-nav .nav-link {
            color: #fff !important;
        }
        .card-title, .fw-bold, h1, h2, h3, h4, h5, h6, label, .form-label {
            color: var(--elbes-dark) !important;
        }
        .alert {
            background: var(--elbes-primary) !important;
            color: #fff !important;
            border: 1px solid var(--elbes-accent) !important;
        }
        .modal-header, .modal-footer {
            background: var(--elbes-accent) !important;
            color: #fff !important;
        }
        .modal-title {
            color: #fff !important;
        }
        .modal-content {
            border: 2px solid var(--elbes-primary) !important;
        }
        .navbar-brand { font-weight: 700; letter-spacing: 2px; }
        .nav-link, .navbar-nav .nav-link { font-weight: 500; letter-spacing: 1px; }
        .main-content { min-height: 80vh; }
        footer { background: var(--elbes-accent); color: #fff; padding: 24px 0; text-align: center; margin-top: 40px; }
        #sidebar .nav-link {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 48px;
            width: 48px;
            margin: 0 auto;
            padding: 0;
        }
        #sidebar .nav-item {
            width: auto;
        }
        .navbar .nav-link .material-symbols-rounded {
            font-size: 1.5rem !important;
        }
        .navbar .nav-link {
            height: 40px !important;
            width: 40px !important;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        #sidebar .material-symbols-rounded {
            font-size: 1.7rem !important;
        }
        #sidebar .nav-link {
            height: 44px;
            width: 44px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
    </style>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm fixed-top">
    <div class="container-fluid">
        <a class="navbar-brand ps-5" href="/" style="display:flex;align-items:center;gap:10px;">
            <span style="display:inline-block;height:40px;width:auto;vertical-align:middle;">
                <svg viewBox="0 0 350 80" xmlns="http://www.w3.org/2000/svg" style="height:40px;width:auto;">
                  <style>
                    .elbes { font-family: 'Montserrat', sans-serif; font-size:48px; font-weight: 600; fill: #232323; letter-spacing: 3px; }
                    .my { font-family: 'Montserrat', sans-serif; font-size: 46px; font-weight: 700; fill: #D4AF37; letter-spacing: 1px; }
                    .tag { fill: none; stroke: #D4AF37; stroke-width: 2; }
                  </style>
                  <text x="10" y="55" class="elbes">elbes</text>
                  <text x="170" y="55" class="my">MY</text>
                  <rect x="65" y="60" width="16" height="7" rx="2" class="tag"/>
                  <circle cx="70" cy="65" r="1.5" fill="#D4AF37"/>
                </svg>
            </span>
        </a>
        <div class="d-flex align-items-center ms-auto">
            @auth
                <a class="nav-link" href="/profile" title="Profile" data-bs-toggle="tooltip" data-bs-placement="bottom">@include('partials.nav-icons', ['icon' => 'profile'])</a>
                <form method="POST" action="{{ route('logout') }}" class="d-inline m-0 p-0" style="margin:0;padding:0;">
                    @csrf
                    <button type="submit" class="btn btn-link nav-link d-flex align-items-center justify-content-center p-0 m-0" style="height:40px;width:40px;" onclick="return confirm('Are you sure you want to logout?');" title="Logout" data-bs-toggle="tooltip" data-bs-placement="bottom">
                        @include('partials.nav-icons', ['icon' => 'logout'])
                    </button>
                </form>
            @else
                <div class="d-flex align-items-center" style="gap: 16px;">
                    <a class="btn btn-outline-light px-4" href="/login">Login</a>
                    <a class="btn btn-primary px-4" href="/register">Register</a>
                </div>
            @endauth
        </div>
    </div>
</nav>
<div class="d-flex" style="margin-top:76px;">
    <!-- Sidebar -->
    <div id="sidebar" class="bg-dark text-white p-3" style="width:70px;position:fixed;top:60px;left:0;height:calc(100vh - 60px);z-index:1020;padding-top:0;margin-top:0;">
        <ul class="nav flex-column text-center" style="display:flex;flex-direction:column;align-items:center;height:100%;gap:18px;">
            <li class="nav-item mb-3"><a class="nav-link text-white" href="/" title="Home">@include('partials.nav-icons', ['icon' => 'home'])</a></li>
            <li class="nav-item mb-3"><a class="nav-link text-white" href="/shop" title="Shop">@include('partials.nav-icons', ['icon' => 'shop'])</a></li>
            @auth
                @if(auth()->user()->isAdmin())
                    <li class="nav-item mb-3"><a class="nav-link text-white" href="/admin" title="Admin Dashboard">@include('partials.nav-icons', ['icon' => 'admin'])</a></li>
                    <li class="nav-item mb-3"><a class="nav-link text-white" href="/products" title="Products">@include('partials.nav-icons', ['icon' => 'products'])</a></li>
                    @php $pendingCount = \DB::table('elb_events')->where('approved', false)->count(); @endphp
                    <li class="nav-item mb-3 position-relative">
                        <a class="nav-link text-white" href="/events/pending" title="Pending Events">
                            @if($pendingCount > 0)
                                <span style="position:absolute;top:2px;right:2px;width:12px;height:12px;background:#dc3545;border-radius:50%;z-index:2;"></span>
                                <span style="position:relative;z-index:1;">@include('partials.nav-icons', ['icon' => 'pending-events'])</span>
                            @else
                                @include('partials.nav-icons', ['icon' => 'pending-events'])
                            @endif
                        </a>
                    </li>
                @endif
                @if(auth()->user()->isIt())
                    <li class="nav-item mb-3"><a class="nav-link text-white" href="/products" title="Products">@include('partials.nav-icons', ['icon' => 'products'])</a></li>
                    <li class="nav-item mb-3 dropdown">
                        <a class="nav-link dropdown-toggle text-white" href="#" id="eventsDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" title="Event Actions">
                            @include('partials.nav-icons', ['icon' => 'event-create-it'])
                        </a>
                        <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="eventsDropdown">
                            <li><a class="dropdown-item" href="/events">All Events</a></li>
                            <li><a class="dropdown-item" href="/events/create">Create Event</a></li>
                            <li><a class="dropdown-item" href="/events/gallery">Event Gallery</a></li>
                        </ul>
                    </li>
                @endif
                @if(auth()->user()->isClient())
                    <li class="nav-item mb-3"><a class="nav-link text-white" href="/orders/history" title="Orders">@include('partials.nav-icons', ['icon' => 'orders'])</a></li>
                @endif
                <li class="nav-item mb-3" id="cart-nav-item">
                    <a class="nav-link text-white" href="/cart" title="Cart">
                        @include('partials.nav-icons', ['icon' => 'cart'])
                    </a>
                </li>
            @endauth
        </ul>
    </div>
    <!-- Main Content -->
    <div class="main-content flex-grow-1" style="margin-left:70px;">
        @isset($header)
            <header class="bg-white shadow-sm mb-4">
                <div class="container py-4">
                    {{ $header }}
                </div>
            </header>
        @endisset
        <main class="container">
            @yield('content')
            {{ $slot ?? '' }}
        </main>
    </div>
</div>
<footer>
    <div class="container">
        &copy; {{ date('Y') }} elbes MY. All rights reserved.
    </div>
</footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    tooltipTriggerList.forEach(function (tooltipTriggerEl) {
        new bootstrap.Tooltip(tooltipTriggerEl);
    });
});
</script>
@stack('scripts')
</body>
</html>