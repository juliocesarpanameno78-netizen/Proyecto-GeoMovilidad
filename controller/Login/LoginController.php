<?php
include_once '../model/Login/LoginModel.php';
include_once '../lib/helpers.php';

class LoginController {

    public function getLogin() {
        session_start();
        if (isset($_SESSION['id_usuario'])) {
            redirect('../web/index.php');
        }
        include_once '../view/Login.php';
    }

    public function postLogin() {
        session_start();

        $correo    = $_POST['correo'];
        $contrasena = $_POST['contrasena'];

        $obj = new LoginModel();
        $usuario = $obj->login($correo, $contrasena);

        if ($usuario) {
            $_SESSION['id_usuario']    = $usuario['id_usuario'];
            $_SESSION['nombre_usuario'] = $usuario['nombre_usuario'];
            $_SESSION['id_rol']        = $usuario['id_rol'];

            redirect('/Geomovilidad/web/index.php');
        } else {
            redirect('/Geomovilidad/view/Login/Login.php?error=1');
        }
    }

    public function logout() {
        session_start();
        session_destroy();
        redirect('../view/Login.php');
    }
}
?>