@extends('layouts.app')

@section('title', 'Daftar Produk - LuxVerum')

@section('content')
<style>
    .product-container {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 20px;
        padding: 10px 0;
    }
    .product-card {
        background-color: #fff;
        border: 2px solid #b30000;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(179, 0, 0, 0.3);
        overflow: hidden;
        display: flex;
        flex-direction: column;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .product-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 12px 24px rgba(179, 0, 0, 0.5);
    }
    .product-image {
        width: 100%;
        height: 180px;
        object-fit: cover;
        border-bottom: 2px solid #b30000;
    }
    .product-info {
        padding: 15px;
        flex-grow: 1;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }
    .product-info h2 {
        margin: 0 0 10px 0;
        color: #ffffff;
        font-size: 1.3rem;
        font-weight: 700;
        text-align: center;
        background-color: #000000;
        border-radius: 8px;
    }
    .product-info p {
        margin: 4px 0;
        color: #333;
        font-size: 1rem;
    }
    .product-actions {
        display: flex;
        gap: 10px;
        padding: 15px;
        border-top: 2px solid #b30000;
    }
    .product-actions a,
    .product-actions form button {
        flex: 1;
        padding: 10px 0;
        border-radius: 8px;
        font-weight: 600;
        font-size: 1rem;
        text-align: center;
        cursor: pointer;
        transition: background-color 0.3s ease;
        border: none;
        color: white;
        text-decoration: none;
        user-select: none;
    }
    .product-actions a.btn-detail {
        background-color: #b30000;
    }
    .product-actions a.btn-detail:hover {
        background-color: #7a0000;
    }
    .product-actions a.btn-edit {
        background-color: #007bff;
        width: 100px;
    }
    .product-actions a.btn-edit:hover {
        background-color: #0056b3;
    }
    .product-actions form button.btn-delete {
        background-color: #dc3545;
        width: 100px;
    }
    .product-actions form button.btn-delete:hover {
        background-color: #a71d2a;
    }
    .add-product-btn {
        display: inline-block;
        margin-bottom: 20px;
        padding: 10px 20px;
        background-color: #b30000;
        color: white;
        border-radius: 8px;
        font-weight: 700;
        text-decoration: none;
        transition: background-color 0.3s ease;
    }
    .add-product-btn:hover {
        background-color: #7a0000;
    }
</style>

<h1 style="text-align: center; background-color:#ff0000;padding:10px; color:#fff; border-radius:8px;">Daftar Produk</h1>
<div class="product-container">
    @foreach($products as $product)
    <div class="product-card">
        @if($product->gambar)
            <img src="{{ asset('storage/' . $product->gambar) }}" alt="{{ $product->nama }}" class="product-image" />
        @else
            <div class="product-image" style="display:flex; align-items:center; justify-content:center; background:#eee; color:#999;">No Image</div>
        @endif
        <div class="product-info">
            <h2>{{ $product->nama }}</h2>
            <p>Tipe: {{ $product->tipe }}</p>
            <p>Ukuran: {{ $product->ukuran }}</p>
            <p>Harga: Rp {{ number_format($product->harga, 0, ',', '.') }}</p>
        </div>
        <div class="product-actions">
            <a href="{{ route('product.show', $product->id) }}" class="btn-detail">Detail</a>
            <a href="{{ route('product.edit', $product->id) }}" class="btn-edit">Edit</a>
            <form action="{{ route('product.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus produk ini?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn-delete">Hapus</button>
            </form>
        </div>
    </div>
    @endforeach
</div>
@endsection
