<?php
include_once '../lib/helpers.php';

// Prueba 1
$_SESSION['id_rol'] = 2;
echo "tieneRol(1): "; var_dump(tieneRol(1));
echo "tieneRol(2): "; var_dump(tieneRol(2));
echo "tieneRol(3): "; var_dump(tieneRol(3));
















































// // Test 3
// echo "nombreRol() con rol 2: "; var_dump(nombreRol());
// unset($_SESSION['id_rol']);
// echo "nombreRol() sin sesion: "; var_dump(nombreRol());

// // Test 4
// echo "getUrl(): "; var_dump(getUrl('Usuarios','Usuarios','getUsuarios'));