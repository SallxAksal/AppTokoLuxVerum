@extends('layouts.app')

@section('title', 'Daftar Produk - LuxVerum')

@section('content')
    <h1>Daftar Produk</h1>
    <a href="{{ route('product.create') }}" class="add-product-btn">Tambah Produk Baru</a>
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
            <a href="{{ route('product.show', $product->id) }}" class="btn btn-detail">Detail</a>
            <a href="{{ route('product.edit', $product->id) }}" class="btn btn-edit">Edit</a>
            <form action="{{ route('product.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus produk ini?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-delete">Hapus</button>
            </form>
        </div>
    </div>
    @endforeach
@endsection
