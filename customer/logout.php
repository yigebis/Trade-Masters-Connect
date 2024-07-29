<?php 
    require('checkCredentials.php');

    $cookie_name = "cust_session_id";

    setcookie($cookie_name, "", time() - (86400 * 30), "/");
    $logoutQuery = "delete from login_customer where session_id = ?";
    $logoutStmt = $conn -> prepare($logoutQuery);
    $logoutStmt -> bind_param("s", $curr_cust_session_id);
    $logoutStmt -> execute();
    
    header('Location: ../PrePages/login.php');
?>

