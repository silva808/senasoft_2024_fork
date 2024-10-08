<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- link css y icons bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- link jquery y ajax -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- link css de la pagina -->
    <link rel="stylesheet" href="./styles/index.css">
    <!-- link de google fonts buenard -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Buenard:wght@400;700&display=swap" rel="stylesheet">

    <title>Document</title>
</head>
<body>
    <header class="container-fluid custom-bg-header">
        <!-- barra de navagación -->
                <nav class="navbar navbar-expand-lg pt-3">
                    <div class="container-fluid  px-lg-5 p-0">
                    <a class="navbar-brand" href="#">
                        <img src="./assets/logo.png" alt="imagen" class="img-fluid custom-logo">
                        SenaBike</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#nav-header" aria-controls="nav-header" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-end" id="nav-header">
                        <div class="navbar-nav align-items-center">
                        <a class="nav-link me-lg-5 me-0 border-lg-0 ps-3 active" aria-current="page" href="#">Bicicletas</a>
                        <a class="nav-link me-lg-5 me-0 border-lg-0  ps-3" href="#">Quienes somos</a>
                        <a class="nav-link me-lg-5  me-0  border-lg-0 ps-3" href="#">Eventos</a>
                        <a href="./templates/login.html" class="nav-link me-lg-5 me-0 px-3 custom-btn-sesion">Inicio Sesión </a>
                        <!-- <button type="button" class="nav-link me-lg-5 me-0 px-3 custom-btn-sesion" data-bs-toggle="modal" data-bs-target="#loginModal">Inicio Sesión </button> -->
                        </div>
                    </div>
                    </div>
                </nav>

        <!-- Seccion de bienvenida  -->
                <div class="container-fluid text-white pt-3">
                    <div class="row">
                        <!-- <div class="col-lg-1">
                        </div> -->
                        <div class="col-lg-6 col-12 text-lg-start text-center ms-lg-5 ms-0">
                            <img src="./assets/exs.png" alt="Imagen" class="img-fluid custom-size-exs d-lg-flex d-none pt-lg-5"></img>
                            <h1 class="pe-lg-2 pe-0 custom-welcome">BIENVENIDO A SENABIKE, POR UN PLANETA MAS ECOLOGICO </h1>
                            <p class="custom-description-header">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Velit consequatur molestiae quaerat laborum ea maiores vel ipsum itaque omnis exercitationem!</p>
                            <button type="button" class="custom-btn-registrarse px-4 py-2">Registrarse</button>
                            <img src="./assets/exs.png" alt="Imagen" class="img-fluid custom-size-exs ms-lg-5 ms-lg-0 "></img>

                        </div>
                        <div class="col-lg-4 col-12 py-5">
                            <!-- <div class=""> -->
                                <img src="./assets/exs.png" alt="Imagen" class="img-fluid custom-size-exs ms-lg-5 ms-lg-0 "></img>
                            <!-- </div> -->
                            <img src="./assets/bike_awful.png" alt="imagen" srcset="" class="img-fluid px-0 custom-bike">
                        </div>
                        
                    </div>
                    
                </div>
                <!-- <div class="border py-5 border">
                    <div class="custom-bg-orange"></div>
                </div> -->
                
    </header>
    <section class="container-fluid pt-5">
        <h4>Eventos </h4>
        <div class="row">
            <div class="col-lg-4"></div>
            <div class="col-lg-4"></div>
        </div>
    </section>
    <!-- modal login  -->
     <!-- Button trigger modal -->
<!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
    Launch static backdrop modal
  </button>
   -->
  <!--Login Modal -->
  <div class="modal fade" id="login-Modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="login-Modal" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
    
      </div>
    </div>
  </div>
  <script src="js/ajax.js"></script>
  <!-- map -->
    <!-- <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d15932.233037802029!2d-76.51328000000001!3d3.3357824!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1ses-419!2sco!4v1727190457020!5m2!1ses-419!2sco" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe> -->

    <!-- link del cdn js de bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>