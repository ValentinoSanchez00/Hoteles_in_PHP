<?php

class HotelesView {

    public function mostrarHoteles($hoteles) {
        foreach ($hoteles as $key => $hotel) {
            echo '<div>';
           
            $i=0;
            foreach ($hotel as $valor) {
                if ($i==4) {
                     echo  "<p> Num Habitaciones:".$valor . "</p>";
                }
            else {
                echo  "<p>".$valor ."</p>";
            }
               
               $i++;
            }
            
            
 
            
            echo '<a href="index.php?controller=Habitaciones&action=mostrarHabitaciones">Ver mas detalles</a>';
            echo '</div>';
            echo '<br>';
            
            
        }
    }
}
