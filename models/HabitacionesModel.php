<?php

//include 'db/DB.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/hoteles/db/DB.php';

class HabitacionessModel{
    
    private $bd;
    private $pdo;

    public function __construct() {
        // $this->pdo = new PDO('mysql:host=localhost;dbname=ejemplo10_tema6', 'root', '');
        $this->bd = new DB();
        $this->pdo = $this->bd->getPDO();
    }

    
    public function getHabitacionesDisponibles() {
        
         
         
    }
    
 
}