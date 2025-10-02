<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>website Produk - LuxVerum</title>
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}" />
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
            color: #b30000;
            margin-bottom: 20px;
        }
        .products {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
        }
        .product-card {
            border: 2px solid #b30000;
            border-radius: 12px;
            padding: 15px;
            width: 220px;
            text-align: center;
            box-shadow: 0 4px 12px rgba(179, 0, 0, 0.3);
            cursor: pointer;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            background: white;
        }
        .product-card:hover {
            box-shadow: 0 8px 24px rgba(179, 0, 0, 0.5);
        }
        .product-card img {
            max-width: 100%;
            height: 160px;
            object-fit: cover;
            border-radius: 10px;
            margin-bottom: 10px;
        }
        .product-card h3 {
            margin: 0 0 10px 0;
            color: #b30000;
            font-size: 1.2rem;
        }
        .product-card p {
            font-weight: bold;
            font-size: 1.1rem;
            margin: 0 0 10px 0;
        }
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
    <h1>Website Produk</h1>
    <div class="products">
        @foreach($products as $product)
            <div class="product-card" data-id="{{ $product->id }}">
                <img src="{{ asset('storage/' . $product->gambar) }}" alt="{{ $product->nama }}">
                <h3>{{ $product->nama }}</h3>
                <p><strong>Tipe:</strong> {{ $product->tipe }}</p>
                <p><strong>Ukuran:</strong> {{ $product->ukuran }}</p>
                <button class="btn-detail" type="button">Detail</button>
            </div>
        @endforeach
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
                modal.style.background = 'white';
                modal.style.padding = '20px';
                modal.style.borderRadius = '12px';
                modal.style.boxShadow = '0 8px 24px rgba(0,0,0,0.3)';
                modal.style.zIndex = '1000';
                modal.style.maxWidth = '300px';
                modal.style.width = '100%';
                modal.style.maxHeight = '80vh';
                modal.style.overflowY = 'auto';

                // Konten modal
                modal.innerHTML = `
                    <button id="closeModal" style="float:right; font-size: 1.5rem; font-weight: bold; color: #b30000; border:none; background:none; cursor:pointer;">&times;</button>
                    <img src="${product.gambar ? '/storage/' + product.gambar : ''}" alt="${product.nama}" style="max-width: 100%; max-height: 200px; object-fit: contain; border-radius: 10px; margin-bottom: 15px; display: block; margin-left: auto; margin-right: auto;">
                    <h2 style="color:#b30000; text-align:center; background-color:black; color:white; border-radius: 9px;">${product.nama}</h2>
                    <p><strong>Harga:</strong> Rp ${product.harga.toLocaleString('id-ID')}</p>
                    <p><strong>Tipe:</strong> ${product.tipe}</p>
                    <p><strong>Ukuran:</strong> ${product.ukuran}</p>
                <p><strong>Deskripsi:</strong> ${product.deskripsi || 'Tidak ada deskripsi.'}</p>
                <div class="rating-stars" id="modalRatingStars" style="color: #555; font-weight: bold; font-size: 1.8rem;">
                    <span style="color: #555; font-weight: bold; font-size: 1.2rem; margin-right: 8px;">Berikan rating:</span>
                    ${[1,2,3,4,5].map(i => `<span class="star" data-value="${i}">&#9733;</span>`).join('')}
                </div>
                <button id="submitRating" style="margin-top: 10px; background-color: #b30000; color: white; border: none; padding: 10px 20px; border-radius: 8px; cursor: pointer;">Submit Rating</button>
            `;

                document.body.appendChild(modal);

                const closeModalBtn = document.getElementById('closeModal');
                const modalRatingStars = document.getElementById('modalRatingStars');
                const submitRatingBtn = document.getElementById('submitRating');

                let selectedRating = 0;

                // Set initial star colors to gray (0 rating)
                modalRatingStars.querySelectorAll('.star').forEach(star => {
                    star.style.color = '#ccc';
                });

                // Event close modal
                closeModalBtn.addEventListener('click', () => {
                    document.body.removeChild(modal);
                });

                // Hover dan click rating stars
                modalRatingStars.querySelectorAll('.star').forEach(star => {
                    star.addEventListener('mouseenter', () => {
                        const val = parseInt(star.getAttribute('data-value'));
                        modalRatingStars.querySelectorAll('.star').forEach(s => {
                            s.style.color = s.getAttribute('data-value') <= val ? '#ffb400' : '#ccc';
                        });
                    });
                    star.addEventListener('mouseleave', () => {
                        modalRatingStars.querySelectorAll('.star').forEach(s => {
                            s.style.color = s.getAttribute('data-value') <= selectedRating ? '#ffb400' : '#ccc';
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
                        document.body.removeChild(modal);
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
