<?php

//include 'db/DB.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/hoteles/db/DB.php';

class HabitacionessModel {
    
    private $bd;
    private $pdo;

    public function __construct() {
        // Crear una instancia de la clase DB para manejar la conexión a la base de datos.
        $this->bd = new DB();
        // Obtener el objeto PDO de la instancia de DB.
        $this->pdo = $this->bd->getPDO();
    }

    /**
     * Obtiene las habitaciones asociadas a un hotel específico.
     * @param int $id Identificador del hotel.
     * @return array Array asociativo con la información de las habitaciones.
     */
    public function getHabitacionesconid($id) {
        // Preparar la consulta SQL utilizando parámetros para evitar SQL injection.
        $stmt = $this->pdo->prepare('SELECT * FROM habitaciones WHERE id_hotel = :id');
        // Asignar el valor del parámetro.
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        // Ejecutar la consulta preparada.
        $stmt->execute();
        // Obtener y devolver los resultados como un array asociativo.
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
