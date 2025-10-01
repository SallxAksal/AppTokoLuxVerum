@extends('layouts.app')

@section('title', 'Daftar Produk - LuxVerum')

@section('content')
    <h1>Daftar Produk</h1>
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}" />
    <a href="{{ route('product.create') }}" class="button" style="margin-bottom: 20px;">Tambah Produk Baru</a>
    <table>
        <thead>
            <tr>
                <th>Gambar</th>
                <th>Nama</th>
                <th>Tipe</th>
                <th>Ukuran</th>
                <th>Harga</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $product)
            <tr>
                <td>
                    @if($product->gambar)
                        <img src="{{ asset('storage/' . $product->gambar) }}" alt="{{ $product->nama }}" style="max-width: 100px; height: auto; border-radius: 6px;">
                    @else
                        Tidak ada gambar
                    @endif
                </td>
                <td>{{ $product->nama }}</td>
                <td>{{ $product->tipe }}</td>
                <td>{{ $product->ukuran }}</td>
                <td>Rp {{ number_format($product->harga, 0, ',', '.') }}</td>
                <td>
                    <a href="{{ route('product.edit', $product->id) }}" class="button" style="background-color: #007bff;">Edit</a>
                    <form action="{{ route('product.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus produk ini?');" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="button" style="background-color: #dc3545; margin-left: 5px;">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endsection