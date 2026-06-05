<?php
    include_once "../model/Acceso/AccesoModel.php";

    class AccesoController{
        public function login(){
            
            $obj=new AccesoModel();

            $usu_correo=$_POST['usu_correo'];
            $usu_clave=$_POST['usu_clave'];

            $sql = "SELECT u.*, r.rol_nombre FROM usuario AS u, rol AS r WHERE u.
            usu_correo='$usu_correo' AND u.usu_clave='$usu_clave' AND u.rol_id=r.rol_id";

            $usuario=$obj->select($sql);

            if(mysqli_num_rows($usuario)>0){

                foreach($usuario as $usu){
                    $_SESSION['nombre'] = $usu['usu_nombre'];
                    $_SESSION['apellido'] = $usu['usu_apellido'];
                    $_SESSION['correo'] = $usu['usu_correo'];
                    $_SESSION['rol'] = $usu['rol_nombre'];
                    $_SESSION['auth']="ok";
                }

                redirect("index.php");
            }else{
                //echo "no entre";
                redirect("login.php");
            }

        }
        public function logout(){
            session_destroy();
            redirect("login.php");
        }
    }
?>


