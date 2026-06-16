<?php

    include_once '../model/MasterModel.php';

    class RolesController{

        public function getCreate()
        {
            $obj = new MasterModel();

            $sql = "SELECT * FROM modulos";
            $modulos = $obj->select($sql);

            $sql = "SELECT * FROM acciones";
            $acciones = $obj->select($sql);

            include_once '../view/roles/create.php';
        }

        public function postCreate()
        {

            $obj = new MasterModel();

            $rol_nombre = trim($_POST['rol_nombre']);

            if($rol_nombre == ""){
                $_SESSION['error_roles'] = "Debe ingresar un nombre para el rol";
                redirect(getUrl("Roles","Roles","getCreate"));
                return;
            }

            $sql = "SELECT * FROM roles WHERE UPPER(nombre_rol)=UPPER('$rol_nombre')";
            $rol_existente = $obj->select($sql);

            if(count($rol_existente) > 0){
                $_SESSION['error_roles'] = "Ya existe un rol con ese nombre";
                redirect(getUrl("Roles","Roles","getCreate"));
                return;
            }

            $rol_id = $obj->autoincrement("roles", "id_rol");

            $sql = "INSERT INTO roles VALUES ('$rol_id', '$rol_nombre')";
            $obj->insert($sql);

            if (isset($_POST['permisos'])) {
                $permisos = $_POST['permisos'];
            } else {
                $permisos = array();
            }

            $permisosFormateados = array();

            foreach ($permisos as $mod_id => $acciones) {
                foreach ($acciones as $acc_id => $val) {

                    $permisosFormateados[$mod_id][] = $acc_id;

                    $per_id = $obj->autoincrement("permisos", "per_id");

                    $sql = "INSERT INTO permisos VALUES ('$per_id', '$rol_id', '$mod_id', '$acc_id')";
                    $obj->insert($sql);
                }
            }

            $_SESSION['success_roles'] = "Rol registrado correctamente";

            redirect(getUrl("Roles","Roles","getRoles"));
        }

        public function getRoles()
        {
            $obj = new MasterModel();

            $sql = "SELECT * FROM roles";
            $roles = $obj->select($sql);

            include_once '../view/roles/list.php';
        }

        public function getUpdate()
        {
            $obj = new MasterModel();

            $rol_id = $_GET['rol_id'];

            $sql = "SELECT * FROM roles WHERE id_rol = $rol_id";
            $roles = $obj->select($sql);

            $sql = "SELECT * FROM modulos";
            $modulos = $obj->select($sql);

            $sql = "SELECT * FROM acciones";
            $acciones = $obj->select($sql);

            $sql = "SELECT * FROM permisos WHERE rol_id = $rol_id";
            $permisos = $obj->select($sql);

            $permisos_rol = array();

            foreach ($permisos as $permiso) {
                $permisos_rol[$permiso['mod_id']][] = $permiso['acc_id'];
            }

            include_once '../view/roles/update.php';
        }

        public function postUpdate()
        {
            $obj = new MasterModel();

            $rol_id = $_POST['rol_id'];
            $rol_nombre = trim($_POST['rol_nombre']);

            if($rol_nombre == ""){
                $_SESSION['error_roles'] = "Debe ingresar un nombre para el rol";
                redirect(getUrl("Roles","Roles","getUpdate")."&rol_id=".$rol_id);
                return;
            }

            $sql = "SELECT * FROM roles WHERE UPPER(nombre_rol)=UPPER('$rol_nombre') AND id_rol <> $rol_id";
            $rol_existente = $obj->select($sql);

            if(count($rol_existente) > 0){
                $_SESSION['error_roles'] = "Ya existe un rol con ese nombre";
                redirect(getUrl("Roles","Roles","getUpdate")."&rol_id=".$rol_id);
                return;
            }

            $sql = "UPDATE roles SET nombre_rol='$rol_nombre' WHERE id_rol=$rol_id";
            $obj->update($sql);

            $sql_delete = "DELETE FROM permisos WHERE rol_id = $rol_id";
            $obj->delete($sql_delete);

            if (isset($_POST['permisos'])) {
                $permisos = $_POST['permisos'];
            } else {
                $permisos = array();
            }

            foreach ($permisos as $mod_id => $acciones) {
                foreach ($acciones as $acc_id => $val) {

                    $per_id = $obj->autoincrement("permisos", "per_id");

                    $sql = "INSERT INTO permisos VALUES ($per_id,$rol_id,$mod_id,$acc_id)";

                    $obj->insert($sql);
                }
            }

            $_SESSION['success_roles'] = "Rol actualizado correctamente";

            redirect(getUrl("Roles","Roles","getRoles"));
        }

    }
?>