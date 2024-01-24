<?php

class ReservasView {

    // Función para mostrar la lista de reservas
    public function mostrarReservas($array) {
        ?>

        <!-- Encabezado de la página -->
        <h1>Bienvenido <?php echo ucfirst($_SESSION['nombre']); ?></h1>

        <!-- Contenedor de reservas -->
        <div class="contenedor__hoteles">

            <?php
            $hoy = date('Y-m-d');

            // Iterar sobre las reservas en el array
            foreach ($array as $reserva) {
                echo '<div class="hoteles">';
                
                // Mostrar detalles de la reserva
                echo "<p>Numero de habitación: " . $reserva->getId_habitacion() . "</p>";
                echo "<p>Fecha entrada: <br> " . $reserva->getFecha_entrada() . "</p>";
                echo "<p>Fecha salida: <br>" . $reserva->getFecha_salida() . "</p>";

                // Enlace para ver detalles adicionales
                echo '<a class="a_navegacion" href="./index.php?controller=Reservas&action=mostrarDetallesReserva&id_reserva=' . $reserva->getId() . '">Ver Detalles</a>';
                
                echo '</div>';
            }
            ?>
        </div>  

        <!-- Navegación y cierre de sesión -->
        <div class="contenedor__hoteles">
            <a class="a_navegacion" href="./index.php?controller=Hoteles&action=mostrarHoteles">Volver</a>
            <a class="a_navegacion" href="index.php?controller=Login&action=cerrarsesion">Cerrar Sesión</a>
        </div>

        <?php
    }

    // Función para mostrar detalles detallados de una reserva
    public function mostrarReservasDetallada($array) {
        ?>

        <!-- Encabezado de la página -->
        <h1>Bienvenido <?php echo ucfirst($_SESSION['nombre']); ?></h1>

        <!-- Contenedor de reservas detalladas -->
        <div class="contenedor__hoteles">

        <?php
        $hoy = date('Y-m-d');

        // Iterar sobre las reservas en el array
        echo '<div class="hoteles">';
        foreach ($array as $reserva) {
            echo "  ".$reserva."  /";
        }
        echo '</div>';
        ?>
        </div>  

        <!-- Navegación y cierre de sesión -->
        <div class="contenedor__hoteles">
            <a class="a_navegacion" href="./index.php?controller=Reservas&action=mostrarReservas">Volver</a>
            <a class="a_navegacion" href="index.php?controller=Login&action=cerrarsesion">Cerrar Sesión</a>
        </div>

        <?php
    }
}
