<?php

    require_once 'C:/xampp/htdocs/Geomovilidad/model/MasterModel.php';

class RegistroModel extends MasterModel {

    public function getTiposDocumento() {
        $sql = "SELECT id_tipos_documentos, nombre_tipos_doc FROM tipos_de_documento ORDER BY id_tipos_documentos";
        return pg_query($this->getConnection(), $sql);
    }

    
    public function existeCorreo($correo) {
        $sql = "SELECT id_persona FROM personas WHERE correo_electronico = $1";
        $result = pg_query_params($this->getConnection(), $sql, array($correo));
        return pg_num_rows($result) > 0;
    }

    
    public function existeIdentificacion($numero) {
        $sql = "SELECT id_persona FROM personas WHERE numero_identificacion = $1";
        $result = pg_query_params($this->getConnection(), $sql, array($numero));
        return pg_num_rows($result) > 0;
    }

    public function registrar($datos) {
        
        $id_persona = $this->autoincrement('personas', 'id_persona');

       
        $sql_persona = "INSERT INTO personas 
                        (id_persona, id_tipo_documento, numero_identificacion, apellido, nombre, correo_electronico, telefono, direccion)
                        VALUES ($1, $2, $3, $4, $5, $6, $7, $8)";

        $result_persona = pg_query_params($this->getConnection(), $sql_persona, array(
            $id_persona,
            $datos['id_tipo_documento'],
            $datos['numero_identificacion'],
            $datos['apellido'],
            $datos['nombre'],
            $datos['correo_electronico'],
            $datos['telefono'],
            $datos['direccion']
        ));

        if (!$result_persona) {
            return false;
        }

        
        $id_usuario = $this->autoincrement('usuarios', 'id_usuario');

        
        $sql_usuario = "INSERT INTO usuarios 
                        (id_usuario, id_persona, id_barrio, id_rol, nombre_usuario, contrasena, correo_electronico)
                        VALUES ($1, $2, $3, $4, $5, $6, $7)";

        $result_usuario = pg_query_params($this->getConnection(), $sql_usuario, array(
            $id_usuario,
            $id_persona,
            1,                          
            2,                          
            $datos['nombre_usuario'],
            md5($datos['contrasena']), 
            $datos['correo_electronico']
        ));

        return $result_usuario ? true : false;
    }
}
?>