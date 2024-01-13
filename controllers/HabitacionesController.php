<?php

class HabitacionesController {

    private $model;
    private $view;

    public function __construct() {
        $this->model = new HotelesModel();
        $this->view = new HotelesView();
    }

    public function mostrarHabitaciones() {
        session_start();
        if (!$_SESSION["nombre"]) {
     header("Location: index.php?controller=Login&action=mostrarFormularioConErrores");
        }

    }
}