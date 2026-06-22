<?php

include_once '../model/Senales/SenalesModel.php';

class SenalesController
{
    public function getCreate()
    {
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
        $usuario = $_SESSION['id_usuario'];
        $estadosenal = $_POST['estadosenal'];
        $categoriasenal = $_POST['categoriasenal'];
        $motivo = $_POST['motivo'];

        $ruta = null;
        if (!empty($_FILES['imagen']['name'])) {
            $imagen = $_FILES['imagen']['name'];
            $archivo = $_FILES['imagen']['tmp_name'];
            $ruta = "../view/assets/img/" . $imagen;

            if (!move_uploaded_file($archivo, $ruta)) {
                $ruta = null;
            }
        }


        $sns_id = $obj->autoincrement("solicitudes_nueva_senal", "sns_id");

        $sql = "INSERT INTO solicitudes_nueva_senal (sns_id, tsen_id, cats_id, sns_descripcion,est_id, usu_id, sns_imagen, sns_direccion) VALUES ($1,$2,$3,$4,$5,$6,$7,$8)";

        $ejecutar = pg_query_params($obj->getConnection(), $sql, array(
            $sns_id, $tiposenal, $categoriasenal, $motivo, $estadosenal, $usuario, $ruta, $direccion
        ));

        if ($ejecutar) {
            redirect(getUrl("Senales", "Senales", "getCreate") . "&status=exito");
        } else {
            redirect(getUrl("Senales", "Senales", "getCreate") . "&status=error");
        }
    }

    public function listar()
    {
        $obj = new SenalesModel();
        $sql = "SELECT s.sns_descripcion,t.tsen_nombre,t.tsen_orientacion,c.cats_nombre, e.est_nombre
        FROM solicitudes_nueva_senal s
        JOIN tipos_de_senales t ON s.tsen_id = t.tsen_id
        JOIN categoria_senales c ON s.cats_id = c.cats_id
        JOIN estadoatencion e on s.est_id = e.est_id";
        $senales = $obj->select($sql);

        include_once '../view/Senales/listar.php';
    }
}

?>