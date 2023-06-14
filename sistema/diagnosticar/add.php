<?php

  include('../../backend/db.php');
  session_start();
  if (empty($_SESSION['active'])) {
      header('location: ../../');
  }

  $cuil_doctor = $_SESSION["cuil"];

if(isset($_POST['diagnostico'])) {
  $diagnostico = $_POST['diagnostico'];
  $id = $_POST['id'];
  $cuil_paciente = $_POST['cuil_paciente'];
  $query = "INSERT INTO diagnosticos(diagnostico, cuil_doctor, cuil_paciente, id_paciente) VALUES ('$diagnostico', '$cuil_doctor', '$cuil_paciente', '$id')";
  $result = mysqli_query($conn, $query);

  if (!$result) {
    die('Query Failed.');
  }

}

echo "Diagnostico enviada con exito"

?>