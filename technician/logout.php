<?php 
    require('checkCredentials.php');

    $cookie_name = "tech_session_id";

    setcookie($cookie_name, "", time() - (86400 * 30), "/");
    $logoutQuery = "delete from login_technician where session_id = '$curr_tech_session_id'";
    $logoutResult = $conn -> query($logoutQuery);

    header('Location: ../PrePages/login.php');
?>

