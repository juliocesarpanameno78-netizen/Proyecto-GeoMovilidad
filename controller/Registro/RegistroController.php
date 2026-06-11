<?php
include_once '../model/Registro/RegistroModel.php';
include_once '../lib/helpers.php';

class RegistroController {

    public function getRegistro() {
        $obj = new RegistroModel();
        $tipos_documento = $obj->getTiposDocumento();
        include_once '../view/Registro.php';
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
            'id_tipo_documento'      => $_POST['id_tipo_documento'],
            'numero_identificacion'  => $_POST['numero_identificacion'],
            'apellido'               => $_POST['apellido'],
            'nombre'                 => $_POST['nombre'],
            'correo_electronico'     => $_POST['correo_electronico'],
            'telefono'               => $_POST['telefono'],
            'direccion'              => $_POST['direccion'],
            'nombre_usuario'         => $_POST['nombre_usuario'],
            'contrasena'             => $_POST['contrasena']
        );

        $resultado = $obj->registrar($datos);

        if ($resultado) {
            redirect('/Geomovilidad/view/Login/Login.php?registro=exitoso');
        } else {
            redirect('/Geomovilidad/view/Registro/Registro.php?error=general');
        }
    }
}
?>