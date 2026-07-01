<?php

include_once '../model/Reporeductor/ReporductorModel.php';

class ReporeductorController
{
    public function getCreate()
    {

        requierePermiso("Gestion de Solicitudes", "Registrar");
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

        requierePermiso("Gestion de Solicitudes", "Registrar");
        $obj = new ReporductorModel();
        $usuario       = $_SESSION['id_usuario'];
        $categoriareduc = isset($_POST['categoriareduc']) ? trim($_POST['categoriareduc']) : '';
        $tiporeductor  = isset($_POST['tiporeductor']) ? trim($_POST['tiporeductor']) : '';
        $barrio        = isset($_POST['barrio']) ? trim($_POST['barrio']) : '';
        $direccion     = isset($_POST['direccion']) ? trim($_POST['direccion']) : '';
        $descripcion   = isset($_POST['descripcion']) ? trim($_POST['descripcion']) : '';
        $tipodanio     = isset($_POST['tipodanio']) ? trim($_POST['tipodanio']) : '';
        $coord_x       = isset($_POST['coord_x']) && $_POST['coord_x'] !== '' ? $_POST['coord_x'] : null;
        $coord_y       = isset($_POST['coord_y']) && $_POST['coord_y'] !== '' ? $_POST['coord_y'] : null;

        
        if ($categoriareduc === '') {
            redirect(getUrl("Reporeductor", "Reporeductor", "getCreate") . "&status=vacio&campo=categoria");
            return;
        }

        if ($tiporeductor === '') {
            redirect(getUrl("Reporeductor", "Reporeductor", "getCreate") . "&status=vacio&campo=tipo");
            return;
        }

        if ($barrio === '') {
            redirect(getUrl("Reporeductor", "Reporeductor", "getCreate") . "&status=vacio&campo=barrio");
            return;
        }

        if ($direccion === '') {
            redirect(getUrl("Reporeductor", "Reporeductor", "getCreate") . "&status=vacio&campo=direccion");
            return;
        }

        if ($tipodanio === '') {
            redirect(getUrl("Reporeductor", "Reporeductor", "getCreate") . "&status=vacio&campo=tipodanio");
            return;
        }

        if ($descripcion === '') {
            redirect(getUrl("Reporeductor", "Reporeductor", "getCreate") . "&status=vacio&campo=descripcion");
            return;
        }

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
                    (srme_id, catr_id, tred_id, srme_tipo_danio, srme_descripcion, srme_imagen, srme_coord_x, srme_coord_y)
                VALUES ($1, $2, $3, $4, $5, $6, $7, $8)";

        $ejecutar = pg_query_params($obj->getConnection(), $sql, array(
            $srme_id,
            $categoriareduc,
            $tiporeductor,
            $tipodanio,
            $descripcion,
            $ruta,
            $coord_x,
            $coord_y
        ));

        if ($ejecutar) {
            redirect(getUrl("Reporeductor", "Reporeductor", "getCreate") . "&status=exito");
        } else {
            redirect(getUrl("Reporeductor", "Reporeductor", "getCreate") . "&status=error");
        }
    }

    public function listar()
{
    requierePermiso("Gestion de Solicitudes", "Listar");

    $obj = new ReporductorModel();

    $sql = "SELECT s.srme_id, s.srme_tipo_danio, s.srme_descripcion, s.srme_imagen,
                   s.srme_coord_x, s.srme_coord_y,
                   c.catr_nombre, t.tred_nombre, t.tred_orientacion
            FROM solicitudes_reductor_mal_estado s
            JOIN categorias_reductores c ON s.catr_id = c.catr_id
            JOIN tipos_de_reductores t ON s.tred_id = t.tred_id
            ORDER BY s.srme_id DESC";

    $reporeductores = $obj->select($sql);

    include_once '../view/Reporeductor/listar.php';
}
}
