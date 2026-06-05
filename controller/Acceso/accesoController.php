<?php 

    class AccesoController {
        public function login(){
            $correo = $_POST['usu_correo'];
            $clave = $_POST['usu_clave'];

            require_once 'lib/conf/connection.php';
            $connection = new Connection();
            $link = $connection->getConnect();

            $query = "SELECT * FROM usuario WHERE usu_correo = '$correo' AND usu_clave = '$clave'";
            $result = pg_query($link, $query);

            if (pg_num_rows($result) > 0) {
                session_start();
                $_SESSION['usuario'] = pg_fetch_assoc($result);
                echo json_encode(['success' => true]);
            } else {
                echo json_encode(['success' => false, 'message' => 'Correo o contraseña incorrectos']);
            }

            $connection->close();
        }
    }

?>