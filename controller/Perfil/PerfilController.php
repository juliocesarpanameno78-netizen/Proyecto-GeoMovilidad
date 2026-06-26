<?php

include_once '../model/Usuarios/UsuariosModel.php';

class PerfilController
{

    public function getPerfil()
    {
        $obj = new UsuariosModel();

        $id_usuario = $_SESSION['id_usuario'];

        $usuario = $obj->obtenerUsuario($id_usuario);

        include_once '../view/Perfil/perfil.php';
    }

    public function postActualizar()
    {
        $obj = new UsuariosModel();

        $id_usuario = $_SESSION['id_usuario'];

        $nombre = trim($_POST['nombre']);
        $apellido = trim($_POST['apellido']);
        $telefono = trim($_POST['telefono']);
        $direccion = trim($_POST['direccion']);
        $correo = trim($_POST['correo_electronico']);
        $nombre_usuario = trim($_POST['nombre_usuario']);

        $clave_actual = trim($_POST['clave_actual']);
        $nueva_clave = trim($_POST['nueva_clave']);
        $confirmar_clave = trim($_POST['confirmar_clave']);

        if ($nombre == "") {
            $_SESSION['error_perfil'] = "Debe ingresar un nombre";
            redirect(getUrl("Perfil", "Perfil", "getPerfil"));
            return;
        }

        if ($apellido == "") {
            $_SESSION['error_perfil'] = "Debe ingresar un apellido";
            redirect(getUrl("Perfil", "Perfil", "getPerfil"));
            return;
        }

        if ($correo == "") {
            $_SESSION['error_perfil'] = "Debe ingresar un correo";
            redirect(getUrl("Perfil", "Perfil", "getPerfil"));
            return;
        }
        if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
            $_SESSION['error_perfil'] = "Debe ingresar un correo válido";
            redirect(getUrl("Perfil", "Perfil", "getPerfil"));
            return;
        }

        if ($nombre_usuario == "") {
            $_SESSION['error_perfil'] = "Debe ingresar un nombre de usuario";
            redirect(getUrl("Perfil", "Perfil", "getPerfil"));
            return;
        }

        $correo_existente = $obj->existeCorreo($correo, $id_usuario);

        if (count($correo_existente) > 0) {
            $_SESSION['error_perfil'] = "El correo ya se encuentra registrado";
            redirect(getUrl("Perfil", "Perfil", "getPerfil"));
            return;
        }

        $usuario_existente = $obj->existeUsuario($nombre_usuario, $id_usuario);

        if (count($usuario_existente) > 0) {
            $_SESSION['error_perfil'] = "El nombre de usuario ya existe";
            redirect(getUrl("Perfil", "Perfil", "getPerfil"));
            return;
        }

        if ($telefono != "" && !is_numeric($telefono)) {
            $_SESSION['error_perfil'] = "El teléfono solo puede contener números";
            redirect(getUrl("Perfil", "Perfil", "getPerfil"));
            return;
        }

        if ($telefono != "" && strlen($telefono) != 10) {
            $_SESSION['error_perfil'] = "El teléfono debe tener exactamente 10 dígitos";
            redirect(getUrl("Perfil", "Perfil", "getPerfil"));
            return;
        }


       if ($clave_actual != "" || $nueva_clave != "" || $confirmar_clave != "") {

            if ($clave_actual == "") {
                $_SESSION['error_perfil'] = "Debe ingresar la contraseña actual";
                redirect(getUrl("Perfil", "Perfil", "getPerfil"));
                return;
            }

            $clave_bd = $obj->obtenerClave($id_usuario);

            if ($clave_bd != md5($clave_actual)) {
                $_SESSION['error_perfil'] = "La contraseña actual es incorrecta";
                redirect(getUrl("Perfil", "Perfil", "getPerfil"));
                return;
            }

            if ($nueva_clave == "") {
                $_SESSION['error_perfil'] = "Debe ingresar la nueva contraseña";
                redirect(getUrl("Perfil", "Perfil", "getPerfil"));
                return;
            }

            if ($confirmar_clave == "") {
                $_SESSION['error_perfil'] = "Debe confirmar la nueva contraseña";
                redirect(getUrl("Perfil", "Perfil", "getPerfil"));
                return;
            }

            if ($nueva_clave != $confirmar_clave) {
                $_SESSION['error_perfil'] = "La nueva contraseña y su confirmación no coinciden";
                redirect(getUrl("Perfil", "Perfil", "getPerfil"));
                return;
            }

            $obj->actualizarClave($id_usuario, md5($nueva_clave));
        }

        $datos = array(
            'id_usuario' => $id_usuario,
            'nombre' => $nombre,
            'apellido' => $apellido,
            'telefono' => $telefono,
            'direccion' => $direccion,
            'correo' => $correo,
            'nombre_usuario' => $nombre_usuario
        );

        $obj->actualizarPerfil($datos);

        $_SESSION['nombre_usuario'] = $nombre_usuario;
        $_SESSION['usu_email'] = $correo;
        $_SESSION['nombre_completo'] = $nombre . " " . $apellido;
        $_SESSION['success_perfil'] = "Perfil actualizado correctamente";

        redirect(getUrl("Perfil", "Perfil", "getPerfil"));
    }

}
?>