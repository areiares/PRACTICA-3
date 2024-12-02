<?php
// login.php

session_start();

// Incluir la configuración de la base de datos
require_once 'Database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener los datos enviados desde el formulario
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    // Validar que los campos no estén vacíos
    if (empty($email) || empty($password)) {
        header("Location: error.php?msg=Por favor completa todos los campos.");
        exit();
    }

    try {
        // Crear una instancia de la base de datos
        $connection = new Database();

        // Consulta para verificar si el usuario existe

        $sql = "SELECT * FROM usuari where email = '$email'";


        $result = $connection->query($sql);
       

        $user  = $result->fetch_assoc();


        // Verificar si se encontró el usuario y la contraseña es válida
        if ($user && password_verify($password, $user['passw'])) {
            // Credenciales correctas: redirigir al dashboard
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_email'] = $user['email'];
            $_SESSION['user_name'] = $user['nom'];
            header("Location:dashboard.php");
            exit();
        } else {
            // Credenciales incorrectas
            header("Location: error.php?msg=Email o contraseña incorrectos.");
            exit();
        }
    } catch (PDOException $e) {
        // Manejar errores de la base de datos
        header("Location: error.php?msg=Error al conectar con la base de datos.");
        exit();
    }
} else {
    // Si el acceso al archivo no es a través de POST, redirigir a login.html
    header("Location: dashboard.php");
    exit();
}
?>
