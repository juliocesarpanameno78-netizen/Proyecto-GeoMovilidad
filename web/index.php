<?php
    session_start();
    include_once("../lib/helpers.php");
    resolve();

    echo "<body>";
        echo "<div class='container'>";
        include_once "../view/partials/navbar.php";
        if(isset($_GET['modulo'])){
            resolve();
        }else{

        }
        include_once "../view/partials/footer.php";
        echo "</div>";
    echo "</body>";
    echo "</html>";


?>