<?php

include 'db/DB.php';

class LoginModel {

    private $bd;
    private $pdo;

    public function __construct() {
        try {
            $this->bd = new DB();
            $this->pdo = $this->bd->getPDO();
            if (!$this->pdo) {
                throw new Exception("Error Inesperado");
            }
        } catch (Exception $exc) {
            echo $exc->getMessage();
        }
    }

    public function comprobarUsuario($usuario, $password) {

        try {
            $stmt = $this->pdo->prepare('SELECT * from usuarios where nombre=:nombre and contraseña=:password');
            $stmt->execute(array('nombre' => $usuario, 'password' => $password));
            if ($stmt->rowCount() > 0) {
                foreach ($stmt as $user) {

                    return $user;
                }
            } else {
                return false;
            }
        } catch (Exception $exc) {
            echo "Esto es el model";
        }

        
        }
    }

