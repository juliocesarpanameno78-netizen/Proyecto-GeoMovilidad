<?php

    include_once '../model/Señales/SeñalesModel.php';

    class SeñalesController {

        public function getCreate(){
            $obj = new SeñalesModel();
            $sql = "SELECT * FROM tipos_de_senales";
            $tiposeñales = $obj->select($sql);
            include_once '../view/Señales/create.php';
        }

        public function postCreate(){
            
        }

    }

?>