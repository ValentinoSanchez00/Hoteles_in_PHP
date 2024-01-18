<?php


class ReservasController {

    private $model;
    private $view;

    public function __construct() {
        $this->model = new ReservasModel();
        $this->view = new ReservasView();
    }
    
    
    
     public function comprobarReserva() {
        $id_hotel=$_GET['id_hotel'];
        $id_habitacion=$_GET['id_habitacion'];
        $fecha_entrada=$_POST['fecha_entrada'];
        $fecha_salida=$_POST['fecha_salida'];
        
       $puedoreserva = $this->model->comprobarReserva($id_hotel,$id_habitacion,$fecha_entrada,$fecha_salida);
       if ($puedoreserva) {
           session_start();
           $id_usuario=$_SESSION["id"];
           $this->model->insertarReserva($id_hotel,$id_habitacion,$fecha_entrada,$fecha_salida,$id_usuario); 
            header("Location: index.php?controller=Habitaciones&action=mostrarHabitaciones&succes&id=".$id_hotel);
       }
        else {
           header("Location: index.php?controller=Habitaciones&action=mostrarHabitaciones&wrong&id=".$id_hotel);
       }
        
    }
    
    
    
    
    
    
}