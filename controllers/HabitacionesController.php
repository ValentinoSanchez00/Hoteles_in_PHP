<?php

include $_SERVER['DOCUMENT_ROOT'] . '/hoteles/models/Habitacion.php';

class HabitacionesController {

    private $model;
    private $view;

    public function __construct() {
        $this->model = new HabitacionessModel ();
        $this->view = new HabitacionesView ();
    }

    public function mostrarHabitaciones() {
        session_start();
        if (!$_SESSION["id"]) {
            header("Location: index.php?controller=Login&action=mostrarFormularioConErrores");
        }

        $id = $_GET['id'];
        $habitaciones = $this->model->getHabitacionesconid($id);

        $arraydehabitaciones = array();
        foreach ($habitaciones as $key => $habitacionfila) {

            $nuevaHabitacion = new Habitacion($habitacionfila["id"], $habitacionfila["id_hotel"], $habitacionfila["num_habitacion"], $habitacionfila["tipo"], $habitacionfila["precio"], $habitacionfila["descripcion"]);

            array_push($arraydehabitaciones, $nuevaHabitacion);
        }

        $this-> verHabitaciones($arraydehabitaciones);
    }

    public function verHabitaciones($arraydehabitaciones) {

        if (isset($_GET["succes"])) {
             $this->view->mostrarHabitacionesCorrecta($arraydehabitaciones);
        } elseif (isset($_GET["wrong"])) {
             $this->view->mostrarHabitacionesFallada($arraydehabitaciones);
        } else {
            $this->view->mostrarHabitaciones($arraydehabitaciones);
        }
    }
}
