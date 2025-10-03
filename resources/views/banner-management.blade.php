@extends('layouts.app')

@section('content')
{{-- 
    ================================================
    CSS STYLING (Cool, Professional, Dark Theme) 
    ================================================
--}}
<style>
    /* Global Reset & Dark Theme Base */
    body {
        background-color: #1e1e1e; /* Dark background */
        color: #fdfdfc; /* Off-white text */
        font-family: 'Inter', sans-serif;
        transition: background-color 0.3s;
    }

    /* Main Container Card */
    .banner-manager-container {
        max-width: 800px;
        margin: 40px auto;
        padding: 30px;
        background: #2a2a2a; /* Slightly lighter card background */
        border-radius: 16px;
        /* Shadow with a subtle red glow for professional look */
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5), 0 0 15px rgba(179, 0, 0, 0.6);
    }

    /* Typography */
    .banner-manager-container h1 {
        color: #ff4d4d; /* Bright red for title */
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

    /* Messages */
    .success-message {
        background-color: #006600; /* Darker green for success */
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

    /* Form & Input Styling */
    .form-box {
        background-color: #333333;
        padding: 25px;
        border-radius: 12px;
        border: 1px solid #444;
        margin-bottom: 40px;
        box-shadow: inset 0 0 15px rgba(0, 0, 0, 0.3);
    }

    .form-box label {
        font-size: 1.1rem;
        font-weight: 600;
        margin-bottom: 10px;
    }

    .file-input {
        background-color: #444444;
        border: 1px solid #b30000;
        padding: 10px;
        border-radius: 8px;
        color: #fdfdfc;
        cursor: pointer;
        transition: background-color 0.3s ease;
        margin-bottom: 15px;
    }

    .file-input:hover {
        background-color: #555555;
    }

    /* --- Button Styling (Interactive and Animated) --- */
    .upload-button {
        /* Gradient for depth and flair */
        background: linear-gradient(145deg, #b30000, #800000); 
        color: white;
        border: none;
        padding: 12px 30px;
        border-radius: 8px;
        cursor: pointer;
        font-weight: bold;
        font-size: 1rem;
        /* Smooth transitions for a professional feel */
        transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1), transform 0.1s; 
        box-shadow: 0 4px 15px rgba(179, 0, 0, 0.4);
        will-change: transform, box-shadow; 
    }

    .upload-button:hover {
        background: linear-gradient(145deg, #ff3333, #b30000);
        transform: translateY(-2px); /* Slight lift */
        box-shadow: 0 6px 20px rgba(255, 51, 51, 0.6);
    }

    .upload-button:active {
        transform: translateY(1px); /* Pressed effect */
        box-shadow: 0 2px 10px rgba(179, 0, 0, 0.5);
    }

    /* Keyframe for the JS animation (Loading Pulse) */
    @keyframes loading-pulse {
        0% { background-color: #b30000; transform: scale(1); }
        50% { background-color: #ff4d4d; transform: scale(1.02); }
        100% { background-color: #b30000; transform: scale(1); }
    }

    .is-loading {
        animation: loading-pulse 0.7s infinite alternate;
        pointer-events: none; /* Disable interaction while loading */
    }

    /* --- Banner Grid and Cards (Cool Display) --- */
    .banner-grid {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
        justify-content: flex-start;
    }

    .banner-card {
        flex: 0 0 220px;
        border: 1px solid #b30000;
        border-radius: 12px;
        overflow: hidden;
        background-color: #333333;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        cursor: pointer;
        box-shadow: 0 4px 15px rgba(179, 0, 0, 0.3);
    }

    .banner-card:hover {
        transform: scale(1.03); /* Subtle scale up */
        box-shadow: 0 8px 25px rgba(255, 51, 51, 0.7); /* Stronger red glow */
    }
    
    .banner-card img {
        width: 100%;
        height: 120px;
        object-fit: cover;
        transition: filter 0.5s ease;
    }

    .banner-card:hover img {
        filter: brightness(1.15) saturate(1.1); /* Subtle visual change on image hover */
    }

    /* Responsive adjustments */
    @media (max-width: 600px) {
        .banner-manager-container {
            padding: 15px;
            margin: 20px auto;
        }
        .banner-card {
            flex: 0 0 100%; /* Full width on small screens */
        }
    }
</style>

<div class="container banner-manager-container">
    <img src="{{ asset('image/LX-luxverum.png') }}" alt="Logo LuxVerum" style="width:150px; height:auto; align-items: center; display: block; margin-left: auto; margin-right: auto; margin-bottom: 20px;">
    <h1>Manajemen Banner Iklan</h1>

    @if(session('success'))
        <div class="success-message">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('banners.preview') }}" method="POST" enctype="multipart/form-data" class="form-box" id="upload-form">
        @csrf
        <label for="image" class="block-label">Tambah Banner Baru:</label>
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
            </div>
        @empty
            <p>Tidak ada banner yang tersedia.</p>
        @endforelse
    </div>
</div>

{{-- 
    ================================================
    JAVASCRIPT FOR ANIMATION (Professional & Cool)
    ================================================
--}}
<script>
document.addEventListener('DOMContentLoaded', () => {
    const uploadForm = document.getElementById('upload-form');
    const submitButton = document.getElementById('upload-button');
    const fileInput = document.getElementById('image');

    if (uploadForm && submitButton && fileInput) {
        // Handle form submission to trigger the animation
        uploadForm.addEventListener('submit', (event) => {
            // Check if a file is actually selected before starting the loading animation
            if (fileInput.files.length > 0) {
                // Add the loading class to trigger the CSS pulse animation
                submitButton.classList.add('is-loading');
                submitButton.textContent = 'Mengunggah...'; // Update text
            }
            // Note: If validation (like file type/size) fails server-side,
            // the page will reload and the class will be naturally cleared.
        });
    }
});
</script>
@endsection
