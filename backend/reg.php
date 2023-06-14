<?php

    include('db.php');

 
    if(!empty($_POST)){
        if (empty($_POST['name']) || empty($_POST['apellido']) || empty($_POST['email']) || empty($_POST['cuil']) || empty($_POST['pass'])){
            $alert = "No se permiten campos vacios";
        }else{
            require_once "db.php";
            $nombre = mysqli_real_escape_string($conn, $_POST['name']);
            $apellido = mysqli_real_escape_string($conn, $_POST['apellido']);
            $email = mysqli_real_escape_string($conn, $_POST['email']);
            $cuil = mysqli_real_escape_string($conn, $_POST['cuil']);
            $clave = md5(mysqli_real_escape_string($conn, $_POST['pass']));

            $query = mysqli_query($conn, "SELECT * FROM usuarios WHERE correo= '$email' OR cuil = '$cuil'");
            $result = mysqli_num_rows($query);

            if($result > 0){
                $alert = "Ya tienes una cuenta, ¡logeate!";


            }else{
                $query_load = "INSERT INTO usuarios(nombre, apellido, correo, cuil, clave, rol) VALUES ('$nombre', '$apellido', '$email', '$cuil', '$clave', '3')";
                $result_load = mysqli_query($conn, $query_load);
                if(!$result_load){
                    die('Query Error' . mysqli_error($conn));
                }
                $alert = 'Te has registrado con exito';
            }
        }
    }

    echo $alert

?>