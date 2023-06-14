<?php

  include('../../backend/db.php');

  session_start();
  if (empty($_SESSION['active'])) {
      header('location: ../../');
  }
  
  $cuil_doctor = $_SESSION["cuil"];
  $id_paciente = $_POST["id_paciente"];

  $query = "SELECT COUNT(*) FROM `evolucion_paciente` WHERE id_paciente = '$id_paciente'";
  $result = mysqli_query($conn, $query);
  if(!$result) {
    die('Query Failed'. mysqli_error($conn));
  }

  $json = array();
  while($row = mysqli_fetch_array($result)) {
    $json[] = array(
      'index' => $row['COUNT(*)']

    );
  }
  $jsonstring = json_encode($json);
  echo $jsonstring;
?>