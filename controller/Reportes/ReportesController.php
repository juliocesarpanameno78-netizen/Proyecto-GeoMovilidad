<?php

    include_once '../model/Reportes/ReportesModel.php';

    class ReportesController {

        public function getCreate(){
            $obj = new ReportesModel();
            include_once '../view/Reportes/create.php';

        }
    }

?>