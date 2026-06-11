<?php 

        include_once '../lib/helpers.php';
        include_once '../view/partials/header.php';
        include_once '../view/partials/navbar.php';
        
        if (isset($_GET['modulo'])) {
            resolve();
        } else{
            include_once '../view/partials/dashboard.php';
        }

        include_once '../view/partials/footer.php';


?>