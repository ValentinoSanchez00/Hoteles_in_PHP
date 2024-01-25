<?php

class LoginController {

    private $model;
    private $view;

    public function __construct() {
        $this->model = new LoginModel();
        $this->view = new LoginView();
    }

    /**
     * Muestra el formulario de inicio de sesión.
     */
    public function mostrarFormulario() {
        $this->view->mostrarFormulario();
    }

    /**
     * Método utilizado para mostrar el formulario de inicio de sesión.
     * Este método está duplicado con 'mostrarFormulario', considera eliminar uno.
     */
    public function mostrarLogin() {
        $this->view->mostrarFormulario();
    }

    /**
     * Comprueba las credenciales del usuario al recibir datos del formulario.
     */
    public function comprobarUsuario() {
        $usr = $_POST["usuario"];
        $pass = $_POST["password"];
        $pass_coding = hash("sha256", $pass);

        try {
            // Intenta validar las credenciales del usuario a través del modelo.
            $usuarios = $this->model->comprobarUsuario($usr, $pass_coding);
        } catch (Exception $exc) {
            // Maneja errores inesperados de manera genérica.
            echo "Error inesperado";
        }

        // Obtiene el id del usuario si las credenciales son válidas.
      

        if ($usuarios) {
              $idusu = $usuarios["id"];
            // Inicia una sesión y guarda información del usuario en variables de sesión.
            session_start();
            $_SESSION['id'] = $idusu;
            $_SESSION['nombre'] = $usuarios["nombre"];
            $_SESSION['rol'] = $usuarios["rol"];
            $diayhora= date("d/m/y | H:i:s");
            setcookie("ultimavez",$diayhora, time()+20*24*60*60);

            // Redirige al usuario a la página de hoteles después de iniciar sesión correctamente.
            header("Location: index.php?controller=Hoteles&action=mostrarHoteles");
        } else {
            // Muestra el formulario con mensajes de error si las credenciales son incorrectas.
            $this->view->mostrarFormularioConErrores();
        }
    }

    /**
     * Cierra la sesión actual del usuario.
     */
    public function cerrarsesion() {
        session_start();

        // Limpia la información de la sesión actual.
        $_SESSION = array();
         setcookie("ultimavez",$diayhora, time()-20*24*60*60);
        // Destruye la sesión actual.
        session_destroy();

        // Redirige al usuario a la página de inicio de sesión.
        header("Location: ./index.php?controller=Login&action=mostrarFormulario");
    }

    /**
     * Redirige a la página de mantenimiento.
     */
    public function mostrarMantenimiento() {
        header("Location: ./views/MantenimientoView.php");
    }

    /**
     * Gestiona las sesiones para garantizar que solo los usuarios autenticados puedan acceder.
     */
    public function gestionarsesiones() {
        session_start();
        
        // Redirige al formulario de inicio de sesión con errores si no hay una sesión válida.
        if (!$_SESSION["id"]) {
            header("Location: index.php?controller=Login&action=mostrarFormularioConErrores");
        }
    }

}
