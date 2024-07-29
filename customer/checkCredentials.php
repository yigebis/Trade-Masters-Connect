<?php 

require('../connection/createConn.php');

session_start();

if (!isset($_COOKIE["cust_session_id"])){
        header('Location: ../prepages/login.php');
        exit;
    }
else{
    $curr_cust_session_id = $_COOKIE["cust_session_id"];
    $checkSessionQuery = "select * from login_customer where session_id = '$curr_cust_session_id'";
    $checkSessionResult = $conn -> query($checkSessionQuery);

    if ($checkSessionResult -> num_rows < 1){
        header('Location: ../prepages/login.php');
        exit;
    }
    else{
        $checkSessionRow = $checkSessionResult -> fetch_assoc();
        $username = $checkSessionRow["username"];
    }
}

?>