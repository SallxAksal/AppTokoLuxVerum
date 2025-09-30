<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>@yield('title', 'LuxVerum')</title>
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}" />
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" />
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <div class="sidebar">
        <div style="text-align: center; margin-bottom: 1rem;">
            <img src="{{ asset('image/L-luxverum.jpg') }}" alt="Luxverum Logo" style="max-width: 150px; height: auto; border-radius: 12px; box-shadow: 0 0 10px rgba(0,0,0,0.5);">
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
    <div class="main-content expanded">
        @yield('content')
    </div>
</body>
</html>

<style>
    body {
        margin: 0;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background-color: #f0f0f0;
        color: #333333;
        display: flex;
        height: 100vh;
    }
    .sidebar {
        background: linear-gradient(135deg, #b30000, #000000, #ffffff);
        color: white;
        width: 220px;
        padding: 20px;
        box-sizing: border-box;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        position: fixed;
        height: 100vh;
        top: 0;
        left: 0;
        z-index: 1000;
    }
    .sidebar h2 {
        margin-top: 0;
        margin-bottom: 1.5rem;
    }
    .sidebar nav ul {
        list-style: none;
        padding: 0;
        margin: 0;
    }
    .sidebar nav ul li {
        margin-bottom: 1rem;
    }
    .sidebar nav ul li a, .sidebar nav ul li form button {
        color: white;
        text-decoration: none;
        font-weight: 600;
        background: none;
        border: none;
        cursor: pointer;
        padding: 0;
        font-size: 1rem;
        transition: background-color 0.3s ease;
        border-radius: 4px;
    }
    .sidebar nav ul li a:hover, .sidebar nav ul li form button:hover {
        background-color: rgba(255, 255, 255, 0.2);
        text-decoration: none;
    }
    .sidebar nav ul li a:active, .sidebar nav ul li form button:active {
        background-color: rgba(255, 255, 255, 0.4);
    }
    .main-content {
        flex-grow: 1;
        padding: 20px;
        overflow-y: auto;
        margin-left: 220px;
    }
    .button {
        background-color: #4caf50;
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 6px;
        cursor: pointer;
        font-weight: 600;
        transition: background-color 0.3s ease;
        display: inline-block;
        text-align: center;
        text-decoration: none;
    }
    .button:hover {
        background-color: #357a38;
    }
</style>
