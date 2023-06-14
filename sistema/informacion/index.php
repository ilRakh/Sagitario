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
                <h2>Motivación y Justificación del Proyecto:</h2>
              </div>
            </div>
            <div class="row">
              <div class="col col-sm-12">
                <p>Dada la situación causada por el virus SARS-COV-2, donde enfermedades muy importantes y graves han sido desplazadas casi que a un segundo plano, se ha decidido relevar el estado de salud de la población en base al COVID-19 y todas las prevenciones que el Estado, habitualmente hace y tuvo que suspender para poder atender esta terrible pandemia. Prevenciones del tipo toma de talla y peso de la población en crecimiento, consultas odontológicas, seguimiento del calendario de vacunación, controles oftalmológicos, cardíacos, etc.</p>
                
              </div>
            </div>
            <div class="row">
              <div class="col col-sm-12">
                <h2>Objetivos del Proyecto:</h2>
              </div>
            </div>
            <div class="row">
              <div class="col col-sm-12">
                <p>El proyecto esta pensado para que sea: </p>
                <ul>
                  <li> <strong>Accesible</strong> para la mayoría de las personas</li>
                  <li><strong>Sencillo</strong> de usar</li>
                  <li><strong>Comunicación</strong> directa entre el paciente y su medico</li>
                  <li><strong>Control</strong> dinámico del los doctores sobre sus pacientes</li>
                </ul>
              </div>
            </div>
            <div class="row">
              <div class="col col-sm-12">
                <h2>Planificación del Proyecto:</h2>
              </div>
            </div>
            <div class="row">
              <div class="col col-sm-12">
                <p>Se conformó un comité social dónde distintos actores de las fuerzas vivas se reúnen y analizan el estado de situación de la comunidad y el impacto que dejaron la ASPO, la DISPO y la cuarentena en sí.
                Luego de largos debates y puestas en común el comité social le confirió a la mesa de expertos informáticos una serie de requerimientos funcionales, parámetros y especificaciones técnicas para que propongan soluciones integrales o segmentada según la expertis de cada grupo
                </p>
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
