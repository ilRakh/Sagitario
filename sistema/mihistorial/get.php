<?php
    include('../../backend/db.php');

    session_start();
    if (empty($_SESSION['active'])) {
        header('location: ../../');
    }

    $cuil = $_SESSION["cuil"];

    $query= "SELECT * FROM asignacion WHERE cuil_paciente = '$cuil'";
    $result= mysqli_query($conn, $query);

    if (!$result) {
        die("Query error");
    }

    $json = array();
    while($row = mysqli_fetch_array($result)){
        $json[] = array(
            'cuil_paciente' => $row['cuil_paciente'],
            'cuil_doctor' => $row['cuil_doctor']

        );
    }

    $jsonstring = json_encode($json);
    echo ($jsonstring);
?>