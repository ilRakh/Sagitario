<?php


    session_start();
    if (empty($_SESSION['active'])) {
        header('location: ../../');
    }else{
      if ($_SESSION['alta'] == 0) {
        header('location: ../');
      }
    }

    $cuil = $_SESSION["cuil"];

    include("../../backend/db.php");
?>
<!DOCTYPE html>
<html lang="en">
  <head>

    <?php
      include("../../includes/head.php");
    ?>
    <link rel="stylesheet" href="style.css">
    <link href="../img/logo/logo_KLg_icon.ico" />
    <title>Sagitario</title>
   </head>
<body>
    
  <div class="all-content row">
    <div class="sidebar">
      <i class='bx bx-menu menu-icon' id="open-sidebar"></i>
      <a href="../" class="home">
          <i class="home"><img src="../../img/logo/logo.png" alt="">
          <p>Sagitario</p>
          </i>
        </a>
      <?php if($_SESSION["rol"] != 1){ ?>
      <a <?php if($_SESSION["rol"] == 2){ ?> href="../diario/" <?php } ?>
          <?php if($_SESSION["rol"] == 3){ ?> href="../midiario/" <?php } ?> 
          class="diario">
        <i class='bx bx-book-heart diario-icon'>
          <p class="diario-text ">Diario</p>
        </i>
      </a>
      <a <?php if($_SESSION["rol"] == 2){ ?> href="../historial/" <?php } ?>
          <?php if($_SESSION["rol"] == 3){ ?> href="../mihistorial/" <?php } ?> class="historial">
        <i class='bx bx-history historial-icon'>
          <p class="historial-text ">Historial</p>
        </i>
      </a>
      <a <?php if($_SESSION["rol"] == 2){ ?> href="../evolucion/" <?php } ?>
          <?php if($_SESSION["rol"] == 3){ ?> href="../mievolucion/" <?php } ?> class="evolucion">
        <i class='bx bx-line-chart evolucion-icon'>
          <p class="evolucion-text ">Evolucion</p>
        </i>
      </a>
      <?php if($_SESSION["rol"] == 2){ ?>
          <a href="../diagnosticar/" class="diagnosticar">
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
      <a href="#" class="notificaciones">
        <i class='bx bx-bell notificaciones-icon'>
          <p class="notificaciones-text ">Notificaciones</p>
        </i>
      </a> 
      <a href="../estadistica/" class="estadistica">
          <i class='bx bx-pie-chart-alt-2 estadistica-icon'>
            <p class="estadistica-text ">Estadistica</p>
          </i>
        </a> 
      <?php }else{ ?>
        <a href="../administrar/" class="administrar">
          <i class='bx bx-user administrar-icon'>
            <p class="administrar-text ">Administrar</p>
          </i>
        </a>
        <style>
          .sidebar .administrar {
            top: 80px;
          }

        </style>
      <?php } ?>
      
      <span></span>
      <a href="../../backend/signout.php" class="salir">
        <i class='bx bx-door-open salir-icon'>
          <p class="salir-text ">Salir</p>
        </i>
      </a>
    </div>

    <div class="home-content">
          <div class="container">
            <div class="row">
              <div class="col col-sm-12">
                <h2>Sección Diario:</h2>
              </div>
            </div>
            <div class="row">
              <div class="col col-sm-12">
                <p>El diario es un sección donde podra escribir que es lo que te sucede, ya se comúnmente o a lo largo de un tratamiento medico, siempre y cuando tenga que ver con tu salud.
                En esta sección recibirás respuestas de tu doctor designado atravéz de recomendaciones. Estas servirán para tener una comunicación y control de tu salud a distancia</p>
                
              </div>
            </div>
            <div class="row">
              <div class="col col-sm-12">
                <h2>Sección Historial:</h2>
              </div>
            </div>
            <div class="row">
              <div class="col col-sm-12">
                <p>En esta sección podras ver todo tu historial de citas a lo largo del tiempo. Podras solicitar una cita a tu médico, ya sea por decición propia o recomendación del mismo, y este decidirá si rechazarla o aceptarla. Cada vez que tu doctor responda a una solicitud de cita se te enviara un mensaje a la sección de notificaciones donde podras ver si tu solicitud fue aceptada o rechazada.</p>
                
              </div>
            </div>
            <div class="row">
              <div class="col col-sm-12">
                <h2>Sección Evolución:</h2>
              </div>
            </div>
            <div class="row">
              <div class="col col-sm-12">
                <p>En la sección de evolución se mostrara en forma de grafico como fue tu seguimiento a lo largo del tiempo o de algún tratamiento. Los datos de este grafico se registran por meses hasta finalizar el año.</p>
                
              </div>
            </div>
          </div>
    </div>

  </div>
    

  <?php
    include("../../includes/script.php");
   ?>
  <script src="sidebar.js"></script>
  <script src="scrollspy.js"></script>
  <script src="ajax.js"></script>
</body>
</html>
