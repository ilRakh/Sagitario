<?php
    include('../../backend/db.php');

    session_start();
    if (empty($_SESSION['active'])) {
        header('location: ../../');
    }

    $cuil = $_SESSION["cuil"];

    $query= "SELECT * FROM notificaciones AS n 
    INNER JOIN usuarios AS u 
    ON n.cuil_doctor = '$cuil' AND n.tipo_noti = 1 AND u.cuil = n.cuil_paciente 
    OR n.cuil_doctor = '$cuil' AND n.tipo_noti = 2 AND u.cuil = n.cuil_paciente
    OR n.cuil_doctor = ' ' AND n.tipo_noti = 2 AND u.cuil = n.cuil_paciente
    OR n.cuil_paciente = '$cuil' AND n.tipo_noti = 3 AND u.cuil = n.cuil_paciente";
    $result= mysqli_query($conn, $query);

    if (!$result) {
        die("Query error");
    }

    $json = array();
    while($row = mysqli_fetch_array($result)){
        $json[] = array(
            'id_user' => $row['id_user'],
            'id_noti' => $row['id_noti'],
            'tipo' => $row['tipo_noti'],
            'texto' => $row['texto_noti'],
            'estado' => $row['estado_noti'],
            'cuil_doctor' => $row['cuil_doctor'],
            'cuil_paciente' => $row['cuil_paciente']
        );
    }

    $jsonstring = json_encode($json);
    echo ($jsonstring);
?>