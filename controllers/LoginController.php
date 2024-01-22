<?php

class LoginController {

    private $model;
    private $view;

    public function __construct() {
        $this->model = new LoginModel();
        $this->view = new LoginView();
    }

    public function mostrarFormulario() {
        // Muestra la vista del formulario
        $this->view->mostrarFormulario();
    }

    public function mostrarLogin() {

        $this->view->mostrarFormulario();
    }

    public function comprobarUsuario() {
        $usr = $_POST["usuario"];
        $pass = $_POST["password"];
        $pass_coding = hash("sha256", $pass);
        try {
             $usuarios = $this->model->comprobarUsuario($usr, $pass_coding);
        } catch (Exception $exc) {
          "Error inesperado";
        }



       
       
        $idusu = $usuarios["id"];
        if ($usuarios) {
            session_start();
            $_SESSION['id'] = $idusu;
            $_SESSION['nombre'] = $usuarios["nombre"];
            $_SESSION['rol'] = $usuarios["rol"];

            header("Location: index.php?controller=Hoteles&action=mostrarHoteles");
        } else {
            $this->view->mostrarFormularioConErrores();
        }
        
    }

    public function cerrarsesion() {
        session_start();

// Limpia la información de la sesión actual
        $_SESSION = array();

// Destruye la sesión actual
        session_destroy();

// Redirecciona al usuario a la página de inicio
        header("Location: ./index.php?controller=Login&action=mostrarFormulario");
    }
    
    public function mostrarMantenimiento() {
        header("Location: ./views/MantenimientoView.php");
    }
    
}
