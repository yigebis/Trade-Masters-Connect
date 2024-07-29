<?php
    require('checkCredentials.php');

    // $username = $_SESSION['username'];
    $date = $_GET['date'];

    $sql = "select * from requests where date = '$date'";
    $result = $conn -> query($sql);

    $row = $result -> fetch_assoc();
    $techUserName = $row['TechUserName'];

    $sql = "select * from Technician where username = '$techUserName'";
    $result = $conn -> query($sql);
    $technician = $result -> fetch_assoc();

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
        
    </style>

</head>
<body>
    <?php require('../template/headerNoSearch.php')?>

    <div id="central">
        <h1>Technician Name</h1>
        <p>
            <?php echo $technician['First Name'] . " " . $technician['Father Name'] . " " . $technician['Grand Father Name'] ?>
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
    </div>

    <?php require('../template/footer.php') ?>
</body>
</html>