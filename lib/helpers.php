<?php

if (!isset($_SESSION)) {
    session_start();
}

function redirect($url) {
    if (!headers_sent()) {
        header("Location: " . $url);
        exit();
    } else {
        echo "<script>window.location.href = '" . $url . "';</script>";
        exit();
    }
}

function dd($var) {
    echo "<pre>"; 
    die(print_r($var));
}

function getUrl($modulo = "", $controlador = "", $function = "") {
    $url = "index.php?modulo=" . $modulo . "&controlador=" . $controlador . "&function=" . $function;
    return $url;
}

function resolve() {
    $modulo      = isset($_GET['modulo']) ? ucwords($_GET['modulo']) : '';
    $controlador = isset($_GET['controlador']) ? ucwords($_GET['controlador']) : '';
    $function    = isset($_GET['function']) ? $_GET['function'] : '';

    if (empty($modulo) || empty($controlador) || empty($function)) {
        echo "Parámetros incompletos";
        return;
    }

    if (is_dir("../controller/" . $modulo)) {
        $archivo = "../controller/" . $modulo . "/" . $controlador . "Controller.php";
        
        if (is_file($archivo)) {
            require_once($archivo);

            $clase = $controlador . "Controller";
            
            if (class_exists($clase)) {
                $objClase = new $clase();

                if (method_exists($objClase, $function)) {
                    $objClase->$function();
                } else {
                    echo "La función '" . $function . "' no existe en el controlador";
                }
            } else {
                echo "La clase '" . $clase . "' no existe";
            }
        } else {
            echo "El controlador '" . $archivo . "' no existe";
        }
    } else {  
        echo "El módulo '" . $modulo . "' no existe";
    }
}

function tieneRol($rol_id) {
    return isset($_SESSION['id_rol']) && $_SESSION['id_rol'] == $rol_id;
}

function esAdministrador() {
    return tieneRol(1);
}

function esFuncionario() {
    return tieneRol(2);
}

function esCiudadano() {
    return tieneRol(3);
}

function nombreRol() {
    $roles = array(
        1 => 'Administrador',
        2 => 'Funcionario',
        3 => 'Ciudadano'
    );
    return isset($roles[$_SESSION['id_rol']]) ? $roles[$_SESSION['id_rol']] : 'Sin rol';
}

function requiereRol($rolesPermitidos = array()) {
    if (!isset($_SESSION['id_usuario'])) {
        redirect(getUrl("Login", "Login", "getLogin"));
    }
    
    if (!empty($rolesPermitidos) && !in_array($_SESSION['id_rol'], $rolesPermitidos)) {
        redirect(getUrl("", "", "") . "?error=acceso_denegado");
    }
}
?>