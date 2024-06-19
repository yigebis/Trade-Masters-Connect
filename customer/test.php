<?php
    // print_r($_SESSION);
    
    if ($_SERVER['REQUEST_METHOD'] == "POST"){
        $serverName = "localhost";
        $userName = "root";
        $password = "";
        $dbName = "trade masters connect";

        $conn = new mysqli($serverName, $userName, $password, $dbName);

        session_start();
        $custUserName = $_SESSION['username'];
        $techUserName = $_POST['tech-username'];
        $jobTitle = $_POST['job-title'];
        $location = $_POST['address'];
        $desc = $_POST['desc'];
        $date = (new DateTime()) -> format('Y-m-d H:i:s');
        $rating = 0;
        $status = 'Pending';
        
        $sql = "insert into requests values (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn -> prepare($sql);
        $stmt -> bind_param("sssssiss", $techUserName, $custUserName, $jobTitle, $location, $desc, $rating, $date, $status);
        $stmt -> execute();
        // print_r([$jobTitle, $location, $desc, $date, $techUserName]);
        
        header("Location: pending.php");


    }

?>