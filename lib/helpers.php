<?php 

    function redirect( $url ) {
        echo "<script>".
            "window.location.href = '$url';".
        "</script>";
        
    }

    function dd($var){
        echo "<pre>"; 
        die(print_r($var));
    }

    function getUrl($modulo,$controlador,$function){
        
        $url = "index.php?modulo=$modulo&controlador=$controlador&function=$function";

        return $url;
    }

    function resolve(){
        $modulo = ucwords($_GET['modulo']); //carpeta dentro del controlador 
        $controlador = ucwords($_GET['controlador']); //controlador -> archivo controller dentro del modulo
        $function = $_GET['function']; // funcion -> metodo dentro de la clase del controlador  

        if(is_dir("../controller/".$modulo)){
            if(is_file("../controller/".$modulo."/".$controlador."Controller.php")){
                require_once("../controller/".$modulo."/".$controlador."Controller.php");

                $controlador = $controlador."Controller";

                $objClase = new $controlador();

                if(method_exists($objClase, $function)){
                    $objClase->$function();
                }else{
                    echo "La funcion no existe";
                }
            }else{
                echo "el controlador especificado no existe";
            }

        }else{  
            echo "El modulo especificado no existe";
        }

    }
?>