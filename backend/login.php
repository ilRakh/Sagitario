<?php
    include('db.php');

    $alert= "";
    session_start();
    if(!empty($_SESSION['active'])){
        header('location: sistema/');
    }else{
        if (!empty($_POST)) {
            if (empty($_POST['cuil']) || empty($_POST['pass'])) {
                $alert = "Ingrese un usuario y contraseña";
            }else{
                require_once "db.php";
                $cuil = mysqli_real_escape_string($conn, $_POST["cuil"]);
                $pass = md5(mysqli_real_escape_string($conn, $_POST["pass"]));

                $query = mysqli_query($conn, "SELECT * FROM usuarios WHERE cuil= '$cuil' AND clave= '$pass'");
                mysqli_close($conn);
                $result = mysqli_num_rows($query);

                if($result > 0){
                    $data = mysqli_fetch_array($query);

                    $_SESSION["active"] = true;
                    $_SESSION["id_user"] = $data['id_user'];
                    $_SESSION["cuil"] = $data['cuil'];
                    $_SESSION["nombre"] = $data['nombre'];
                    $_SESSION["apellido"] = $data['apellido'];
                    $_SESSION["email"] = $data['email'];
                    $_SESSION["clave"] = $data['clave'];
                    $_SESSION["rol"] = $data['rol'];
                    $_SESSION["alta"] = $data['alta'];

                    
                    header('location: ../sistema');

                }else{
                    $alert = "Cuil o Contraseña incorrectos";
                    session_destroy();
                }
            }
        }
    }
    echo $alert;
?>