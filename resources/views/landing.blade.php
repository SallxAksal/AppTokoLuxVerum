<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Website Resmi LuxVerum</title>
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}" />
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap');

        body {
            font-family: 'Poppins', Arial, sans-serif;
            background: linear-gradient(135deg, #b30000, #000000, #ffffff);
            background-size: 400% 400%;
            animation: gradientAnimation 15s ease infinite;
            color: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            flex-direction: column;
            overflow: hidden;
        }
        @keyframes gradientAnimation {
            0% {background-position: 0% 50%;}
            50% {background-position: 100% 50%;}
            100% {background-position: 0% 50%;}
        }
        img {
            max-width: 180px;
            height: auto;
            border-radius: 50%;
            box-shadow: 0 0 30px rgba(255, 255, 255, 0.7);
            margin-bottom: 30px;
            transition: transform 0.3s ease;
        }
        img:hover {
            transform: scale(1.1);
        }
        h1 {
            font-size: 2.5rem;
            margin-bottom: 30px;
            text-shadow: 2px 2px 8px rgba(0,0,0,0.7);
        }
        button {
            padding: 12px 30px;
            font-size: 18px;
            cursor: pointer;
            background-color: #b30000;
            border: none;
            color: white;
            border-radius: 30px;
            box-shadow: 0 4px 15px rgba(179, 0, 0, 0.6);
            transition: background-color 0.3s ease, box-shadow 0.3s ease;
            font-weight: 700;
            letter-spacing: 1px;
            margin-bottom: 20px;
            width: 220px;
        }
        button:hover {
            background-color: #7a0000;
            box-shadow: 0 6px 20px rgba(122, 0, 0, 0.8);
        }
        #owner-question {
            margin-top: 20px;
            display: none;
            flex-direction: column;
            gap: 15px;
            align-items: center;
            text-align: center;
            width: 100%;
            max-width: 280px;
        }
        #owner-question p {
            font-size: 1.2rem;
            font-weight: 600;
            text-shadow: 1px 1px 5px rgba(0,0,0,0.6);
        }
        #owner-question button {
            width: 100%;
            padding: 12px 0;
            font-size: 16px;
            border-radius: 25px;
            box-shadow: 0 4px 12px rgba(179, 0, 0, 0.6);
        }
        #owner-question button:hover {
            box-shadow: 0 6px 18px rgba(122, 0, 0, 0.8);
        }
    </style>
</head>
<body>
    <img src="image/LX-luxverum.png" alt="">
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
