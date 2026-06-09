<?php 
    include_once '../lib/helpers.php';
    include_once '/Geomovilidad/view/partials/header.php';
    include_once "../view/partials/navbar.php";
    
    echo "<body>";
        echo "<div class=container>";
        
            if(isset($_GET['modulo'])){
                resolve();
            }else{
                
            }
        include_once "../view/partials/footer.php";
    echo "</body>";
    echo "</html>";



   
?>