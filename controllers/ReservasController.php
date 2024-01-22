<?php
include $_SERVER['DOCUMENT_ROOT'] . '/hoteles/models/Reserva.php';

class ReservasController {

    private $model;
    private $view;

    public function __construct() {
        $this->model = new ReservasModel();
        $this->view = new ReservasView();
    }
    
    
    
     public function comprobarReserva() {
        session_start();
        if (!$_SESSION["id"]) {
            header("Location: index.php?controller=Login&action=mostrarFormularioConErrores");
        }
        $id_hotel=$_GET['id_hotel'];
        $id_habitacion=$_GET['id_habitacion'];
        $fecha_entrada=$_POST['fecha_entrada'];
        $fecha_salida=$_POST['fecha_salida'];
        
        try {
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
        } catch (Exception $exc) {
            echo "Error inesperado";
        }



      
        
    }
    
    public function mostrarReservas() {
        
        session_start();
        if (!$_SESSION["id"]) {
            header("Location: index.php?controller=Login&action=mostrarFormularioConErrores");
        }
        
        $consulta=$this->model->mostrarReservas();
        $arraydereservas=[];
        foreach ($consulta as $reserva) {
            $reserva= new Reserva($reserva["id"],$reserva["id_usuario"],$reserva["id_hotel"],$reserva["id_habitacion"],$reserva["fecha_entrada"],$reserva["fecha_salida"]);
            array_push($arraydereservas,$reserva);
            
        }
        
        $this->view->mostrarReservas($arraydereservas);
        
        
    }
    
    public function mostrarDetallesReserva() {
        session_start();
        if (!$_SESSION["id"]) {
            header("Location: index.php?controller=Login&action=mostrarFormularioConErrores");
        }
        
        
        try {
            
        $consulta=$this->model->mostrarDetalleReserva($_GET['id_reserva']);
         $arraydereservadetallada=[];
        foreach ($consulta as $reserva) { 
            array_push($arraydereservadetallada,"Usuario_reserva: ".$reserva["nombre_usuario"]);
            array_push($arraydereservadetallada,"Id_habitación: ".$reserva["id_habitacion"]);
            array_push($arraydereservadetallada,"Fecha_entrada: ".$reserva["fecha_entrada"]);
            array_push($arraydereservadetallada,"Fecha_salida: ".$reserva["fecha_salida"]);
            array_push($arraydereservadetallada,"Nombre del hotel: ".$reserva["nombre"]);
            array_push($arraydereservadetallada,"Dirección : ".$reserva["direccion"]);
            array_push($arraydereservadetallada,"Ciudad: ".$reserva["ciudad"]);
            array_push($arraydereservadetallada,"Pais: ".$reserva["pais"]);
           
            
            
        }
        $this->view->mostrarReservasDetallada($arraydereservadetallada);
        } catch (Exception $exc) {
              echo "Error inesperado";
        }

        
        
    }
    
    
    
    
    
    
    
}