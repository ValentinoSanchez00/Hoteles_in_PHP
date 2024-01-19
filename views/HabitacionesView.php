<?php

class HabitacionesView {

    public function mostrarHabitaciones($array) {
        ?>

        <h1>Bienvenido <?php echo ucfirst($_SESSION['nombre']); ?></h1>
        <?php
        if ($_SESSION["rol"] == 1) {
            echo ' <a class="a_navegacion" href="index.php?controller=Reservas&action=mostrarReservas">Mostrar Reservas</a>';
        }
        ?>

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
        <div class="contenedor__hoteles">
            <a class="a_navegacion" href="./index.php?controller=Hoteles&action=mostrarHoteles">Volver</a>
            <a class="a_navegacion" href="index.php?controller=Login&action=cerrarsesion">Cerrar Sesión</a>
        </div>

        <?php
    }

    public function mostrarHabitacionesFallada($array) {
        ?>

        <h1>Bienvenido <?php echo ucfirst($_SESSION['nombre']); ?></h1>
        <?php
        if ($_SESSION["rol"] == 1) {
            echo ' <a class="a_navegacion" href="index.php?controller=Reservas&action=mostrarReservas">Mostrar Reservas</a>';
        }
        ?>

        <div class="alert alert-danger" role="alert">
            Error: No se ha podido hacer la reserva, en esas fechas ya esta reservada
        </div>

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
        <div class="contenedor__hoteles">
            <a class="a_navegacion" href="./index.php?controller=Hoteles&action=mostrarHoteles">Volver</a>
            <a class="a_navegacion" href="index.php?controller=Login&action=cerrarsesion">Cerrar Sesión</a>
        </div>

        <?php
    }

    public function mostrarHabitacionesCorrecta($array) {
        ?>

        <h1>Bienvenido <?php echo ucfirst($_SESSION['nombre']); ?></h1>
        <?php
          if ($_SESSION["rol"]==1) {
                echo ' <a class="a_navegacion" href="index.php?controller=Reservas&action=mostrarReservas">Mostrar Reservas</a>';
            }
        ?>
        <div class="alert alert-success" role="alert">
            Reserva Realizada Correctamente
        </div>

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
        <div class="contenedor__hoteles">
            <a class="a_navegacion" href="./index.php?controller=Hoteles&action=mostrarHoteles">Volver</a>
            <a class="a_navegacion" href="index.php?controller=Login&action=cerrarsesion">Cerrar Sesión</a>
        </div>

        <?php
    }
}
