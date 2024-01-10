<?php
include 'conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener datos del formulario
    $email = $_POST['email'];
    $contrasena = $_POST['contrasena'];

    try {
        // Conectar a la base de datos
        $conexion = conectar();

        // Escapar datos para evitar inyección de SQL (mejora la seguridad)
        $email = mysqli_real_escape_string($conexion, $email);
        $contrasena = mysqli_real_escape_string($conexion, $contrasena);

        // Insertar datos en la tabla Usuarios
        $sql = "INSERT INTO Usuarios (apodo, telefono, email, contrasena) VALUES ('', '', '$email', '$contrasena')";

        if (mysqli_query($conexion, $sql)) {
            echo "Registro exitoso";
        } else {
            throw new Exception("Error al registrar: " . mysqli_error($conexion));
        }
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    } finally {
        // Cerrar la conexión
        if ($conexion) {
            mysqli_close($conexion);
        }
    }
} else {
    echo "Acceso no autorizado";
}
?>
s