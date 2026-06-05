<?php
    include_once("../model/Acceso/Acceso.php");

    class LoginController {

        public function index() {
            include_once("../web/login.php");
        }

        public function login() {

            $correo    = $_POST['usuario'];
            $contrasena = md5($_POST['contrasena']);

            $modelo    = new Acceso();
            $resultado = $modelo->getUsuario($correo, $contrasena);

            if ($resultado == "No se encontró ningún registro") {
                $_SESSION['error'] = "Correo o contraseña incorrectos";
                redirect('login.php');
            } else {
                $usuario = pg_fetch_assoc($resultado);

                $_SESSION['id']     = $usuario['id_usuario'];
                $_SESSION['nombre'] = $usuario['nombre_usuario'];
                $_SESSION['correo'] = $usuario['correo_electronico'];
                $_SESSION['rol']    = $usuario['nombre_rol'];

                redirect('index.php?modulo=Dashboard&controlador=Dashboard&funcion=index');
            }
        }

        public function logout() {
            session_destroy();
            redirect('login.php');
        }
    }
?>