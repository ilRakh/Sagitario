<?php

  include('../../backend/db.php');
  session_start();
  if (empty($_SESSION['active'])) {
      header('location: ../../');
  }

  $cuil_doctor = $_SESSION["cuil"];

if(isset($_POST['id_paciente'])) {
  $id_paciente = $_POST['id_paciente'];
  $query = "DELETE FROM evolucion_paciente WHERE id_paciente = '$id_paciente'";
  $result = mysqli_query($conn, $query);

  if (!$result) {
    die('Query Failed.');
  }

  echo "Datos Reseteados con exito";
}else{
    echo "A chuparla";
}


?>