<?php

require_once __DIR__ . '/usuari.php';


$usuari = new Usuari();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $telefono = $_POST['telefono'];
    $password = $_POST['password'];

    // Validar que los campos no estén vacíos
    if (!empty($nombre) && !empty($email) && !empty($telefono) && !empty($password)) {
        
        // Validar formato del email
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo "El email no es válido.";
        } else {

            // Validar la contraseña con una expresión regular (mínimo 8 caracteres, al menos una letra y un número)
            if ($usuari->isValidPasswd($password)) {

                // Verificar si el email ya está registrado
                if ($usuari->isEmailRegistered($email)) {
                    echo "Este email ya está registrado.";
                } else {
                    // Registrar al usuario
                    if ($usuari->addUser($nombre, $email, $telefono, $password)) {
                        // Redirigir al dashboard con el nombre del usuario
                        header("Location: dashboard.php?user=" . urlencode(htmlspecialchars($nombre)));
                        exit();
                    } else {
                        echo "Error al registrar el usuario. Intenta nuevamente.";
                    }
                }

            } else {
                echo "La contraseña no cumple con los requisitos mínimos.";
            }
        }
    } else {
        echo "Por favor, completa todos los campos.";
    }
}

$usuari->closeConnection();

// Configurar los encabezados del correo
$to = $email; // El correo del usuario registrado
$subject = "Bienvenido a Noto!";
$message = "
<html>
<head>
    <title>Bienvenido a Noto</title>
</head>
<body>
    <h1>¡Hola $nombre!</h1>
    <p>Gracias por registrarte en Noto. Estamos emocionados de tenerte con nosotros.</p>
    <p>Próximamente podrás gestionar tus notas de manera eficiente y organizada.</p>
    <p><strong>¡Que disfrutes tu experiencia!</strong></p>
</body>
</html>
";
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
$headers .= "From: no-reply@notoapp.com" . "\r\n";

// Enviar el correo
if (mail($to, $subject, $message, $headers)) {
    // Mostrar mensaje de éxito y botón al dashboard
    echo "
    <!DOCTYPE html>
    <html lang='es'>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <title>Registro exitoso</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                text-align: center;
                padding: 20px;
                background-color: #f4f4f4;
                color: #333;
            }
            .message {
                margin-bottom: 20px;
                font-size: 18px;
            }
            .button {
                display: inline-block;
                padding: 10px 20px;
                font-size: 16px;
                color: #fff;
                background-color: #FF4555;
                text-decoration: none;
                border-radius: 5px;
                transition: background-color 0.3s;
            }
            .button:hover {
                background-color: #D03D49;
            }
        </style>
    </head>
    <body>
        <h1>¡Registro exitoso!</h1>
        <p class='message'>El correo de bienvenida se ha enviado a <strong>$email</strong>.</p>
        <a href='dashboard.php?user=" . urlencode($nombre) . "' class='button'>Ir al Dashboard</a>
    </body>
    </html>
    ";
} else {
    // Mostrar mensaje de error si no se pudo enviar el correo
    echo "
    <!DOCTYPE html>
    <html lang='es'>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <title>Error en el envío</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                text-align: center;
                padding: 20px;
                background-color: #f4f4f4;
                color: #333;
            }
            .error {
                margin-bottom: 20px;
                font-size: 18px;
                color: #FF4555;
            }
            .button {
                display: inline-block;
                padding: 10px 20px;
                font-size: 16px;
                color: #fff;
                background-color: #FF4555;
                text-decoration: none;
                border-radius: 5px;
                transition: background-color 0.3s;
            }
            .button:hover {
                background-color: #D03D49;
            }
        </style>
    </head>
    <body>
        <h1>Error al enviar el correo</h1>
        <p class='error'>Hubo un problema al enviar el correo de bienvenida. Por favor, intenta nuevamente.</p>
        <a href='register.html' class='button'>Volver al registro</a>
    </body>
    </html>
    ";
}



?>



