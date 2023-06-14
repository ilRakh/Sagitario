<?php

  include('../../backend/db.php');

  session_start();
  if (empty($_SESSION['active'])) {
      header('location: ../../');
  }
  
  $cuil_doctor = $_SESSION["cuil"];

  $query = "SELECT * FROM usuarios AS u 
            INNER JOIN asignacion as a
            ON a.cuil_doctor = '$cuil_doctor'
            AND u.cuil = a.cuil_paciente
            AND u.rol = 3";
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
      'id_user' => $row['id_user'],
    );
  }
  $jsonstring = json_encode($json);
  echo $jsonstring;
?>