<?php

  include('../../backend/db.php');
  session_start();
  if (empty($_SESSION['active'])) {
      header('location: ../../');
  }

  $cuil_doctor = $_SESSION["cuil"];

if(isset($_POST['razon'])) {
  $razon = $_POST['razon'];
  $conclusion = $_POST['conclusion'];
  $estado = $_POST['estado'];
  $id = $_POST['id'];
  $query = "UPDATE historial_citas SET razon_cita = '$razon', conclusion_cita = '$conclusion', estado_paciente = '$estado' WHERE id_historial = $id";
  $result = mysqli_query($conn, $query);

  if (!$result) {
    die('Query Failed.');
  }

  echo "Rellenado con exito";
}else{
    echo "A chuparla";
}


?>