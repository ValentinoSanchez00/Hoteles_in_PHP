<?php

include $_SERVER['DOCUMENT_ROOT'] . '/hoteles/models/Hotel.php';


class HotelesController {

    private $model;
    private $view;

    public function __construct() {
        $this->model = new HotelesModel();
        $this->view = new HotelesView();
    }

    public function mostrarHoteles() {
        session_start();
        if (!$_SESSION["id"]) {
            header("Location: index.php?controller=Login&action=mostrarFormularioConErrores");
        }

        $hoteles = $this->model->getHoteles();
        $arraydehoteles=array();
            foreach ($hoteles as $key => $hotel) {
          
                $nuevohotel=new Hotel($hotel["id"],$hotel["nombre"],$hotel["direccion"],$hotel["ciudad"],$hotel["pais"],$hotel["num_habitaciones"],$hotel["descripcion"],$hotel["foto"]);
         
                array_push($arraydehoteles, $nuevohotel);
            }
            
            
        $this->view->mostrarHoteles($arraydehoteles);
    }
}
