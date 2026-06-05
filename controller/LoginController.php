<?php
    include_once("../model/Acceso/Acceso.php");

    class LoginController {

        public function index() {
            include_once("../web/login.php");
        }

        public function login() {

            $email      = $_POST['usuario'];
            $contrasena = md5($_POST['contrasena']);

            $modelo    = new Acceso();
            $resultado = $modelo->findOne("usuarios", "*", "email='$email' AND contrasena='$contrasena'");

            if ($resultado == "No se encontró ningún registro") {
                $_SESSION['error'] = "Correo o contraseña incorrectos";
                redirect('../web/login.php');
            } else {
                $usuario = mysqli_fetch_assoc($resultado);

                $_SESSION['id']     = $usuario['id'];
                $_SESSION['email']  = $usuario['email'];
                $_SESSION['nombre'] = $usuario['nombre'];

                redirect('../web/index.php');
            }
        }

        public function logout() {
            session_destroy();
            redirect('../web/login.php');
        }
    }
?>

