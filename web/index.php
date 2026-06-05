<<<<<<< HEAD
<?php 
    include_once '../lib/helpers.php';
    include_once '../view/partials/header.php';
    
    echo "<body>";
        echo "<div class=container>";
        include_once "../view/partials/navbar.php";
            if(isset($_GET['modulo'])){
                resolve();
            }else{
                
            }
        include_once "../view/footer.php";
    echo "</body>";
    echo "</html>";

=======
<?php
    session_start();
    include_once("../lib/helpers.php");
    resolve();
>>>>>>> 7367345bf1967d26e52e642af76293ce9b6948f4
?>