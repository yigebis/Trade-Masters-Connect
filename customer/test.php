<?php
    // print_r($_SESSION);
    
    if ($_SERVER['REQUEST_METHOD'] == "POST"){
        
        require('checkCredentials.php');

        $custUserName = $username;
        $techUserName = $_POST['tech-username'];
        $jobTitle = $_POST['job-title'];
        $location = $_POST['address'];
        $desc = $_POST['desc'];
        $date = (new DateTime()) -> format('Y-m-d H:i:s');
        $rating = 0;
        $status = 'Pending';
        $notSeen = 'N';
        
        $sql = "insert into requests values (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn -> prepare($sql);
        $stmt -> bind_param("sssssissss", $techUserName, $custUserName, $jobTitle, $location, $desc, $rating, $date, $status, $notSeen, $notSeen);
        $stmt -> execute();
        // print_r([$jobTitle, $location, $desc, $date, $techUserName]);
        
        header("Location: pending.php");


    }

?>