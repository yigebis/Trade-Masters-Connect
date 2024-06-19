<?php

    session_start();

    if (!isset($_SESSION['username']) || $_SESSION['role'] != 'technician'){
        header('Location: ../prepages/login.php');
        exit;
    }

    $serverName = 'localhost';
    $userName = 'root';
    $password = '';
    $dbName = 'trade masters connect';
    $conn = new mysqli($serverName, $userName, $password, $dbName);

    if (!$conn){
        echo "Connection Failed.";
        exit;
    }

    $username = $_SESSION['username'];

    $sql = "select * from requests where TechUserName = '$username' and status = 'P'";
    $result = $conn -> query($sql);

?>

<!DOCTYPE html>
<html>
    <head>
        <title>New Requests</title>
        <link rel="stylesheet" href="home.css">
        <link rel="stylesheet" href="requests.css"
    </head>
    <body>
        <!-- Doing the header -->
        <?php
            require('../template/header.php');
        ?>

        <div id="central">
            <?php
                require('technicianNav.php');
            ?>
            <!-- The main contents -->
            <main>
                <ul id="pending-requests">
                    <h1>Pending Requests</h1>
                    
                    <?php
                        if ($result -> num_rows == 0){
                            echo "You don't have any new requests.";
                        }
                    ?>
                    <?php while ($row = $result -> fetch_assoc()){ ?>
                        <li onclick="viewRequestDetails('<?php echo $row['Date'] ?>', '<?php echo $username ?>', '<?php echo $row['CustUserName'] ?>')">
                            <?php 
                                // print_r($row);
                                $date = $row['Date'];
                                $date = DateTime :: createFromFormat('Y-m-d H:i:s', $date);
                                $date = $date -> format('F d Y h:i A');
                                $jobTitle = $row['Skill Title'];
                                $custUserName = $row['CustUserName'];
                                $sql = "select * from Customer where 1 = 1";
                                $subResult = $conn -> query($sql);
                                $details = $subResult -> fetch_assoc();
                                // print_r($details);
                                $firstName = $details['First Name'];
                                $fatherName = $details['Father Name'];
                                $gfName = $details['Grand Father Name'];
                            ?>
                            <div class="left-detail">
                                <p class="name"><?php echo $firstName ." ". $fatherName ." ". $gfName ?></p>
                                <p class="job-date">
                                    <span class="job-title"><?php echo $jobTitle ?></span>
                                    <span>&middot;</span>
                                    <span class="date">
                                        <?php 
                                            echo $date;
                                        ?>
                                    </span>   
                                </p>
                            </div>
                            <div class="photo-div">

                            </div>
                        </li>
                    <?php } ?>
                </ul>
            </main>
        </div>

        <?php
            require('../template/footer.php');
        ?>
        
        <script src="requests.js"></script>
    </body>
</html>