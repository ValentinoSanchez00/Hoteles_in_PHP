<?php

include $_SERVER['DOCUMENT_ROOT'] . '/hoteles/models/Habitacion.php';

class HabitacionesController {

    private $model;
    private $view;

    public function __construct() {
        $this->model = new HabitacionessModel();
        $this->view = new HabitacionesView();
    }

    /**
     * Muestra las habitaciones de un hotel, requiere la sesión de un usuario autenticado.
     */
    public function mostrarHabitaciones() {
        // Gestiona las sesiones y verifica si hay una sesión activa.
        $sesion = $this->gestionarsesiones();

        if ($sesion) {
            $id = $_GET['id'];

            try {
                // Obtiene las habitaciones del modelo asociadas a un hotel específico.
                $habitaciones = $this->model->getHabitacionesconid($id);

                $arraydehabitaciones = array();

                // Convierte los datos de las habitaciones en objetos de la clase Habitacion.
                foreach ($habitaciones as $key => $habitacionfila) {
                    $nuevaHabitacion = new Habitacion(
                        $habitacionfila["id"],
                        $habitacionfila["id_hotel"],
                        $habitacionfila["num_habitacion"],
                        $habitacionfila["tipo"],
                        $habitacionfila["precio"],
                        $habitacionfila["descripcion"]
                    );

                    array_push($arraydehabitaciones, $nuevaHabitacion);
                }

                // Llama a la función para mostrar las habitaciones según el estado de la URL.
                $this->verHabitaciones($arraydehabitaciones);
            } catch (Exception $exc) {
                // Maneja errores inesperados de manera genérica.
                echo "Error inesperado";
            }
        }
    }

    /**
     * Redirige a las vistas correspondientes según el estado de la URL.
     * @param array $arraydehabitaciones Array de objetos Habitacion a mostrar.
     */
    public function verHabitaciones($arraydehabitaciones) {
        // Verifica el estado de la URL y llama a la vista correspondiente.
        if (isset($_GET["succes"])) {
            $this->view->mostrarHabitacionesCorrecta($arraydehabitaciones);
        } elseif (isset($_GET["wrong"])) {
            $this->view->mostrarHabitacionesFallada($arraydehabitaciones);
        } else {
            $this->view->mostrarHabitaciones($arraydehabitaciones);
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
