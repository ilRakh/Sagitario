<?php

include('../../backend/db.php');

if(isset($_POST['id'])) {
  $id = mysqli_real_escape_string($conn, $_POST['id']);

  $query = "SELECT * from diario_paciente AS dp INNER JOIN usuarios AS u ON dp.id_paciente = {$id} AND  u.id_user = {$id} ORDER BY id_diario DESC LIMIT 1";

  $result = mysqli_query($conn, $query);
  if(!$result) {
    die('Query Failed'. mysqli_error($conn));
  }

  $json = array();
  while($row = mysqli_fetch_array($result)) {
    $json[] = array(
      'nombre' => $row['nombre'],
      'apellido' => $row['apellido'],
      'titulo' => $row['title_diario'],
      'texto' => $row['texto_diario'],
      'cuil' => $row['cuil_paciente'],
      'fecha' => $row['fecha_diario'],
      'id_paciente' => $row['id_paciente'],
      'id_diario' => $row['id_diario']

    );
  }
  $jsonstring = json_encode($json[0]);
  echo $jsonstring;
}

?>