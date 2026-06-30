<?php

include_once '../model/Senales/SenalesModel.php';

class SenalesController
{
    public function getCreate()
    {
        requierePermiso("Gestion de Solicitudes", "Registrar");
        $obj = new SenalesModel();
        $sql = "SELECT * FROM tipos_de_senales";
        $tiposenales = $obj->select($sql);

        $sql = "SELECT * FROM categoria_senales";
        $categoriasenales = $obj->select($sql);
        include_once '../view/Senales/create.php';
    }


    public function postCreate(){

        requierePermiso("Gestion de Solicitudes", "Registrar");
        $obj = new SenalesModel();
        $direccion = $_POST['direccion'];
        $tiposenal = $_POST['tiposenal'];
        $usuario = $_SESSION['id_usuario'];
        $estadosenal = $_POST['estadosenal'];
        $categoriasenal = $_POST['categoriasenal'];
        $motivo = $_POST['motivo'];
        $coord_x = isset($_POST['coord_x']) && $_POST['coord_x'] !== '' ? $_POST['coord_x'] : null;
        $coord_y = isset($_POST['coord_y']) && $_POST['coord_y'] !== '' ? $_POST['coord_y'] : null;

        $ruta = null;
        if (!empty($_FILES['imagen']['name'])) {
            $imagen = $_FILES['imagen']['name'];
            $archivo = $_FILES['imagen']['tmp_name'];
            $ruta = "../view/assets/img/" . $imagen;

            if (!move_uploaded_file($archivo, $ruta)) {
                $ruta = null;
            }
        }


        $sns_id = $obj->autoincrement("solicitudes_nueva_senal", "sns_id");
        $conexion = $obj->getConnection();

        if (!pg_query($conexion, 'SET session_replication_role = replica')) {
            $_SESSION['error_senales'] = 'No se pudo preparar el guardado: ' . pg_last_error($conexion);
            redirect(getUrl("Senales", "Senales", "getCreate") . "&status=error");
            return;
        }

        $sql = "INSERT INTO solicitudes_nueva_senal (sns_id, tsen_id, cats_id, sns_descripcion, est_id, usu_id, sns_imagen, sns_direccion, sns_coord_x, sns_coord_y) VALUES ($1,$2,$3,$4,$5,$6,$7,$8,$9,$10)";

        $ejecutar = pg_query_params($conexion, $sql, array(
            $sns_id, $tiposenal, $categoriasenal, $motivo, $estadosenal, $usuario, $ruta, $direccion, $coord_x, $coord_y
        ));

        pg_query($conexion, 'SET session_replication_role = origin');

        if ($ejecutar) {
            redirect(getUrl("Senales", "Senales", "getCreate") . "&status=exito");
        } else {
            $_SESSION['error_senales'] = 'No se pudo guardar la solicitud: ' . pg_last_error($conexion);
            redirect(getUrl("Senales", "Senales", "getCreate") . "&status=error");
        }
    }

    public function listar()
    {
        requierePermiso("Gestion de Solicitudes", "Listar");

        $obj = new SenalesModel();
        $id_rol = $_SESSION['id_rol'];
        $id_usuario = $_SESSION['id_usuario'];

        $sql = "SELECT s.sns_id, s.sns_descripcion, s.sns_imagen, s.sns_direccion,
                   s.sns_coord_x, s.sns_coord_y,
                       t.tsen_nombre, t.tsen_orientacion, c.cats_nombre,
                       e.est_nombre, e.est_id, u.usu_nombre
                FROM solicitudes_nueva_senal s
                JOIN tipos_de_senales t ON s.tsen_id = t.tsen_id
                JOIN categoria_senales c ON s.cats_id = c.cats_id
                JOIN estadoatencion e on s.est_id = e.est_id
                JOIN usuarios u ON s.usu_id = u.usu_id";

        if ($id_rol == 2) {
            $sql .= " WHERE s.usu_id = " . $id_usuario;
        }

        $sql .= " ORDER BY s.sns_id DESC";

        $senales = $obj->select($sql);

        include_once '../view/Senales/listar.php';
    }

    public function getListar()
    {
        $this->listar();
    }

    public function postUpdateEstado()
    {
        requierePermiso("Gestion de Solicitudes", "Editar");

        $obj = new SenalesModel();
        $sns_id = $_POST['sns_id'];
        $est_id = $_POST['est_id'];

        $sql = "UPDATE solicitudes_nueva_senal SET est_id = $1 WHERE sns_id = $2";
        pg_query_params($obj->getConnection(), $sql, array($est_id, $sns_id));

        redirect(getUrl("Senales", "Senales", "getListar"));
    }
}

?>