<?php

class DB {
    private $conn;
    private $error;

    public function __construct() {
        $this->conn = new mysqli('localhost', 'root', '', 'galeria');
        if ($this->conn->connect_error) {
            die("Error de conexión: " . $this->conn->connect_error);
        }
    }

    public function query($sql) {
        $result = mysqli_query($this->conn, $sql);
        if (!$result) {
            $this->error = mysqli_error($this->conn);
        }
        return $result;
    }

    public function getError() {
        return $this->error;
    }
}

?>