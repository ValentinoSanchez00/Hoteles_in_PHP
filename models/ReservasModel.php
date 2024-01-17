<?php

include 'db/DB.php';

class ReservasModel {

    private $bd;
    private $pdo;

    public function __construct() {
        // $this->pdo = new PDO('mysql:host=localhost;dbname=ejemplo10_tema6', 'root', '');
        $this->bd = new DB();
        $this->pdo = $this->bd->getPDO();
    }

    public function comprobarReserva($id_hotel, $id_habitacion, $fecha_entrada, $fecha_salida) {
        $stmt = $this->pdo->prepare('SELECT * FROM reservas WHERE id_habitacion = :id_habitacion AND id_hotel=:id_hotel AND(:fecha_entrada BETWEEN fecha_entrada AND fecha_salida) OR (:fecha_salida BETWEEN fecha_entrada AND fecha_salida);');
        $stmt->execute(array('id_hotel' => $id_hotel, 'id_habitacion' => $id_habitacion, 'fecha_entrada' => $fecha_entrada, 'fecha_salida' => $fecha_salida));
        if ($stmt->rowCount() > 0) {
            return false;
        } else {
            return true;
        }
    }
    
    
    public function insertarReserva($id_hotel, $id_habitacion, $fecha_entrada, $fecha_salida, $id_usuario) {
        $stmt= $this->pdo->prepare('INSERT INTO reservas values((SELECT MAX(id)+1 from reservas),:id_usuario,:id_hotel,:id_habitacion,:fecha_entrada,:fecha_salida)');
         $stmt->execute(array('id_hotel' => $id_hotel, 'id_habitacion' => $id_habitacion, 'fecha_entrada' => $fecha_entrada, 'fecha_salida' => $fecha_salida,'id_usuario'=>$id_usuario));
         header("Location:../index.php?controller=Habitaciones&action=mostrarHabitaciones&id='.$id_hotel.'");
    }
    
    
    
    
}
