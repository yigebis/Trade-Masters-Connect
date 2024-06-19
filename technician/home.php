<?php

    session_start();

    if (!isset($_SESSION['username']) || $_SESSION['role'] != 'technician'){
        header('Location: ../prepages/login.php');
        exit;
    }
    $serverName = 'localhost';
    $userName = 'root';
    $password = '';
    $dbName = 'trade masters connect';
    $conn = new mysqli($serverName, $userName, $password, $dbName);

    if (!$conn){
        echo "Connection Failed.";
        exit;
    }

    //array which associates skills with each technician data

    //$technicians = []; //associative array used to store the data from technicians table


    // $sql = "select * from technician_skill";
    // $result = $conn -> query($sql);

    // while ($row = $result -> fetch_assoc()){
    //     $tech_skills[$row['SkillTitle']][] = $row;

    // }

    
?>  


<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Techinician</title>
    <link rel="stylesheet" href="home.css">
</head>
<body>
    <?php
        require('header.php');
    ?>

    <div id="central">
        <?php
            require('technicianNav.php');
        ?>
        <main>

        </main>
    </div>
    

    <?php
        require('../template/footer.php');
    ?>
</body>
</html>