<?php


    session_start();
    if (empty($_SESSION['active'])) {
        header('location: ../');
    }

    include("../backend/db.php");
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <?php
      include("../includes/head.php");
      ?>
    <link rel="stylesheet" href="css/style.css">
    <link href="../img/logo/logo_KLg_icon.ico" />
    <title>Sagitario</title>
   </head>
<body>
  <?php if($_SESSION["alta"] == 0){ ?>
    <style>
      body{
        background-image: url("../img/fondo.jpg");
        background-size: cover;
      }
    </style>
    <a href="../backend/signout.php" class="btn btn-primary">Salir</a>
    <div class="container my-cont">
      <div class="row my-row">
        <div class="col s12">
          <h1 class="advice">¡Espera!</h1>
          <h3 class="advice">Tu cuenta aun no a sido dada de alta. Aguarda a que el administrador compruebe tus datos</h3>
          </div>
      </div>
    </div>
  <?php }else{ ?>
    <div class="all-content row">
      <div class="sidebar">
        <i class='bx bx-menu menu-icon' id="open-sidebar"></i>
        <a href="#" class="home">
          <i class="home"><img src="../img/logo/logo.png" alt="">
          <p>Sagitario</p>
          </i>
        </a>
        <?php if($_SESSION["rol"] != 1){ ?>
        <a <?php if($_SESSION["rol"] == 2){ ?> href="diario/" <?php } ?>
           <?php if($_SESSION["rol"] == 3){ ?> href="midiario/" <?php } ?> 
           class="diario">
          <i class='bx bx-book-heart diario-icon'>
            <p class="diario-text ">Diario</p>
          </i>
        </a>
        <a <?php if($_SESSION["rol"] == 2){ ?> href="historial/" <?php } ?>
           <?php if($_SESSION["rol"] == 3){ ?> href="mihistorial/" <?php } ?> class="historial">
          <i class='bx bx-history historial-icon'>
            <p class="historial-text ">Historial</p>
          </i>
        </a>
        <a <?php if($_SESSION["rol"] == 2){ ?> href="evolucion/" <?php } ?>
           <?php if($_SESSION["rol"] == 3){ ?> href="mievolucion/" <?php } ?> class="evolucion">
          <i class='bx bx-line-chart evolucion-icon'>
            <p class="evolucion-text ">Evolucion</p>
          </i>
        </a>
        <?php if($_SESSION["rol"] == 2){ ?>
          <a href="diagnosticar/" class="diagnosticar">
            <i class='bx bx-spreadsheet diagnosticar-icon'>
              <p class="diagnosticar-text ">Diagnosticar</p>
            </i>
          </a> 
          <style>
            .sidebar .diagnosticar {
                top: 230px;
            }

            .sidebar .notificaciones {
                top: 280px;
            }
            .sidebar .estadistica {
                top: 330px;
            }

          </style>
        <?php } ?>

        <a href="notificaciones/" class="notificaciones">
          <i class='bx bx-bell notificaciones-icon'>
            <p class="notificaciones-text ">Notificaciones</p>
          </i>
        </a> 
        <a href="estadistica/" class="estadistica">
          <i class='bx bx-pie-chart-alt-2 estadistica-icon'>
            <p class="estadistica-text ">Estadistica</p>
          </i>
        </a> 
        <?php }else{ ?>
          <a href="estadistica/" class="estadistica">
            <i class='bx bx-pie-chart-alt-2 estadistica-icon'>
              <p class="estadistica-text ">Estadistica</p>
            </i>
          </a> 
          <a href="administrar/" class="administrar">
            <i class='bx bx-user administrar-icon'>
              <p class="administrar-text ">Administrar</p>
            </i>
          </a>
          <style>
            .sidebar .administrar {
              top: 80px;
            }
            .sidebar .estadistica {
                top: 130px;
            }

          </style>
        <?php } ?>
        
        <span></span>
        <a href="../backend/signout.php" class="salir">
          <i class='bx bx-door-open salir-icon'>
            <p class="salir-text ">Salir</p>
          </i>
        </a>
      </div>

      <div class="home-content">
        <div class="parallax-container">
          <div class="parallax">
            <img src="img/parallax1.jpg">
          </div>
        </div>
        <div class="section white">
          <div class="container">
            <div class="row">
              <div class="col-lg-4 col-md-6 col-sm-12">
                <div class="card-panel">
                  <span class="black-text">
                    <a href="explicaciones/" style="color:black;">
                      <i class="bx bx-book-heart"></i>
                    </a>
                    <p>Aprende como y cuando usar el Diario para comunicarte con tu doctor</p>
                  </span>
                </div>
              </div>
              <div class="col-lg-4 col-md-6 col-sm-12">
                <div class="card-panel">
                  <span class="black-text">
                    <a href="explicaciones/" style="color:black;">
                      <i class="bx bx-history"></i>
                    </a>
                    <p>Aprende para que sirve y como funciona el Historial de citas</p>
                  </span>
                </div>
              </div>
              <div class="col-lg-4 col-md-12 col-sm-12">
                <div class="card-panel">
                  <span class="black-text">
                    <a href="explicaciones/" style="color:black;">
                      <i class="bx bx-line-chart"></i>
                    </a>
                    <p>Aprende como tu doctor controla tu Evolución medica atravéz del tiempo</p>
                  </span>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="parallax-container">
          <div class="parallax">
            <img src="img/parallax2.jpg">
          </div>
        </div>
        <div class="section black">
          <footer class="page-footer">
            <div class="container">
              <div class="row">
                <div class="col l6 s12">
                  <h5 class="white-text">Más Información</h5>
                  <a href="informacion/">
                    <p class="text-lighten-4">Información sobre el proyecto destinado a las Olimpiadas de Programación, Informatica y Computación 2021</p>
                  </a>
                </div>
                <div class="col l4 offset-l2 s12">
                  <h5 class="white-text">Contactanos</h5>
                  <ul>
                    <li style="display: inline-block;">
                      <a class="grey-text text-lighten-3" href="https://www.facebook.com/" style="text-decoration: none;">
                        <i class='bx bxl-facebook-square' style="font-size: 30px;"></i>
                        <p style="display:inline-block; font: size 20px;">Clínica Sagitario</p>
                      </a>
                    </li>
                    <li style="display: inline-block;">
                      <a class="grey-text text-lighten-3" href="https://www.instagram.com/" style="text-decoration: none;">
                        <i class='bx bxl-instagram' style="font-size: 30px;"></i>
                        <p style="display:inline-block; font: size 20px;">@sagitario.esalud</p>
                      </a>
                    </li>
                    <li style="display: inline-block;">
                      <a class="grey-text text-lighten-3" href="https://www.linkedin.com/" style="text-decoration: none;">
                        <i class='bx bxl-linkedin-square' style="font-size: 30px;"></i>
                        <p style="display:inline-block; font: size 20px;">Clínica Sagitario</p>
                      </a>
                    </li>
                    <li style="display: inline-block;">
                      <a class="grey-text text-lighten-3" href="#!" style="text-decoration: none;">
                        <i class='bx bxl-whatsapp' style="font-size: 30px;"></i>
                        <p style="display:inline-block; font: size 20px;">+54 3518765432</p>
                      </a>
                    </li>
                    <li style="display: inline-block;">
                      <a class="grey-text text-lighten-3" href="#!" style="text-decoration: none;">
                        <i class='bx bx-envelope' style="font-size: 30px;"></i>
                        <p style="display:inline-block; font: size 20px;">clinicasagitario@consultas.com</p>
                      </a>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
            <div class="footer-copyright">
              <div class="container">
              © 2021 Copyright | IPET N°57 Comodoro Martin Rivadavia | 7° Programación
              <a class="grey-text text-lighten-4 right" href="https://ipet57.edu.ar/">IPET 57</a>
              </div>
            </div>
          </footer>
        </div>
    </div>
    <?php } ?>

  <?php
    include("../includes/script.php");
   ?>
  <script src="js/sidebar.js"></script>
  <script src="js/paralla.js"></script>

</body>
</html>
