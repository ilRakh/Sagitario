<?php

    include('../../backend/db.php');

    session_start();
    if (empty($_SESSION['active'])) {
        header('location: ../../');
    }

    $cuil = $_SESSION["cuil"];

 
    if(isset($_POST['texto'])){
        $texto = $_POST['texto'];
        $doctor = $_POST['cuil_doctor'];
        $paciente = $_POST['cuil_paciente'];
        $query = "INSERT INTO notificaciones(texto_noti, cuil_doctor, cuil_paciente, estado_noti, tipo_noti) VALUES ('$texto', '$doctor', '$paciente', 'En Espera', 1)";
        $result = mysqli_query($conn, $query);
        if(!$result){
            die('Query Error' . mysqli_error($conn));
        }
        echo 'Solicitud enviada con exito';
    }else{
        echo "hola";
    }


?>