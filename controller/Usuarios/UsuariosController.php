<?php

include_once '../model/Usuarios/UsuariosModel.php';

class UsuariosController
{

    public function getUsuarios()
    {
        $obj = new UsuariosModel();

        $usuarios = $obj->listarUsuarios();

        include_once '../view/listarUsuarios/listaUsuarios.php';
    }

    public function getUpdate()
    {
        $obj = new UsuariosModel();

        $id_usuario = $_GET['id_usuario'];

        $usuario = $obj->obtenerUsuario($id_usuario);

        $roles = $obj->listarRoles();

        include_once '../view/listarUsuarios/editarUsuarios.php';
    }

    public function postUpdate()
    {
        $obj = new UsuariosModel();

        $id_usuario = $_POST['id_usuario'];

        $nombre = trim($_POST['nombre']);
        $apellido = trim($_POST['apellido']);
        $telefono = trim($_POST['telefono']);
        $direccion = trim($_POST['direccion']);
        $correo = trim($_POST['correo_electronico']);
        $nombre_usuario = trim($_POST['nombre_usuario']);
        $id_rol = $_POST['id_rol'];

        if ($nombre == "") {
            $_SESSION['error_usuario'] = "Debe ingresar un nombre";
            redirect(getUrl("Usuarios", "Usuarios", "getUpdate") . "&id_usuario=" . $id_usuario);
            return;
        }

        if ($apellido == "") {
            $_SESSION['error_usuario'] = "Debe ingresar un apellido";
            redirect(getUrl("Usuarios", "Usuarios", "getUpdate") . "&id_usuario=" . $id_usuario);
            return;
        }

        if ($correo == "") {
            $_SESSION['error_usuario'] = "Debe ingresar un correo";
            redirect(getUrl("Usuarios", "Usuarios", "getUpdate") . "&id_usuario=" . $id_usuario);
            return;
        }

        $correo_existente = $obj->existeCorreo($correo, $id_usuario);

        if (count($correo_existente) > 0) {
            $_SESSION['error_usuario'] = "El correo ya se encuentra registrado";
            redirect(getUrl("Usuarios", "Usuarios", "getUpdate") . "&id_usuario=" . $id_usuario);
            return;
        }

        $usuario_existente = $obj->existeUsuario($nombre_usuario, $id_usuario);

        if (count($usuario_existente) > 0) {
            $_SESSION['error_usuario'] = "El nombre de usuario ya existe";
            redirect(getUrl("Usuarios", "Usuarios", "getUpdate") . "&id_usuario=" . $id_usuario);
            return;
        }

        $rol_existente = $obj->existeRol($id_rol);

        if (count($rol_existente) == 0) {
            $_SESSION['error_usuario'] = "El rol seleccionado no existe";
            redirect(getUrl("Usuarios", "Usuarios", "getUpdate") . "&id_usuario=" . $id_usuario);
            return;
        }

        if ($telefono != "" && !is_numeric($telefono)) {
            $_SESSION['error_usuario'] = "El teléfono solo puede contener números";
            redirect(getUrl("Usuarios", "Usuarios", "getUpdate") . "&id_usuario=" . $id_usuario);
            return;
        }

        if ($telefono != "" && strlen($telefono) != 10) {
            $_SESSION['error_usuario'] = "El teléfono debe tener exactamente 10 dígitos";
            redirect(getUrl("Usuarios", "Usuarios", "getUpdate") . "&id_usuario=" . $id_usuario);
            return;
        }

        $datos = array(
            'id_usuario' => $id_usuario,
            'nombre' => $nombre,
            'apellido' => $apellido,
            'telefono' => $telefono,
            'direccion' => $direccion,
            'correo' => $correo,
            'nombre_usuario' => $nombre_usuario,
            'id_rol' => $id_rol
        );

        $obj->actualizarUsuario($datos);

        $_SESSION['success_usuario'] = "Usuario actualizado correctamente";

        redirect(getUrl("Usuarios", "Usuarios", "getUsuarios"));
    }


    public function buscarUsuario()
    {
        $obj = new UsuariosModel();

        $cedula = trim($_POST['cedula']);

        if ($cedula == "") {
            $_SESSION['error_usuario'] = "Debe ingresar una cédula";
            redirect(getUrl("Usuarios", "Usuarios", "getUsuarios"));
            return;
        }

        if (!is_numeric($cedula)) {
            $_SESSION['error_usuario'] = "La cédula solo puede contener números";
            redirect(getUrl("Usuarios", "Usuarios", "getUsuarios"));
            return;
        }

        if (strlen($cedula) < 6) {
            $_SESSION['error_usuario'] = "La cédula debe tener mínimo 6 dígitos";
            redirect(getUrl("Usuarios", "Usuarios", "getUsuarios"));
            return;
        }

        if (strlen($cedula) > 10) {
            $_SESSION['error_usuario'] = "La cédula no puede superar los 10 dígitos";
            redirect(getUrl("Usuarios", "Usuarios", "getUsuarios"));
            return;
        }

        $usuarios = $obj->buscarPorCedula($cedula);

        if (count($usuarios) == 0) {
            $_SESSION['error_usuario'] = "No se encontró ningún usuario con esa cédula";
            redirect(getUrl("Usuarios", "Usuarios", "getUsuarios"));
            return;
        }

        include_once '../view/listarUsuarios/listaUsuarios.php';
    }

}

?>