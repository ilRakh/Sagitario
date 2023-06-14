<?php
    include('../../backend/db.php');

    session_start();
    if (empty($_SESSION['active'])) {
        header('location: ../../');
    }

    $cuil = $_SESSION["cuil"];
    $id_paciente= $_POST['id_paciente'];
    $cuil_paciente= $_POST['cuil_paciente'];
    $estado= $_POST['estado'];
    $tipo= $_POST['tipo'];
    $tipo2= $_POST['tipo2'];
    $texto= $_POST['texto'];

    $query= "INSERT INTO notificaciones (texto_noti, cuil_doctor, cuil_paciente, estado_noti, tipo_noti) VALUES ('$texto', '$cuil', '$cuil_paciente', '$estado', '$tipo')";
    $result= mysqli_query($conn, $query);

    if ($estado == "Aceptada" && $tipo2 == 1) {
        $query_historial= "INSERT INTO `historial_citas` (`id_historial`, `razon_cita`, `conclusion_cita`, `estado_paciente`, `fecha_cita`, `cuil_doctor`, `cuil_paciente`, `id_paciente` ) VALUES (NULL, '', '', '', current_timestamp(), '$cuil', '$cuil_paciente', '$id_paciente')";
        $result_historial= mysqli_query($conn, $query_historial);
        
        if (!$result || !$result_historial) {
            die("Query error");
        }{
            echo "Notificado con exito" ;
        }
    }

    

?>