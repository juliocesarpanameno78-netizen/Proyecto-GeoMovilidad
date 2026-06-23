<?php

include_once '../model/Reporeductor/ReporductorModel.php';

class ReporeductorController
{
    public function getCreate()
    {
        $obj = new ReporductorModel();

        $sql = "SELECT * FROM categorias_reductores";
        $categoriareduc = $obj->select($sql);

        $sql = "SELECT * FROM tipos_de_reductores";
        $tiposreductor = $obj->select($sql);

        $sql = "SELECT * FROM barrios";
        $barrios = $obj->select($sql);

        include_once '../view/Reporeductor/create.php';
    }

    public function postCreate()
    {
        $obj = new ReporductorModel();
        $usuario       = $_SESSION['id_usuario'];
        $categoriareduc = $_POST['categoriareduc'];
        $tiporeductor  = $_POST['tiporeductor'];
        $barrio        = $_POST['barrio'];
        $direccion     = $_POST['direccion'];
        $descripcion   = $_POST['descripcion'];
        $tipodanio     = $_POST['tipodanio'];

        $ruta = null;
        if (!empty($_FILES['imagen']['name'])) {
            $imagen  = $_FILES['imagen']['name'];
            $archivo = $_FILES['imagen']['tmp_name'];
            $ruta    = "../view/assets/img/" . $imagen;
            if (!move_uploaded_file($archivo, $ruta)) {
                $ruta = null;
            }
        }

        $srme_id = $obj->autoincrement("solicitudes_reductor_mal_estado", "srme_id");

        $sql = "INSERT INTO solicitudes_reductor_mal_estado
                    (srme_id, catr_id, tred_id, srme_tipo_danio, srme_descripcion, srme_imagen)
                VALUES ($1, $2, $3, $4, $5, $6)";

        $ejecutar = pg_query_params($obj->getConnection(), $sql, array(
            $srme_id,
            $categoriareduc,
            $tiporeductor,
            $tipodanio,
            $descripcion,
            $ruta
        ));

        if ($ejecutar) {
            redirect(getUrl("Reporeductor", "Reporeductor", "getCreate") . "&status=exito");
        } else {
            redirect(getUrl("Reporeductor", "Reporeductor", "getCreate") . "&status=error");
        }
    }

    public function listar()
    {
        $obj = new ReporductorModel();
        $sql = "SELECT s.srme_id, s.srme_tipo_danio, s.srme_descripcion, s.srme_imagen,c.catr_nombre, t.tred_nombre, t.tred_orientacion
                FROM solicitudes_reductor_mal_estado s
                JOIN categorias_reductores c ON s.catr_id = c.catr_id
                JOIN tipos_de_reductores t   ON s.tred_id = t.tred_id
                ORDER BY s.srme_id DESC";
        $reporeductores = $obj->select($sql);

        include_once '../view/Reporeductor/listar.php';
    }
}
