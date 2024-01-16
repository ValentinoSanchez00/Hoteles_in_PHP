<?php

class HotelesView {

    public function mostrarHoteles($arraydehoteles) {
        ?>
        
        <h1>Bienvenido</h1>


    <div class="contenedor__hoteles">

        <?php

        foreach ($arraydehoteles as $hotel) {
            echo '<div class="hoteles">';
            echo "<p>" . $hotel->getNombre() . "</p>";
            echo "<p>".$hotel->getDireccion()." ".$hotel->getCiudad()."(".$hotel->getPais().")"."</p>";
            echo "<p> Numero de habitaciones: " . $hotel->getNum_habitaciones() . "</p>";
            echo "<p>" . $hotel->getDescripcion() . "</p>";
            echo '<a href="index.php?controller=Habitaciones&action=mostrarHabitaciones&id='.$hotel->getId().'">Ver mas detalles</a>';
            echo '</div>';
        }
        
        ?>
          </div>   
        
        <?php
   
        
    }
    
}
