<?php

    $conn = mysqli_connect(
        "localhost",
        "root",
        "",
        "sagitario"
    );

    if(!$conn){
        die("Conection Failed");
    }

?>