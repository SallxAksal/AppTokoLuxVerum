<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Website Resmi LuxVerum</title>
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}" />
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #b30000, #000000, #ffffff);
            color: #ffffff;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            flex-direction: column;
        }
        h1 {
            margin-bottom: 20px;
        }
        button {
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
            background-color: #b30000;
            border: none;
            color: white;
            border-radius: 6px;
            transition: background-color 0.3s ease;
        }
        button:hover {
            background-color: #7a0000;
        }
        #owner-question {
            margin-top: 20px;
            display: none;
            flex-direction: column;
            gap: 10px;
            align-items: center;
            text-align: center;
        }
        #owner-question button {
            width: 200px;
        }
    </style>
</head>
<body>
    <img src="image/LX-luxverum.png" alt="" style="max-width: 200px; height: auto; border-radius: 50%; box-shadow: 0 0 20px rgba(0,0,0,0.5); margin-bottom: 20px;">
    <h1>Website Resmi LuxVerum</h1>
    <button id="btn-masuk">Masuk</button>
    <div id="owner-question">
        <p>Apakah Anda Owner?</p>
        <button id="btn-owner">Ya, Saya Owner</button>
        <button id="btn-visitor">Saya Hanya Pengunjung</button>
    </div>

    <script>
        const btnMasuk = document.getElementById('btn-masuk');
        const ownerQuestion = document.getElementById('owner-question');
        const btnOwner = document.getElementById('btn-owner');
        const btnVisitor = document.getElementById('btn-visitor');

        btnMasuk.addEventListener('click', () => {
            btnMasuk.style.display = 'none';
            ownerQuestion.style.display = 'flex';
        });

        btnOwner.addEventListener('click', () => {
            window.location.href = '/login';
        });

        btnVisitor.addEventListener('click', () => {
            window.location.href = '/katalog';
        });
    </script>
</body>
</html>
