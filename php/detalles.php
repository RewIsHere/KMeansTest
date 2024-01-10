<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../css/vestidos.css" rel="stylesheet" />
    <link href="../css/detalles.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" />
    <link
      href="../css_b/bootstrap.min.css"
      rel="stylesheet"
    />
    <title>Detalles del Producto</title>
    <style>
        /* Puedes añadir estilos adicionales si es necesario */
    </style>
</head>
<body>
<header>
      <nav class="navbar navbar-expand-lg shadow">
        <div class="container">
          <a class="navbar-brand" href="#">
            <strong class="logo">TopShop</strong>
          </a>
          <button
            class="navbar-toggler"
            type="button"
            data-toggle="collapse"
            data-target="#navbarResponsive"
            aria-controls="navbarResponsive"
            aria-expanded="false"
            aria-label="Toggle navigation"
          >
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
            </ul>
              <li class="nav-item mx-3">
    <a href="perfil.php?idUsuario=<?php echo $idUsuario; ?>">
        <i class="fa fa-user" aria-hidden="true"></i>
    </a>
</li>
            </ul>
          </div>
        </div>
      </nav>
    </header>

<?php
// detalles.php
include('conexion.php');

// Verificar si se recibió el parámetro 'codPrenda' en la URL
if (isset($_GET['codPrenda'])) {
    $codPrenda = $_GET['codPrenda'];

    // Conectar a la base de datos (asegúrate de tener la función conectar() disponible)
    $conexion = conectar();

    if ($conexion) {
        try {
            // Obtener información de la tabla producto
            $sqlProducto = "SELECT * FROM producto WHERE CodPrenda = $codPrenda";
            $resultadoProducto = mysqli_query($conexion, $sqlProducto);

            if ($resultadoProducto) {
                // Obtener información de la tabla medidasprenda
                $sqlMedidas = "SELECT * FROM medidasprenda WHERE CodPrenda = $codPrenda";
                $resultadoMedidas = mysqli_query($conexion, $sqlMedidas);

                ?>

                <div class="product-card">
                    <?php
                    if ($resultadoMedidas) {
                        $filaProducto = mysqli_fetch_assoc($resultadoProducto);

                        // Imagen del producto
                        ?>
                        <div class="badge">Hot</div>
                        <div class="product-tumb">
                            <img src="data:image/jpeg;base64,<?php echo base64_encode($filaProducto['Imagen_Producto']); ?>" alt="Imagen del Producto" />
                        </div>

                        <?php
                        // Detalles del producto
                        ?>
                        <div class="product-details">
                            <span class="product-catagory"><?php echo (isset($filaProducto['CodPrenda']) ? $filaProducto['CodPrenda'] : 'No disponible'); ?></span>
                            <p><?php echo (isset($filaProducto['Descripcion']) ? $filaProducto['Descripcion'] : 'No disponible'); ?></p>
                            
                            <?php
                            // Detalles adicionales y enlaces
                            ?>
                            <div class="product-bottom-details">
                                <div class="product-price"><small>$<?php echo (isset($filaProducto['Precio']) ? $filaProducto['Precio'] : 'No disponible'); ?></small></div>
                                
                                <?php
                                // Medidas de la prenda
                                while ($filaMedidas = mysqli_fetch_assoc($resultadoMedidas)) {
                                    echo "<br>";
                                    echo "<br>";
                                    ?>
                                    
                                    <h5 class='text-center'>Medidas de la Prenda:</h5>
                                    <p>Altura: <?php echo (isset($filaMedidas['altura']) ? $filaMedidas['altura'] . ' cm' : 'No disponible'); ?></p>
<p>Peso: <?php echo (isset($filaMedidas['peso']) ? $filaMedidas['peso'] . ' kg' : 'No disponible'); ?></p>
<p>Busto: <?php echo (isset($filaMedidas['busto']) ? $filaMedidas['busto'] . ' cm' : 'No disponible'); ?></p>
<p>Cintura: <?php echo (isset($filaMedidas['cintura']) ? $filaMedidas['cintura'] . ' cm' : 'No disponible'); ?></p>
<p>Caderas: <?php echo (isset($filaMedidas['caderas']) ? $filaMedidas['caderas'] . ' cm' : 'No disponible'); ?></p>

                                    <?php
                                }
                                ?>
                                
                            </div>
                        </div>
                        <?php
                    } else {
                        throw new Exception("Error al obtener las medidas de la prenda: " . mysqli_error($conexion));
                    }
                    ?>
                </div>

                <?php
            } else {
                throw new Exception("Error al obtener los detalles del producto: " . mysqli_error($conexion));
            }
        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        } finally {
            // Cerrar la conexión
            mysqli_close($conexion);
        }
    } else {
        echo "Error al conectar a la base de datos.";
    }
} else {
    // Manejar el caso en que no se proporciona el parámetro 'codPrenda'
    echo "Error: Falta el parámetro 'codPrenda' en la URL.";
}
?>
 <script> href="../js_b/bootstrap.bundle.js"</script>
</body>
</html>
