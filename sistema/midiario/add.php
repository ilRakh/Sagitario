<?php

    include('../../backend/db.php');

    session_start();
    if (empty($_SESSION['active']) || $_SESSION['rol'] == 2) {
        header('location: ../../');
    }

    $cuil = $_SESSION["cuil"];
    $id = $_SESSION["id_user"];

 
    if(isset($_POST['title'])){
        $title = $_POST['title'];
        $textarea = $_POST['textarea'];
        $query = "INSERT INTO diario_paciente(title_diario, texto_diario, cuil_paciente, id_paciente) VALUES ('$title', '$textarea', '$cuil', '$id')";
        $result = mysqli_query($conn, $query);
        if(!$result){
            die('Query Error' . mysqli_error($conn));
        }
        echo 'Se ha agregado el articulo a tu diario';
    }else{
        echo "hola";
    }



?>