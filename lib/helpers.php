<?php 

    function redirect($url){
        echo "<script>";
            echo "window.location.href = '$url';";
        echo "</script>";
    }

    function dd($data){
        echo "<pre>";
        die(print_r($data));
    }

    function getUrl($modulo,$controador,$funcion,$parametros=false, $pagina=false){

        if($pagina == false){
            $pagina = "index";
        }
        $url = "$pagina.php?modulo=$modulo&controlador=$controador&funcion=$funcion";

        if($parametros != false){
            foreach ($parametros as $key => $value) {
                $url .= "&$key=$value";
            }
        }
        return $url;
    }

    function resolve(){
        $modulo = ucwords($_GET['modulo']);
        $controlador = ucwords($_GET['controlador']);
        $funtion = $_GET['funcion'];

        if(is_dir("../controller/$modulo/")){
            
            if(is_file("../controller/$modulo/".$controlador."Controller.php")){

                include_once "../controller/$modulo/".$controlador."Controller.php";

                $nombreClase = $controlador."Controller";

                $objeto = new $nombreClase();

                if(method_exists($objeto,$funtion)){
                    $objecto->$function();
                }else{
                    echo "La funcion especificada no existe";
                }
            }else{
                echo "El controlador especificado no existe";
            }
        }
    }
?>