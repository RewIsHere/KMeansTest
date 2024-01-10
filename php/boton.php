<?php
session_start();

// Verificar si el usuario está autenticado
if (!isset($_SESSION['idUsuario'])) {
    // Redirigir al usuario a la página de inicio de sesión si no está autenticado
    header("Location: login.php");
    exit();
}

// Ruta al script de Python
$pythonScript = "../python/medidas.py";

// Verificar si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['ejecutarScript'])) {
    // Comando para ejecutar el script de Python con el idUsuario como argumento
    $command = "python $pythonScript";

    // Ejecuta el comando y captura la salida
    $output = exec($command);

    // Muestra la salida (puedes ajustar esto según lo que imprima tu script de Python)
    echo "Salida del script de Python: $output";


}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejecutar Script Python</title>
</head>
<body>
    <h2>Ejecutar Script Python</h2>
    <form method="post">
        <button type="submit" name="ejecutarScript">Ejecutar Script</button>
    </form>
</body>
</html>
