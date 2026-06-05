<?php

function redirect($url) {
    echo "<script>";
        echo "window.location.href='$url'";
    echo "</script>";
}

function dd($var) {
    echo "<pre>";
    die(print_r($var));
}

function getUrl($modulo, $controlador, $funcion, $parametros = false, $pagina = false) {
    if ($pagina == false) {
        $pagina = "index";
    }

    $url = "$pagina.php?modulo=$modulo&controlador=$controlador&funcion=$funcion";

    if ($parametros != false) {
        $url .= "&" . $parametros;
    }

    return $url;
}

function resolve() {

    if (!isset($_GET['modulo']) || !isset($_GET['controlador']) || !isset($_GET['funcion'])) {
        echo "Parámetros de ruta incompletos";
        return;
    }

    $modulo      = ucwords($_GET['modulo']);
    $controlador = ucwords($_GET['controlador']);
    $funcion     = $_GET['funcion'];

    if (is_dir("../controller/$modulo")) {

        if (is_file("../controller/$modulo/" . $controlador . "Controller.php")) {

            include_once "../controller/$modulo/" . $controlador . "Controller.php";

            $nombreClase = $controlador . "Controller";
            $objeto      = new $nombreClase();

            if (method_exists($objeto, $funcion)) {
                $objeto->$funcion();
            } else {
                echo "La función especificada no existe";
            }

        } else {
            echo "El controlador especificado no existe";
        }

    } else {
        echo "El módulo especificado no existe";
    }
}
?>