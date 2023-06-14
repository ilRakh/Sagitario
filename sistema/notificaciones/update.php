<?php
    include('../../backend/db.php');

    session_start();
    if (empty($_SESSION['active'])) {
        header('location: ../../');
    }

    $cuil = $_SESSION["cuil"];


    $id= $_POST['id'];
    $id_paciente= $_POST['id_paciente'];
    $estado= $_POST['estado'];


    $query= "UPDATE notificaciones SET estado_noti= '$estado', cuil_doctor = '$cuil' WHERE id_noti = '$id'";
    $result= mysqli_query($conn, $query);
    $extra_query= "UPDATE asignacion SET cuil_doctor= '$cuil' WHERE id_paciente = '$id_paciente'";
    $extra_result= mysqli_query($conn, $extra_query);

    if (!$result || !$extra_result) {
        die("Query error");
    }{
        echo "Respondido con exito" ;
    }
?>