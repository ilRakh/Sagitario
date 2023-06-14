<?php
    include("../../backend/db.php");

    session_start();
    if (empty($_SESSION['active'])) {
        header('location: ../../');
    }else{
      if ($_SESSION['alta'] == 0) {
        header('location: ../');
      }
    }

    $cuil = $_SESSION["cuil"];
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <?php
      include("../..//includes/head.php");
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
            <a <?php if($_SESSION["rol"] == 2){ ?> href="#" <?php } ?>
                <?php if($_SESSION["rol"] == 3){ ?> href="#" <?php } ?> class="historial">
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
            <a href="../notificaciones/" class="notificaciones">
                <i class='bx bx-bell notificaciones-icon'>
                <p class="notificaciones-text ">Notificaciones</p>
                </i>
            </a> 
            <a href="../estadistica/" class="estadistica">
          <i class='bx bx-pie-chart-alt-2 estadistica-icon'>
            <p class="estadistica-text ">Estadistica</p>
          </i>
        </a> 
            
            <span></span>
            <a href="../../backend/signout.php" class="salir">
                <i class='bx bx-door-open salir-icon'>
                <p class="salir-text ">Salir</p>
                </i>
            </a>
        </div>

        <div class="home-content container">
            <form id="form">
                <button type="submit" class="btn-floating btn-large waves-effect waves-light blue" data-bs-toggle="tooltip" data-bs-placement="right" title="Solicitar una cita" name="solicitar" id="solicitar">
                <i class="material-icons">add</i>
                </button>
                <input type="hidden" id="cuilPaciente">
                <input type="hidden" id="cuilDoctor">
            </form>
            
            <h3>Historial de Citas</h4>
            <table class="table table-hover" id="historial-paciente">
                <thead>
                    <tr>
                        <th scope="col">Fecha</th>
                        <th scope="col">Razon</th>
                        <th scope="col">Conclusion</th>
                        <th scope="col">Estado del Paciente</th>
                    </tr>
                </thead>
                <tbody id="historial">
                    
                </tbody>
            </table>
        </div>
    </div>

    <?php
        include("../../includes/script.php");
    ?>
    <script src="sidebar.js"></script>
    <script src="tooltip.js"></script>
    <script src="ajax.js"></script>

</body>
</html>