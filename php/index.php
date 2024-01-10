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




<html>
  <head>
    <title>Fashion</title>
    <link rel="stylesheet" href="home.css" />
    <link
      rel="stylesheet"
      href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"
    />
    <link
      rel="stylesheet"
      href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
    />
    <link
      href="../css/index.css"
      rel="stylesheet"
    />
    <link
      href="../css_b/bootstrap.min.css"
      rel="stylesheet"
    />
  </head>
  <body>
    <header>
      <!-- Navigation -->
      <!-- navbar-dark bg-dark static-top -->
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
              <li class="nav-item active mx-3">
                <a class="nav-link" href="vestidos.php"
                  >Vestidos
                  <span class="sr-only"></span>
                </a>
              </li>
              <li class="nav-item mx-3">
                <a class="nav-link" href="playeras.php">Playeras</a>
              </li>
              <li class="nav-item mx-3">
                <a class="nav-link" href="faldas.php">Faldas</a>
              </li>
              <li class="nav-item mx-3">
                <a class="nav-link" href="trajesdebaño.php">Trajes de baño</a>
              </li>
              <li class="nav-item mx-3">
                <a class="nav-link" href="gorras.php">Sombreros</a>
              </li>
              <li class="nav-item mx-3">
                <a class="nav-link" href="Jumpsuits.php">Jumpsuits</a>
              </li>
              <li class="nav-item mx-3">
                <a class="nav-link" href="#">
                <img src="../svgs/solid/bag-shopping.svg" alt=perfil width="20" height="20" aria-hidden="true"></img>
                </a>
              </li>
              <li class="nav-item mx-3">
    <a href="perfil.php?idUsuario=<?php echo $idUsuario; ?>">
        <img src="../svgs/solid/user.svg" alt=perfil width="20" height="20" aria-hidden="true"></img>
    </a>
</li>
            </ul>
          </div>
        </div>
      </nav>
    </header>
    <!-- main -->
    <div class="container-fluid">
      <!-- banner -->
      <div class="row banner" color="primary">
        <div class="row col-md inner-banner m-4">
          <div class="col-md-6 content bg-circle align-self-center text-center">
            <h1 class="text-center">Hola Invierno!</h1>
            <h5>Disfruta de lo que esta en venta este 2023!</h5>
            <p class="dummy-desc">
            Disfruta de nuestras ofertas este 2023, con nuevos y mejores productos para dama!
            </p>
            <div class="button">
              <button type="button" class="btn">
                Compra ahora! <i class="fa fa-shopping-bag" aria-hidden="true"></i>
              </button>
            </div>
          </div>
          <div class="col-md-6 image alig-end">
            <div class=""></div>
          </div>
        </div>
      </div>
    </div>
    <!-- About -->
    <div class="container text-center about my-5">
      <div class="row">
        <div class="col-lg col-md col-sm col-xs">
          <h2 class="custom-title my-5">
            Lo que ofrecemos!
          </h2>
          <p class="dummy-desc">
            Oferecemos productos de la mas alta calidad usados por las mas altas celebridades, diseñados e importados de tiendas colaboradoras con nosotros como lo son Shein, Zara entre otras marcas!
          </p>
        </div>
      </div>
    </div>
    <!-- collection -->
    <div class="container text-center collections my-5">
      <h2 class="custom-title">Nuevos Productos</h2>
      <div class="row my-5">
        <div class="col-md-4">
          <div class="card" style="width: 18rem;">
            <img class="card-img-top" src="../img/728.webp" alt="Card image cap" />
            <div class="card-body">
              <h5 class="card-title">Sacos y Blazers</h5>
              <p class="card-text dummy-desc">
                Este año luce mas fresca con nuestra nueva variedad!
              </p>
              <a href="sacos.php" class="btn"
                >Ve nuestros productos!
                <i class="fa fa-shopping-bag" aria-hidden="true"></i
              ></a>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card" style="width: 18rem;">
            <img class="card-img-top" src="../img/sueter.jpg" alt="Card image cap" />
            <div class="card-body">
              <h5 class="card-title">Blusas</h5>
              <p class="card-text dummy-desc">
                Blusas con estampados originales!
              </p>
              <a href="blusas.php" class="btn"
                > Ve nuestros productos!
                <i class="fa fa-shopping-bag" aria-hidden="true"></i
              ></a>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card" style="width: 18rem;">
            <img class="card-img-top" src="../img/507.jpeg" alt="Card image cap" />
            <div class="card-body">
              <h5 class="card-title">Sombreros</h5>
              <p class="card-text dummy-desc">
                Variedad!
              </p>
              <a href="maternidad.php" class="btn"
                >Ve nuestros productos!
                <i class="fa fa-shopping-bag" aria-hidden="true"></i
              ></a>
            </div>
          </div>
        </div>
      </div>
      <div class="row my-5">
        <div class="col-md-4">
          <div class="card" style="width: 18rem;">
            <img class="card-img-top" src="p-2.jpg" alt="Card image cap" />
            <div class="card-body">
              <h5 class="card-title">Bermudas</h5>
              <p class="card-text dummy-desc">
                Ve nuestra increible ropa para baño!
              </p>
              <a href="#" class="btn"
                >Add to Cart
                <i class="fa fa-shopping-bag" aria-hidden="true"></i
              ></a>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card" style="width: 18rem;">
            <img class="card-img-top" src="p-3.jpg" alt="Card image cap" />
            <div class="card-body">
              <h5 class="card-title">Zapatos</h5>
              <p class="card-text dummy-desc">
                
              </p>
              <a href="#" class="btn"
                >Add to Cart
                <i class="fa fa-shopping-bag" aria-hidden="true"></i
              ></a>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card" style="width: 18rem;">
            <img class="card-img-top" src="p-5.jpg" alt="Card image cap" />
            <div class="card-body">
              <h5 class="card-title">Sneakers</h5>
              <p class="card-text dummy-desc">
                Lorem Ipsum is simply dummy text of the printing and typesetting
                industry. Lorem Ipsum has been the industry's standard dummy
                text ever since the 1500s, when an unknown printer took a galley
                of type and scrambled it to make a type specimen book.
              </p>
              <a href="#" class="btn"
                >Add to Cart
                <i class="fa fa-shopping-bag" aria-hidden="true"></i
              ></a>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- sale -->
    <div class="container-fluid text-center my-5">
      <div class="row sale-section">
        <div class="col-md align-self-center">
          <h2>Enjoy a Big Sale!</h2>
          <h5>50% off on entire stock</h5>
          <div class="button my-4">
            <button type="button" class="btn">
              Shop Now <i class="fa fa-shopping-bag" aria-hidden="true"></i>
            </button>
          </div>
        </div>
      </div>
    </div>
    <!-- new arrival -->
    <div class="container my-5 text-center">
      <h2 class="custom-title my-5">New Arrival</h2>

      <div class="row grid-1">
        <div class="col-12 col-md-8 col-sm-6 col-xs-4 grid grid-1-1">
          <div class="button align-items-center">
            <div class="row align-items-center">
              <div class="col-md">
                <h3 class="title">sjakgdask</h3>
                <button type="button" class="btn">
                  Shop Now <i class="fa fa-shopping-bag" aria-hidden="true"></i>
                </button>
              </div>
            </div>
          </div>
        </div>
        <div class="col-6 col-md-4 col-sm-2 col-xs grid grid-1-2">
          <div class="button">
            <button type="button" class="btn align-self-center">
              Shop Now <i class="fa fa-shopping-bag" aria-hidden="true"></i>
            </button>
          </div>
        </div>
      </div>

      <div class="row grid-2">
        <div class="col-6 col-md-4 grid grid-2-1">
          <div class="button">
            <button type="button" class="btn align-self-center">
              Shop Now <i class="fa fa-shopping-bag" aria-hidden="true"></i>
            </button>
          </div>
        </div>
        <div class="col-6 col-md-4 grid grid-2-2">
          <div class="button">
            <button type="button" class="btn align-self-center">
              Shop Now <i class="fa fa-shopping-bag" aria-hidden="true"></i>
            </button>
          </div>
        </div>
        <div class="col-6 col-md-4 grid grid-2-3">
          <div class="button">
            <button type="button" class="btn align-self-center">
              Shop Now <i class="fa fa-shopping-bag" aria-hidden="true"></i>
            </button>
          </div>
        </div>
      </div>
      <div class="row grid-3">
        <div class="col-6 grid grid-3-1">
          <div class="button">
            <button type="button" class="btn align-self-center">
              Shop Now <i class="fa fa-shopping-bag" aria-hidden="true"></i>
            </button>
          </div>
        </div>
        <div class="col-6 grid grid-3-2">
          <div class="button">
            <button type="button" class="btn align-self-center">
              Shop Now <i class="fa fa-shopping-bag" aria-hidden="true"></i>
            </button>
          </div>
        </div>
      </div>
    </div>
    <!-- carousel -->

    <!-- footer -->
    <footer class="footer">
      <div class="container">
        <div class="row">
          <div class="col-md-3 footer-widget one">
            <strong class="logo">Fashion</strong>
            <div class="row">
              <div class="col-md">
                <p class="dummy-desc">
                  Disfruta de nuestras ofertas este 2023, con nuevos y mejores productos para dama!
                </p>
              </div>
            </div>
          </div>
          <div class="col-md-3 footer-widget two">
            <h5>Categories</h5>
            <ul>
              <li>Sale</li>
              <li>Shoes</li>
              <li>Ladies Bags</li>
              <li>Summer Collections</li>
              <li>Men Collection</li>
              <li>Women Collection</li>
            </ul>
          </div>
          <div class="col-md-3 footer-widget three">
            <h5>Folow Us on Social Media</h5>
            <div class="row"></div>
            <div class="social-icons col-md">
              <a href="#" class="fa fa-facebook"></a>
              <a href="#" class="fa fa-twitter"></a>
              <a href="#" class="fa fa-google"></a>
              <a href="#" class="fa fa-linkedin"></a>
              <a href="#" class="fa fa-youtube"></a>
              <a href="#" class="fa fa-instagram"></a>
            </div>
          </div>
          <div class="col-md-3 footer-widget four">
            <h5>What's New</h5>
            <div class="news">
              <div></div>
              <div class="media my-2">
                <img
                  src="banner1.jpg"
                  class="mx-2"
                  height="64px"
                  width="64px"
                  alt="..."
                />
                <div class="media-body">
                  Cras sit amet nibh libero, in gravida nulla.
                </div>
              </div>
              <div class="media">
                <img
                  src="banner2.jpg"
                  class="mx-2"
                  height="64px"
                  width="64px"
                  alt="..."
                />
                <div class="media-body">
                  Cras sit amet nibh libero, in gravida nulla.
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </footer>
    <div class="copyright text-center">
      <span class="text-center"
        >Copyright <i class="fa fa-copyright" aria-hidden="true"></i> 2020 |
        Developed By <b> Umar Mughal</b></span>
    </div>
    <script> href="../js_b/bootstrap.bundle.js"</script>
  </body>
</html>
