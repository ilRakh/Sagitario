<?php

    session_start();
    if (empty($_SESSION['active'])) {
        header('location: ../');
    }

    $cuil_doctor = $_SESSION["cuil"];
    $id_paciente = $_SESSION["id_user"];
    $nombre = $_SESSION["nombre"];
    $apellido = $_SESSION["apellido"];

    include("../../backend/db.php");
    include("../../includes/head.php")



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../img/logo/logo_KLg_icon.ico" />
    <title>Sagitario</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.5.1/chart.min.js" integrity="sha512-Wt1bJGtlnMtGP0dqNFH1xlkLBNpEodaiQ8ZN5JLA5wpc1sUlk/O5uuOMNgvzddzkpvZ9GLyYNa8w2s7rqiTk5Q==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="style.css">
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
            <a <?php if($_SESSION["rol"] == 2){ ?> href="" <?php } ?>
                <?php if($_SESSION["rol"] == 3){ ?> href="" <?php } ?> class="evolucion">
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
    </div>
        <div class="home-content container">
            <div class="contenedor-estadistica">
                <div class="row">
                    <div class="col-md-2">
                        <div class="my-card" style="height: 500px">
                            <div class="card-body text-center">
                                <i class='bx bxs-user-rectangle' style="font-size:80px; color:rgb(128, 200, 248);"></i>
                                <h5 class="card-title"><?php echo $nombre ?> <br> <?php echo $apellido ?></h5>
                                <div class="btn-flex">
                                    <div class="btn-fin">
                                        <button id="btn-diario" class="btn-diario">
                                        <a  <?php if($_SESSION["rol"] == 2){ ?> href="../diario/" <?php } ?>
                                            <?php if($_SESSION["rol"] == 3){ ?> href="../midiario/" <?php } ?>>
                                            <strong>Diario del pasiente</strong>
                                            <br>
                                            <i class='bx bxs-book-heart' style="font-size: 30px"></i>
                                        </a>
                                    </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-10">
                            <canvas id="myChart" width="70" height="40"></canvas>
                    </div>
                    <input type="hidden" id="id_paciente">
                </div>
            </div>
        </div>


    <?php include("../../includes/script.php") ?>
    <script>
        $("#id_paciente").val(<?php echo $id_paciente ?>)
    </script>
    <script src="sidebar.js"></script>
    <script src="chart.js"></script>
</body>
</html>