<?php
    include('../../backend/db.php');

    session_start();
    if (empty($_SESSION['active'])) {
        header('location: ../../');
    }

    $cuil = $_SESSION["cuil"];

    $num = 1;
    while ($num <= 9) {
        
        $query= "SELECT COUNT(*) FROM `diagnosticos` WHERE diagnostico = $num;";
        $result= mysqli_query($conn, $query);
    
        if (!$result) {
            die("Query error");
        }
    
        while($row = mysqli_fetch_array($result)){
            $json[] = $row['COUNT(*)'];
    
        }
        $num = $num + 1;
    }


    $jsonstring = json_encode($json);
    echo ($jsonstring);
   
?>