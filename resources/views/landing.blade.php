<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Website Resmi LuxVerum</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #fdfdfc;
            color: #1b1b18;
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
        }
        #owner-question {
            margin-top: 20px;
            display: none;
            flex-direction: column;
            gap: 10px;
        }
        #owner-question button {
            width: 200px;
        }
    </style>
</head>
<body>
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
