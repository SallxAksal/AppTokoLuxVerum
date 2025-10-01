<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>@yield('title', 'LuxVerum')</title>
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}" />
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <div style="text-align: center; margin-bottom: 1rem;">
            <img src="{{ asset('image/L-luxverum.jpg') }}" 
                 alt="Luxverum Logo" 
                 style="max-width: 150px; height: auto; border-radius: 12px; box-shadow: 0 0 10px rgba(0,0,0,0.5);">
        </div>
        <nav>
            <ul>
                <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
                <li><a href="{{ route('product.list') }}">Daftar Produk</a></li>
                <li><a href="{{ route('product.create') }}">Tambah Produk Baru</a></li>
                <li>
                    <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                        @csrf
                        <button type="submit" class="button">Logout</button>
                    </form>
                </li>
            </ul>
        </nav>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        @yield('content')
    </div>
</body>
</html>
