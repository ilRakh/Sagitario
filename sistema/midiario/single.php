<?php

include('../../backend/db.php');

if(isset($_POST['id'])) {
  $id = mysqli_real_escape_string($conn, $_POST['id']);


  $query = "SELECT * from diario_paciente AS dp INNER JOIN recomendaciones AS r ON dp.id_diario = {$id} AND r.id_diario = {$id}";

  $result = mysqli_query($conn, $query);
  if(!$result) {
    die('Query Failed'. mysqli_error($conn));
  }

  $json = array();
  while($row = mysqli_fetch_array($result)) {
    $json[] = array(
      'titulo' => $row['title_diario'],
      'texto' => $row['texto_diario'],
      'cuil' => $row['cuil_paciente'],
      'fecha' => $row['fecha_diario'],
      'id_diario' => $row['id_diario'],
      'recomendacion' => $row['recomendacion']

    );
  }
  $jsonstring = json_encode($json[0]);
  echo $jsonstring;
}

?>