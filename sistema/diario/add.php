<?php

  include('../../backend/db.php');
  session_start();
  if (empty($_SESSION['active'])) {
      header('location: ../../');
  }

  $cuil_doctor = $_SESSION["cuil"];

if(isset($_POST['answer'])) {
  $answer = $_POST['answer'];
  $cuilPaciente = $_POST['cuilPaciente'];
  $idDiario = $_POST['idDiario'];
  $query = "INSERT into recomendaciones(recomendacion, cuil_paciente, cuil_doctor, id_diario) VALUES ('$answer', '$cuilPaciente', '$cuil_doctor', '$idDiario')";
  $result = mysqli_query($conn, $query);

  if (!$result) {
    die('Query Failed.');
  }

}

echo "Respuesta enviada con exito"

?>