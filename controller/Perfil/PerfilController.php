<?php

include_once '../model/Perfil/PerfilModel.php';

class PerfilController
{

    public function getPerfil()
    {
        $obj = new PerfilModel();

        $id_usuario = $_SESSION['id_usuario'];

        $usuario = $obj->obtenerPerfil($id_usuario);

        include_once '../view/Perfil/perfil.php';
    }

    public function postActualizar()
    {

        $obj = new PerfilModel();

        $id_usuario = $_POST['id_usuario'];

        $nombre = trim($_POST['nombre']);
        $apellido = trim($_POST['apellido']);
        $correo = trim($_POST['correo_electronico']);
        $usuario = trim($_POST['nombre_usuario']);
        $telefono = trim($_POST['telefono']);
        $direccion = trim($_POST['direccion']);

        if ($nombre == "") {

            $_SESSION['error_perfil'] = "Debe ingresar un nombre";

            redirect(getUrl("Perfil","Perfil","getPerfil"));

            return;
        }

        if ($apellido == "") {

            $_SESSION['error_perfil'] = "Debe ingresar un apellido";

            redirect(getUrl("Perfil","Perfil","getPerfil"));

            return;
        }

        if ($correo == "") {

            $_SESSION['error_perfil'] = "Debe ingresar un correo";

            redirect(getUrl("Perfil","Perfil","getPerfil"));

            return;
        }

        if ($usuario == "") {

            $_SESSION['error_perfil'] = "Debe ingresar un nombre de usuario";

            redirect(getUrl("Perfil","Perfil","getPerfil"));

            return;
        }

        if ($telefono != "") {

            if (!is_numeric($telefono)) {

                $_SESSION['error_perfil'] = "El teléfono sólo puede contener números";

                redirect(getUrl("Perfil","Perfil","getPerfil"));

                return;
            }

            if (strlen($telefono) != 10) {

                $_SESSION['error_perfil'] = "El teléfono debe tener 10 dígitos";

                redirect(getUrl("Perfil","Perfil","getPerfil"));

                return;
            }

        }

        if(count($obj->correoExiste($correo,$id_usuario))>0){

            $_SESSION['error_perfil']="Ese correo ya pertenece a otro usuario";

            redirect(getUrl("Perfil","Perfil","getPerfil"));

            return;

        }

        if(count($obj->usuarioExiste($usuario,$id_usuario))>0){

            $_SESSION['error_perfil']="Ese nombre de usuario ya existe";

            redirect(getUrl("Perfil","Perfil","getPerfil"));

            return;

        }

        $datos=array(

            "id_usuario"=>$id_usuario,

            "nombre"=>$nombre,

            "apellido"=>$apellido,

            "correo"=>$correo,

            "usuario"=>$usuario,

            "telefono"=>$telefono,

            "direccion"=>$direccion

        );

        $obj->actualizarPerfil($datos);

        $_SESSION['nombre_usuario']=$usuario;
        $_SESSION['usu_email']=$correo;
        $_SESSION['per_nombre']=$nombre;
        $_SESSION['per_apellido']=$apellido;
        $_SESSION['per_telefono']=$telefono;
        $_SESSION['per_direccion']=$direccion;
        $_SESSION['nombre_completo']=$nombre." ".$apellido;

        $_SESSION['success_perfil']="Información actualizada correctamente.";

        redirect(getUrl("Perfil","Perfil","getPerfil"));

    }


    public function postCambiarClave(){

        $obj=new PerfilModel();

        $id_usuario=$_POST['id_usuario'];

        $actual=$_POST['clave_actual'];

        $nueva=$_POST['nueva_clave'];

        $confirmar=$_POST['confirmar_clave'];

        if($actual=="" || $nueva=="" || $confirmar==""){

            $_SESSION['error_perfil']="Debe completar todos los campos.";

            redirect(getUrl("Perfil","Perfil","getPerfil"));

            return;

        }

        if($nueva!=$confirmar){

            $_SESSION['error_perfil']="Las contraseñas no coinciden.";

            redirect(getUrl("Perfil","Perfil","getPerfil"));

            return;

        }

        if(strlen($nueva)<6){

            $_SESSION['error_perfil']="La contraseña debe tener mínimo 6 caracteres.";

            redirect(getUrl("Perfil","Perfil","getPerfil"));

            return;

        }

        if(!$obj->validarClaveActual($id_usuario,$actual)){

            $_SESSION['error_perfil']="La contraseña actual es incorrecta.";

            redirect(getUrl("Perfil","Perfil","getPerfil"));

            return;

        }

        $obj->actualizarClave($id_usuario,$nueva);

        $_SESSION['success_perfil']="Contraseña actualizada correctamente.";

        redirect(getUrl("Perfil","Perfil","getPerfil"));

    }

}

?>