@extends('layouts.app')

@section('content')
<style>
    body {
        background-color: #1e1e1e;
        color: #fdfdfc;
        font-family: 'Inter', sans-serif;
        margin: 0;
        padding: 0;
        height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .preview-container {
        max-width: 900px;
        width: 90vw;
        margin: 40px auto;
        background: #2a2a2a;
        padding: 30px;
        border-radius: 16px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5), 0 0 15px rgba(179, 0, 0, 0.6);
        color: #fdfdfc;
        text-align: center;
        overflow: hidden; /* cegah isi keluar */
    }

    .image-wrapper {
        max-width: 100%;
        max-height: 450px;
        overflow: hidden;
        margin: auto;
        border-radius: 12px;
        border: 1px solid #b30000;
        box-shadow: 0 4px 15px rgba(179, 0, 0, 0.4);
    }

    #image-to-crop {
        max-width: 100%;
        max-height: 450px;
        display: block;
        margin: auto;
    }

    .crop-buttons {
        margin-top: 20px;
        display: flex;
        justify-content: center;
        gap: 20px;
    }

    .crop-button {
        background-color: #b30000;
        color: white;
        border: none;
        padding: 12px 30px;
        border-radius: 8px;
        cursor: pointer;
        font-weight: bold;
        font-size: 1rem;
        transition: background-color 0.3s ease;
        box-shadow: 0 4px 15px rgba(179, 0, 0, 0.4);
    }

    .crop-button:hover {
        background-color: #ff3333;
    }
</style>

<div class="container" style="max-width: 960px; margin: 40px auto; padding: 20px; background-color: #2a2a2a; border-radius: 16px; box-shadow: 0 10px 30px rgba(0,0,0,0.5), 0 0 15px rgba(179,0,0,0.6); color: #fdfdfc;">
    <div class="preview-container">
        <h1>Preview dan Crop Banner</h1>
        <div class="image-wrapper">
            <img id="image-to-crop" src="data:{{ $imageType }};base64,{{ $imageData }}" alt="Image to crop">
        </div>

        <form action="{{ route('banners.crop') }}" method="POST" id="crop-form">
            @csrf
            <input type="hidden" name="cropped_image" id="cropped_image">
            <div class="crop-buttons">
                <button type="button" class="crop-button" id="crop-btn">Crop & Simpan</button>
                <a href="{{ route('banners') }}" class="crop-button" style="text-decoration:none; display:flex; align-items:center; justify-content:center;">Batal</a>
            </div>
        </form>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.css" rel="stylesheet"/>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const image = document.getElementById('image-to-crop');
    const cropBtn = document.getElementById('crop-btn');
    const cropForm = document.getElementById('crop-form');
    const croppedImageInput = document.getElementById('cropped_image');

    const cropper = new Cropper(image, {
        aspectRatio: 16 / 9,
        viewMode: 1,        // batasi agar tidak keluar container
        autoCropArea: 1,    // area crop default penuh
        responsive: true,
        background: false
    });

    cropBtn.addEventListener('click', () => {
        const canvas = cropper.getCroppedCanvas({
            width: 800,
            height: 450,
            imageSmoothingQuality: 'high',
        });
        croppedImageInput.value = canvas.toDataURL('image/png', 0.8);
        cropForm.submit();
    });
});
</script>
@endsection
