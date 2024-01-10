
<?php
include 'conexion.php';

session_start();


// Verificar si se recibió el ID del usuario
if (isset($_GET['idUsuario'])) {
    $idUsuario = $_GET['idUsuario'];


}


?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  <link
  href="../css/vestidos.css"
  rel="stylesheet"
/>
<link
      href="../css_b/bootstrap.min.css"
      rel="stylesheet"
    />
  <title>Mi Cuenta</title>
</head>
<style>
.row {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
    gap: 5rem;
}

.btn-sugeridas{
    background-color: #3498db; /* Cambia el color de fondo según tus preferencias */
    color: #fff; 
    border-radius: 2px;
    border-color: #3498db;
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
          
        </div>
      </div>
    </nav>
  </header>

  

  
  <div class="container-fluid">
    <div class="container">
    <h2>Conjuntos de Ropa</h2>
        <form method="post">
            <button type="submit" class="btn btn-primary"  name="obtenerConjuntoCasual">Conjunto Casual</button>
            <button type="submit" class="btn btn-primary" name="obtenerConjuntoVerano">Conjunto de Verano</button>
        </form>
        
    </div>
        <?php
        if (isset($_POST['obtenerConjuntoCasual'])) {
        
            try {
                $conexion = conectar();

                // Consulta SQL para obtener cuatro productos aleatorios de cada categoría ('A', 'B', 'C')
                $sqlConjunto = "SELECT
                p.CodPrenda,
                p.Descripcion,
                p.Precio,
                p.CodMarca,
                p.ColorPrenda,
                p.Imagen_Producto
            FROM producto p
            JOIN categoria c ON p.CodCategoria = c.CodCategoria
            JOIN ClusterAssignments ca ON p.CodPrenda = ca.CodPrenda
            WHERE
                c.NombreCategoria IN ('Playeras', 'faldas')
                AND ca.ClusterID = 0
            ORDER BY RAND()
            LIMIT 2";
            

                $resultadoConjunto = mysqli_query($conexion, $sqlConjunto);

                if ($resultadoConjunto) {
                    // Mostrar los conjuntos de ropa
                    while ($filaConjunto = mysqli_fetch_assoc($resultadoConjunto)) {
                        ?>
                        
                        <div class="container"><div class="row">
                        <div class="col-md-4">
                            <div class="card" style="width: 18rem;">
                                <img src="data:image/jpeg;base64,<?php echo base64_encode($filaConjunto['Imagen_Producto']); ?>"
                                    class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo $filaConjunto['Descripcion']; ?></h5>
                                    <h6 class="card-subtitle mb-2 text-muted">ID: <?php echo $filaConjunto['CodPrenda']; ?></h6>
                                    <p class="card-text">Marca: <?php echo $filaConjunto['CodMarca']; ?></p>
                                    <p class="card-text">Precio: <?php echo $filaConjunto['Precio']; ?></p>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                } else {
                    throw new Exception("Error al obtener los conjuntos de ropa: " . mysqli_error($conexion));
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


<?php
        if (isset($_POST['obtenerConjuntoVerano'])) {
        
            try {
                $conexion = conectar();

                // Consulta SQL para obtener cuatro productos aleatorios de cada categoría ('A', 'B', 'C')
                $sqlConjunto = "SELECT
                p.CodPrenda,
                p.Descripcion,
                p.Precio,
                p.CodMarca,
                p.ColorPrenda,
                p.Imagen_Producto
            FROM producto p
            JOIN categoria c ON p.CodCategoria = c.CodCategoria
            JOIN ClusterAssignments ca ON p.CodPrenda = ca.CodPrenda
            WHERE
                c.NombreCategoria IN ('trajes de baño', 'Blusas')
                AND ca.ClusterID = 0
            ORDER BY RAND()
            LIMIT 3";
            

                $resultadoConjunto = mysqli_query($conexion, $sqlConjunto);

                if ($resultadoConjunto) {
                    // Mostrar los conjuntos de ropa
                    while ($filaConjunto = mysqli_fetch_assoc($resultadoConjunto)) {
                        ?>
                        
                        <div class="container mx-auto mt-4"><div class="row">
                        <div class="col-md-4">
                            <div class="card" style="width: 18rem;">
                                <img src="data:image/jpeg;base64,<?php echo base64_encode($filaConjunto['Imagen_Producto']); ?>"
                                    class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo $filaConjunto['Descripcion']; ?></h5>
                                    <h6 class="card-subtitle mb-2 text-muted">ID: <?php echo $filaConjunto['CodPrenda']; ?></h6>
                                    <p class="card-text">Marca: <?php echo $filaConjunto['CodMarca']; ?></p>
                                    <p class="card-text">Precio: <?php echo $filaConjunto['Precio']; ?></p>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                } else {
                    throw new Exception("Error al obtener los conjuntos de ropa: " . mysqli_error($conexion));
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



<?php
        if (isset($_POST['obtenerConjuntoNoches'])) {
        
            try {
                $conexion = conectar();

                // Consulta SQL para obtener cuatro productos aleatorios de cada categoría ('A', 'B', 'C')
                $sqlConjunto = "SELECT
                p.CodPrenda,
                p.Descripcion,
                p.Precio,
                p.CodMarca,
                p.ColorPrenda,
                p.Imagen_Producto
            FROM producto p
            JOIN categoria c ON p.CodCategoria = c.CodCategoria
            JOIN ClusterAssignments ca ON p.CodPrenda = ca.CodPrenda
            WHERE
                c.NombreCategoria IN ('Sacos y Blazers', 'Jumpsuits', 'Shorts')
                AND ca.ClusterID = 1
            ORDER BY RAND()
            LIMIT 3";
            

                $resultadoConjunto = mysqli_query($conexion, $sqlConjunto);

                if ($resultadoConjunto) {
                    // Mostrar los conjuntos de ropa
                    while ($filaConjunto = mysqli_fetch_assoc($resultadoConjunto)) {
                        ?>
                        
                        <div class="container mx-auto mt-4"><div class="row">
                        <div class="col-md-4">
                            <div class="card" style="width: 18rem;">
                                <img src="data:image/jpeg;base64,<?php echo base64_encode($filaConjunto['Imagen_Producto']); ?>"
                                    class="card-img-top" alt="...">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo $filaConjunto['Descripcion']; ?></h5>
                                    <h6 class="card-subtitle mb-2 text-muted">ID: <?php echo $filaConjunto['CodPrenda']; ?></h6>
                                    <p class="card-text">Marca: <?php echo $filaConjunto['CodMarca']; ?></p>
                                    <p class="card-text">Precio: <?php echo $filaConjunto['Precio']; ?></p>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                } else {
                    throw new Exception("Error al obtener los conjuntos de ropa: " . mysqli_error($conexion));
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
  
        </div>
    </div>
</div>


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


  

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script> href="../js_b/bootstrap.bundle.js"</script>

  <script>
    
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
</html>
