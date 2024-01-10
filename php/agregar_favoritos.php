<?php
include 'conexion.php';

// Verificar si se recibió el ID del usuario y el ID de la prenda
if (isset($_GET['CodPrenda']) && isset($_GET['idUsuario'])) {
    // Print the received idUsuario for debugging
    $idPrenda = $_GET['CodPrenda'];
    $idUsuario = $_GET['idUsuario'];
    echo "Received idUsuario: $idUsuario<br>";

    try {
        // Conectar a la base de datos
        $conexion = conectar();

        // Verificar si la prenda ya está en favoritos using prepared statements
        $verificarExistencia = "SELECT 1 FROM mis_preferencias WHERE IdUsuario = ? AND CodPrenda = ?";
        $stmtExistencia = mysqli_prepare($conexion, $verificarExistencia);
        mysqli_stmt_bind_param($stmtExistencia, 'ii', $idUsuario, $idPrenda);
        mysqli_stmt_execute($stmtExistencia);
        mysqli_stmt_store_result($stmtExistencia);

        if (mysqli_stmt_num_rows($stmtExistencia) > 0) {
            echo "Esta prenda ya está en favoritos";
        } else {
            // La prenda no está en favoritos, realizar la inserción
            $sql = "INSERT INTO mis_preferencias (IdUsuario, CodPrenda) VALUES (?, ?)";
            $stmt = mysqli_prepare($conexion, $sql);
            mysqli_stmt_bind_param($stmt, 'ii', $idUsuario, $idPrenda);
            mysqli_stmt_execute($stmt);

            if (!$stmt) {
                throw new Exception("Error al agregar a favoritos: " . mysqli_error($conexion));
            } else {
                echo "Agregado a favoritos con éxito";
            }
        }
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    } finally {
        // Cerrar la conexión
        if ($conexion) {
            mysqli_close($conexion);
        }
    }
}
?>
