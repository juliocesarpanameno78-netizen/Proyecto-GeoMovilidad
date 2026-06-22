<?php

    include_once '../model/Reductor/ReductorModel.php';

    class ReductorController{
        public function getCreate(){
            $obj = new ReductorModel();
            $sql  = "SELECT * FROM tipos_de_reductores";
            $tiposreductor = $obj->select($sql);

            $sql = "SELECT * FROM categorias_reductores";
            $categoriareduc = $obj->select($sql);
            include_once '../view/Reductor/create.php';
        }

        public function postCreate(){
            $obj = new ReductorModel();
            $usuario = $_SESSION['id_usuario'];
            $descripcion = $_POST['descripcion'];
            $categoriareductor = $_POST['categoriareductor'];
            $tiporeductor = $_POST['tiporeductor'];
            $orientacion = $_POST['orienta'];
            $direccion = $_POST['direccion'];
            $estadosoli = $_POST['estado'];

            $sql = "INSERT INTO solicitudes_nuevo_reductor (catr_id, tred_id, snr_descripcion, est_id, snr_imagen, usu_id) VALUES ('$categoriareductor','$tiporeductor','$descripcion','$estadosoli','','$usuario')";

            $ejecutar = $obj->insert($sql);

            if($ejecutar){
                redirect(getUrl("Senales","Senales","getCreate")."&status=exito");
            }else{
                redirect(getUrl("Senales","Senales","getCreate")."&status=error");
            }
        }

        public function listar(){
            $obj = new ReductorModel();
            $sql = "";
        }
    
    }
?>