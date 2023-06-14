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
                <?php if($_SESSION["rol"] == 3){ ?> href="midiario/" <?php } ?> 
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
            <div class="row">
                <div class="col col-md-9">
                    <table class="table table-hover" id="lista-pacientes">
                        <tbody id="pacientes">
                            
                        </tbody>
                    </table>
                    
                
                    <div id="modal-container">
                        <div class="modal fade" id="exampleModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="diarioTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-scrollable modal-lg modal-sm">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="diarioTitle">Diagnosticar</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="" id="answerForm" method="post">
                                            <input type="text" name="answer" class="answer" id="diagnostico" placeholder="Ingresa el numero referente al diagnostico"></input>
                                            <input type="hidden" name="answer" class="answer" id="enfermedad" placeholder="Ingresa el diagnostico"></input>
                                            <br>
                                            <input type="hidden" id="id">
                                            <input type="hidden" id="cuil">
                                            <button type="submit" id="sendAnswer" name="sendAnswer" class="btn btn-primary">Enviar</button>
                                            <input type="hidden" id="cuilPaciente">
                                            <input type="hidden" id="idDiario">
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col col-md-3">
                    <ul>
                        <?php 
                            $query= "SELECT * FROM enfermedades" ;
                            $result = mysqli_query($conn, $query);
                            while ($row = mysqli_fetch_array($result)) {
                        ?>
                        <li><?php echo $row['id_enfermedad'] ?>: <?php echo $row['enfermedad'] ?></li>
                        <?php } ?>
                    </ul>
                </div>
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