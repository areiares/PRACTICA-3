<?php


require_once __DIR__ . '/Database.php';

class Usuari {
    private $db;

    public function __construct() {
        $this->db = new Database(); // Instancia la conexión a la base de datos
    }

    public function addUser($nombre, $email, $telefono, $password) {
        // Encripta la contraseña antes de guardar
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

        // Prepara y ejecuta la consulta
        $stmt = $this->db->prepare("INSERT INTO usuari (nom, email, telf, passw) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $nombre, $email, $telefono, $hashedPassword);
        return $stmt->execute();
    }

    public function isEmailRegistered($email) {
        // Verifica si el email ya está registrado
        $stmt = $this->db->prepare("SELECT id FROM usuari WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();
        return $stmt->num_rows > 0;
    }

    public function isValidPasswd($password) {
        // Requisitos: al menos 8 caracteres, una letra y un número
        return preg_match('/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/', $password);
    }

    public function closeConnection() {
        $this->db->close();
    }
}

