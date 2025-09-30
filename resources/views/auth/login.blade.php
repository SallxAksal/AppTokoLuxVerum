<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Login - LuxVerum</title>
    <style>
        body { font-family: Arial, sans-serif; background: #fdfdfc; color: #1b1b18; display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0; }
        form { background: white; padding: 20px; border: 1px solid #ddd; border-radius: 5px; width: 300px; position: relative; }
        h2 { margin-top: 0; }
        label { display: block; margin-top: 10px; }
        input[type="password"] { width: 100%; padding: 8px; margin-top: 5px; box-sizing: border-box; }
        button { margin-top: 15px; padding: 10px; width: 100%; background-color: #4b60e6; color: white; border: none; cursor: pointer; transition: transform 0.1s ease; }
        button:active {
            transform: scale(0.95);
        }
        .notification {
            position: fixed;
            top: 20px;
            right: 20px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            padding: 15px 20px;
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 16px;
            opacity: 0;
            pointer-events: none;
            transition: opacity 0.3s ease;
            z-index: 1000;
        }
        .notification.show {
            opacity: 1;
            pointer-events: auto;
        }
        .notification.success {
            border-left: 5px solid #4CAF50;
            color: #4CAF50;
        }
        .notification.error {
            border-left: 5px solid #F44336;
            color: #F44336;
        }
        .icon {
            width: 24px;
            height: 24px;
            stroke-width: 2;
            stroke-linecap: round;
            stroke-linejoin: round;
            fill: none;
            stroke: currentColor;
            animation-duration: 0.5s;
            animation-fill-mode: forwards;
        }
        @keyframes checkmark {
            0% {
                stroke-dashoffset: 48;
            }
            100% {
                stroke-dashoffset: 0;
            }
        }
        @keyframes cross {
            0% {
                stroke-dashoffset: 32;
            }
            100% {
                stroke-dashoffset: 0;
            }
        }
        .checkmark {
            stroke-dasharray: 48;
            stroke-dashoffset: 48;
            animation-name: checkmark;
        }
        .cross {
            stroke-dasharray: 32;
            stroke-dashoffset: 32;
            animation-name: cross;
        }
        a { display: block; margin-top: 10px; text-align: center; color: #4b60e6; text-decoration: none; }
    </style>
</head>
<body>
    <form id="loginForm" method="POST" action="{{ route('login') }}">
        @csrf
        <h2>Login Admin</h2>

        <label for="password">Password</label>
        <input id="password" type="password" name="password" required autofocus />
        @error('password')
            <div class="notification error">{{ $message }}</div>
        @enderror

        <button type="submit" id="submitBtn">Masuk</button>
        <a href="/">Kembali</a>
    </form>

    <div id="notification" class="notification" role="alert" aria-live="assertive" aria-atomic="true" style="display:none;">
        <svg id="icon" class="icon" viewBox="0 0 24 24" aria-hidden="true"></svg>
        <span id="notificationText"></span>
    </div>

    <style>
        .notification {
            position: fixed;
            top: 20px;
            right: 20px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            padding: 15px 20px;
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 16px;
            opacity: 0;
            pointer-events: none;
            transition: opacity 0.3s ease;
            z-index: 1000;
        }
        .notification.show {
            opacity: 1;
            pointer-events: auto;
        }
        .notification.success {
            border-left: 5px solid #4CAF50;
            color: #4CAF50;
        }
        .notification.error {
            border-left: 5px solid #F44336;
            color: #F44336;
        }
        .icon {
            width: 24px;
            height: 24px;
            stroke-width: 2;
            stroke-linecap: round;
            stroke-linejoin: round;
            fill: none;
            stroke: currentColor;
            animation-duration: 0.5s;
            animation-fill-mode: forwards;
        }
        @keyframes checkmark {
            0% {
                stroke-dashoffset: 48;
            }
            100% {
                stroke-dashoffset: 0;
            }
        }
        @keyframes cross {
            0% {
                stroke-dashoffset: 32;
            }
            100% {
                stroke-dashoffset: 0;
            }
        }
        .checkmark {
            stroke-dasharray: 48;
            stroke-dashoffset: 48;
            animation-name: checkmark;
        }
        .cross {
            stroke-dasharray: 32;
            stroke-dashoffset: 32;
            animation-name: cross;
        }
    </style>

    <script>
        const form = document.getElementById('loginForm');
        const notification = document.getElementById('notification');
        const notificationText = document.getElementById('notificationText');
        const icon = document.getElementById('icon');
        const submitBtn = document.getElementById('submitBtn');

        let isSubmitting = false;
        form.addEventListener('submit', async function(e) {
            e.preventDefault();
            if (isSubmitting) return;
            if (!form.password.value) {
                return;
            }
            isSubmitting = true;
            submitBtn.disabled = true;

            // Show loading spinner icon
            icon.innerHTML = '<circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4" fill="none" stroke-linecap="round" stroke-linejoin="round" class="spinner"></circle>';
            notificationText.textContent = 'Memeriksa...';
            notification.className = 'notification show';

            try {
                const response = await fetch(form.action, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({
                        password: form.password.value
                    })
                });

                if (response.ok) {
                    // Success
                    icon.innerHTML = '<polyline class="checkmark" points="20 6 9 17 4 12"></polyline>';
                    notificationText.textContent = 'Login berhasil!';
                    notification.className = 'notification show success';
                    setTimeout(() => {
                        window.location.href = '/dashboard';
                    }, 1500);
                } else {
                    // Error
                    icon.innerHTML = '<line class="cross" x1="18" y1="6" x2="6" y2="18"></line><line class="cross" x1="6" y1="6" x2="18" y2="18"></line>';
                    notificationText.textContent = 'Password salah.';
                    notification.className = 'notification show error';
                    submitBtn.disabled = false;
                    isSubmitting = false;
                }
            } catch (error) {
                icon.innerHTML = '<line class="cross" x1="18" y1="6" x2="6" y2="18"></line><line class="cross" x1="6" y1="6" x2="18" y2="18"></line>';
                notificationText.textContent = 'Terjadi kesalahan jaringan.';
                notification.className = 'notification show error';
                submitBtn.disabled = false;
                isSubmitting = false;
            }
        });
    </script>
</body>
</html>
