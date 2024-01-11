<?php

class LoginController{
    private $moodel;
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
        $pass=$_POST[""];
        $usr=$_POST[""];
        $this->model->getUsuario();
        
    }
    
    
    
    
    
}
