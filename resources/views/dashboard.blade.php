<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Dashboard - LuxVerum</title>
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
        .actions {
            margin-bottom: 20px;
            text-align: center;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: auto;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #eee;
        }
        img {
            max-width: 100px;
            height: auto;
        }
        a.button {
            display: inline-block;
            padding: 6px 12px;
            margin: 2px;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 4px;
        }
        form {
            display: inline;
        }
        form button {
            background-color: #dc3545;
            border: none;
            color: white;
            padding: 6px 12px;
            cursor: pointer;
            border-radius: 4px;
        }
    </style>
</head>
<body>
    <h1>Dashboard Produk</h1>
    <div class="actions">
        <a href="{{ route('product.create') }}" class="button">Tambah Produk Baru</a>
    </div>
    @if(session('success'))
        <p style="color: green; text-align: center;">{{ session('success') }}</p>
    @endif
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
                        <img src="{{ asset('storage/' . $product->gambar) }}" alt="{{ $product->nama }}">
                    @else
                        Tidak ada gambar
                    @endif
                </td>
                <td>{{ $product->nama }}</td>
                <td>{{ $product->tipe }}</td>
                <td>{{ $product->ukuran }}</td>
                <td>Rp {{ number_format($product->harga, 0, ',', '.') }}</td>
                <td>
                    <a href="{{ route('product.edit', $product->id) }}" class="button">Edit</a>
                    <form action="{{ route('product.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus produk ini?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
