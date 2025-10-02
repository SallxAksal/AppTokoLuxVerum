<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>website Produk - LuxVerum</title>
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}" />
    <style>
        /* Palet Warna: Merah Marun/Gagah (#b30000), Hitam (#1b1b18), Emas/Krem (#f2e2bd) */
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            
            /* PEROMBAKAN BACKGROUND: Gradien gelap (dark mode) dengan tekstur */
            background-color: #1b1b18; /* Warna dasar gelap */
            background-image: radial-gradient(circle at center, #2e2e2e 0%, #1b1b18 100%);
            color: #fdfdfc; /* Teks putih */
            margin: 0;
            padding: 0; /* Hapus padding pada body, pindahkan ke main-content */
            min-height: 100vh;
        }

        /* Kontainer Utama */
        .main-container {
            max-width: 1200px;
            margin: 0px auto; /* Centering */
            padding: 40px 20px; /* Padding lebih besar di dalam */
        }

        h1 {
            text-align: center;
            /* Perkuat warna header */
            color: #ff3333; 
            text-shadow: 0 0 10px rgba(179, 0, 0, 0.5); /* Efek cahaya pada judul */
            margin-bottom: 40px;
            font-size: 2.5rem;
            letter-spacing: 2px;
        }

        .products {
            display: flex;
            flex-wrap: wrap;
            gap: 30px; /* Gap lebih besar untuk bernapas */
            justify-content: center;
        }

        .product-card {
            /* Perombakan Card: Tampilan gelap dan premium */
            border: 2px solid #b30000;
            border-radius: 15px;
            padding: 20px; /* Padding lebih besar */
            width: 250px; /* Lebar lebih besar */
            text-align: center;
            /* Shadow merah yang lebih halus */
            box-shadow: 0 6px 20px rgba(179, 0, 0, 0.5); 
            cursor: pointer;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            background: #2e2e2e; /* Background card gelap */
            color: #fdfdfc; /* Teks card putih */
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .product-card:hover {
            transform: translateY(-5px); /* Efek melayang saat hover */
            box-shadow: 0 12px 30px rgba(255, 51, 51, 0.7); /* Shadow hover lebih kuat */
        }

        .product-card img {
            max-width: 100%;
            height: 180px; /* Tinggi gambar ditingkatkan */
            object-fit: cover;
            border-radius: 12px;
            margin-bottom: 15px;
            border: 2px solid #b30000; /* Border merah di sekitar gambar */
        }
        .product-card h3 {
            margin: 0 0 10px 0;
            color: #fdfdfc; /* Nama produk putih */
            background-color: #b30000; /* Background nama produk merah */
            padding: 5px 0;
            border-radius: 5px;
            font-size: 1.3rem;
            letter-spacing: 1px;
        }
        .product-card p {
            font-weight: 500;
            font-size: 1rem;
            margin: 5px 0;
            color: #f2e2bd; /* Warna krem untuk detail */
        }
        
        /* Tombol Detail */
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

        /* Rating Stars (untuk modal) */
        .rating-stars {
            color: gold;
            font-size: 1.1rem;
            margin-bottom: 10px;
        }
        .rating-stars .star {
            cursor: pointer;
            transition: color 0.3s ease;
        }
        .rating-stars .star:hover,
        .rating-stars .star.hovered {
            color: #ffb400;
        }
    </style>
</head>
<body>
    <div class="main-container">
        <h1>Website Produk Luxverum</h1>
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
        const products = @json($products);

        document.querySelectorAll('.product-card .btn-detail').forEach(button => {
            button.addEventListener('click', () => {
                const productCard = button.closest('.product-card');
                const productId = productCard.getAttribute('data-id');
                const product = products.find(p => p.id == productId);

                // Buat modal preview sederhana
                const modal = document.createElement('div');
                modal.style.position = 'fixed';
                modal.style.top = '50%';
                modal.style.left = '50%';
                modal.style.transform = 'translate(-50%, -50%)';
                
                // Style modal agar sesuai dengan tema gelap
                modal.style.background = '#3c3c3c'; 
                modal.style.color = '#fdfdfc';
                modal.style.padding = '25px';
                modal.style.borderRadius = '15px';
                modal.style.boxShadow = '0 10px 30px rgba(255, 51, 51, 0.9)'; /* Shadow yang lebih mencolok */
                modal.style.zIndex = '1000';
                modal.style.maxWidth = '350px'; /* Modal lebih besar */
                modal.style.width = '90%';
                modal.style.maxHeight = '85vh';
                modal.style.overflowY = 'auto';

                // Konten modal
                modal.innerHTML = `
                    <button id="closeModal" style="float:right; font-size: 2rem; font-weight: bold; color: #ff3333; border:none; background:none; cursor:pointer;">&times;</button>
                    <img src="${product.gambar ? '/storage/' + product.gambar : ''}" alt="${product.nama}" style="max-width: 100%; max-height: 250px; object-fit: contain; border-radius: 10px; margin-bottom: 20px; display: block; margin-left: auto; margin-right: auto; border: 1px solid #ff3333;">
                    <h2 style="color:#fdfdfc; text-align:center; background-color:#b30000; padding: 10px; border-radius: 10px; margin-top: 0;">${product.nama}</h2>
                    <p><strong>Harga:</strong> <span style="color: gold;">Rp ${product.harga ? product.harga.toLocaleString('id-ID') : 'N/A'}</span></p>
                    <p><strong>Tipe:</strong> ${product.tipe}</p>
                    <p><strong>Ukuran:</strong> ${product.ukuran}</p>
                    <p style="margin-top: 15px;"><strong>Deskripsi:</strong> ${product.deskripsi || 'Tidak ada deskripsi.'}</p>
                    <div class="rating-stars" id="modalRatingStars" style="margin-top: 20px; border-top: 1px solid #555; padding-top: 15px;">
                        <span style="color: #f2e2bd; font-weight: bold; font-size: 1.1rem; margin-right: 8px;">Berikan rating:</span>
                        ${[1,2,3,4,5].map(i => `<span class="star" data-value="${i}" style="font-size: 1.8rem;">&#9733;</span>`).join('')}
                    </div>
                    <button id="submitRating" style="margin-top: 20px; background-color: #b30000; color: white; border: none; padding: 12px 25px; border-radius: 8px; cursor: pointer; width: 100%; font-weight: bold;">Submit Rating</button>
                `;

                // Overlay
                const overlay = document.createElement('div');
                overlay.id = 'modalOverlay';
                overlay.style.position = 'fixed';
                overlay.style.top = 0;
                overlay.style.left = 0;
                overlay.style.width = '100%';
                overlay.style.height = '100%';
                overlay.style.backgroundColor = 'rgba(0, 0, 0, 0.8)'; // Overlay gelap
                overlay.style.zIndex = '999';
                document.body.appendChild(overlay);
                
                document.body.appendChild(modal);

                const closeModal = () => {
                    document.body.removeChild(modal);
                    document.body.removeChild(overlay);
                };

                const closeModalBtn = document.getElementById('closeModal');
                const modalRatingStars = document.getElementById('modalRatingStars');
                const submitRatingBtn = document.getElementById('submitRating');

                let selectedRating = 0;

                // Set initial star colors to gray (0 rating)
                modalRatingStars.querySelectorAll('.star').forEach(star => {
                    star.style.color = '#777';
                });

                // Event close modal
                closeModalBtn.addEventListener('click', closeModal);
                overlay.addEventListener('click', closeModal); // Tutup saat klik overlay

                // Hover dan click rating stars
                modalRatingStars.querySelectorAll('.star').forEach(star => {
                    star.addEventListener('mouseenter', () => {
                        const val = parseInt(star.getAttribute('data-value'));
                        modalRatingStars.querySelectorAll('.star').forEach(s => {
                            s.style.color = s.getAttribute('data-value') <= val ? '#ffb400' : '#777';
                        });
                    });
                    star.addEventListener('mouseleave', () => {
                        modalRatingStars.querySelectorAll('.star').forEach(s => {
                            s.style.color = s.getAttribute('data-value') <= selectedRating ? '#ffb400' : '#777';
                        });
                    });
                    star.addEventListener('click', () => {
                        selectedRating = parseInt(star.getAttribute('data-value'));
                    });
                });

                // Submit rating
                submitRatingBtn.addEventListener('click', () => {
                    if (selectedRating === 0) {
                        alert('Silakan pilih rating terlebih dahulu.');
                        return;
                    }
                    fetch('/rate-product', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            product_id: productId,
                            rating: selectedRating
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        alert(data.message);
                        closeModal();
                    })
                    .catch(error => {
                        alert('Terjadi kesalahan saat mengirim rating.');
                    });
                });
            });
        });
    </script>
</body>
</html>