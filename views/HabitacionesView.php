<?php

class HabitacionesView{
    
    
    
    public function mostrarHabitaciones($array) {
        ?>
        
        <h1>Bienvenido</h1>


    <div class="contenedor__hoteles">

        <?php

        foreach ($array as $habitacion) {
            echo '<div class="hoteles">';
            echo "<p>" . $habitacion->getNum_habitacion() . "</p>";
            echo "<p>".$habitacion->getTipo()."</p>";
            echo "<p>" . $habitacion->getPrecio() . "</p>";
            echo "<p>" . $habitacion->getDescripcion() . "</p>";
            echo '<a href="index.php?controller=Habitaciones&action=mostrarHabitaciones&id='.$hotel->getId().'">Ver mas detalles</a>';
            echo '</div>';
        }
        
        ?>
          </div>   
        
        <?php
   
        
    }
    
    
}