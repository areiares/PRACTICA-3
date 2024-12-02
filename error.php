<?php
session_start();

// Verificar si hay un mensaje de error en la sesión
if (isset($_SESSION['error_message'])) {
    $error_message = $_SESSION['error_message'];
    unset($_SESSION['error_message']); // Limpiar el mensaje después de mostrarlo
} else {
    $error_message = "Ha ocurrido un error desconocido.";
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Error - Noto</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body {
            margin: 0;
            font-family: 'Inter', sans-serif;
            background-color: #FF4555;
            color: #ffffff;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            text-align: center;
            max-width: 400px;
            padding: 20px;
        }

        .title {
            font-size: 24px;
            font-weight: 700;
            margin-bottom: 10px;
        }

        .message {
            font-size: 16px;
            font-weight: 400;
            margin-bottom: 20px;
        }

        .button {
            display: inline-block;
            background-color: #ffffff;
            color: #FF4555;
            text-decoration: none;
            font-size: 14px;
            font-weight: 600;
            padding: 10px 20px;
            border-radius: 5px;
            transition: background-color 0.3s, color 0.3s;
        }

        .button:hover {
            background-color: #FF7885;
            color: #ffffff;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="title">¡Error!</div>
        <div class="message"><?php echo htmlspecialchars($error_message); ?></div>
        <a href="login.html" class="button">Volver a intentar</a>
    </div>
</body>
</html>
