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

// Verificar si el formulario ha sido enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Conectar a la base de datos (asegúrate de tener la función conectar() definida)
    include 'conexion.php';
    $conexion = conectar();

    // Verificar si la conexión fue exitosa
    if (!$conexion) {
        die("Error de conexión: " . mysqli_connect_error());
    }

    // Obtener medidas del formulario
    $altura = $_POST['altura'];
    $peso = $_POST['peso'];
    $busto = $_POST['busto'];
    $cintura = $_POST['cintura'];
    $caderas = $_POST['caderas'];
    $preferenciaTalla = $_POST['preferencia-talla'];

    // Insertar las medidas en la tabla medidasUsuario
    $sql = "INSERT INTO medidasUsuario (idUsuario, altura, peso, busto, cintura, caderas, talla)
            VALUES ('$idUsuario', '$altura', '$peso', '$busto', '$cintura', '$caderas', '$preferenciaTalla')";

    if (mysqli_query($conexion, $sql)) {
        echo "Medidas insertadas correctamente.";
    } else {
        echo "Error al insertar medidas: " . mysqli_error($conexion);
    }

    // Cerrar la conexión
    mysqli_close($conexion);
}
?>

<!-- Tu formulario HTML sigue aquí -->

<!-- Tu formulario HTML sigue aquí -->


<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  <link
  href="../css/medidas.css"
  rel="stylesheet"
/>
<link
      href="../css_b/bootstrap.min.css"
      rel="stylesheet"
    />
  <title>Mi Cuenta</title>
</head>
<body>
  <header>
    <!-- Barra de navegación -->
    <nav class="navbar navbar-expand-lg">
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
          aria-label="Toggle navigation">
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
        <a href="perfil.html" class="text-reset" title="Home"><i class=" fa fa-user"></i></a>
      </li>
      <li class="list-group-item">
        <a href="#" class="text-reset" title="About"><i class="fa fa-heart"></i></a>
      </li>
      <li class="list-group-item">
        <a href="#" class="text-reset" title="Collection"><i class="fa fa-gear"></i></a>
      </li>
      <li class="list-group-item">
        <a href="#" class="text-reset" title="Collection"><i class="fa fa-sign-out"></i></a>
      </li>
    </ul>
  </div>


  <!-- Contenido principal -->
  <div id="main-content">
    <form id="edit-nickname-form">
        <div class="row">
            <div class="col-md-4">
              <img src="../img/size_guide-0154e82eea.png" alt="Imagen" class="form-image">
            </div>
            <!-- Formulario -->
            <div class="col-md-8">
                <div class="info-message">
                  <p>Por favor, completa el formulario con tus medidas. La información proporcionada nos ayudará a ofrecerte una mejor experiencia.</p>
                </div>
      <!-- Resto del Formulario -->
  
      <!-- Medidas -->
      <div class="form-group" method="post">
        <h2>Medidas</h2>
  
        <!-- Altura -->
        <div class="form-group">
          <label for="altura">Altura:</label>
          <input type="text" class="form-control" id="altura" name="altura" placeholder="120 a 210 cm">
        </div>
  
        <!-- Peso -->
        <div class="form-group">
          <label for="peso">Peso:</label>
          <input type="text" class="form-control" id="peso" name="peso" placeholder="30 a 150 kg">
        </div>
  
        <!-- Busto -->
        <div class="form-group">
          <label for="busto">Busto:</label>
          <input type="text" class="form-control" id="busto" name="busto" placeholder="65 a 130 cm">
        </div>
  
        <!-- Cintura -->
        <div class="form-group">
          <label for="cintura">Cintura:</label>
          <input type="text" class="form-control" id="cintura" name="cintura" placeholder="55 a 130 cm">
        </div>
  
        <!-- Caderas -->
        <div class="form-group">
          <label for="caderas">Caderas:</label>
          <input type="text" class="form-control" id="caderas" name="caderas" placeholder="70 a 150 cm">
        </div>
  
        <!-- Preferencia de Talla -->
        <div class="form-group">
          <label for="preferencia-talla">Preferencia (talla):</label>
          <input type="text" class="form-control" id="preferencia-talla" name="preferencia talla" placeholder="Grande/Mediana/Chica">
        </div>
  
      </div>

      <button class="btn btn-primary" type="submit">Guardar</button>
  
    </form>
  </div>
  
  
  

  <!-- Agrega los scripts de Bootstrap y jQuery al final del cuerpo -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
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
</html>
