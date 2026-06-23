<?php

include_once '../model/Via/ViaModel.php';

class ViaController
{
    public function getCreate()
    {
        $obj = new ViaModel();
        $sql = "SELECT * FROM tipos_de_vias";
        $tipvias = $obj->select($sql);

        $sql = "SELECT * FROM categoriastipodanio WHERE cdan_id_tipo_solicitud = 2";
        $tiposdanio = $obj->select($sql);

        include_once '../view/Via/create.php';
    }

    public function postCreate()
    {
        $obj     = new ViaModel();
        $usuario     = $_SESSION['id_usuario'];
        $tipovia     = $_POST['tipovia'];
        $descripcion = $_POST['descripcion'];
        $cdan_id     = $_POST['tipodanio'];

        $ruta = null;
        if (!empty($_FILES['imagenes']['name'])) {
            $imagen  = $_FILES['imagenes']['name'];
            $archivo = $_FILES['imagenes']['tmp_name'];
            $ruta    = "../view/assets/img/" . $imagen;
            if (!move_uploaded_file($archivo, $ruta)) {
                $ruta = null;
            }
        }

        // Estado inicial = 1 (Pendiente)
        $svme_id = $obj->autoincrement("solicitudes_via_mal_estado", "svme_id");

        $sql = "INSERT INTO solicitudes_via_mal_estado
                    (svme_id, cdan_id, est_id, svme_descripcion_detallada, svme_imagen, usu_id)
                VALUES ($1, $2, $3, $4, $5, $6)";

        $ejecutar = pg_query_params($obj->getConnection(), $sql, array(
            $svme_id,
            $cdan_id,
            1,           // estado pendiente
            $descripcion,
            $ruta,
            $usuario
        ));

        if ($ejecutar) {
            redirect(getUrl("Via", "Via", "getCreate") . "&status=exito");
        } else {
            redirect(getUrl("Via", "Via", "getCreate") . "&status=error");
        }
    }

    public function listar()
    {
        $obj = new ViaModel();
        $sql = "SELECT v.svme_id, v.svme_descripcion_detallada, v.svme_imagen,
                       c.cdan_nombre, e.est_nombre,
                       u.usu_nombre
                FROM solicitudes_via_mal_estado v
                JOIN categoriastipodanio c ON v.cdan_id = c.cdan_id
                JOIN estadoatencion e      ON v.est_id  = e.est_id
                JOIN usuarios u            ON v.usu_id  = u.usu_id
                ORDER BY v.svme_id DESC";
        $vias = $obj->select($sql);

        include_once '../view/Via/listar.php';
    }
}
?>
