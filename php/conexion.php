<?php
function conectar() {
    $user = "root";
    $pass = "";
    $server = "localhost";
    $db = "topshop";

    // Crear conexión
    $con = new mysqli($server, $user, $pass, $db);

    // Verificar la conexión
    if ($con->connect_error) {
        die("Error al conectar con la base de datos: " . $con->connect_error);
    }

    return $con;
}
?>
