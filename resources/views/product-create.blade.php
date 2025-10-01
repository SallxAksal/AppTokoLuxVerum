@extends('layouts.app')

@section('title', 'Tambah Produk - LuxVerum')

@section('content')
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
    <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <label for="nama">Nama</label>
        <input type="text" id="nama" name="nama" value="{{ old('nama') }}" required>

        <label for="tipe">Tipe</label>
        <input type="text" id="tipe" name="tipe" value="{{ old('tipe') }}" required>

        <label for="ukuran">Ukuran</label>
        <input type="text" id="ukuran" name="ukuran" value="{{ old('ukuran') }}" required>

        <label for="harga">Harga</label>
        <input type="number" id="harga" name="harga" value="{{ old('harga') }}" required step="0.01">

        <label for="gambar">Gambar</label>
        <input type="file" id="gambar" name="gambar" accept="image/*">

        <label for="deskripsi">Deskripsi</label>
        <textarea id="deskripsi" name="deskripsi">{{ old('deskripsi') }}</textarea>

        <label for="link_shopee">Link Shopee</label>
        <input type="url" id="link_shopee" name="link_shopee" value="{{ old('link_shopee') }}">

        <label for="link_tiktok_shop">Link TikTok Shop</label>
        <input type="url" id="link_tiktok_shop" name="link_tiktok_shop" value="{{ old('link_tiktok_shop') }}">

        <button type="submit">Simpan</button>
    </form>
    <a href="{{ route('dashboard') }}">Kembali ke Dashboard</a>
@endsection
