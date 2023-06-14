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
      <h1>Notificaciones</h1>
      <div class="notis">

      </div>
    </div>

  </div>
    

  <?php
    include("../../includes/script.php");
   ?>
  <script src="sidebar.js"></script>
  <script src="ajax.js"></script>
</body>
</html>
