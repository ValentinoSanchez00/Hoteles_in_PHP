<?php

include $_SERVER['DOCUMENT_ROOT'] . '/hoteles/models/Reserva.php';

class ReservasController {

    private $model;
    private $view;

    public function __construct() {
        $this->model = new ReservasModel();
        $this->view = new ReservasView();
    }

    /**
     * Comprueba la disponibilidad y realiza una reserva, requiere la sesión de un usuario autenticado.
     */
    public function comprobarReserva() {
        $sesion = $this->gestionarsesiones();

        if ($sesion) {
            $id_hotel = $_GET['id_hotel'];
            $id_habitacion = $_GET['id_habitacion'];
            $fecha_entrada = $_POST['fecha_entrada'];
            $fecha_salida = $_POST['fecha_salida'];

            try {
                // Comprueba si es posible realizar la reserva y redirige según el resultado.
                $puedoreserva = $this->model->comprobarReserva($id_hotel, $id_habitacion, $fecha_entrada, $fecha_salida);

                if ($puedoreserva) {
                    session_start();
                    $id_usuario = $_SESSION["id"];
                    $this->model->insertarReserva($id_hotel, $id_habitacion, $fecha_entrada, $fecha_salida, $id_usuario);
                    header("Location: index.php?controller=Habitaciones&action=mostrarHabitaciones&succes&id=" . $id_hotel);
                } else {
                    header("Location: index.php?controller=Habitaciones&action=mostrarHabitaciones&wrong&id=" . $id_hotel);
                }
            } catch (Exception $exc) {
                echo "Error inesperado";
            }
        }
    }

    /**
     * Muestra la lista de todas las reservas, requiere la sesión de un usuario autenticado.
     */
    public function mostrarReservas() {
        $sesion = $this->gestionarsesiones();

        if ($sesion) {
            $consulta = $this->model->mostrarReservas();
            $arraydereservas = [];

            // Convierte los datos de las reservas en objetos de la clase Reserva.
            foreach ($consulta as $reserva) {
                $reserva = new Reserva(
                    $reserva["id"],
                    $reserva["id_usuario"],
                    $reserva["id_hotel"],
                    $reserva["id_habitacion"],
                    $reserva["fecha_entrada"],
                    $reserva["fecha_salida"]
                );

                array_push($arraydereservas, $reserva);
            }

            // Muestra la vista de reservas con la lista de objetos Reserva.
            $this->view->mostrarReservas($arraydereservas);
        }
    }

    /**
     * Muestra los detalles de una reserva específica, requiere la sesión de un usuario autenticado.
     */
    public function mostrarDetallesReserva() {
        $sesion = $this->gestionarsesiones();

        if ($sesion) {
            try {
                // Obtiene los detalles de una reserva específica del modelo.
                $consulta = $this->model->mostrarDetalleReserva($_GET['id_reserva']);
                $arraydereservadetallada = [];

                // Convierte los detalles en un array de información detallada.
                foreach ($consulta as $reserva) {
                    array_push($arraydereservadetallada, "Usuario_reserva: " . $reserva["nombre_usuario"]);
                    array_push($arraydereservadetallada, "Id_habitación: " . $reserva["id_habitacion"]);
                    array_push($arraydereservadetallada, "Fecha_entrada: " . $reserva["fecha_entrada"]);
                    array_push($arraydereservadetallada, "Fecha_salida: " . $reserva["fecha_salida"]);
                    array_push($arraydereservadetallada, "Nombre del hotel: " . $reserva["nombre"]);
                    array_push($arraydereservadetallada, "Dirección: " . $reserva["direccion"]);
                    array_push($arraydereservadetallada, "Ciudad: " . $reserva["ciudad"]);
                    array_push($arraydereservadetallada, "Pais: " . $reserva["pais"]);
                }

                // Muestra la vista de detalles de la reserva con la información detallada.
                $this->view->mostrarReservasDetallada($arraydereservadetallada);
            } catch (Exception $exc) {
                echo "Error inesperado";
            }
        }
    }

    /**
     * Gestiona las sesiones para asegurarse de que solo los usuarios autenticados puedan acceder.
     * @return bool Devuelve true si hay una sesión activa, de lo contrario, redirige al formulario de inicio de sesión.
     */
    public function gestionarsesiones() {
        session_start();

        // Redirige al formulario de inicio de sesión con errores si no hay una sesión válida.
        if (!$_SESSION["id"]) {
            header("Location: index.php?controller=Login&action=mostrarFormularioConErrores");
        } else {
            return true;
        }
    }
}
