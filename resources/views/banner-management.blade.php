@extends('layouts.app')

@section('content')
{{-- 
    ================================================
    CSS STYLING (Cool, Professional, Dark Theme) 
    ================================================
--}}
<style>
    body {
        background-color: #1e1e1e;
        color: #fdfdfc;
        font-family: 'Inter', sans-serif;
    }

    .banner-manager-container {
        max-width: 800px;
        margin: 40px auto;
        padding: 30px;
        background: #2a2a2a;
        border-radius: 16px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5), 0 0 15px rgba(179, 0, 0, 0.6);
    }

    .banner-manager-container h1 {
        color: #ff4d4d;
        text-align: center;
        margin-bottom: 30px;
        text-shadow: 0 0 8px rgba(255, 77, 77, 0.7);
        font-size: 2.5rem;
        font-weight: 800;
    }

    .banner-manager-container h2 {
        color: #fdfdfc;
        border-bottom: 2px solid #b30000;
        padding-bottom: 10px;
        margin-bottom: 25px;
        font-weight: 600;
    }

    .success-message {
        background-color: #006600;
        padding: 15px;
        border-radius: 10px;
        margin-bottom: 20px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.3);
        font-weight: 500;
    }

    .error-message {
        color: #ff6666;
        margin-bottom: 15px;
        font-size: 0.9rem;
    }

    .form-box {
        background-color: #333333;
        padding: 25px;
        border-radius: 12px;
        border: 1px solid #444;
        margin-bottom: 40px;
    }

    .file-input {
        background-color: #444444;
        border: 1px solid #b30000;
        padding: 10px;
        border-radius: 8px;
        color: #fdfdfc;
        cursor: pointer;
        margin-bottom: 15px;
    }

    .upload-button {
        background: linear-gradient(145deg, #b30000, #800000);
        color: white;
        border: none;
        padding: 12px 30px;
        border-radius: 8px;
        cursor: pointer;
        font-weight: bold;
        font-size: 1rem;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(179, 0, 0, 0.4);
    }

    .upload-button:hover {
        background: linear-gradient(145deg, #ff3333, #b30000);
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(255, 51, 51, 0.6);
    }

    .is-loading {
        animation: loading-pulse 0.7s infinite alternate;
        pointer-events: none;
    }

    @keyframes loading-pulse {
        0% { background-color: #b30000; transform: scale(1); }
        50% { background-color: #ff4d4d; transform: scale(1.02); }
        100% { background-color: #b30000; transform: scale(1); }
    }

    .banner-grid {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
    }

    .banner-card {
        position: relative;
        flex: 0 0 220px;
        border: 1px solid #b30000;
        border-radius: 12px;
        overflow: hidden;
        background-color: #333333;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        cursor: pointer;
    }

    .banner-card img {
        width: 100%;
        height: 120px;
        object-fit: cover;
    }

    .delete-button {
        position: absolute;
        top: 8px;
        right: 8px;
        background: rgba(179, 0, 0, 0.9);
        border: none;
        color: #fff;
        padding: 5px 10px;
        font-size: 0.8rem;
        border-radius: 6px;
        cursor: pointer;
        transition: background 0.3s ease;
    }

    .delete-button:hover {
        background: rgba(255, 51, 51, 1);
    }
</style>

<div class="container banner-manager-container">
    <img src="{{ asset('image/LX-luxverum.png') }}" 
         alt="Logo LuxVerum" 
         style="width:150px; display:block; margin:0 auto 20px auto;">

    <h1>Manajemen Banner Iklan</h1>

    @if(session('success'))
        <div class="success-message">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('banners.preview') }}" method="POST" enctype="multipart/form-data" class="form-box" id="upload-form">
        @csrf
        <label for="image">Tambah Banner Baru:</label>
        <input type="file" name="image" id="image" accept="image/*" required class="file-input" onchange="this.form.submit()">
        @error('image')
            <div class="error-message">{{ $message }}</div>
        @enderror
        <button type="submit" class="upload-button" id="upload-button" style="display:none;">Upload Banner</button>
    </form>

    <h2>Banner yang Sudah Ada:</h2>
    <div class="banner-grid">
        @forelse($banners as $banner)
            <div class="banner-card">
                <img src="{{ asset('storage/' . $banner->image_path) }}" alt="Banner {{ $banner->id }}">
                <form action="{{ route('banners.destroy', $banner->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus banner ini?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="delete-button">Hapus</button>
                </form>
            </div>
        @empty
            <p>Tidak ada banner yang tersedia.</p>
        @endforelse
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const uploadForm = document.getElementById('upload-form');
    const submitButton = document.getElementById('upload-button');
    const fileInput = document.getElementById('image');

    if (uploadForm && submitButton && fileInput) {
        uploadForm.addEventListener('submit', () => {
            if (fileInput.files.length > 0) {
                submitButton.classList.add('is-loading');
                submitButton.textContent = 'Mengunggah...';
            }
        });
    }
});
</script>
@endsection
