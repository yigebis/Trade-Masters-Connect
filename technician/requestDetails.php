<?php

    session_start();
    if (!isset($_SESSION['username']) || $_SESSION['role'] != 'technician'){
        header('Location: ../prepages/login.php');
        exit;
    }

    $username = $_SESSION['username'];

    $serverName = 'localhost';
    $userName = 'root';
    $password = '';
    $dbName = 'trade masters connect';
    $conn = new mysqli($serverName, $userName, $password, $dbName);

    if (!$conn){
        echo "Connection Failed.";
        exit;
    }
    
    if ($_SERVER['REQUEST_METHOD'] == 'GET'){
        if (!isset($_GET['date']) || !isset($_GET['techUsername']) || !isset($_GET['custUsername'])){
            header('Location: requests.php');
            exit;
            // echo $_GET['custUsername'].$GET['techUsername'];
        }

        $date = $_GET['date'];

        $sql = "select * from requests where Date = '$date' and TechUserName = '$username'";
        $result = $conn -> query($sql);

        $row = $result -> fetch_assoc();
        $custUserName = $row['CustUserName'];

        $sql = "select * from customer where UserName = '$custUserName'";
        $result = $conn -> query($sql);
        $customer = $result -> fetch_assoc();
    }
    else{
        // print_r($_POST);
        $custUsername = $_POST['custUsername'];
        $date = $_POST['date'];

        $sql = "update requests set status = ? where TechUserName='$username' and CustUserName='$custUsername' and Date='$date'";
        $stmt = $conn -> prepare($sql);

        if ($_POST['submit'] == 'Accept Request'){
            $status = 'A';
            $stmt -> bind_param("s", $status);
            $stmt -> execute();
            header('Location: accepted.php');
            exit;
        }
        else{
            $status = 'R';
            $stmt -> bind_param('s', $status);
            $stmt -> execute();
            header('Location: rejected.php');
            exit;
        }

        
    }
    

    

    

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Details</title>
    <style>
        #central{
            position: relative;
            top : 120px;
        }
        #central p{
            font-style: italic;
            font-size: 20px;
            color:black;
            background-color: whitesmoke;
            min-height: 40px;
            /* width: fit-content; */
        }
        #accept, #reject{
            background-color: green;
            height : 35px;
            font-size: 20px;
            border: none;
            outline: none;
            color: white;
            cursor: pointer;
            border-radius: 10px;
        }
        #reject{
            background-color: red;
            color: black;
        }
        
    </style>

</head>
<body>
    <?php require('header.php')?>
    
    <div id="central">
        <h1>Customer Name</h1>
        
        <p>
            <?php echo $customer['First Name'] . " " . $customer['Father Name'] . " " . $customer['Grand Father Name'] ?>
        </p>
        <h1>Job Title</h1>
        <p>
            <?php echo $row['Skill Title']?>
        </p>
        <h1>Your Location</h1>
        <p>
            <?php echo $row['Location']?>
        </p>
        <h1>Descrition</h1>
        <p>
            <?php echo $row['Description']?>   
        </p>
        <h1>Date</h1>
        <p>
            <?php echo $row['Date']?>
        </p>
        <form action="requestDetails.php" method="post">
            <input hidden name="custUsername" value="<?php echo htmlspecialchars($custUserName) ?>">
            <input hidden name="date" value="<?php echo $date ?>">
            <input id="accept" name="submit" type="submit" value="Accept Request">
            <input id="reject" name="submit" type="submit" value="Reject Request">
        </form>
        
    </div>

    <?php require('../template/footer.php') ?>
</body>
</html>