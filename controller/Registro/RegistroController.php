<?php
include_once '../model/Registro/RegistroModel.php';
include_once '../lib/helpers.php';

class RegistroController {

    public function getRegistro() {
        $obj = new RegistroModel();
        $tipos_documento = $obj->getTiposDocumento();
        include_once dirname(__FILE__) . '/../../view/Registro/Registro.php';
    }

    public function postRegistro() {
        $obj = new RegistroModel();

        
        if ($_POST['contrasena'] !== $_POST['confirmar_contrasena']) {
            redirect('/Geomovilidad/view/Registro/Registro.php?error=passwords');
            return;
        }

        
        if ($obj->existeCorreo($_POST['correo_electronico'])) {
            redirect('/Geomovilidad/view/Registro/Registro.php?error=correo');
            return;
        }

        
        if ($obj->existeIdentificacion($_POST['numero_identificacion'])) {
            redirect('/Geomovilidad/view/Registro/Registro.php?error=identificacion');
            return;
        }

        $datos = array(
            'tdoc_id'      => $_POST['id_tipo_documento'],
            'per_identificacion'  => $_POST['numero_identificacion'],
            'per_apellido'               => $_POST['apellido'],
            'per_nombre'                 => $_POST['nombre'],
            'per_correo_electronico'     => $_POST['correo_electronico'],
            'per_telefono'               => $_POST['telefono'],
            'per_direccion'              => $_POST['direccion'],
            'usu_nombre'         => $_POST['nombre_usuario'],
            'usu_contrasena'             => $_POST['contrasena']
        );

        $resultado = $obj->registrar($datos);

        if ($resultado) {
            redirect('/Geomovilidad/view/Login/Login.php?registro=exitoso');
        } else {
            redirect('/Geomovilidad/view/Registro/Registro.php?error=general');
        }
    }

    public function getCreate() {
    $this->getRegistro();
    }
}
?>