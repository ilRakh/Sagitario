<?php

  include('../../backend/db.php');

  session_start();
  if (empty($_SESSION['active'])) {
      header('location: ../../');
  }
  
  $cuil_doctor = $_SESSION["cuil"];

  $query = "SELECT * FROM usuarios WHERE rol = 2 AND alta = 0 OR rol = 3 AND alta = 0";
  $result = mysqli_query($conn, $query);
  if(!$result) {
    die('Query Failed'. mysqli_error($conn));
  }

  $json = array();
  while($row = mysqli_fetch_array($result)) {
    $json[] = array(
      // De la tabla usuarios
      'nombre' => $row['nombre'],
      'apellido' => $row['apellido'],
      'cuil' => $row['cuil'],
      'correo' => $row['correo'],
      'rol' => $row['rol'],
      'alta' => $row['alta'],
      'id_user' => $row['id_user'],
    );
  }
  $jsonstring = json_encode($json);
  echo $jsonstring;
?>