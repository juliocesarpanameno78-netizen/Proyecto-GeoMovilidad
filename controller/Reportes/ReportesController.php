<?php

include_once '../model/Reportes/ReportesModel.php';

class ReportesController
{
    public function getCreate()
    {
        requierePermiso("Reportes", "Registrar");
        $obj = new ReportesModel();

        $sql = "SELECT * FROM causasaccidentes";
        $causas = $obj->select($sql);

        $sql = "SELECT * FROM barrios";
        $barrio = $obj->select($sql);

        $sql = "SELECT * FROM categorias_tipos_de_choque";
        $catechoque = $obj->select($sql);

        $sql = "SELECT * FROM tipos_de_choque";
        $tipochoque = $obj->select($sql);

        $sql = "SELECT * FROM tipos_de_vehiculos";
        $tipovehi = $obj->select($sql);

        include_once '../view/Reportes/create.php';
    }

    public function postCreate()
    {
        requierePermiso("Reportes", "Registrar");
        
        $obj          = new ReportesModel();
        $usuario      = $_SESSION['id_usuario'];
        $lesionados   = $_POST['leccionado'];           // Corregido nombre lógico
        $direccion    = $_POST['direccion'];
        $fecha        = date('Y-m-d');
        $causas       = $_POST['causas'];
        $tipochoque   = $_POST['tipochoque'];
        $cativehiculo = $_POST['cativehiculo'];
        $barrio       = $_POST['barrio'];
        $descripcion  = $_POST['descripcion'];
        $tipovehiculo = $_POST['tipovehiculo'];
        $marca        = $_POST['marca'];
        $color        = $_POST['color'];
        $placa        = $_POST['placa'];

        $ruta = null;
        if (!empty($_FILES['imagen']['name'])) {
            $imagen  = $_FILES['imagen']['name'];
            $archivo = $_FILES['imagen']['tmp_name'];
            $ruta    = "../view/assets/img/" . $imagen;
            
            if (!move_uploaded_file($archivo, $ruta)) {
                $ruta = null;
            }
        }

        // Insertar vehículo
        $veh_id = $obj->autoincrement("vehiculos", "veh_id");
        $sql = "INSERT INTO vehiculos (veh_id, tveh_id, usu_id, veh_placa, veh_modelo, veh_color)
                VALUES ($1, $2, $3, $4, $5, $6)";
        
        pg_query_params($obj->getConnection(), $sql, array(
            $veh_id, 
            $tipovehiculo, 
            $usuario, 
            $placa, 
            $marca, 
            $color
        ));

        // Insertar solicitud de reporte
        $sra_id = $obj->autoincrement("solicitudes_reporte_accidentes", "sra_id");
        $sql = "INSERT INTO solicitudes_reporte_accidentes
                    (sra_id, sra_fecha, sra_cantidad_lesionados, veh_id, tch_id,
                     usu_id, sra_cantidad_vehiculo, cau_id, sra_decripcion,
                     bar_id, sra_imagen, sra_direccion)
                VALUES ($1, $2, $3, $4, $5, $6, $7, $8, $9, $10, $11, $12)";

        $ejecutar = pg_query_params($obj->getConnection(), $sql, array(
            $sra_id,
            $fecha,
            $lesionados,
            $veh_id,
            $tipochoque,
            $usuario,
            $cativehiculo,
            $causas,
            $descripcion,
            $barrio,
            $ruta,
            $direccion
        ));

        if ($ejecutar) {
            redirect(getUrl("Reportes", "Reportes", "getCreate") . "&status=exito");
        } else {
            redirect(getUrl("Reportes", "Reportes", "getCreate") . "&status=error");
        }
    }

    public function listar()
    {
        requierePermiso("Reportes", "Listar");

        $obj = new ReportesModel();
        $id_rol     = $_SESSION['id_rol'];
        $id_usuario = $_SESSION['id_usuario'];

        $sql = "SELECT s.sra_id, s.sra_fecha, s.sra_cantidad_lesionados, s.sra_cantidad_vehiculo,
                       s.sra_descripcion, s.sra_direccion, s.sra_imagen,
                       b.bar_nombre, c.cau_descripcion, t.tch_nombre,
                       u.usu_nombre,
                       v.veh_placa, v.veh_modelo, v.veh_color, tv.tveh_nombre
                FROM solicitudes_reporte_accidentes s
                JOIN barrios b             ON s.bar_id  = b.bar_id
                JOIN causasaccidentes c    ON s.cau_id  = c.cau_id
                JOIN tipos_de_choque t     ON s.tch_id  = t.tch_id
                JOIN usuarios u            ON s.usu_id  = u.usu_id
                JOIN vehiculos v           ON s.veh_id  = v.veh_id
                JOIN tipos_de_vehiculos tv ON v.tveh_id = tv.tveh_id";

        if ($id_rol == 2) {
            $sql .= " WHERE s.usu_id = " . $id_usuario;
        }

        $sql .= " ORDER BY s.sra_id DESC";
        $reportes = $obj->select($sql);

        include_once '../view/Reportes/listar.php';
    }

    public function getListar()
    {
        $this->listar();
    }
}
?>