<?php

    include_once '../model/Senales/SenalesModel.php';

    class SenalesController {
    public function getCreate(){
        $obj = new SenalesModel();
        $sql = "SELECT * FROM tipos_de_senales";
        $tiposenales = $obj->select($sql);
        include_once '../view/Senales/create.php';
    }
    }

?>