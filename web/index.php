<?php

include_once "../lib/helpers.php";
include_once "../view/partials/head.php";

if(!isset($_SESSION['auth']) || $_SESSION['auth'] !="ok"){
    redirect('login.php');

}

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