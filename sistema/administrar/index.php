<?php


    session_start();
    if (empty($_SESSION['active'])) {
        header('location: ../../');
    }else{
      if ($_SESSION['alta'] == 0) {
        header('location: ../');
      }
    }

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

        <div class="home-content">
            <a href="#" id="news"><i class='bx bxs-grid' ></i>Ver Nuevos</a>
            <a href="#" id="all"><i class='bx bx-grid-small'></i>Ver Todos</a>
            <table class="table table-hover" id="lista-all">
                <thead>
                    <tr>
                        <td>Nombre</td>
                        <td>Apellido</td>
                        <td>Correo</td>
                        <td>Cuil</td>
                        <td>Rol</td>
                        <td>Alta</td>
                    </tr>
                </thead>
                <tbody id="pacientes-all">
                    
                </tbody>
            </table>
            <table class="table table-hover" id="lista-news">
                <thead>
                    <tr>
                        <td>Nombre</td>
                        <td>Apellido</td>
                        <td>Correo</td>
                        <td>Cuil</td>
                        <td>Rol</td>
                        <td>Alta</td>
                    </tr>
                </thead>
                <tbody id="pacientes-news">
                    
                </tbody>
            </table>
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-sm">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Dar de Alta</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="form" method="post" action="">
                                <select name="rol" id="rol" >
                                  <option value="" selected>Seleccione el rol</option>
                                  <?php 
                                    $query = "SELECT * FROM roles WHERE id_rol != 1";
                                    $result = mysqli_query($conn, $query);

                                    while($row = mysqli_fetch_array($result)){
                                  ?>
                                  <option value="<?php echo $row['id_rol']; ?>"><?php echo $row['rol'];?></option>
                                  <?php } ?>
                                </select>
                                <input type="hidden" id="id_user">
                                <input type="hidden" id="cuil">
                                <button type="submit" class="btn btn-primary">Guardar</button>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    

  <?php
    include("../../includes/script.php");
   ?>
  <script src="sidebar.js"></script>
  <script src="modal.js"></script>
  <script src="ajax.js"></script>
</body>
</html>
