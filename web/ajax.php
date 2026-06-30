<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once '../lib/helpers.php';
require_once '../controller/Usuarios/UsuariosController.php';
require_once '../controller/Perfil/PerfilController.php';
require_once '../controller/Via/ViaController.php';
require_once '../model/Usuarios/UsuariosModel.php';
require_once '../model/Via/ViaModel.php';

$accion = isset($_POST['action']) ? trim($_POST['action']) : (isset($_GET['action']) ? trim($_GET['action']) : '');

function obtenerCampo($campo, $valorPorDefecto = '')
{
    if (isset($_POST[$campo])) {
        return trim($_POST[$campo]);
    }

    if (isset($_GET[$campo])) {
        return trim($_GET[$campo]);
    }

    return $valorPorDefecto;
}

function redirigirConError($mensaje, $destino)
{
    $_SESSION['error_generico'] = $mensaje;
    redirect($destino);
}

if ($accion === '') {
    redirigirConError('Debe enviar una accion valida.', '../web/index.php');
}

try {
    switch ($accion) {
        case 'listarUsuarios':
            $controlador = new UsuariosController();
            $controlador->getUsuarios();
            break;

        case 'buscarUsuarioCedula':
            $cedula = obtenerCampo('cedula');

            if ($cedula === '') {
                redirigirConError('Debe ingresar una cedula.', getUrl('Usuarios', 'Usuarios', 'getUsuarios'));
            }

            if (!is_numeric($cedula)) {
                redirigirConError('La cedula solo puede contener numeros.', getUrl('Usuarios', 'Usuarios', 'getUsuarios'));
            }

            if (strlen($cedula) < 6) {
                redirigirConError('La cedula debe tener minimo 6 digitos.', getUrl('Usuarios', 'Usuarios', 'getUsuarios'));
            }

            if (strlen($cedula) > 10) {
                redirigirConError('La cedula no puede superar los 10 digitos.', getUrl('Usuarios', 'Usuarios', 'getUsuarios'));
            }

            $obj = new UsuariosModel();
            $usuarios = $obj->buscarPorCedula($cedula);

            if (count($usuarios) == 0) {
                redirigirConError('No se encontro ningun usuario con esa cedula.', getUrl('Usuarios', 'Usuarios', 'getUsuarios'));
            }

            $_SESSION['success_usuario'] = 'Consulta realizada correctamente.';
            include_once '../view/listarUsuarios/listaUsuarios.php';
            break;

        case 'obtenerUsuario':
            $idUsuario = obtenerCampo('id_usuario');

            if ($idUsuario === '') {
                redirigirConError('Debe enviar el identificador del usuario.', getUrl('Usuarios', 'Usuarios', 'getUsuarios'));
            }

            $_GET['id_usuario'] = $idUsuario;
            $controlador = new UsuariosController();
            $controlador->getUpdate();
            break;

        case 'actualizarPerfil':
            $controlador = new PerfilController();
            $controlador->postActualizar();
            break;

        case 'listarVias':
            $controlador = new ViaController();
            $controlador->getListar();
            break;

        case 'actualizarEstadoVia':
            $controlador = new ViaController();
            $controlador->postUpdateEstado();
            break;

        case 'ping':
            echo 'ok';
            break;

        default:
            redirigirConError('Accion no reconocida.', '../web/index.php');
            break;
    }
} catch (Exception $e) {
    redirigirConError('Ocurrio un error al procesar la solicitud.', '../web/index.php');
}