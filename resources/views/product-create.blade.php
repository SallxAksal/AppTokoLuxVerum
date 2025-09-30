<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Tambah Produk - LuxVerum</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #fdfdfc;
            color: #1b1b18;
            margin: 0;
            padding: 20px;
        }
        form {
            max-width: 500px;
            margin: auto;
            display: flex;
            flex-direction: column;
            gap: 10px;
        }
        label {
            font-weight: bold;
        }
        input[type="text"],
        input[type="number"],
        input[type="url"],
        textarea {
            padding: 8px;
            font-size: 16px;
            width: 100%;
            box-sizing: border-box;
        }
        button {
            padding: 10px;
            font-size: 16px;
            cursor: pointer;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
        }
        .error {
            color: red;
            font-size: 14px;
        }
        a {
            display: block;
            text-align: center;
            margin-top: 20px;
            color: blue;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <h1>Tambah Produk Baru</h1>
    @if ($errors->any())
        <div class="error">
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
</body>
</html>
