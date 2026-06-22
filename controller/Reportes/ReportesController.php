<?php

    include_once '../model/Reportes/ReportesModel.php';

    class ReportesController {

        public function getCreate(){
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

        public function postCreate(){
            $obj = new ReportesModel();
            $usuario = $_POST['id_usuario'];
            $leccionado = $_POST['leccionado'];
            $direccion = $_POST['direccion'];
            $fecha = $_POST['fecha'];
            $causas = $_POST['causas'];
            $tipochoque = $_POST['tipochoque'];
            $catechoque = $_POST['catechoque'];
            $cativehiculo = $_POST['cativehiculo'];
            $barrio = $_POST['barrio'];
            $descripcion = $_POST['descripcion'];
            $tipovehiculo = $_POST['tipovehiculo'];
            $marca = $_POST['marca'];
            $color = $_POST['color'];
            $placa = $_POST['placa'];
            
            $ruta = null;
            if(!empty($_FILES['imagen']['name'])){
                $imagen = $_FILES['imagen']['name'];
                $archivo = $_FILES['imagen']['tmp_name'];
                $ruta = "../view/assest/img/". $imagen;

                if(!move_uploaded_file($archivo, $ruta)){
                    $ruta = null;
                }
            }

            $veh_id = $obj->autoincrement("vehiculo","veh_id");

            $sql = "INSERT INTO vehiculo (veh_id, tvhe_id, usu_id, veh_placa, veh_modelo, veh_color)
            VALUES ($1, $2, $3, $4, $5, $6)";

            $ejecutar = pg_query_params($obj->getConnection(), $sql, array(
                $veh_id, $tipovehiculo, $usuario, $placa, $marca, $color 
            ));

            $sra_id = $obj->autoincrement("solicitudes_reporte_accidentes","sra_id");
            $sql = "INSERT INTO solicitudes_reporte_accidentes(sra_id, sra_fecha, sra_direccion, sra_cantida_lesionados, veh_id, tch_id, usu_id) VALUES ($1; $2, $3, %4, $5, $6)";

            $ejecutar = pg_query_params($obj->getConnection(), $sql, array(
                $sra_id, $fecha, $direccion, $leccionado, $cativehiculo
            ));
        }

    }

?>