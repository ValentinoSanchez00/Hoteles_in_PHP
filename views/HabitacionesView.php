<?php

class HabitacionesView {

    public function mostrarHabitaciones($array) {
        ?>

        <h1>Bienvenido</h1>


        <div class="contenedor__hoteles">

            <?php
            $hoy = date('Y-m-d');
            //SELECT * FROM reservas WHERE id_habitacion = 1 AND '2022-01-01' BETWEEN fecha_entrada AND fecha_salida     SI NO SALE NADA; SE PUEDE RESERVAR;
           
            foreach ($array as $index => $habitacion) {
                echo '<div class="hoteles">';
                echo "<p> Numero de habitación:" . $habitacion->getNum_habitaciones() . "</p>";
                echo "<p>Tipo de habitación: " . $habitacion->getTipo() . "</p>";
                echo "<p>Precio:" . $habitacion->getPrecio() . "€</p>";
                echo "<p>" . $habitacion->getDescripcion() . "</p>";
                $id_capa = "miCapa_" . $index;
                $fechaactual = date("Y-m-d",);
                $fechaManana = date("Y-m-d", strtotime($fechaactual . ' +1 day'));
                echo '<td>
                        <form action="index.php?controller=Reservas&action=comprobarReserva&id_hotel=' . $habitacion->getId_hotel() . '&id_habitacion=' . $habitacion->getId() . '" method="POST">
                             <div class="mb-3">
                                 <label>Fecha de Entrada:</label>
                                  <input type="date" min="' . $fechaactual . '" name="fecha_entrada" required>
                              </div>
                              <div class="mb-3">
                                  <label>Fecha de Salida:</label>
                                  <input type="date" min="' . $fechaManana . '" name="fecha_salida" required>
                               </div>
                               <button type="submit" class="btn btn-primary">Reservar</button>
                          </form>
                                           
                       </td>';
                echo '</div>';
            }
            ?>
        </div>   

        <?php
    }
}
