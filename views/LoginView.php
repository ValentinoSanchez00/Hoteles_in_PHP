<?php

class LoginView{
    
       public function mostrarFormulario() {

        // Genera el formulario
        echo '<form action="index.php?controller=Login&action=comprobarUsuario" method="POST">';
        echo '<label>Usuario:</label>';
        echo '<input type="text" name="usuario"">';
        echo '<br>';
        echo '<label>Contraseña:</label>';
       echo '<input type="password" name="password"">';
        echo '<br>';
        echo '<input type="submit" value="Iniciar Sesión">';
        echo '</form>';
    }
    public function mostrarFormularioConErrores() {
        echo '<p class="error-message">Error: Usuaro o Contraseña incorrectos</p>';
        echo '<form action="index.php?controller=Login&action=comprobarUsuario" method="POST">';
        echo '<label>Usuario:</label>';
        echo '<input type="text" name="usuario"">';
        echo '<br>';
        echo '<label>Contraseña:</label>';
       echo '<input type="password" name="password"">';
        echo '<br>';
        echo '<input type="submit" value="Iniciar Sesión">';
        echo '</form>';
    }
    
    
    
    
    
    
}

