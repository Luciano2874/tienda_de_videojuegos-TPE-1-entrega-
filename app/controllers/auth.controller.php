<?php

require_once 'app/models/user.model.php';
require_once 'app/views/auth.view.php';

class authController {

    private $user_model;
    private $user_view;

    public function __construct(){
        $this->user_model = new userModel();
        $this->user_view = new authView();
    }

    public function showLogin(){
        $this->user_view->showLogin();
    }

    public function login(){
        if (!isset($_POST['email']) || empty($_POST['email'])) {
            return $this->user_view->showLogin("Falta completar el email");
        }

        if (!isset($_POST['password']) || empty($_POST['password'])) {
            return $this->user_view->showLogin("Falta completar la contraseña");
        }

        $email = $_POST['email'];
        $password = $_POST['password'];

        
        $userFromDB = $this->user_model->getUserByEmail($email);

        if($userFromDB && password_verify($password, $userFromDB->password)) {
            session_start();
            $_SESSION['ID_USER'] = $userFromDB->id;
            $_SESSION['EMAIL_USER'] = $userFromDB->email;
            
            header("Location: " . BASE_URL . "home");
        } else {
            return $this->user_view->showLogin("Ha introducido datos incorrectos");
        }
    }

    public function logout() {
        session_start();
        session_destroy();

        header("Location: " . BASE_URL . "home");
    }
   
}