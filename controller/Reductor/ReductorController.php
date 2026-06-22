<?php

include_once '../model/Reductor/ReductorModel.php';

class ReductorController
{
    public function getCreate()
    {
        $obj = new ReductorModel();
        $sql = "SELECT * FROM tipos_de_reductores";
        $tiposreductor = $obj->select($sql);

        $sql = "SELECT * FROM categorias_reductores";
        $categoriareduc = $obj->select($sql);
        include_once '../view/Reductor/create.php';
    }

    public function postCreate()
    {
        $obj = new ReductorModel();
        $usuario = $_SESSION['id_usuario'];
        $categoriareductor = $_POST['categoriareductor'];
        $tiporeductor = $_POST['tiporeductor'];
        $estadosoli = $_POST['estadoreductor'];
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
        $snr_id = $obj->autoincrement("solicitudes_nuevo_reductor", "snr_id");

        $sql = "INSERT INTO solicitudes_nuevo_reductor (snr_id, catr_id, tred_id, snr_descripcion, est_id, snr_imagen, usu_id) VALUES ($1, $2, $3, $4, $5, $6, $7)";

        $ejecutar = pg_query_params($obj->getConnection(), $sql, array(
            $snr_id, $categoriareductor, $tiporeductor,  $motivo, $estadosoli, $ruta, $usuario 
        ));

        if ($ejecutar) {
            redirect(getUrl("Senales", "Senales", "getCreate") . "&status=exito");
        } else {
            redirect(getUrl("Senales", "Senales", "getCreate") . "&status=error");
        }
    }

    public function listar()
    {
        $obj = new ReductorModel();
        $sql = "";
    }

}
?>