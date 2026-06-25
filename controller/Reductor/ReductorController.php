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
        requiereRol(array(1, 2, 3));

        $obj = new ReductorModel();
        $id_rol = $_SESSION['id_rol'];
        $id_usuario = $_SESSION['id_usuario'];

        $sql = "SELECT r.snr_id, r.snr_descripcion, r.snr_imagen,
                       cr.catr_nombre, tr.tred_nombre, e.est_nombre, e.est_id,
                       u.usu_nombre
                FROM solicitudes_nuevo_reductor r
                JOIN categorias_reductores cr ON r.catr_id = cr.catr_id
                JOIN tipos_de_reductores tr   ON r.tred_id = tr.tred_id
                JOIN estadoatencion e         ON r.est_id  = e.est_id
                JOIN usuarios u               ON r.usu_id  = u.usu_id";

        if ($id_rol == 2) {
            $sql .= " WHERE r.usu_id = " . $id_usuario;
        }

        $sql .= " ORDER BY r.snr_id DESC";

        $reductores = $obj->select($sql);

        include_once '../view/Reductor/listar.php';
    }

    public function getListar()
    {
        $this->listar();
    }

    public function postUpdateEstado()
    {
        requiereRol(array(1, 3));

        $obj = new ReductorModel();
        $snr_id = $_POST['snr_id'];
        $est_id = $_POST['est_id'];

        $sql = "UPDATE solicitudes_nuevo_reductor SET est_id = $1 WHERE snr_id = $2";
        pg_query_params($obj->getConnection(), $sql, array($est_id, $snr_id));

        redirect(getUrl("Reductor", "Reductor", "getListar"));
    }

}
?>