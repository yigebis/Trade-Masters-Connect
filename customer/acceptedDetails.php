<?php 

    require('checkCredentials.php');

    if (!isset($_GET['date']) || !isset($_GET['techUserName']) || !isset($_GET['custUserName']) || !isset($_GET['skillTitle'])){
        header('Location : accepted.php');
        exit;
    }
    
    $custSeen = "S";
    $date = $_GET['date'];
    $skillTitle = $_GET["skillTitle"];
    $techUserName = $_GET['techUserName'];
    $custUserName = $_GET['custUserName'];

    // $sql = "select * from requests where TechUserName = ? and CustUserName = ? and Date = ?";
    // $stmt = $conn -> prepare($sql);
    // $stmt -> bind_param("sss", $custUserName, $techUserName, $date);

    // $stmt -> execute();
    // $row = $stmt -> fetch();

    //updating the CustSeen status from database
    $sql = "update requests set CustSeen = ? , Date = ? where TechUserName = ? and CustUserName = ? and Date = ? and `Skill Title` = ?";
    $stmt = $conn -> prepare($sql);
    $stmt -> bind_param("ssssss", $custSeen, $date, $techUserName, $custUserName, $date, $skillTitle);
    $stmt -> execute();

    $sql = "select * from requests where TechUserName = '$techUserName' and CustUserName = '$custUserName' and Date = '$date' and `Skill Title` = '$skillTitle'";
    $result = $conn -> query($sql);
    $row = $result -> fetch_assoc();

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
        #rate {
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

        #rate:hover {
            background-color: rgb(0, 255, 64);
            color: black;
        }

        .detail-card {
            display: flex;
            flex-direction: column;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin: 20px auto;
            max-width: 600px;
            transition: transform 0.3s ease;
        }

        .detail-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .detail-card h2, .detail-card h1 {
            color: #f8b418;
            margin-top: 0;
        }

        .detail-card p {
            font-style: italic;
            font-size: 20px;
            color: black;
            background-color: whitesmoke;
            padding: 10px;
            border-radius: 5px;
        }

        .detail-card span {
            font-weight: bold;
        }

        .detail-card h2 {
            margin-bottom: 5px;
        }
    </style>
</head>
<body>
    <?php require('../template/headerNoSearch.php')?>

    <div class="detail-card">
        <h1>Technician Details</h1>
        
        <h2>Name</h2>
        <p>
            <?php echo $technician['First Name'] . " " . $technician['Father Name'] . " " . $technician['Grand Father Name'] ?>
        </p>
        
        <h2>Job Title</h2>
        <p>
            <?php echo $row['Skill Title']?>
        </p>
        
        <h2>Location</h2>
        <p>
            <?php echo $row['Location']?>
        </p>
        
        <h2>Description</h2>
        <p>
            <?php echo $row['Description']?>   
        </p>
        
        <h2>Date</h2>
        <p>
            <?php echo $row['Date']?>
        </p>
        
        <h2>Contact Technician</h2>
        
        <h3>Phone</h3>
        <p>
            <?php echo $technician['Phone Number'] ?>
        </p>
        
        <h3>Email</h3>
        <p>
            <?php echo $technician['Email'] ?>
        </p>
        
        <button id="rate" onclick="rateTechnician('<?php echo $techUserName ?>', '<?php echo $row['Skill Title'] ?>', '<?php echo $row['Date'] ?>')">Rate technician if contacted</button>
    </div>

    <?php require('../template/footer.php') ?>
    <script src="requests.js"></script>
</body>
</html>  
  