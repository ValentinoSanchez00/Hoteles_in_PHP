<?php

include 'db/DB.php';

class LoginModel {

    private $bd;
    private $pdo;

    public function __construct() {
        // $this->pdo = new PDO('mysql:host=localhost;dbname=ejemplo10_tema6', 'root', '');
        $this->bd = new DB();
        $this->pdo = $this->bd->getPDO();
    }

    public function comprobarUsuario($usuario, $password) {
    try {
        $stmt = $this->pdo->prepare('SELECT * from usuarios where nombre=:nombre and contraseña=:password');
        $stmt->execute(array('nombre' => $usuario, 'password' => $password));
        if ($stmt->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
         } catch (Exception $e) {
             header("Location: ../index.php");
    }

        
}
}
