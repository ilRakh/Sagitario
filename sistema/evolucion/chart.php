<?php

    include("../../backend/db.php");
        
    if(empty($_POST['num'])){
        $num = $_POST['num'];   
        $id = $_POST['id'];
        $query= "UPDATE usuarios SET num = '$num' WHERE id = '$id'";
        $result = mysqli_query($conn, $query);

        if (!$result) {
            die('query error');
        }

        $query_datos = "SELECT * FROM usuarios WHERE id = '$id'";
        $result_datos = mysqli_query($conn, $query_datos);

        if (!$result_datos) {
            die("Query fail");
        }


        $json = array();
        while($row = mysqli_fetch_array($result_datos)){
            $json[] = array(
                'num' => $row['num']
            );
        }
        
        $jsonstring = json_encode($json);
        echo ($jsonstring);
    }

?>