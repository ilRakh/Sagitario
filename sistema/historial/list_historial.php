<?php

  include('../../backend/db.php');

  session_start();
  if (empty($_SESSION['active'])) {
      header('location: ../../');
  }
  
  $cuil_doctor = $_SESSION["cuil"];

  $id_paciente = $_POST['id_paciente'];

  $query = "SELECT * FROM historial_citas WHERE id_paciente = '$id_paciente' ORDER BY id_historial DESC";
  $result = mysqli_query($conn, $query);
  if(!$result) {
    die('Query Failed'. mysqli_error($conn));
  }

  $json = array();
  while($row = mysqli_fetch_array($result)) {
    $json[] = array(
      // De la tabla historial
      'id_historial' => $row['id_historial'],
      'razon' => $row['razon_cita'],
      'conclusion' => $row['conclusion_cita'],
      'estado' => $row['estado_paciente'],
      'fecha' => $row['fecha_cita'],
      'cuil_doctor' => $row['cuil_doctor'],
      'cuil_paciente' => $row['cuil_paciente'],
      'id_paciente' => $row['id_paciente']
    );
  }
  $jsonstring = json_encode($json);
  echo $jsonstring;
?>