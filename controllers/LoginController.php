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


        $usuarios = $this->model->comprobarUsuario($usr, $pass_coding);
        $idusu=$usuarios;
        if ($usuarios) {
            session_start();
            $_SESSION['id']=$idusu;
            
            header("Location: index.php?controller=Hoteles&action=mostrarHoteles");
            
        } else {
            $this->view->mostrarFormularioConErrores();
        }
    }
}
