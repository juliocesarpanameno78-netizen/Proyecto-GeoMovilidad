<?php

class MapaController
{
    public function getSelectLocation()
    {
        require_once '../lib/ayudantes.php';
        require_once '../model/MasterModel.php';

        $returnUrl = isset($_GET['return']) ? $_GET['return'] : '';
        $returnParam = isset($_GET['param']) ? $_GET['param'] : 'coords';

        include_once '../view/Mapa/seleccionarUbicacion.php';
    }
}
