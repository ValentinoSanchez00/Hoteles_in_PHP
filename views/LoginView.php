<?php

class LoginView {
    
    /**
     * Muestra el formulario de inicio de sesión.
     * @return void
     */
    public function mostrarFormulario() {
        // Genera el formulario
        ?>
        <form action="index.php?controller=Login&action=comprobarUsuario" method="POST">
            <label>Usuario:</label>
            <input type="text" name="usuario" required>
            <br>
            <label>Contraseña:</label>
            <input type="password" name="password" required>
            <br>
            <input type="submit" value="Iniciar Sesión">
        </form>
        <?php
    }

    /**
     * Muestra el formulario de inicio de sesión con un mensaje de error.
     * @return void
     */
    public function mostrarFormularioConErrores() {
        ?>
        <p class="error-message">Error: Usuario o Contraseña incorrectos</p>
        <form action="index.php?controller=Login&action=comprobarUsuario" method="POST">
            <label>Usuario:</label>
            <input type="text" name="usuario" required>
            <br>
            <label>Contraseña:</label>
            <input type="password" name="password" required>
            <br>
            <input type="submit" value="Iniciar Sesión">
        </form>
        <?php
    }
}
