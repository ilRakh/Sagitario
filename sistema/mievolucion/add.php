<?php

  include('../../backend/db.php');
  session_start();
  if (empty($_SESSION['active'])) {
      header('location: ../../');
  }

  $cuil_doctor = $_SESSION["cuil"];

if(isset($_POST['datos'])) {
  $datos = $_POST['datos'];
  $estado = $_POST['estado'];
  $cuil_paciente = $_POST['cuil_paciente'];
  $id_paciente = $_POST['id_paciente'];
  $query = "INSERT evolucion_paciente (datos_evolucion, estado_paciente, cuil_doctor, cuil_paciente, id_paciente) VALUES ('$datos', '$estado', '$cuil_doctor', '$cuil_paciente', '$id_paciente')";
  $result = mysqli_query($conn, $query);

  if (!$result) {
    die('Query Failed.');
  }

  echo "Datos enviados con exito";
}else{
    echo "A chuparla";
}


?>