<?php

class HotelesView {

    /**
     * Muestra la información de los hoteles.
     * @param array $arraydehoteles Arreglo de objetos Hotel.
     * @return void
     */
    public function mostrarHoteles($arraydehoteles) {
        ?>
        
       <h1>Bienvenido <?php echo ucfirst($_SESSION['nombre']);?></h1>

        <div class="contenedor__hoteles">

        <?php
        foreach ($arraydehoteles as $hotel) {
            echo '<div class="hoteles">';
            echo '<img class="img-fluid mb-3" src="data:image/jpeg;base64,'.base64_encode($hotel->getFoto()) .' "/>';
            echo "<p>" . $hotel->getNombre() . "</p>";
            echo "<p>".$hotel->getDireccion()." ".$hotel->getCiudad()."(".$hotel->getPais().")"."</p>";
            echo "<p> Numero de habitaciones: " . $hotel->getNum_habitaciones() . "</p>";
            echo "<p>" . $hotel->getDescripcion() . "</p>";
            echo '<a class="btn btn-primary" href="index.php?controller=Habitaciones&action=mostrarHabitaciones&id='.$hotel->getId().'">Ver más detalles</a>';
            echo '</div>';
        }
        ?>
        </div>  
        <div class="contenedor__hoteles">
            <a class="a_navegacion" href="./index.php?controller=Login&action=mostrarFormulario">Volver</a>
            <a class="a_navegacion" href="index.php?controller=Login&action=cerrarsesion">Cerrar Sesión</a>
        </div>
        
        <?php
    }
}
