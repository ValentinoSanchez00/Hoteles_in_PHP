<?php


class LoginController {

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
           $id_usuario=$_SERVER["id"];
           $this->model->insertarReserva($id_hotel,$id_habitacion,$fecha_entrada,$fecha_salida,$id_usuario); 
       }
        else {
           
       }
        
    }
    
    
    
    
    
    
}