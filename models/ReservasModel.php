<?php

class ReservasModel {

    private $bd;
    private $pdo;

    public function __construct() {
        // Crear una instancia de la clase DB para manejar la conexión a la base de datos.
        $this->bd = new DB();
        // Obtener el objeto PDO de la instancia de DB.
        $this->pdo = $this->bd->getPDO();
    }

    /**
     * Comprueba si hay alguna reserva para la habitación y fechas proporcionadas.
     * @param int $id_hotel ID del hotel.
     * @param int $id_habitacion ID de la habitación.
     * @param string $fecha_entrada Fecha de entrada de la reserva.
     * @param string $fecha_salida Fecha de salida de la reserva.
     * @return bool Retorna true si la reserva es posible, false si ya existe una reserva para las fechas y habitación proporcionadas.
     */
    public function comprobarReserva($id_hotel, $id_habitacion, $fecha_entrada, $fecha_salida) {
        $stmt = $this->pdo->prepare('SELECT * FROM reservas WHERE id_habitacion = :id_habitacion AND id_hotel = :id_hotel AND (:fecha_entrada BETWEEN fecha_entrada AND fecha_salida OR :fecha_salida BETWEEN fecha_entrada AND fecha_salida);');
        $stmt->execute(array('id_hotel' => $id_hotel, 'id_habitacion' => $id_habitacion, 'fecha_entrada' => $fecha_entrada, 'fecha_salida' => $fecha_salida));
        return $stmt->rowCount() === 0; // Si no hay filas, la reserva es posible; retorna true.
    }

    /**
     * Inserta una nueva reserva en la base de datos.
     * @param int $id_hotel ID del hotel.
     * @param int $id_habitacion ID de la habitación.
     * @param string $fecha_entrada Fecha de entrada de la reserva.
     * @param string $fecha_salida Fecha de salida de la reserva.
     * @param int $id_usuario ID del usuario que realiza la reserva.
     * @return void
     */
    public function insertarReserva($id_hotel, $id_habitacion, $fecha_entrada, $fecha_salida, $id_usuario) {
        $stmt = $this->pdo->prepare('INSERT INTO reservas (id, id_usuario, id_hotel, id_habitacion, fecha_entrada, fecha_salida) 
                            SELECT MAX(id) + 1, :id_usuario, :id_hotel, :id_habitacion, :fecha_entrada, :fecha_salida 
                            FROM reservas');
        $stmt->execute(array('id_usuario' => $id_usuario, 'id_hotel' => $id_hotel, 'id_habitacion' => $id_habitacion, 'fecha_entrada' => $fecha_entrada, 'fecha_salida' => $fecha_salida));
        header("Location:../index.php?controller=Habitaciones&action=mostrarHabitaciones&id={$id_hotel}");
    }
    
    
    /**
     * Obtiene todas las reservas ordenadas por ID de usuario.
     * @return PDOStatement Retorna un objeto PDOStatement que contiene todas las reservas ordenadas por ID de usuario.
     */
    public function mostrarReservas() {
        $stmt = $this->pdo->prepare('SELECT * FROM reservas ORDER BY id_usuario');
        $stmt->execute();
        return $stmt;
    }
    
    
    /**
     * Obtiene detalles de una reserva específica.
     * @param int $id ID de la reserva.
     * @return PDOStatement Retorna un objeto PDOStatement que contiene los detalles de la reserva.
     */
    public function mostrarDetalleReserva($id) {
        $stmt = $this->pdo->prepare('SELECT r.id_habitacion, r.fecha_entrada, r.fecha_salida, ht.nombre, ht.direccion, ht.ciudad, ht.pais, (SELECT UPPER(nombre) FROM usuarios WHERE id IN (SELECT id_usuario FROM reservas WHERE id = :id)) AS nombre_usuario FROM reservas r JOIN habitaciones h ON r.id_habitacion = h.id JOIN hoteles ht ON r.id_hotel = ht.id WHERE r.id = :id;');
        $stmt->execute(array("id"=>$id));
        return $stmt;
    }
}
