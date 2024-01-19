<?php

class ReservasView {

    public function mostrarReservas($array) {
        ?>

        <h1>Bienvenido <?php echo ucfirst($_SESSION['nombre']); ?></h1>
        <div class="contenedor__hoteles">

            <?php
            $hoy = date('Y-m-d');

            //SELECT * FROM reservas WHERE id_habitacion = 1 AND '2022-01-01' BETWEEN fecha_entrada AND fecha_salida     SI NO SALE NADA; SE PUEDE RESERVAR;

            foreach ($array as $index => $reserva) {
                echo '<div class="hoteles">';
                echo "<p> Numero de habitación:" . $reserva->getId_habitacion() . "</p>";
                echo "<p>Fecha entrada: <br> " . $reserva->getFecha_entrada() . "</p>";
                echo "<p>Fecha salida: <br>" . $reserva->getFecha_salida() . "</p>";
                echo '<a class="a_navegacion" href="./index.php?controller=Reservas&action=mostrarDetallesReserva&id_reserva=' . $reserva->getId() . '">Ver Detalles</a>';
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

    public function mostrarReservasDetallada($array) {
        ?>

        <h1>Bienvenido <?php echo ucfirst($_SESSION['nombre']); ?></h1>
        <div class="contenedor__hoteles">

        <?php
        $hoy = date('Y-m-d');

        //SELECT * FROM reservas WHERE id_habitacion = 1 AND '2022-01-01' BETWEEN fecha_entrada AND fecha_salida     SI NO SALE NADA; SE PUEDE RESERVAR;
        echo '<div class="hoteles">';
        foreach ($array as $index => $reserva) {
            echo "  ".$reserva."  /";
        }
        echo '</div>';
        ?>
        </div>  
        <div class="contenedor__hoteles">
            <a class="a_navegacion" href="./index.php?controller=Reservas&action=mostrarReservas">Volver</a>
            <a class="a_navegacion" href="index.php?controller=Login&action=cerrarsesion">Cerrar Sesión</a>
        </div>

        <?php
    }
}
