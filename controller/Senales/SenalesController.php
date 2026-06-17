<?php

    include_once '../model/Senales/SenalesModel.php';

    class SenalesController {
    public function getCreate(){
        $obj = new SenalesModel();
        $sql = "SELECT * FROM tipos_de_senales";
        $tiposenales = $obj->select($sql);

        $sql = "SELECT * FROM categoria_senales";
        $categoriasenales = $obj->select($sql);
        include_once '../view/Senales/create.php';
        }


    public function postCreate(){
        $obj = new SenalesModel();
        $direccion = $_POST['direccion'];
        $tiposenal = $_POST['tiposenal'];
        $orientacionsenal = $_POST['orientacionsenal'];
        $categoriasenal = $_POST['categoriasenal'];
        $descripcion = $_POST['descripcion'];
        $imagen = $_FILES['imagen']['name'];
        $archivo = $_FILES['imagen']['tmp_name'];
        $ruta = "view/assets/img".imagen;

        if(move_uploaded_file($archivo, $ruta)){
            $sql = "INSERT INTO solicitud_nueva_senal (id_orientacion_senal, id_tipo_senal, tipo_senal, id_categoria, descripcion, id_usuario, imagen_nueva_senal, direccion) VALUES ('$orientacionsenal','$tiposenal','','$categoriasenal','$descripcion','','$ruta','$direccion') ";
        }
    }
}

?>