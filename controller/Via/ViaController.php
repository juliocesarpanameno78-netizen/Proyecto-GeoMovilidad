<?php

include_once '../model/Via/ViaModel.php';

class ViaController
{
    public function getCreate()
    {
        requierePermiso("Gestion de Solicitudes", "Registrar");
        $obj = new ViaModel();
        $sql = "SELECT * FROM tipos_de_vias";
        $tipvias = $obj->select($sql);

        $sql = "SELECT * FROM categoriastipodanio WHERE cdan_id_tipo_solicitud = 2";
        $tiposdanio = $obj->select($sql);

        include_once '../view/Via/create.php';
    }

    public function postCreate()
    {
        requierePermiso("Gestion de Solicitudes", "Registrar");
        
        $obj     = new ViaModel();
        $usuario     = $_SESSION['id_usuario'];
        $tipovia     = $_POST['tipovia'];
        $descripcion = $_POST['descripcion'];
        $cdan_id     = $_POST['tipodanio'];
        $coord_x     = isset($_POST['coord_x']) && $_POST['coord_x'] !== '' ? $_POST['coord_x'] : null;
        $coord_y     = isset($_POST['coord_y']) && $_POST['coord_y'] !== '' ? $_POST['coord_y'] : null;

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
                    (svme_id, cdan_id, est_id, svme_descripcion_detallada, svme_imagen, usu_id, svme_coord_x, svme_coord_y)
                VALUES ($1, $2, $3, $4, $5, $6, $7, $8)";

        $ejecutar = pg_query_params($obj->getConnection(), $sql, array(
            $svme_id,
            $cdan_id,
            1,           // estado pendiente
            $descripcion,
            $ruta,
            $usuario,
            $coord_x,
            $coord_y
        ));

        if ($ejecutar) {
            redirect(getUrl("Via", "Via", "getCreate") . "&status=exito");
        } else {
            redirect(getUrl("Via", "Via", "getCreate") . "&status=error");
        }
    }

    public function listar()
    {
       requierePermiso("Gestion de Solicitudes", "Listar");

        $obj = new ViaModel();
        $id_rol = $_SESSION['id_rol'];
        $id_usuario = $_SESSION['id_usuario'];

        $sql = "SELECT v.svme_id, v.svme_descripcion_detallada, v.svme_imagen,
                   v.svme_coord_x, v.svme_coord_y,
                       c.cdan_nombre, e.est_nombre, e.est_id,
                       u.usu_nombre
                FROM solicitudes_via_mal_estado v
                JOIN categoriastipodanio c ON v.cdan_id = c.cdan_id
                JOIN estadoatencion e      ON v.est_id  = e.est_id
                JOIN usuarios u            ON v.usu_id  = u.usu_id";

        if ($id_rol == 2) {
            $sql .= " WHERE v.usu_id = " . $id_usuario;
        }

        $sql .= " ORDER BY v.svme_id DESC";

        $vias = $obj->select($sql);

        include_once '../view/Via/listar.php';
    }

    public function getListar()
    {
        $this->listar();
    }

    public function postUpdateEstado()
    {
        requierePermiso("Gestion de Solicitudes", "Editar");

        $obj = new ViaModel();
        $svme_id = $_POST['svme_id'];
        $est_id = $_POST['est_id'];

        $sql = "UPDATE solicitudes_via_mal_estado SET est_id = $1 WHERE svme_id = $2";
        pg_query_params($obj->getConnection(), $sql, array($est_id, $svme_id));

        redirect(getUrl("Via", "Via", "getListar"));
    }
}
?>