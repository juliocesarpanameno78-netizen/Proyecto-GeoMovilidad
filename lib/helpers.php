<?php
    session_start();
    function redirect($url){
        echo "<script>";
            echo "window.location.href='$url'";
        echo "</script>";
    }
    function dd($var){
        echo "<pre>";
        die(print_r($var));
    }

    function getUrl($modulo, $controlador, $funcion, $parametros=false, $pagina=false){
    $url = "index.php?modulo=$modulo&controlador=$controlador&funcion=$funcion";

    if($pagina == false){
        $pagina = "index";
    }

    return $url;
    $url = "$pagina.php?modulo=$modulo&controlador=$controlador&funcion=$funcion";
    }


    function resolve(){
        $modulo = ucwords($_GET['modulo']); //modulo -> carpeta dentro controller
        $controlador = ucwords($_GET['controlador']); //archivo dentro de módullo
        $funcion = $_GET['funcion']; //función -métodoo dentro de lla clase del controlador
    

    //Toda ruta empieza desde index.php -> carpeta web

    if(is_dir("../controller/$modulo")){

        if(is_file("../controller/$modulo/".$controlador."Controller.php")){

            include_once "../controller/$modulo/$controlador"."Controller.php";

            $nombreClase = $controlador."Controller";

            $objeto = new $nombreClase();

            if(method_exists($objeto, $funcion)){
                $objeto ->$funcion();
            }else{
                echo "La función especificada no existe";
            }
        }else{
            echo "El controlador especificado no existe";
        }
    }else{
        echo "El módulo especificado no existe";
    }
    }
?>