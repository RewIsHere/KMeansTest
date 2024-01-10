<?php
include 'conexion.php';

session_start(); // Inicia la sesión

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

        // Consultar si el usuario existe en la base de datos
        $sql = "SELECT idUsuario FROM Usuarios WHERE email = '$email' AND contrasena = '$contrasena'";
        $resultado = mysqli_query($conexion, $sql);

        // Después de ejecutar la consulta SQL
        if ($resultado) {
            // Imprimir información sobre los resultados (para propósitos de depuración)
            var_dump($resultado);

            if (mysqli_num_rows($resultado) > 0) {
                // Resto del código
                $fila = mysqli_fetch_assoc($resultado);
                $idUsuario = $fila['idUsuario'];

                // Almacena el ID del usuario en una variable de sesión
                $_SESSION['idUsuario'] = $idUsuario;

                // Registra el inicio de sesión en la tabla "inicios_sesion"
                $sqlInsert = "INSERT INTO inicios_sesion (idUsuario, fechaHoraInicio) VALUES ('$idUsuario', NOW())";
                mysqli_query($conexion, $sqlInsert);

                // Redirige a perfil.php con el ID del usuario en la URL
                header("Location: perfil.php?idUsuario=$idUsuario");
                exit(); // Asegura que el script se detenga después de la redirección
            } else {
                echo "Credenciales incorrectas";
            }
        } else {
            // Imprimir errores de MySQL (para propósitos de depuración)
            echo "Error en la consulta: " . mysqli_error($conexion);
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
