<?php

include_once '../model/Pqrfs/PqrfsModel.php';

class PqrfsController
{
    public function getCreate()
    {

        requierePermiso("PQRSF", "Registrar");
        include_once '../view/Pqrfs/create.php';
    }

    public function postCreate()
    {

        requierePermiso("PQRSF", "Registrar");
        $obj = new PqrfsModel();
        $usuario = $_SESSION['id_usuario'];
        $tipo = $_POST['tipo'];
        $descripcion = $_POST['descripcion'];

        $pqr_id = $obj->autoincrement("pqrsf", "pqr_id");

        $sql = "INSERT INTO pqrsf (pqr_id, usu_id, pqr_tipo, pqr_estado_solicitud, pqr_descripcion)
                VALUES ($1, $2, $3, $4, $5)";

        $ejecutar = pg_query_params($obj->getConnection(), $sql, array(
            $pqr_id,
            $usuario,
            $tipo,
            'Pendiente',
            $descripcion
        ));

        if ($ejecutar) {
            redirect(getUrl("Pqrfs", "Pqrfs", "getCreate") . "&status=exito");
        } else {
            redirect(getUrl("Pqrfs", "Pqrfs", "getCreate") . "&status=error");
        }
    }

    public function listar(){
        requierePermiso("PQRSF", "Listar");

        $obj = new PqrfsModel();
        $usuario = $_SESSION['id_usuario'];
        $id_rol = $_SESSION['id_rol'];

        // Admin y funcionario ven todas; ciudadano solo las suyas
        if ($id_rol == 1 || $id_rol == 3) {
            $sql = "SELECT p.pqr_id, p.pqr_tipo, p.pqr_estado_solicitud, p.pqr_descripcion,u.usu_nombre
                    FROM pqrsf p
                    JOIN usuarios u ON p.usu_id = u.usu_id
                    ORDER BY p.pqr_id DESC";
            $pqrs = $obj->select($sql);
        } else {
            $sql = "SELECT p.pqr_id, p.pqr_tipo, p.pqr_estado_solicitud, p.pqr_descripcion, u.usu_nombre
                    FROM pqrsf p
                    JOIN usuarios u ON p.usu_id = u.usu_id
                    WHERE p.usu_id = $1
                    ORDER BY p.pqr_id DESC";
            $result = pg_query_params($obj->getConnection(), $sql, array($usuario));
            $pqrs = array();
            while ($row = pg_fetch_assoc($result)) {
                array_push($pqrs, $row);
            }
        }

        include_once '../view/Pqrfs/listar.php';
    }

    public function getListar(){
        $this->listar();
    }

    public function postAtender()
    {
        requierePermiso("PQRSF", "Editar");

        $obj = new PqrfsModel();
        $pqr_id = $_POST['pqr_id'];
        $estado = $_POST['pqr_estado_solicitud'];

        $sql = "UPDATE pqrsf SET pqr_estado_solicitud = $1 WHERE pqr_id = $2";
        pg_query_params($obj->getConnection(), $sql, array($estado, $pqr_id));

        redirect(getUrl("Pqrfs", "Pqrfs", "getListar"));
    }
}
?>