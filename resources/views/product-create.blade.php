@extends('layouts.app')

@section('title', 'Tambah Produk - LuxVerum')

@section('content')
    <img src="{{ asset('image/LX-luxverum.png') }}" alt="Logo LuxVerum" style="width:150px; height:auto; display:block; margin:0 auto 20px;">

    <h1>Tambah Produk Baru</h1>

    @if ($errors->any())
        <div class="alert-error">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #1e1e1e;
            margin: 0;
            padding: 0;
        }

        h1 {
            color: #ff3333;
            text-align: center;
            margin-bottom: 25px;
            text-shadow: 0 0 6px rgba(255, 77, 77, 0.6);
        }

        form {
            max-width: 900px;
            margin: 30px auto;
            padding: 25px 30px;
            border-radius: 16px;
            background: #2a2a2a;
            box-shadow: 0 8px 20px rgba(0,0,0,0.5);
            display: grid;
            gap: 20px;
            grid-template-columns: 1fr 1fr;
        }

        .form-group {
            display: flex;
            flex-direction: column;
        }

        .form-group label {
            font-weight: 600;
            margin-bottom: 6px;
            color: #fdfdfc;
        }

        .form-group input,
        .form-group textarea {
            padding: 12px;
            border: 1.5px solid #ff4d4d;
            border-radius: 8px;
            font-size: 15px;
            background: #333;
            color: #fdfdfc;
            transition: all 0.3s ease;
        }

        .form-group input:focus,
        .form-group textarea:focus {
            border-color: #b30000;
            box-shadow: 0 0 6px rgba(179, 0, 0, 0.5);
            outline: none;
        }

        textarea {
            resize: vertical;
            min-height: 100px;
        }

        .full-width {
            grid-column: span 2;
        }

        button[type="submit"] {
            background: linear-gradient(145deg, #b30000, #800000);
            color: #fff;
            border: none;
            padding: 14px 20px;
            border-radius: 8px;
            cursor: pointer;
            font-size: 16px;
            font-weight: bold;
            transition: all 0.3s ease, transform 0.1s ease;
            grid-column: span 2;
        }

        button[type="submit"]:hover {
            background: linear-gradient(145deg, #ff3333, #b30000);
            transform: translateY(-2px);
            box-shadow: 0 6px 18px rgba(255, 51, 51, 0.6);
        }

        .alert-error {
            background: #ffe5e5;
            border: 1px solid #ff9b9b;
            color: #a10000;
            padding: 12px;
            border-radius: 8px;
            grid-column: span 2;
        }

        .back-button {
            display: block;
            background: #fff;
            border: 2px solid #b30000;
            color: #b30000;
            padding: 12px;
            border-radius: 8px;
            font-weight: bold;
            text-decoration: none;
            text-align: center;
            transition: all 0.3s;
            grid-column: span 2;
        }

        .back-button:hover {
            background: #b30000;
            color: #fff;
        }

        @media (max-width: 768px) {
            form {
                grid-template-columns: 1fr;
            }

            button[type="submit"],
            .alert-error,
            .back-button,
            .full-width {
                grid-column: span 1;
            }
        }
    </style>

    <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="nama">Nama</label>
            <input type="text" id="nama" name="nama" value="{{ old('nama') }}" required>
        </div>

        <div class="form-group">
            <label for="tipe">Tipe</label>
            <input type="text" id="tipe" name="tipe" value="{{ old('tipe') }}" required>
        </div>

        <div class="form-group">
            <label for="ukuran">Ukuran</label>
            <input type="text" id="ukuran" name="ukuran" value="{{ old('ukuran') }}" required>
        </div>

        <div class="form-group">
            <label for="harga">Harga</label>
            <input type="number" id="harga" name="harga" value="{{ old('harga') }}" required step="0.01">
        </div>

        <div class="form-group full-width">
            <label for="gambar">Gambar</label>
            <input type="file" id="gambar" name="gambar" accept="image/*">
        </div>

        <div class="form-group full-width">
            <label for="deskripsi">Deskripsi</label>
            <textarea id="deskripsi" name="deskripsi">{{ old('deskripsi') }}</textarea>
        </div>

        <div class="form-group">
            <label for="link_shopee">Link Shopee</label>
            <input type="url" id="link_shopee" name="link_shopee" value="{{ old('link_shopee') }}">
        </div>

        <div class="form-group">
            <label for="link_tiktok_shop">Link TikTok Shop</label>
            <input type="url" id="link_tiktok_shop" name="link_tiktok_shop" value="{{ old('link_tiktok_shop') }}">
        </div>

        <button type="submit">Simpan</button>
        <a href="{{ route('dashboard') }}" class="back-button">Kembali ke Dashboard</a>
    </form>
@endsection
