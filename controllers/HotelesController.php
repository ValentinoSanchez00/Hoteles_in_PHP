<?php

include $_SERVER['DOCUMENT_ROOT'] . '/hoteles/models/Hotel.php';

class HotelesController {

    private $model;
    private $view;

    public function __construct() {
        $this->model = new HotelesModel();
        $this->view = new HotelesView();
    }

    /**
     * Muestra la lista de hoteles si hay una sesión de usuario activa.
     */
    public function mostrarHoteles() {
        // Gestiona las sesiones y verifica si hay una sesión activa.
        $sesion = $this->gestionarsesiones();

        if ($sesion) {
            try {
                // Obtiene la lista de hoteles del modelo.
                $hoteles = $this->model->getHoteles();
                $arraydehoteles = array();

                // Convierte los datos de los hoteles en objetos de la clase Hotel.
                foreach ($hoteles as $key => $hotel) {
                    $nuevohotel = new Hotel(
                        $hotel["id"],
                        $hotel["nombre"],
                        $hotel["direccion"],
                        $hotel["ciudad"],
                        $hotel["pais"],
                        $hotel["num_habitaciones"],
                        $hotel["descripcion"],
                        $hotel["foto"]
                    );

                    array_push($arraydehoteles, $nuevohotel);
                }

                // Muestra la vista de hoteles con la lista de objetos Hotel.
                $this->view->mostrarHoteles($arraydehoteles);
            } catch (Exception $exc) {
                // Maneja errores inesperados de manera genérica.
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
