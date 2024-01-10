<?php
include 'conexion.php';
session_start();

// Verificar si el usuario está autenticado
if (!isset($_SESSION['idUsuario'])) {
    // Redirigir al usuario a la página de inicio de sesión si no está autenticado
    header("Location: login.php");
    exit();
}


// Obtener el ID del usuario desde la sesión
$idUsuario = $_SESSION['idUsuario'];
$pythonScript = "../python/medidas.py";
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link href="../css/preferencias.css" rel="stylesheet" />
    <link
      href="../css_b/bootstrap.min.css"
      rel="stylesheet"
    />
    <title>Mi Cuenta</title>
</head>
<style>
.banner-container{
    margin-left: 40px;
}
.btn-sugeridas{
    background-color: #3498db; /* Cambia el color de fondo según tus preferencias */
    color: #fff; 
    border-radius: 5px;
    border-color:  #3498db;
    padding: 10px
}
.row {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
    gap: 1rem;
}
</style>
<body>
    <header>
        <!-- Barra de navegación -->
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

    <!-- Barra lateral -->
    <div id="sidebar-container">
        <ul class="list-group">
            <li class="list-group-item">
                <a href="perfil.php?idUsuario=<?php echo $idUsuario; ?>" class="text-reset" title="Home"><i
                        class=" fa fa-user"></i></a>
            </li>
            <li class="list-group-item">
                <a href="preferencias.php" class="text-reset" title="About"><img src="../svgs/solid/heart.svg" width="20" height="20"></a>
            </li>
            <li class="list-group-item">
                <a href="#" class="text-reset" title="Collection"><img src="../svgs/solid/user.svg" width="20" height="20"></a>
            </li>
            <li class="list-group-item">
                <a href="#" class="text-reset" title="Collection"><img src="../svgs/solid/gear.svg" width="20" height="20"></a>
            </li>
        </ul>
    </div>

    <!-- Botón para mostrar/ocultar la barra lateral -->
    <div id="sidebar-btn">&#9654;</div>

    <!-- Contenido principal -->
    <div id="main-content">
        
            <h2>Mis Preferencias </h2>
                <?php
                try {

                  $conexion=conectar();
                    // Consulta SQL para obtener información de mis_preferencias, producto y marca
                    $sql = "SELECT mp.CodPrenda, p.Descripcion, p.CodMarca, p.Precio, p.Imagen_Producto
                            FROM mis_preferencias mp
                            JOIN producto p ON mp.CodPrenda = p.CodPrenda
                            WHERE mp.IdUsuario = $idUsuario";

                    // Ejecutar la consulta
                    $resultado = mysqli_query($conexion, $sql);

                    if ($resultado) {
                        // Mostrar los resultados
                        while ($fila = mysqli_fetch_assoc($resultado)) {
                            ?>
                            <div class="col-md-4">
                                <div class="card" style="width: 18rem;">
                                    <img src="data:image/jpeg;base64,<?php echo base64_encode($fila['Imagen_Producto']); ?>"
                                        class="card-img-top" alt="...">
                                    <div class="card-body">
                                        <h5 class="card-title"><?php echo $fila['Descripcion']; ?></h5>
                                        <h6 class="card-subtitle mb-2 text-muted">ID: <?php echo $fila['CodPrenda']; ?>
                                        </h6>
                                        <p class="card-text">Marca: <?php echo $fila['CodMarca']; ?></p>
                                        <p class="card-text">Precio: <?php echo $fila['Precio']; ?></p>
                                    </div>
                                </div>
                            </div>
                            <?php
                        }
                    } else {
                        throw new Exception("Error al ejecutar la consulta: " . mysqli_error($conexion));
                    }
                } catch (Exception $e) {
                    echo "Error: " . $e->getMessage();
                }
                ?>
            </div>
        </div>
        </div>

        <div class="container mx-auto mt-4">
        <h2>Prendas Sugeridas por tus medidas!!!!</h2>
        <form class="formulario" method="post">
            <button type="submit" class="btn-sugeridas" name="obtenerPrendasSugeridas">Obtener Prendas Sugeridas</button>
        </form>
        <?php
        $pythonScript = "../python/medidas.py";
        if (isset($_POST['obtenerPrendasSugeridas'])) {
            try {

                $command = "python $pythonScript";

    // Ejecuta el comando y captura la salida
                $output = exec($command);


                
               
                $con = conectar();
                
                // Consulta SQL para obtener las prendas sugeridas
                $sql = "SELECT p.CodPrenda, p.Descripcion, p.Precio, p.CodMarca, p.ColorPrenda, p.Imagen_Producto
                FROM producto p
                JOIN ClusterAssignments c ON p.CodPrenda = c.CodPrenda
                WHERE c.ClusterID = 0";  

                // Ejecutar la consulta
                $resultado = mysqli_query($con, $sql);

                if ($resultado) {
                    // Mostrar las prendas sugeridas
                    while ($fila = mysqli_fetch_assoc($resultado)) {
                        ?>
                           <div class="container mx-auto mt-4">
                            <div class="col-md-4">
                                <div class="card" style="width: 18rem;">
                                    <img src="data:image/jpeg;base64,<?php echo base64_encode($fila['Imagen_Producto']); ?>"
                                        class="card-img-top" alt="...">
                                    <div class="card-body">
                                        <h5 class="card-title"><?php echo $fila['Descripcion']; ?></h5>
                                        <h6 class="card-subtitle mb-2 text-muted">ID: <?php echo $fila['CodPrenda']; ?>
                                        </h6>
                                        <p class="card-text">Marca: <?php echo $fila['CodMarca']; ?></p>
                                        <p class="card-text">Precio: <?php echo $fila['Precio']; ?></p>
                                    </div>
                                </div>
                            </div>
                            
                        <?php  // Código para mostrar las prendas sugeridas (similar al existente)
                    }
                } else {
                    throw new Exception("Error al ejecutar la consulta: " . mysqli_error($con));
                }

                // Cerrar la conexión
                mysqli_close($con);
            } catch (Exception $e) {
                echo "Error: " . $e->getMessage();
            }
        }
        ?>      
    </div>

    <!-- Descargar Información -->

    <footer class="mt-5">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h4>Contacto</h4>
                    <p>Email: info@topshop.com</p>
                    <p>Teléfono: +123 456 7890</p>
                </div>
                <div class="col-md-6">
                    <h4>Enlaces Útiles</h4>
                    <ul>
                        <li><a href="#">Política de Privacidad</a></li>
                        <li><a href="#">Términos y Condiciones</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>

    <!-- Agrega los scripts de Bootstrap y jQuery al final del cuerpo -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>}
    <script> href="../js_b/bootstrap.bundle.js"</script> 

    <script>
        // Función para mostrar/ocultar la barra lateral
        function toggleSidebar() {
            var sidebar = document.getElementById('sidebar-container');
            var mainContent = document.getElementById('main-content');
            var sidebarBtn = document.getElementById('sidebar-btn');

            if (sidebar.style.width === '80px') {
                sidebar.style.width = '0';
                mainContent.style.marginLeft = '0';
                sidebarBtn.innerHTML = '&#9654;'; // Flecha derecha
            } else {
                sidebar.style.width = '80px';
                mainContent.style.marginLeft = '80px';
                sidebarBtn.innerHTML = '&#9664;'; // Flecha izquierda
            }
        }

        // Asigna el evento clic al botón de la barra lateral
        document.getElementById('sidebar-btn').addEventListener('click', toggleSidebar);
    </script>
</body>
</html>

<?php
// Cerrar la conexión al final del script
if ($conexion) {
    mysqli_close($conexion);
}
?>
