<?php
function conectar() {
    $user = "root";
    $pass = "";
    $server = "localhost";
    $db = "topshop";

    // Crear conexi�n
    $con = new mysqli($server, $user, $pass, $db);

    // Verificar la conexi�n
    if ($con->connect_error) {
        die("Error al conectar con la base de datos: " . $con->connect_error);
    }

    return $con;
}
?>
