<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Katalog Produk - LuxVerum</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #fdfdfc;
            color: #1b1b18;
            margin: 0;
            padding: 20px;
        }
        h1 {
            text-align: center;
        }
        .products {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
        }
        .product-card {
            border: 1px solid #ddd;
            padding: 10px;
            width: 200px;
            text-align: center;
        }
        .product-card img {
            max-width: 100%;
            height: 150px;
            object-fit: cover;
        }
        .product-card button {
            margin-top: 10px;
            padding: 5px 10px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <h1>Katalog Produk</h1>
    <div class="products">
        @foreach($products as $product)
            <div class="product-card">
                <img src="{{ asset('storage/' . $product->gambar) }}" alt="{{ $product->nama }}">
                <h3>{{ $product->nama }}</h3>
                <p>Rp {{ number_format($product->harga, 0, ',', '.') }}</p>
                <button onclick="window.location.href='/produk/{{ $product->id }}'">Detail</button>
            </div>
        @endforeach
    </div>
</body>
</html>
