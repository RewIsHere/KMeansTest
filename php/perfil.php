<?php
include 'conexion.php';

session_start();

// Verificar si se recibió el ID del usuario
if (isset($_GET['idUsuario'])) {
    $idUsuario = $_GET['idUsuario'];

    // Verificar si se envió el formulario de edición de información
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Verificar qué campo se está editando y realizar la acción correspondiente
        if (isset($_POST['nickname'])) {
            // Editar apodo
            editarApodo($idUsuario, $_POST['nickname']);
        } elseif (isset($_POST['password'])) {
            // Cambiar contraseña
            cambiarContrasena($idUsuario, $_POST['password']);
        } elseif (isset($_POST['phone'])) {
            // Añadir teléfono
            agregarTelefono($idUsuario, $_POST['phone']);
        }
    }
} else {
    echo "ID del Usuario no encontrado";
}
// Función para editar el apodo
function editarApodo($idUsuario, $nuevoApodo) {
    try {
        // Conectar a la base de datos
        $conexion = conectar();

        // Actualizar apodo en la tabla Usuarios
        $sql = "UPDATE Usuarios SET apodo = '$nuevoApodo' WHERE IdUsuario = $idUsuario";
        $resultado = mysqli_query($conexion, $sql);

        if (!$resultado) {
            throw new Exception("Error al editar el apodo: " . mysqli_error($conexion));
        }
        $sql = "SELECT apodo FROM Usuarios WHERE IdUsuario = $idUsuario";
        $resultado = mysqli_query($conexion, $sql);

        if ($fila = mysqli_fetch_assoc($resultado)) {
            return $fila['apodo'];
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

// Función para cambiar la contraseña
// Función para cambiar la contraseña
function cambiarContrasena($idUsuario, $Contrasena) {
  try {
      // Conectar a la base de datos
      $conexion = conectar();

      // Actualizar contraseña en la tabla Usuarios
      $sql = "UPDATE Usuarios SET contrasena = '$Contrasena' WHERE IdUsuario = $idUsuario";
      $resultado = mysqli_query($conexion, $sql);

      if (!$resultado) {
          throw new Exception("Error al cambiar la contraseña: " . mysqli_error($conexion));
      }

      $sql = "SELECT contrasena FROM Usuarios WHERE IdUsuario = $idUsuario";
        $resultado = mysqli_query($conexion, $sql);

        if ($fila = mysqli_fetch_assoc($resultado)) {
            return $fila['contrasena'];
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



// Función para agregar el teléfono
function agregarTelefono($idUsuario, $nuevoTelefono) {
    try {
        // Conectar a la base de datos
        $conexion = conectar();

        // Actualizar teléfono en la tabla Usuarios
        $sql = "UPDATE Usuarios SET telefono = '$nuevoTelefono' WHERE IdUsuario = $idUsuario";
        $resultado = mysqli_query($conexion, $sql);

        if (!$resultado) {
            throw new Exception("Error al agregar el teléfono: " . mysqli_error($conexion));
        }
        $sql = "SELECT telefono FROM Usuarios WHERE IdUsuario = $idUsuario";
        $resultado = mysqli_query($conexion, $sql);

        if ($fila = mysqli_fetch_assoc($resultado)) {
            return $fila['telefono'];
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

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  <link href="../css/perfil.css" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;700&display=swap" rel="stylesheet">

  <style>
    /* Botones de color rosa */
    .btn-pink {
      background-color: #ff69b4;
      color: #fff;
    }

    .btn-pink:hover {
      background-color: #ff4980;
    }

    /* Tipografía atractiva */
    body {
      font-family: 'Open Sans', sans-serif;
    }

    /* Icono de menú estrella */
    #sidebar-btn {
      font-size: 24px;
      cursor: pointer;
    }

    /* Estilos para los formularios */
    form {
      margin-bottom: 20px;
    }

    .input-group-prepend,
    .input-group-append {
      background-color: #fff;
    }

    /* Transiciones animadas a los formularios */
    .input-group input,
    .input-group button {
      transition: all 0.3s ease-in-out;
    }

    .input-group input:hover,
    .input-group button:hover {
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    /* Estilos para el pie de página */
    footer {
      background-color: #f8f9fa;
      padding: 20px 0;
      margin-top: 50px;
    }

    /* Estilos para el banner */
    #banner-container {
      margin-top: 20px;
    }

    #banner-container img {
      width: 100%;
      border-radius: 10px;
    }
  </style>

  <title>Mi Cuenta</title>
</head>
<body>
 
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  <link
  href="../css/perfil.css"
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
        <a href="perfil.php?idUsuario=<?php echo $idUsuario; ?>" class="text-reset" title="Home"><img src="../svgs/solid/user.svg" width="20" height="20"></a>
      </li>
      <li class="list-group-item">
        <a href="preferencias.php" class="text-reset"  title="About"><img src="../svgs/solid/heart.svg" width="20" height="20"></a>
      </li>
      <li class="list-group-item">
        <a href="conjunto.php" class="text-reset" title="About"><img src="../svgs/solid/shirt.svg" width="20" height="20"></a>
      </li>
      <li class="list-group-item">
        <a href="#" class="text-reset" title="Collection"><i class="fa fa-gear"></i></a>
      </li>
      <li class="list-group-item">
        <a href="exit.php" class="text-reset" title="Collection"><img src="../svgs/solid/x.svg" width="20" height="20"></a>
      </li>
    </ul>
  </div>

  <!-- Botón para mostrar/ocultar la barra lateral -->
  <div id="sidebar-btn">&#9654;</div>

  

  <!-- Contenido principal -->
  <div id="main-content">

    <div id="banner-container">
        <img src="../img/banner.png" alt="Banner" class="img-fluid">
    </div>
    
    <div id="user-info-container">
        <h2>Información</h2>

        <!-- Editar Apodo -->
        <form id="edit-nickname-form" method="POST" action="perfil.php?idUsuario=<?php echo $idUsuario; ?>">
            <div class="input-group input-group-sm mb-3">
                <div class="input-group-prepend">
                    <label class="input-group-text" for="nickname">Editar Apodo*:</label>
                </div>
                <input type="text" class="form-control form-control-sm" id="nickname" name="nickname" placeholder="Nuevo Apodo" aria-label="Nuevo Apodo" aria-describedby="inputGroup-sizing-sm"  value="<?php echo isset($nuevoApodo) ? $nuevoApodo : ''; ?>" required>
                <div class="input-group-append">
                    <button class="btn btn-outline-secondary" type="submit">Guardar</button>
                </div>
            </div>
        </form>

        <!-- Cambiar Contraseña -->
        <form id="change-password-form" method="POST" action="perfil.php?idUsuario=<?php echo $idUsuario; ?>">
            <div class="input-group input-group-sm mb-3">
                <div class="input-group-prepend">
                    <label class="input-group-text" for="password">Cambiar Contraseña:</label>
                </div>
                <input type="password" class="form-control form-control-sm" id="password" name="password" placeholder="Nueva Contraseña" aria-label="Nueva Contraseña" aria-describedby="inputGroup-sizing-sm" value="<?php echo isset($contrasena) ? $contrasena : ''; ?>" required>
                <div class="input-group-append">
                    <button class="btn btn-outline-secondary" type="submit">Guardar</button>
                </div>
            </div>
        </form>

        <!-- Añadir Teléfono -->
        <form id="add-phone-form" method="POST" action="perfil.php?idUsuario=<?php echo $idUsuario; ?>">
            <div class="input-group input-group-sm mb-3">
                <div class="input-group-prepend">
                    <label class="input-group-text" for="phone">Añadir Teléfono:</label>
                </div>
                <input type="tel" class="form-control form-control-sm" id="phone" name="phone" placeholder="Número de Teléfono" aria-label="Número de Teléfono" aria-describedby="inputGroup-sizing-sm" value="<?php echo isset($nuevoTelefono) ? $nuevoTelefono : ''; ?>" required>
                <div class="input-group-append">
                    <button class="btn btn-outline-secondary" type="submit">Guardar</button>
                </div>
            </div>
        </form>

    </div>
    <div class="form-group">
        <h2>Descargar Información</h2>
        <p>Para solicitar una copia de tus datos personales, 
          completa el siguiente formulario. Para mantener la seguridad de tus datos, 
          verificaremos tu identidad en función de la información que proporciones a continuación 
          y la información en nuestros sistemas. Si necesitamos más información para fines de verificación, 
          nos pondremos en contacto contigo.</p>
        
        <!-- Aquí puedes agregar más campos para la descarga de información -->
        
        <button class="btn btn-primary" type="submit">Solicitar Descarga</button>
      </div>
    </form>
  </div>
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

  <!-- Agregar los scripts de Bootstrap y jQuery al final del cuerpo -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script href="../js_b/bootstrap.bundle.js"></script> 
  <script>
    // Función para mostrar/ocultar la barra lateral
    function toggleSidebar() {
      var sidebar = document.getElementById('sidebar-container');
      var mainContent = document.getElementById('main-content');
      var sidebarBtn = document.getElementById('sidebar-btn');

      if (sidebar.style.width === '80px') {
        sidebar.style.width = '0';
        mainContent.style.marginLeft = '0';
        sidebarBtn.innerHTML = '&#9733;'; // Estrella amarilla
      } else {
        sidebar.style.width = '80px';
        mainContent.style.marginLeft = '80px';
        sidebarBtn.innerHTML = '&#9734;'; // Estrella vacía
      }
    }

    // Asigna el evento clic al botón de la barra lateral
    document.getElementById('sidebar-btn').addEventListener('click', toggleSidebar);
  </script>
</body>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="../js_b/bootstrap.bundle.js"></script>
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
  document.getElementById('sidebar-btn').addEventListener('click', function() {
    toggleSidebar();
    fixStarIcon();
  });

  // Arreglar el problema de la estrella
  function fixStarIcon() {
    var sidebar = document.getElementById('sidebar-container');
    var sidebarBtn = document.getElementById('sidebar-btn');

    if (sidebar.style.width === '80px') {
      sidebarBtn.innerHTML = '&#9664;'; // Flecha izquierda
    } else {
      sidebarBtn.innerHTML = '&#9654;'; // Flecha derecha
    }
  }
</script>

</html>
