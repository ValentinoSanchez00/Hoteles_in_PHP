<?php

include 'db/DB.php';

class LoginModel{
    
    private $bd;
    private $pdo;
    
    
    public function __construct() {
       // $this->pdo = new PDO('mysql:host=localhost;dbname=ejemplo10_tema6', 'root', '');
        $this->bd =new DB();
        $this->pdo = $this->bd->getPDO();
    }
    
    public function getUsuario() {
        $stmt = $this->pdo->prepare('SELECT * from');
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    
    
    
    
}