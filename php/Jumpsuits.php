<?php
session_start();

// Verificar si el usuario está autenticado
if (!isset($_SESSION['idUsuario'])) {
    // Redirigir al usuario a la página de inicio de sesión si no está autenticado
    header("Location: login.php");
    exit();
}

// Obtener el ID del usuario desde la sesión
$idUsuario = $_SESSION['idUsuario'];

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fashion</title>
    <link rel="stylesheet" href="home.css" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" />
    <link href="../css/vestidos.css" rel="stylesheet" />
    <link
      href="../css_b/bootstrap.min.css"
      rel="stylesheet"
    />
  </head>
</head>
<body>
    <header>
        
        <nav class="navbar navbar-expand-lg shadow">
            <div class="container">
                <a class="navbar-brand" href="index.php">
                    <strong class="logo">TopShop</strong>
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive"
                    aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav ml-auto">
                        
                        
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    
    <div class="container-fluid">
        
        <?php
include 'conexion.php';

try {
   
    $conexion = conectar();

    
    $categoriaNombre = "Jumpsuits";

    
    $sql = "CALL ObtenerProductosPorCategoria('$categoriaNombre')";
    $resultado = mysqli_query($conexion, $sql);

    if ($resultado) {
        
        echo '<div class="container mx-auto mt-4"><div class="row">';

        while ($fila = mysqli_fetch_assoc($resultado)) {
            ?>
            <div class="col-md-4">
                <div class="card" style="width: 18rem;">
                    <img src="data:image/jpeg;base64,<?php echo base64_encode($fila['Imagen_Producto']); ?>" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $fila['Descripcion']; ?></h5>
                        <h6 class="card-subtitle mb-2 text-muted">ID: <?php echo $fila['CodPrenda']; ?></h6>
                        <p class="card-text">Color: <?php echo $fila['ColorPrenda']; ?></p>
                        <p class="card-text">Color: <?php echo $fila['Precio']; ?></p>
                        <a href="detalles.php?codPrenda=<?php echo $fila['CodPrenda']; ?>" class="btn mr-2">Detalles</a>

                        <button class="btn btn-danger" data-id-usuario="<?php echo $idUsuario; ?>" data-cod-prenda="<?php echo $fila['CodPrenda']; ?>" onclick="toggleHeart(this)">
                            <i class="fa fa-heart"></i> Agregar a favoritos
                        </button>
                    </div>
                </div>
            </div>
            <?php
        }

        echo '</div></div>';
    } else {
        throw new Exception("Error al ejecutar el procedimiento almacenado: " . mysqli_error($conexion));
    }
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
} finally {
    // Cerrar la conexión
    if ($conexion) {
        mysqli_close($conexion);
    }
}
?>
</div>


    <script>

    function toggleHeart(button) {
    var idUsuario = button.getAttribute("data-id-usuario");
    var codPrenda = button.getAttribute("data-cod-prenda");

    
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "agregar_favoritos.php?CodPrenda=" + codPrenda + "&idUsuario=" + idUsuario, true);
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            
            alert(xhr.responseText);

            
            if (xhr.responseText.includes("ya está en favoritos")) {
                button.classList.remove("btn-danger");
                button.classList.add("btn-outline-danger");
                button.disabled = true; 
            } else {
                button.classList.remove("btn-outline-danger");
                button.classList.add("btn-danger");
                button.disabled = false; 
            }
        }
    };
    xhr.send();
}
</script>
<script> href="../js_b/bootstrap.bundle.js"</script> 
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
