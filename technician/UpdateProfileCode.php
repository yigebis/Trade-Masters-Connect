<?php

    // require("../checkCredentials.php");

    $techStatusQuery = "SELECT * from technician where UserName = '$username';";
    $techStatusResult = $conn -> query($techStatusQuery);
    $techStatusRow = $techStatusResult -> fetch_assoc();

    // print_r($techStatusRow);

    $photoLink = "../PrePages/" . $techStatusRow['Photo'];


    $skillQuery = "SELECT * FROM technician_skill where TechUserName = '$username';";
    $skillResult = $conn -> query($skillQuery);

?>