<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Website Produk - LuxVerum</title>
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}" />
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #1b1b18;
            background-image: radial-gradient(circle at center, #2e2e2e 0%, #1b1b18 100%);
            color: #fdfdfc;
            margin: 0;
            padding: 0;
            min-height: 100vh;
        }
        .main-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 40px 20px;
        }
        .header-logo {
            display: block;
            margin: 0 auto 20px auto;
            width: 150px;
            height: auto;
        }
        h1 {
            text-align: center;
            color: #ff3333; 
            text-shadow: 0 0 15px rgba(255, 51, 51, 0.7);
            margin-bottom: 40px;
            font-size: 2.5rem;
            letter-spacing: 3px;
            text-transform: uppercase;
        }

        /* --- BANNER SLIDER --- */
        .banner-slider-container {
            position: relative;
            overflow: hidden;
            max-width: 100%;
            margin-bottom: 30px;
            border-radius: 15px;
            box-shadow: 0 4px 20px rgba(179, 0, 0, 0.7);
            background: #1b1b18;
        }
        .banner-slider {
            display: flex;
            transition: transform 0.5s ease-in-out;
            width: 100%;
        }
        .banner-slider img {
            flex: 0 0 100%;
            width: 100%;
            height: auto;
            max-height: 400px;
            object-fit: cover;
            border-radius: 12px;
        }
        .slider-dots {
            position: absolute;
            bottom: 10px;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            gap: 8px;
            z-index: 10;
        }
        .dot {
            height: 10px;
            width: 10px;
            background-color: rgba(242, 226, 189, 0.5);
            border-radius: 50%;
            cursor: pointer;
            transition: background-color 0.3s, transform 0.3s;
        }
        .dot.active {
            background-color: #f2e2bd;
            transform: scale(1.2);
        }

        /* --- PRODUK (saya biarkan sama, tidak dihapus) --- */
        .products {
            display: flex;
            flex-wrap: wrap;
            gap: 30px;
            justify-content: center;
        }
        .product-card {
            border: 2px solid #b30000;
            border-radius: 15px;
            padding: 20px;
            width: 250px;
            text-align: center;
            box-shadow: 0 6px 20px rgba(179, 0, 0, 0.5); 
            cursor: pointer;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            background: #2e2e2e;
            color: #fdfdfc;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 30px rgba(255, 51, 51, 0.8);
        }
        .product-card img {
            width: 100%;
            height: 180px;
            object-fit: cover;
            border-radius: 12px;
            margin-bottom: 15px;
            border: 2px solid #b30000;
        }
        .product-card h3 {
            margin: 0 0 10px 0;
            color: #fdfdfc;
            background-color: #b30000;
            padding: 8px 0;
            border-radius: 5px;
            font-size: 1.4rem;
            letter-spacing: 1px;
        }
        .product-card p {
            font-weight: 500;
            font-size: 1rem;
            margin: 5px 0;
            color: #f2e2bd;
        }
        .btn-detail {
            background-color: #b30000;
            color: white;
            border: none;
            padding: 10px 25px;
            border-radius: 8px;
            font-size: 1rem;
            font-weight: bold;
            cursor: pointer;
            margin-top: 15px;
            transition: background-color 0.2s, transform 0.1s;
        }
        .btn-detail:hover {
            background-color: #ff3333;
            transform: translateY(-2px);
        }
    </style>
</head>
<body>
<div class="main-container">
    <img class="header-logo" src="{{ asset('image/LX-luxverum.png') }}" alt="Logo LuxVerum">
    <h1>Website Produk Luxverum</h1>

    @if(isset($banners) && $banners->count() > 0)
    <div class="banner-slider-container">
        <div class="banner-slider">
            @foreach($banners as $banner)
                <img class="slider-image" src="{{ asset('storage/' . $banner->image_path) }}" alt="Banner {{ $banner->id }}">
            @endforeach
        </div>
        <div class="slider-dots">
            @for($i = 0; $i < $banners->count(); $i++)
                <span class="dot" data-slide-index="{{ $i }}"></span>
            @endfor
        </div>
    </div>
    @endif

    <div class="products">
        @foreach($products as $product)
            <div class="product-card" data-id="{{ $product->id }}">
                <div>
                    <img src="{{ asset('storage/' . $product->gambar) }}" alt="{{ $product->nama }}">
                    <h3>{{ $product->nama }}</h3>
                    <p><strong>Tipe:</strong> {{ $product->tipe }}</p>
                    <p><strong>Ukuran:</strong> {{ $product->ukuran }}</p>
                </div>
                <button class="btn-detail" type="button">Detail</button>
            </div>
        @endforeach
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // ==================== SLIDER ====================
    const slider = document.querySelector('.banner-slider');
    const images = document.querySelectorAll('.slider-image');
    const dots = document.querySelectorAll('.dot');
    let currentIndex = 0;

    function updateSlider() {
        slider.style.transform = `translateX(-${currentIndex * 100}%)`;
        dots.forEach((dot, i) => dot.classList.toggle('active', i === currentIndex));
    }
    function nextSlide() {
        currentIndex = (currentIndex + 1) % images.length;
        updateSlider();
    }

    // autoplay setiap 5 detik
    if (images.length > 0) {
        updateSlider();
        setInterval(nextSlide, 5000);
    }

    // klik dot manual
    dots.forEach((dot, i) => dot.addEventListener('click', () => {
        currentIndex = i;
        updateSlider();
    }));
});
</script>
</body>
</html>
