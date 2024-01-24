<?php

//include 'db/DB.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/hoteles/db/DB.php';

class HotelesModel {
    
    private $bd;
    private $pdo;

    public function __construct() {
        // Crear una instancia de la clase DB para manejar la conexión a la base de datos.
        $this->bd = new DB();
        // Obtener el objeto PDO de la instancia de DB.
        $this->pdo = $this->bd->getPDO();
    }

    /**
     * Obtiene la información de todos los hoteles.
     * @return array Array asociativo con la información de los hoteles.
     */
    public function getHoteles() {
        // Preparar la consulta SQL.
        $stmt = $this->pdo->prepare('SELECT * FROM hoteles');
        // Ejecutar la consulta.
        $stmt->execute();
        // Obtener y devolver los resultados como un array asociativo.
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
