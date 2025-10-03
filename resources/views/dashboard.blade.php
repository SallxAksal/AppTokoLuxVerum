@extends('layouts.app')

@section('title', 'Dashboard - LuxVerum')

@section('content')
<div class="dashboard-header">
    <h1>Dashboard</h1>
    <div class="digital-clock-container" id="digitalClock"></div>
</div>

<style>
    /* ----------------------------------------------------------------
    * UMUM
    * ---------------------------------------------------------------- */
    .dashboard-section {
        max-width: 1201px;
        margin: 20px auto;
        background: white;
        padding: 20px;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }

    /* ----------------------------------------------------------------
    * CARD PENGUNJUNG (Dashboard Cards) - Disesuaikan untuk lebar dan tinggi
    * ---------------------------------------------------------------- */
    .dashboard-cards {
        display: flex;
        justify-content: space-between;
        gap: 20px; /* Diubah dari 1px ke 20px agar ada jarak yang jelas */
        margin: 20px auto;
        flex-wrap: wrap;
        max-width: 1245px; /* Disesuaikan agar sama dengan dashboard-section */
    }

    .dashboard-card {
        /* Lebar diatur agar 2 card dapat mengisi penuh, dikurangi gap */
        flex: 1; /* Agar card memanjang untuk mengisi sisa ruang */ 

        /* Penambahan untuk tinggi dan centering konten */
        min-height: 200px; /* Memberi tinggi minimum agar tidak terlalu pendek */
        display: flex;
        flex-direction: column;
        justify-content: center; /* Konten di tengah vertikal */
        align-items: center; /* Konten di tengah horizontal */
        
        background: white;
        padding: 50px;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        text-align: center;
    }

    .dashboard-card h2 {
        color: #000000;
        margin-bottom: 15px;
        font-size: 1.2rem;
    }

    .visitor-count {
        font-size: 1.2rem;
        font-weight: bold;
        color: #b30000;
    }

    /* ----------------------------------------------------------------
    * SLIDER PRODUK TERBARU (Latest Products) - Diubah menjadi Flexbox Slider
    * ---------------------------------------------------------------- */
    .latest-products {
        display: flex; 
        overflow-x: hidden; /* Sembunyikan horizontal scrollbar */
        scroll-behavior: smooth; /* Untuk animasi geser yang mulus */
        gap: 20px;
        padding: 10px 0;
    }

    .product-card {
        /* Disesuaikan untuk menampilkan 4 produk per tampilan slider */
        flex: 0 0 calc(25% - 15px); /* 25% lebar dikurangi sedikit untuk gap */
        min-width: 250px; /* Minimal 250px agar resolusi gambar tetap baik */
        
        border: 1.5px solid #b30000;
        border-radius: 10px;
        padding: 15px;
        text-align: center;
        background: rgb(83, 73, 73);
        box-shadow: 0 2px 8px rgba(179, 0, 0, 0.15);
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }
    .product-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 6px 16px rgba(179, 0, 0, 0.3);
    }

    .product-card img {
        max-width: 100%;
        height: 200px;
        object-fit: cover;
        border-radius: 8px;
        margin-bottom: 10px;
    }

    .product-card h3 {
        margin: 0 0 8px 0;
        color: #ffffff;
        background-color: #ff1818;
        width: 100px;
        border-radius: 6px;
        font-size: 1.1rem;
        display: inline-block; /* Agar width 100px bisa diterapkan */
    }

    .product-card .rating {
        margin-top: 8px;
        font-size: 0.9rem;
        color: #ffffff;
    }
    
    /* Tombol Navigasi Slider */
    .slider-nav {
        display: flex;
        justify-content: space-between;
        margin-top: 15px;
    }
    .slider-nav button {
        padding: 10px 20px; 
        background-color: #b30000; 
        color: white; 
        border: none; 
        border-radius: 6px; 
        cursor: pointer;
        font-weight: bold;
        transition: background-color 0.2s;
    }
    .slider-nav button:hover {
        background-color: #800000;
    }

    /* ----------------------------------------------------------------
    * TABEL RATING
    * ---------------------------------------------------------------- */
    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 15px;
    }

    th, td {
        border: 1px solid #000000;
        padding: 10px 12px;
        text-align: center;
    }

    th {
        background-color: #ff0000;
        color: white;
    }

    .star {
        color: gold;
        font-size: 1.1rem;
    }
</style>

{{-- =================================================================
-- BAGIAN PRODUK TERBARU (SLIDER)
-- ================================================================= --}}
<div class="dashboard-section">
    <h2>Produk Terbaru</h2>
    <div class="latest-products" id="productSlider">
        {{-- Loop Produk --}}
        @foreach($latestProducts as $product)
        <div class="product-card">
            @if($product->gambar)
                <img src="{{ asset('storage/' . $product->gambar) }}" alt="{{ $product->nama }}">
            @else
                <div style="height: 200px; background: #eee; display: flex; align-items: center; justify-content: center; color: #999; border-radius: 8px;">No Image</div>
            @endif
            <h3>{{ $product->nama }}</h3>
            <div class="rating">
                @for ($i = 1; $i <= 5; $i++)
                    @if ($i <= floor($product->average_rating))
                        <span class="star">&#9733;</span>
                    @else
                        <span class="star" style="color: #ccc;">&#9733;</span>
                    @endif
                @endfor
                ({{ $product->total_ratings }} rating)
            </div>
        </div>
        @endforeach
    </div>
    
    {{-- Tombol Navigasi Slider --}}
    @if(count($latestProducts) > 4)
    <div class="slider-nav">
        <button id="slider-prev">&#8592; Sebelumnya</button>
        <button id="slider-next">Selanjutnya &#8594;</button>
    </div>
    @endif
</div>

{{-- =================================================================
-- BAGIAN KARTU PENGUNJUNG
-- ================================================================= --}}
<div class="dashboard-cards">
    <div class="dashboard-card">
        <h2>Jumlah Pengunjung</h2>
        <div class="visitor-count">Total Pengunjung: {{ $visitorCount }}</div>
    </div>
    <div class="dashboard-card">
        <h2>Pengunjung Aktif/Online</h2>
        <div class="visitor-count">
            @if($onlineVisitorCount > 0)
                {{ $onlineVisitorCount }} pengunjung online
            @else
                Tidak ada pengunjung online
            @endif
        </div>
    </div>
</div>

{{-- =================================================================
-- BAGIAN TABEL RATING PRODUK
-- ================================================================= --}}
<div class="dashboard-section">
    <h2>Rating Produk</h2>
    <table>
        <thead>
            <tr>
                <th>Nama Produk</th>
                <th>Gambar</th>
                <th>Jumlah Rating</th>
                <th>Rata-rata Rating</th>
            </tr>
        </thead>
        <tbody>
            @foreach($latestProducts as $product)
            <tr>
                <td>{{ $product->nama }}</td>
                <td>
                    @if($product->gambar)
                        <img src="{{ asset('storage/' . $product->gambar) }}" alt="{{ $product->nama }}" style="max-width: 80px; border-radius: 6px;">
                    @else
                        No Image
                    @endif
                </td>
                <td>{{ $product->total_ratings }}</td>
                <td>
                    @for ($i = 1; $i <= 5; $i++)
                        @if ($i <= floor($product->average_rating))
                            <span class="star">&#9733;</span>
                        @else
                            <span class="star" style="color: #ccc;">&#9733;</span>
                        @endif
                    @endfor
                    ({{ $product->average_rating }})
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

<script>
    // FUNGSI JAM DIGITAL
    function updateClock() {
        const clockElement = document.getElementById('digitalClock');
        if (!clockElement) return; // Pastikan elemen ada
        const now = new Date();

        const days = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
        const dayName = days[now.getDay()];

        const day = now.getDate();
        const monthNames = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
        const month = monthNames[now.getMonth()];
        const year = now.getFullYear();

        const hours = now.getHours().toString().padStart(2, '0');
        const minutes = now.getMinutes().toString().padStart(2, '0');
        const seconds = now.getSeconds().toString().padStart(2, '0');

        const formattedTime = `${dayName}, ${day} ${month} ${year} ${hours}:${minutes}:${seconds}`;
        clockElement.textContent = formattedTime;
    }

    setInterval(updateClock, 1000);
    updateClock();

    // LOGIKA SLIDER PRODUK
    const slider = document.getElementById('productSlider');
    const prevButton = document.getElementById('slider-prev');
    const nextButton = document.getElementById('slider-next');
    
    // Sesuaikan nilai scroll ini berdasarkan lebar kontainer dashboard-section (1201px)
    // Nilai ini harus sama dengan lebar 4 product-card + 3 gap
    const scrollAmount = 1240; 

    if (nextButton && slider) {
        nextButton.addEventListener('click', () => {
            slider.scrollBy({
                left: scrollAmount, 
                behavior: 'smooth'
            });
        });
    }

    if (prevButton && slider) {
        prevButton.addEventListener('click', () => {
            slider.scrollBy({
                left: -scrollAmount, 
                behavior: 'smooth'
            });
        });
    }
</script>
@endsection