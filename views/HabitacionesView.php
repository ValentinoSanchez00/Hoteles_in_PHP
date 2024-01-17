<?php

class HabitacionesView{
    
    
    
    public function mostrarHabitaciones($array) {
        ?>
        
        <h1>Bienvenido</h1>


        <div class="contenedor__hoteles">

        <?php
        $hoy= date('Y-m-d');
  //SELECT * FROM reservas WHERE id_habitacion = 1 AND '2022-01-01' NOT BETWEEN fecha_entrada AND fecha_salida;

        foreach ($array as $habitacion) {
            echo '<div class="hoteles">';
            echo "<p> Numero de habitación:" . $habitacion->getNum_habitaciones() . "</p>";
            echo "<p>Tipo de habitación: ".$habitacion->getTipo()."</p>";
            echo "<p>Precio:" . $habitacion->getPrecio() . "€</p>";
            echo "<p>" . $habitacion->getDescripcion() . "</p>";
            echo '<a href="index.php?controller=Habitaciones&action=mostrarHabitaciones&id='.$habitacion->getId_hotel().'">Reservar</a>';
            echo '</div>';
           
        }
        
        ?>
          </div>   
        
        <?php
   
        
    }
    
    
}