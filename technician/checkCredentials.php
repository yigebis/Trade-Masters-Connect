<?php 

require("../connection/createConn.php");

session_start();


if (!isset($_COOKIE["tech_session_id"])){
        // echo "cookie";
        header('Location: ../prepages/login.php');
        exit;
    }
else{
    $curr_tech_session_id = $_COOKIE["tech_session_id"];
    $checkSessionQuery = "select * from login_technician where session_id = '$curr_tech_session_id'";
    $checkSessionResult = $conn -> query($checkSessionQuery);

    if ($checkSessionResult -> num_rows < 1){
        // echo "num";
        header('Location: ../prepages/login.php');
        exit;
    }
    else{
        $checkSessionRow = $checkSessionResult -> fetch_assoc();
        $username = $checkSessionRow["username"];
    }
}

?>