<?php

if (isset($_GET['user'])) {
    $user = htmlspecialchars($_GET['user']);
} else {
    $user = "Usuario";
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Noto</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            margin: 0;
            font-family: 'Inter', sans-serif;
            background-color: #ffffff;
            color: #333333;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            text-align: center;
            width: 100%;
            max-width: 400px;
        }

        .logo {
            margin-bottom: 20px;
        }

        .logo img {
            max-width: 150px;
        }

        .title {
            font-size: 24px;
            font-weight: 700;
            color: #FF4555;
            margin-bottom: 10px;
        }

        .subtitle {
            font-size: 16px;
            font-weight: 400;
            margin-bottom: 30px;
            color: #555555;
        }

        .button {
            display: inline-block;
            background-color: #FF4555;
            color: #ffffff;
            text-decoration: none;
            font-size: 14px;
            font-weight: 600;
            padding: 10px 20px;
            border-radius: 5px;
            margin-top: 20px;
            transition: background-color 0.3s;
        }

        .button:hover {
            background-color: #D03D49;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="logo">
            <img src="logo.png" alt="Noto Logo">
        </div>
        <div class="title">¡Hola, <?php echo $user; ?>!</div>
        <div class="subtitle">Próximamente podrás gestionar tus notas aquí.</div>
        <a href="login.html" class="button">Volver al inicio</a>
    </div>
</body>
</html>
