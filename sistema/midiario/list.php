<?php
    include('../../backend/db.php');

    session_start();
    if (empty($_SESSION['active'])) {
        header('location: ../../');
    }

    $cuil = $_SESSION["cuil"];

    $query= "SELECT * FROM diario_paciente WHERE cuil_paciente = '$cuil'";
    $result= mysqli_query($conn, $query);

    if (!$result) {
        die("Query error");
    }

    $json = array();
    while($row = mysqli_fetch_array($result)){
        $json[] = array(
            'title' => $row['title_diario'],
            'textarea' => $row['texto_diario'],
            'fecha' => $row['fecha_diario'],
            'id' => $row['id_diario']

        );
    }

    $jsonstring = json_encode($json);
    echo ($jsonstring);
?>