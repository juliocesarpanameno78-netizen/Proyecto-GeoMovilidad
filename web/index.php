<?php

include_once '../lib/helpers.php';

$modulo = isset($_GET['modulo']) ? $_GET['modulo'] : '';

if ($modulo != 'Login' && $modulo != 'Registro') {
    include_once '../view/partials/header.php';
    include_once '../view/partials/navbar.php';
}

if (isset($_GET['modulo'])) {
    resolve();
} else {
    include_once '../view/partials/dashboard.php';
}

if ($modulo != 'Login' && $modulo != 'Registro') {
    include_once '../view/partials/footer.php';
}
?>