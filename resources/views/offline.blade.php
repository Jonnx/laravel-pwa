<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Offline</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
        }
        body {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            background: #f8fafc;
            font-family: Arial, sans-serif;
        }
        .offline-container {
            text-align: center;
            background: #fff;
            padding: 2rem 3rem;
            border-radius: 12px;
            box-shadow: 0 2px 16px rgba(0,0,0,0.08);
        }
        .offline-title {
            font-size: 2rem;
            margin-bottom: 1rem;
            color: #333;
        }
        .offline-message {
            margin-bottom: 2rem;
            color: #555;
        }
        .reload-btn {
            padding: 0.75rem 2rem;
            font-size: 1rem;
            background: #2563eb;
            color: #fff;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            transition: background 0.2s;
        }
        .reload-btn:disabled {
            background: #94a3b8;
            cursor: not-allowed;
        }
    </style>
</head>
<body>
    <div class="offline-container">
        <div class="offline-title">You're Offline</div>
        <div class="offline-message">
            It looks like you lost your internet connection.<br>
            Please check your connection and try reloading the app.
        </div>
        <button class="reload-btn" id="reloadBtn" disabled>Reload App</button>
    </div>
    <script>
        function updateButton() {
            const btn = document.getElementById('reloadBtn');
            if (navigator.onLine) {
                btn.disabled = false;
            } else {
                btn.disabled = true;
            }
        }
        window.addEventListener('online', updateButton);
        window.addEventListener('offline', updateButton);
        document.getElementById('reloadBtn').addEventListener('click', function() {
            location.reload();
        });
        updateButton();
    </script>
</body>
</html>