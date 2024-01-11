<?php

class HotelesController {

    private $model;
    private $view;

    public function __construct() {
        $this->model = new HotelesModel();
        $this->view = new HotelesView();
    }

    public function mostrarHoteles() {
        session_start();
        if (!$_SESSION["nombre"]) {
     header("Location: index.php?controller=Login&action=mostrarFormularioConErrores");
        }

        $hoteles = $this->model->getHoteles();

        $this->view->mostrarHoteles($hoteles);
    }
}
