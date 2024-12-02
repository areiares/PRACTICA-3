<?php

class Database {
    private $host = "mysql-notoapp.alwaysdata.net";
    private $username = "notoapp";
    private $password = "Cam.12345";
    private $dbname = "notoapp_bd";
    private $conn;

    public function __construct() {
        $this->conn = new mysqli($this->host, $this->username, $this->password, $this->dbname);

        if ($this->conn->connect_error) {
            die("Conexión fallida: " . $this->conn->connect_error);
        }
    }

    public function prepare($sql) {
        return $this->conn->prepare($sql);
    }

    public function close() {
        $this->conn->close();
    }

    public function query ($sql) {
        return $this->conn->query($sql);
    }
}

?>

