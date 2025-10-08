<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $product->nama }} - LuxVerum</title>
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}" />
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #121212;
            color: #E0E0E0;
            margin: 0;
            padding: 20px;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            gap: 40px;
            align-items: flex-start;
            background: #1e1e1e;
            border-radius: 16px;
            padding: 30px;
            box-shadow: 0 10px 30px rgba(179,0,0,0.6);
        }

        .image {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .image img {
            max-width: 100%;
            height: auto;
            border-radius: 12px;
            border: 2px solid #FF4444;
            box-shadow: 0 6px 20px rgba(255,68,68,0.6);
        }

        .details {
            flex: 1;
        }

        .details h1 {
            margin-top: 0;
            color: #FF4444;
            font-size: 2rem;
            margin-bottom: 15px;
        }

        .details p {
            margin: 8px 0;
            font-size: 1.1rem;
            line-height: 1.5;
        }

        .details strong {
            color: #ffffff;
        }

        .btn-group {
            margin-top: 20px;
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }

        .btn-link, .btn-back {
            display: inline-block;
            background: #FF4444;
            color: #121212;
            padding: 10px 18px;
            border-radius: 8px;
            font-weight: 600;
            text-decoration: none;
            transition: 0.3s;
            text-align: center;
            min-width: 120px;
        }

        .btn-link:hover, .btn-back:hover {
            background: #ff2222;
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(255,68,68,0.6);
        }

        /* 📱 Responsif untuk tablet dan HP */
        @media (max-width: 992px) {
            .container {
                flex-direction: column;
                gap: 20px;
                padding: 20px;
            }

            .details h1 {
                font-size: 1.8rem;
                text-align: center;
            }

            .details p {
                font-size: 1rem;
            }

            .btn-group {
                justify-content: center;
            }
        }

        @media (max-width: 576px) {
            body {
                padding: 10px;
            }

            .container {
                padding: 15px;
                gap: 15px;
            }

            .details h1 {
                font-size: 1.5rem;
            }

            .btn-link, .btn-back {
                flex: 1 1 100%;
                min-width: unset;
            }
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

            <div class="btn-group">
                @if($product->link_shopee)
                    <a href="{{ $product->link_shopee }}" class="btn-link" target="_blank">Beli di Shopee</a>
                @endif
                @if($product->link_tiktok_shop)
                    <a href="{{ $product->link_tiktok_shop }}" class="btn-link" target="_blank">Beli di TikTok Shop</a>
                @endif
                <a href="{{ url()->previous() }}" class="btn-back">⬅ Kembali</a>
            </div>
        </div>
    </div>
</body>
</html>
