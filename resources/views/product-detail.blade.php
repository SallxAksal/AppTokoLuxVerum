<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $product->nama }} - LuxVerum</title>
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}" />
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #fdfdfc;
            color: #1b1b18;
            margin: 0;
            padding: 20px;
        }
        .container {
            display: flex;
            gap: 20px;
        }
        .image {
            flex: 1;
        }
        .details {
            flex: 1;
        }
        img {
            max-width: 100%;
        }
        a {
            color: blue;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="image">
            <img src="{{ asset('storage/' . $product->gambar) }}" alt="{{ $product->nama }}">
        </div>
        <div class="details">
            <h1>{{ $product->nama }}</h1>
            <p><strong>Tipe:</strong> {{ $product->tipe }}</p>
            <p><strong>Ukuran:</strong> {{ $product->ukuran }}</p>
            <p><strong>Harga:</strong> Rp {{ number_format($product->harga, 0, ',', '.') }}</p>
            <p><strong>Deskripsi:</strong> {{ $product->deskripsi }}</p>
            <p><a href="{{ $product->link_shopee }}" target="_blank">Beli di Shopee</a></p>
            <p><a href="{{ $product->link_tiktok_shop }}" target="_blank">Beli di TikTok Shop</a></p>
        </div>
    </div>
</body>
</html>
