<?php

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
        $stmt = $this->pdo->prepare('INSERT INTO reservas (id, id_usuario, id_hotel, id_habitacion, fecha_entrada, fecha_salida) 
                            SELECT MAX(id) + 1, :id_usuario, :id_hotel, :id_habitacion, :fecha_entrada, :fecha_salida 
                            FROM reservas');
        $stmt->execute(array('id_usuario' => $id_usuario, 'id_hotel' => $id_hotel, 'id_habitacion' => $id_habitacion, 'fecha_entrada' => $fecha_entrada, 'fecha_salida' => $fecha_salida));
        header("Location:../index.php?controller=Habitaciones&action=mostrarHabitaciones&id={$id_hotel}");
    }
    
    
    public function mostrarReservas() {
        $stmt = $this->pdo->prepare('SELECT * FROM reservas order by id_usuario');
        $stmt->execute();
        return $stmt;
    }
    
    
    public function mostrarDetalleReserva($id) {
        $stmt = $this->pdo->prepare('SELECT r.id_habitacion, r.fecha_entrada, r.fecha_salida, ht.nombre, ht.direccion, ht.ciudad, ht.pais, (SELECT UPPER(nombre) FROM usuarios WHERE id IN (SELECT id_usuario FROM reservas WHERE id = :id)) AS nombre_usuario FROM reservas r JOIN habitaciones h ON r.id_habitacion = h.id JOIN hoteles ht ON r.id_hotel = ht.id WHERE r.id = :id;');
        $stmt->execute(array("id"=>$id));
        return $stmt;
    }
    
    
}
