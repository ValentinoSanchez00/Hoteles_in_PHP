<?php

//include 'db/DB.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/hoteles/db/DB.php';

class HotelesModel{
    
    private $bd;
    private $pdo;

    public function __construct() {
        // $this->pdo = new PDO('mysql:host=localhost;dbname=ejemplo10_tema6', 'root', '');
        $this->bd = new DB();
        $this->pdo = $this->bd->getPDO();
    }

    
    public function getHoteles() {
         $stmt = $this->pdo->prepare('SELECT nombre,direccion,ciudad,pais,num_habitaciones,descripcion from hoteles');
         $stmt->execute();
         return $stmt->fetchAll(PDO::FETCH_ASSOC);
         
         
    }
    
 
}