@extends('layouts.app')

@section('title', 'Tambah Produk - LuxVerum')

@section('content')
<img src="{{ asset('image/LX-luxverum.png') }}" alt="Logo LuxVerum" style="width:150px; height:auto;">
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
        background: #ffffff;
        margin: 0;
        padding: 0;
    }

    h1 {
        color: #b30000;
        text-align: center;
        margin-bottom: 25px;
    }

    form {
        max-width: 900px;
        margin: 30px auto;    padding: 25px 30px;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        display: grid;
        gap: 20px;
    }

    .form-group {
        display: flex;
        flex-direction: column;
    }

    .form-group label {
        font-weight: bold;
        margin-bottom: 6px;
        color: #333;
    }

    .form-group input,
    .form-group textarea {
        padding: 10px;
        border: 1.5px solid #ff8383;
        border-radius: 8px;
        font-size: 15px;
        transition: all 0.3s ease;
    }

    .form-group input:focus,
    .form-group textarea:focus {
        border-color: #b30000;
        box-shadow: 0 0 6px rgba(179, 0, 0, 0.3);
        outline: none;
    }

    textarea {
        resize: vertical;
        min-height: 100px;
    }

    button[type="submit"] {
        background: #b30000;
        color: #fff;
        border: none;
        padding: 14px 20px;
        border-radius: 8px;
        cursor: pointer;
        font-size: 16px;
        font-weight: bold;
        transition: background 0.3s ease;
        grid-column: span 2;
    }

    button[type="submit"]:hover {
        background: #8a0000;
    }

    .alert-error {
        background: #ffe5e5;
        border: 1px solid #ff9b9b;
        color: #a10000;
        padding: 12px;
        border-radius: 8px;
        grid-column: span 2;
    }

    a {
        display: inline-block;
        margin-top: 10px;
        color: #b30000;
        text-decoration: none;
        font-weight: bold;
    }

    a:hover {
        text-decoration: underline;
    }

    img {
        display: block;
        margin: 20px auto;
    }

    /* Layout grid untuk desktop */
    form {
        grid-template-columns: 1fr 1fr;
    }

    .full-width {
        grid-column: span 2;
    }

    /* Responsif untuk HP/tablet */
    @media (max-width: 768px) {
        form {
            grid-template-columns: 1fr;
        }

        button[type="submit"],
        .alert-error,
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
        <a href="{{ route('dashboard') }}" style="display: inline-block; background: #fff ;border: 2px solid #b30000; color: #b30000; padding: 10px 18px; border-radius: 8px;font-weight: bold; text-decoration: none; text-align: center; margin-top: 15px; transition: all 0.3s; width: 300px;">Kembali ke Dashboard</a>
    </form>
   
@endsection
