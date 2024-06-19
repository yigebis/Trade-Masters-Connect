<?php
    $serverName = "localhost";
    $userName = "root";
    $password = "";
    $dbName = "trade masters connect";

    $conn = new mysqli($serverName, $userName, $password, $dbName);
    // if ($conn) echo "success";
?>

<?php
    $userName = "";
    $password = "";
    if ($_SERVER["REQUEST_METHOD"] == "POST"){
        $userName = $_POST['username'];
        $password = $_POST['password'];
        echo $userName;
        echo $password;
        $hashed = password_hash($password, PASSWORD_BCRYPT);
        echo $hashed;
        $sql = "insert into technician_credentials values (?, ?)";
        $stmt = $conn -> prepare($sql);
        $stmt -> bind_param("ss", $userName, $hashed);
        $stmt -> execute();
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method="post" action="signup.php">
        <input name="username" type="text" placeholder="username">
        <input name="password" type="password" placeholder="Password">
        <input type="submit" name="submit" value="Submit">
    </form>
    <?php echo $userName . " " . $password . " " . $_SERVER["REQUEST_METHOD"];
    print_r($_POST);
    ?>
</body>
</html>