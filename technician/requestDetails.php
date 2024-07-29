<?php

    require('checkCredentials.php');
    
    if ($_SERVER['REQUEST_METHOD'] == 'GET'){
        if (!isset($_GET['date']) || !isset($_GET['techUsername']) || !isset($_GET['custUsername'])){
            header('Location: requests.php');
            exit;
            // echo $_GET['custUsername'].$GET['techUsername'];
        }

        $techSeen = "S";
        $date = $_GET['date'];
        $skillTitle = $_GET["skillTitle"];
        $techUserName = $_GET['techUsername'];
        $custUserName = $_GET['custUsername'];

        //updating the CustSeen status from database
        $sql = "update requests set TechSeen = ? , Date = ? where TechUserName = ? and CustUserName = ? and Date = ? and `Skill Title` = ?";
        $stmt = $conn -> prepare($sql);
        $stmt -> bind_param("ssssss", $custSeen, $date, $techUserName, $custUserName, $date, $skillTitle);
        $stmt -> execute();

        $sql = "select * from requests where Date = '$date' and TechUserName = '$username' and CustUserName = '$custUserName'";
        $result = $conn -> query($sql);

        $row = $result -> fetch_assoc();

        $sql = "select * from customer where UserName = '$custUserName'";
        $result = $conn -> query($sql);
        $customer = $result -> fetch_assoc();
        // print_r($customer);
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
                #accept,
        #reject {
            background-color: #14213d;
            height: 35px;
            font-size: 15px;
            color: #ffffff;
            border: none;
            padding: 10px 20px;
            border-radius: 10px;
            cursor: pointer;
            text-align: center;
        }

        #reject:hover {
            background-color: rgb(255, 0, 0);
            color: black;
        }
        #accept:hover {
            background-color: rgb(0, 255, 64);
            color: black;
        }
        .left-detail{
            
            display: flex;
            flex-direction: column;
            margin-right: 20%;
            position :relative; 
            top:100px;
            /* left : -7%; */
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin: 20px auto;
            max-width: 600px;
            transition: transform 0.3s ease;
        }
        .left-detail:hover{
            /* background-color: cadetblue; */
            transform: translateY(-5px);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .left-detail h2{
            margin-top: 0;
            color: #f8b418;
        }
        .left-detail span{
            font-weight: bold;
        }
        
    </style>

</head>
<body>
<?php require('../template/headerNoSearch.php') ?>
    <div class="left-detail">
        <h2><?php echo $row['Skill Title'] ?></h2>
        <p class="name"><span>User: </span><?php echo $customer['First Name'] . " " . $customer['Father Name'] . " " . $customer['Grand Father Name'] ?></p>
        <p class="job-date"><span>Date: </span><?php echo $row['Date'] ?></p>
        <p><span>Location: </span><?php echo $row['Location'] ?> </p>
        <p><span>Description: </span><?php echo $row['Description'] ?> </p>
 
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