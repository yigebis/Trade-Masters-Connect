<?php

    $custStatusQuery = "SELECT * from customer where UserName = '$username';";
    $custStatusResult = $conn -> query($custStatusQuery);
    $custStatusRow = $custStatusResult -> fetch_assoc();

    // print_r($custStatusRow);

    $photoLink = "../PrePages/" . $custStatusRow['Photo Link'];

?>