<?php

  include('../../backend/db.php');
  session_start();
  if (empty($_SESSION['active'])) {
      header('location: ../../');
  }

  $cuil_doctor = $_SESSION["cuil"];

if(isset($_POST['rol'])) {
  $rol = $_POST['rol'];
  $id = $_POST['id'];
  $cuil_paciente = $_POST['cuil_paciente'];
  $query = "UPDATE usuarios SET rol = '$rol', alta = 1 WHERE id_user = '$id'";
  $result = mysqli_query($conn, $query);

  if ($rol == 3) {
    $extra_query = "INSERT INTO asignacion (cuil_paciente, id_paciente) VALUES ('$cuil_paciente', '$id')";
    $extra_query2 = "INSERT INTO notificaciones (texto_noti, cuil_paciente, estado_noti, tipo_noti) VALUES ('Un paciente nuevo requiere de un doctor', '$cuil_paciente', 'En Espera', 2)";
    $extra_result = mysqli_query($conn, $extra_query);
    $extra_result2 = mysqli_query($conn, $extra_query2);
    if (!$extra_result || !$extra_result2) {
      die('Query Failed.');
    }

}

if (!$result) {
  die('Query Failed.');
}

  echo "Rol asignado con exito";
}else{
    echo "A chuparla";
}


?>