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

        $obj = new ReportesModel();
        $usuario = $_SESSION['id_usuario'];
        $lesionados = isset($_POST['leccionado']) ? trim($_POST['leccionado']) : '';
        $direccion = isset($_POST['direccion']) ? trim($_POST['direccion']) : '';
        $fecha = date('Y-m-d');
        $causas = isset($_POST['causas']) ? trim($_POST['causas']) : '';
        $categoriaChoque = isset($_POST['tipochoque']) ? trim($_POST['tipochoque']) : '';
        $tipochoque = isset($_POST['catechoque']) ? trim($_POST['catechoque']) : '';
        $cativehiculo = isset($_POST['cativehiculo']) ? trim($_POST['cativehiculo']) : '';
        $barrio = isset($_POST['barrio']) ? trim($_POST['barrio']) : '';
        $descripcion = isset($_POST['descripcion']) ? trim($_POST['descripcion']) : '';
        $tipovehiculo = isset($_POST['tipovehiculo']) ? trim($_POST['tipovehiculo']) : '';
        $marca = isset($_POST['marca']) ? trim($_POST['marca']) : '';
        $color = isset($_POST['color']) ? trim($_POST['color']) : '';
        $placa = isset($_POST['placa']) ? trim($_POST['placa']) : '';
        $coord_x = isset($_POST['coord_x']) && $_POST['coord_x'] !== '' ? $_POST['coord_x'] : null;
        $coord_y = isset($_POST['coord_y']) && $_POST['coord_y'] !== '' ? $_POST['coord_y'] : null;

        $errores = array();

        if ($lesionados === '' || !is_numeric($lesionados) || (int)$lesionados < 0) {
            $errores[] = 'Debe ingresar un numero valido de lesionados.';
        }

        if ($direccion === '') {
            $errores[] = 'Debe ingresar una direccion.';
        }

        if ($causas === '') {
            $errores[] = 'Debe seleccionar la causa del accidente.';
        }

        if ($categoriaChoque === '') {
            $errores[] = 'Debe seleccionar la categoria del choque.';
        }

        if ($tipochoque === '') {
            $errores[] = 'Debe seleccionar el tipo de choque.';
        }

        if ($cativehiculo === '' || !is_numeric($cativehiculo) || (int)$cativehiculo < 0) {
            $errores[] = 'Debe ingresar una cantidad valida de vehiculos afectados.';
        }

        if ($barrio === '') {
            $errores[] = 'Debe seleccionar un barrio.';
        }

        if ($tipovehiculo === '') {
            $errores[] = 'Debe seleccionar el tipo de vehiculo.';
        }

        if ($marca === '') {
            $errores[] = 'Debe ingresar la marca y modelo del vehiculo.';
        }

        if ($color === '') {
            $errores[] = 'Debe ingresar el color del vehiculo.';
        }

        if ($placa === '') {
            $errores[] = 'Debe ingresar la placa del vehiculo.';
        }

        if($descripcion === ''){
            $errores[] = 'Debe describir el accidente.';
        }

        if (count($errores) > 0) {
            $_SESSION['error_reporte'] = implode(' ', $errores);
            redirect(getUrl('Reportes', 'Reportes', 'getCreate') . '&status=error');
            return;
        }

        $ruta = null;
        if (!empty($_FILES['imagen']['name'])) {
            $imagen = $_FILES['imagen']['name'];
            $archivo = $_FILES['imagen']['tmp_name'];
            $ruta = "../view/assets/img/" . $imagen;

            if (!move_uploaded_file($archivo, $ruta)) {
                $ruta = null;
            }
        }

        $conexion = $obj->getConnection();
        pg_query($conexion, 'BEGIN');
        if (!pg_query($conexion, 'SET session_replication_role = replica')) {
            pg_query($conexion, 'ROLLBACK');
            $_SESSION['error_reporte'] = 'No se pudo preparar el guardado: ' . pg_last_error($conexion);
            redirect(getUrl('Reportes', 'Reportes', 'getCreate') . '&status=error');
            return;
        }

        // Insertar vehículo
        $veh_id = $obj->autoincrement("vehiculos", "veh_id");
        $sql = "INSERT INTO vehiculos (veh_id, tveh_id, usu_id, veh_placa, veh_modelo, veh_color)
                VALUES ($1, $2, $3, $4, $5, $6)";

        $guardarVehiculo = pg_query_params($conexion, $sql, array(
            $veh_id,
            $tipovehiculo,
            $usuario,
            $placa,
            $marca,
            $color
        ));

        if (!$guardarVehiculo) {
            pg_query($conexion, 'ROLLBACK');
            pg_query($conexion, 'SET session_replication_role = origin');
            $_SESSION['error_reporte'] = 'No se pudo guardar el vehiculo: ' . pg_last_error($conexion);
            redirect(getUrl('Reportes', 'Reportes', 'getCreate') . '&status=error');
            return;
        }

        // Insertar solicitud de reporte
        $sra_id = $obj->autoincrement("solicitudes_reporte_accidentes", "sra_id");
        $sql = "INSERT INTO solicitudes_reporte_accidentes
                    (sra_id, sra_fecha, sra_cantidad_lesionados, veh_id, tch_id,
                     usu_id, sra_cantidad_vehiculo, cau_id, sra_descripcion,
                     bar_id, sra_imagen, sra_direccion, sra_coordenadas)
                VALUES ($1, $2, $3, $4, $5, $6, $7, $8, $9, $10, $11, $12,
                        CASE
                            WHEN $13 IS NULL OR $14 IS NULL THEN NULL
                            ELSE ST_SetSRID(ST_MakePoint(CAST($13 AS double precision), CAST($14 AS double precision)), 4326)
                        END)";

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
            $direccion,
            $coord_x,
            $coord_y
        ));

        if ($ejecutar) {
            pg_query($conexion, 'SET session_replication_role = origin');
            pg_query($conexion, 'COMMIT');
            redirect(getUrl("Reportes", "Reportes", "getCreate") . "&status=exito");
        } else {
            pg_query($conexion, 'ROLLBACK');
            pg_query($conexion, 'SET session_replication_role = origin');
            $_SESSION['error_reporte'] = 'No se pudo guardar el reporte: ' . pg_last_error($conexion);
            redirect(getUrl("Reportes", "Reportes", "getCreate") . "&status=error");
        }
    }

    public function listar()
    {
        requiereAlgunPermiso(array(
            array("Reportes", "Listar"),
            array("Mis Reportes", "Listar")
        ));

        $obj = new ReportesModel();
        $id_rol = $_SESSION['id_rol'];
        $id_usuario = $_SESSION['id_usuario'];

        $sql = "SELECT s.sra_id, s.sra_fecha, s.sra_cantidad_lesionados, s.sra_cantidad_vehiculo,
                       s.sra_descripcion, s.sra_direccion, s.sra_imagen,
                   ST_AsText(s.sra_coordenadas) AS sra_coordenadas_texto,
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