<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Website Produk - LuxVerum</title>
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}" />
    <style>
        /* ==================== GLOBAL & LAYOUT ==================== */
        body {
            font-family: 'Poppins', sans-serif; 
            background-color: #121212;
            background-image: radial-gradient(
                circle at top, 
                #333333 0%, 
                #AA0000 35%, 
                #121212 70%
            );
            background-attachment: fixed;
            color: #E0E0E0; 
            margin: 0;
            padding: 0;
            min-height: 100vh;
            line-height: 1.6;
        }
        .main-container {
            max-width: 1300px; 
            margin: 0 auto;
            padding: 40px 20px;
        }

        /* ==================== HEADER & TITLE ==================== */
        .header-logo {
            display: block;
            margin: 0 auto 15px auto;
            width: 120px; 
            height: auto;
            filter: drop-shadow(0 0 10px rgba(255, 51, 51, 0.7));
        }
        h1 {
            text-align: center;
            color: #ffffff; 
            text-shadow: 0 0 20px rgba(255, 68, 68, 0.9);
            margin-bottom: 50px;
            font-size: 2.8rem;
            letter-spacing: 5px;
            text-transform: uppercase;
            font-weight: 700;
        }

        /* ==================== BANNER SLIDER ==================== */
        .banner-slider-container {
            position: relative;
            overflow: hidden;
            max-width: 100%;
            margin-bottom: 60px;
            border-radius: 18px; 
            box-shadow: 0 10px 40px rgba(179, 0, 0, 0.75); 
            background: #0d0d0d;
            aspect-ratio: 16 / 5;
        }
        .banner-slider {
            display: flex;
            transition: transform 0.6s cubic-bezier(0.25, 0.46, 0.45, 0.94);
            width: 100%;
            height: 100%;
        }
        .banner-slider img {
            flex: 0 0 100%;
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 18px;
            display: block;
        }
        .slider-dots {
            position: absolute;
            bottom: 20px;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            gap: 12px;
            z-index: 10;
        }
        .dot {
            height: 10px;
            width: 10px;
            background-color: rgba(255, 255, 255, 0.4);
            border-radius: 50%;
            cursor: pointer;
            transition: background-color 0.3s, transform 0.3s, width 0.3s;
            border: 2px solid rgba(0, 0, 0, 0.2);
        }
        .dot.active {
            background-color: #FF4444; 
            transform: scale(1.4);
            width: 25px; 
            border-radius: 5px;
        }

        /* ==================== PRODUCTS GRID ==================== */
        .products {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); 
            gap: 40px; 
            padding: 20px 0;
        }
        .product-card {
            border: 1px solid #FF4444;
            border-radius: 15px;
            text-align: center;
            box-shadow: 0 8px 30px rgba(179, 0, 0, 0.6); 
            cursor: pointer;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            background: #1e1e1e; 
            transition: transform 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275), box-shadow 0.4s ease;
            overflow: hidden; 
        }
        .product-card:hover {
            transform: translateY(-10px) scale(1.02); 
            box-shadow: 0 20px 50px rgba(255, 68, 68, 0.9), 0 0 0 5px rgba(255, 68, 68, 0.3); 
            border-color: #FF4444;
        }

        .product-image-container {
            height: 250px; 
            overflow: hidden;
            border-bottom: 2px solid #FF4444; 
        }
        .product-card img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.6s ease;
        }
        .product-card:hover img {
            transform: scale(1.1); 
        }

        .product-info {
            padding: 20px 25px 25px 25px;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .product-card h3 {
            margin: 0 0 15px 0;
            color: #FFFFFF;
            background-color: #AA0000; 
            padding: 12px 0;
            border-radius: 8px;
            font-size: 1.6rem;
            letter-spacing: 1.5px;
            text-transform: uppercase;
        }
        .product-card p {
            font-weight: 500;
            font-size: 1.05rem;
            margin: 8px 0;
            color: #FFDD99; 
        }
        .product-card p strong {
            color: #FF4444; 
        }

        /* ==================== DETAIL BUTTON ==================== */
        .btn-detail {
            background-color: #FF4444;
            color: #121212; 
            border: none;
            padding: 12px 25px;
            border-radius: 10px;
            font-size: 1.15rem;
            font-weight: 700;
            cursor: pointer;
            margin-top: 20px;
            transition: background-color 0.2s, transform 0.2s, box-shadow 0.2s;
            letter-spacing: 1px;
            width: 100%;
        }
        .btn-detail:hover {
            background-color: #FF6666;
            transform: translateY(-4px);
            box-shadow: 0 8px 15px rgba(255, 68, 68, 0.7);
        }

        /* ==================== MEDIA QUERIES (Responsiveness) ==================== */
        @media (max-width: 1200px) {
            h1 {
                font-size: 2.3rem;
            }
            .products {
                gap: 30px;
            }
        }

        @media (max-width: 900px) {
            .products {
                grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
                gap: 25px;
            }
            .product-card h3 {
                font-size: 1.4rem;
            }
            .btn-detail {
                font-size: 1rem;
                padding: 10px 20px;
            }
        }

        @media (max-width: 768px) {
            .banner-slider-container {
                aspect-ratio: 4 / 3;
                margin-bottom: 40px;
            }
            h1 {
                font-size: 2rem;
                letter-spacing: 3px;
            }
            .product-info {
                padding: 15px;
            }
        }

        @media (max-width: 576px) {
            .main-container {
                padding: 15px 10px;
            }
            .banner-slider-container {
                aspect-ratio: 1 / 1;
            }
            h1 {
                font-size: 1.6rem;
                letter-spacing: 1px;
                margin-bottom: 25px;
            }
            .products {
                grid-template-columns: 1fr;
                gap: 20px;
            }
            .product-card {
                border-radius: 12px;
            }
            .product-card h3 {
                font-size: 1.2rem;
                padding: 10px 0;
            }
            .product-card p {
                font-size: 0.95rem;
            }
            .btn-detail {
                font-size: 0.95rem;
                padding: 10px;
            }
            .slider-dots {
                bottom: 10px;
                gap: 8px;
            }
            .dot {
                height: 8px;
                width: 8px;
            }
        }
    </style>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700&display=swap" rel="stylesheet">
</head>
<body>
<div class="main-container">
    <img class="header-logo" src="{{ asset('image/LX-luxverum.png') }}" alt="Logo LuxVerum">
    <h1>Katalog Produk Eksklusif</h1>

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
                <div class="product-image-container">
                    <img src="{{ asset('storage/' . $product->gambar) }}" alt="{{ $product->nama }}">
                </div>
                <div class="product-info">
                    <div>
                        <h3>{{ $product->nama }}</h3>
                        <p><strong>Tipe:</strong> {{ $product->tipe }}</p>
                        <p><strong>Ukuran:</strong> {{ $product->ukuran }}</p>
                    </div>
                    <button class="btn-detail" type="button">LIHAT DETAIL</button>
                </div>
            </div>
        @endforeach
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // ==================== SLIDER LOGIC ====================
    const slider = document.querySelector('.banner-slider');
    const images = document.querySelectorAll('.slider-image');
    const dots = document.querySelectorAll('.dot');
    let currentIndex = 0;

    function updateSlider() {
        if (slider) {
            slider.style.transform = `translateX(-${currentIndex * 100}%)`;
        }
        dots.forEach((dot, i) => dot.classList.toggle('active', i === currentIndex));
    }

    function nextSlide() {
        currentIndex = (currentIndex + 1) % images.length;
        updateSlider();
    }

    // Autoplay slider every 5 seconds
    if (images.length > 1) { 
        updateSlider();
        setInterval(nextSlide, 5000);
    } else if (images.length === 1) {
        dots.forEach((dot, i) => dot.classList.toggle('active', i === 0));
    }

    // Manual dot click
    dots.forEach((dot, i) => dot.addEventListener('click', () => {
        currentIndex = i;
        updateSlider();
    }));
    
    // ==================== PRODUCT CARD DETAIL ====================
    document.querySelectorAll('.btn-detail').forEach(button => {
        button.addEventListener('click', (e) => {
            const card = e.target.closest('.product-card');
            const productId = card.getAttribute('data-id');
            
            // Arahkan ke halaman detail (Laravel route)
            window.location.href = `/produk/${productId}`;
        });
    });
});
</script>
</body>
</html>
