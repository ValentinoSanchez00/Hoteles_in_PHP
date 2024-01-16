<?php
include $_SERVER['DOCUMENT_ROOT'] . '/hoteles/models/Habitacion.php';
class HabitacionesController {

    private $model;
    private $view;

    public function __construct() {
        $this->model = new HabitacionesModel();
        $this->view = new HabitacionesView();
    }

    public function mostrarHabitaciones() {
        session_start();
        if (!$_SESSION["nombre"]) {
     header("Location: index.php?controller=Login&action=mostrarFormularioConErrores");
        }
        
        $id=$_GET['id'];
        $habitaciones =$this->model->getHabitacionesconid($id);
        
          $arraydehabitaciones=array();
            foreach ($habitaciones as $key => $habitacionfila) {
          
                $nuevaHabitacion=new Habitacion($habitacionfila["id"],$habitacionfila["id_hotel"],$habitacionfila["num_habitacion"],$habitacionfila["tipo"],$habitacionfila["precio"],$habitacionfila["descripcion"]);
         
                array_push($arraydehabitaciones, $nuevaHabitacion);
            }
            
            
        $this->view->mostrarHabitacion($arraydehabitaciones);

    }
}